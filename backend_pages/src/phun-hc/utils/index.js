import {castArray, has, isArray, isPlainObject, map} from "lodash";
import nanoid from 'nanoid/non-secure'

/*
* https://github.com/EricSmekens/jsep
* https://github.com/donmccurdy/expression-eval
* https://mathjs.org/examples/expressions.js.html
* */

import * as expr_lib from 'expression-eval';

export const evaluate = (expr, scope) => expr_lib.eval(expr_lib.parse(expr), scope)

export const toFormulateSchema = (schema) => {
    if(isPlainObject(schema)) schema = castArray(schema)

    return schema.map((field, index) => {
        if(!has(field, 'rulesName') && field.label) field['rulesName'] = field.label

        map({
            validation: 'rules',
            validationName: ['rules-name', 'rulesName'],
            validationMessages: ['rules-messages', 'rulesMessages'],
        }, (val, key) => {
            let names = castArray(val)
            names.map(name => {
                if(has(field, name)) {
                    field[key] = field[name]
                    delete field[name]
                }
            })
        })

        if(isArray(field.children)) field.children = toFormulateSchema(field.children)

        return field
    })
}

export function setId (o, id, key = '__id') {
    if (!has(o, key)) {
        return Object.defineProperty(o, key, Object.assign(Object.create(null), { value: id || nanoid(9) }))
    }
    return o
}

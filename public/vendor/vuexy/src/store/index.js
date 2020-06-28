import Vue from 'vue'
import {defaultsDeep, mapKeys, replace} from 'lodash-es'
import Vuex from 'vuex'
import vueDeepSet  from 'vue-set-value'
import pathify from 'vuex-pathify'
import { createField, getField, updateField } from '@ttungbmt/vue-form'
import VuexVuexy from '../plugins/vuex-vuexy'

import moduleMap from './map/index'
import moduleForm from './form'
import moduleModal from './modal'
import moduleCat from './cat'

const modules = mapKeys({
    moduleMap, moduleForm, moduleModal, moduleCat
}, v => v.name)

export const createStore = options => {
    let innerOptions = defaultsDeep({
        plugins: [ pathify.plugin, VuexVuexy ],
        getters: {
            getField,
        },
        mutations: {
            updateField(state, field) {
                vueDeepSet(state, replace(field.path, '/', '.'), field.value)

                // updateField(state, {
                //     path: replace(field.path, '/', '.'),
                //     value: field.value,
                // });

            },
            createField,
            removeField(state, {path, value}){
                let fieldPath = replace(path, '/', '.'),
                    fieldValue = this.getIn(fieldPath).filter((v, k) => k !== value)

                vueDeepSet(state, fieldPath, fieldValue)
            },
        },
        modules
    }, options)


    return new Vuex.Store(innerOptions)
}


export default createStore()

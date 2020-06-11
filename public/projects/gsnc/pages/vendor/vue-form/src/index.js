import VueFormulate from '@braid/vue-formulate'
import {clone, map} from 'lodash-es'

import Input from './fields/Input'
import Box from './fields/Box'
import Select from './fields/Select'

const getComponents = () => {
    const formulate = clone(VueFormulate.defaults.components)
    let components = {},
        names = {
        'VueForm': 'FormulateForm',
        'FieldInput': 'FormulateInput',
    }

    map(names, (c, n) => {
        components[n] = formulate[c]
        components[n].name = n
    })

    return components
}

class VueForm {
    constructor() {

        this.options = {}
        this.defaults = {
            components: getComponents(),
        }
    }

    setCustomName(component, name) {
        component.name = name
        return component
    }

    install(Vue, options) {
        Vue.prototype.$vueform = this
        this.options = {
            ...this.defaults,
            components: {
                ...this.defaults.components,
                BText: Input,
                BBox: Box,
                BSelect: Select,
            }
        }

        for (let componentName in this.options.components) {
            Vue.component(componentName, this.options.components[componentName])
        }


        Vue.use(VueFormulate, {
            library: {
                'b-text': {
                    classification: 'text',
                    component: 'BText'
                },
                'b-radio': {
                    classification: 'text',
                    component: 'BBox'
                },
                'b-select': {
                    classification: 'text',
                    component: 'BSelect'
                }
            }
        })

    }
}

export default new VueForm()
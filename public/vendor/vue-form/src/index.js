import {BootstrapVue} from 'bootstrap-vue'
import draggable from 'vuedraggable'
import {has, mapKeys, replace} from 'lodash-es'
import vueDeepSet from 'vue-set-value'
import {registerComponents} from '@ttungbmt/vue-toolkit'
import VueValidation from './Validation'

import * as comps from './components'
import './style.scss'

const NAME = 'VueForm'

const components = {
    ...mapKeys(comps, v => v.name),
    'v-draggable': draggable,
}

const VueForm = {
    install(Vue, config = {}) {
        registerComponents(Vue, components)

        Vue.use(BootstrapVue)
        Vue.use(VueValidation)
    },
    NAME
}

export default VueForm

export function createField(state, payload) {
    let path = replace(payload.path, '/', '.')

    if (!has(state, path)) {
        vueDeepSet(state, path, null)
    }
}

export {getField, updateField} from 'vuex-map-fields'
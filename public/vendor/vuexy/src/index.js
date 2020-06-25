import Vue2Filters from 'vue2-filters'
import VueWait from 'vue-wait'
import VueLodash from 'vue-lodash'
import VueAxios from './plugins/axios'
import VuexyPlugin from './plugins/vuexy'
import lodash, {has, defaultsDeep} from 'lodash-es'
import pathify from 'vuex-pathify'
import Vuex from 'vuex'
import VueNoty from 'vuejs-noty'
import { getField, updateField } from 'vuex-map-fields';

import 'vuejs-noty/dist/vuejs-noty.css'

const NAME = 'Vuexy'

// --- Vuexy plugin ---
const Vuexy = {
    install(Vue, config = {}){
        Vue.use(VueAxios)
        Vue.use(VueLodash, { lodash })
        Vue.use(VueWait)
        Vue.use(Vue2Filters)
        Vue.use(VueNoty, {
            theme: 'nest'
        })

    },
    NAME
}


export const createStore = options => {
    let innerOptions = defaultsDeep({
        plugins: [ pathify.plugin, VuexyPlugin ],
        getters: {
            getField,
        },
        mutations: {
            updateField,
            createField,
        },
    }, options)


    return new Vuex.Store(innerOptions)
}

export function createField(state, { path, value }) {
    if (!has(state, path)) {
        this.setIn(path, null)
    }
}

export default Vuexy
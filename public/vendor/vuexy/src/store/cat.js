import {isPlainObject, map} from 'lodash-es'

export default {
    name: 'cat',
    namespaced: true,
    state: () => ({}),

    getters: {},

    actions: {},

    mutations: {
        initPageData(state) {
            let catData = window.pageData.cat
            if(isPlainObject(catData)) map(catData, (value, name) => state[name] = value)
        }
    },
}

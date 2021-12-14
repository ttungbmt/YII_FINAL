import {isPlainObject, map} from 'lodash-es'

export default {
    name: 'cat',
    namespaced: true,
    state: () => ({}),

    getters: {},

    actions: {},

    mutations: {
        init(state, payload) {
            if(isPlainObject(payload)) map(payload, (value, name) => state[name] = value)
        },
    },
}

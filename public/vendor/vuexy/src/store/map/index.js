import {defaults} from 'lodash-es'
import moduleConfig from './config'
import moduleLayers from './layers'
import moduleControls from './controls'
import moduleOptions from './options'

export default {
    name: 'map',
    namespaced: true,
    state: () => ({

    }),

    getters: {
        mapOptions(state){
            return defaults(state.config, state.options.map)
        }
    },

    actions: {

    },

    mutations: {

    },
    modules: {
        config: moduleConfig,
        layers: moduleLayers,
        controls: moduleControls,
        options: moduleOptions,
    }
}

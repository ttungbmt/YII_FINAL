import {map} from 'lodash-es'
import {latLngBounds, LatLngBounds} from 'leaflet'

export default {
    namespaced: true,
    state: () => ({
        center: [10.802842, 106.640002],
        zoom: 15,
    }),
    mutations: {
        setBounds(state, payload){
        },
        setCenter(state, payload){
            state.center = payload
        },
        setZoom(state, payload){
            state.zoom = payload
        },
        init(state, payload){
            map(payload, (v, name) => {
                state[name] = payload[name]
            })
        }
    }
}

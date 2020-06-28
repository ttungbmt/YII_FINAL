import {latLngBounds, LatLngBounds} from 'leaflet'

export default {
    namespaced: true,
    state: () => ({
        center: [10.802842, 106.640002],
        zoom: 15,
    }),
    mutations: {
        setBounds(state, payload){
            state.bounds = [
                [40.70081290280357, -74.26963806152345],
                [40.82991732677597, -74.08716201782228]
            ]

            // if(payload instanceof LatLngBounds){
            //
            //     // state.center = [40.70081290280357, -74.26963806152345]
            // }
        },
        setCenter(state, payload){
            state.center = payload
        },
        setZoom(state, payload){
            state.zoom = payload
        }
    }
}

import {omit, isArray, map} from 'lodash-es'

export default {
    namespaced: true,
    state: () => ([
        {
            control: "basemap",
            title: "Google",
            type: "tile",
            active: false,
            options: {
                url: "http://{s}.google.com/vt/lyrs={map}&x={x}&y={y}&z={z}",
                map: "m",
                subdomains: ["mt0", "mt1", "mt2", "mt3"],
                attribution: "Map data &copy; <a href='https://www.google.com/maps'>Google Maps</a>"
            }
        },
        {
            control: 'basemap',
            title: 'Mapbox',
            type: 'tile',
            active: true,
            options: {
                map: "mapbox.streets",
                url: "https://api.tiles.mapbox.com/v4/{map}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoidHR1bmdibXQiLCJhIjoiY2EzNDFhZjU4ZThkNzY5NTU3M2U1YWFiNmY4OTE3OWQifQ.Bo1ss5J4UjPPOjmq9S3VQw",
                attribution: "Map data &copy; <a href='http://mapbox.com'>Mapbox</a>"
            },
        },
        {
            control: "basemap",
            title: "OpenStreetMap",
            type: "tile",
            active: false,
            options: {
                url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                attribution: "&copy; <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a> contributors"
            }
        },
        {
            control: "basemap",
            title: "HCMGIS",
            type: "tile",
            active: false,
            options: {
                url: "https://pcd.hcmgis.vn/geoserver/gwc/service/wmts?service=wmts&request=GetTile&version=1.0.0&layer=hcm_map:hcm_map_all&tilematrixset=EPSG:900913&tilematrix=EPSG:900913:{z}&tilerow={y}&tilecol={x}&format=image%2Fjpeg",
                attribution: "Map data &copy; <a href='https://hcmgis.vn/'>HCMGIS</a>"
            }
        },
        {
            control: "basemap",
            title: "Ảnh hàng không",
            type: "tile",
            active: false,
            options: {
                url: "http://trueortho.hcmgis.vn/basemap/cache_lidar/{z}/{x}/{y}.jpg",
                attribution: "Map data &copy; <a href='https://hcmgis.vn/'>HCMGIS</a>"
            }
        },
        {
            control: "basemap",
            title: "Ảnh vệ tinh",
            type: "tile",
            active: false,
            options: {
                url: "http://{s}.google.com/vt/lyrs={map}&x={x}&y={y}&z={z}",
                map: "y",
                subdomains: ["mt0", "mt1", "mt2", "mt3"],
                attribution: "Map data &copy; <a href='https://www.google.com/maps'>Google Maps</a>"
            }
        },
    ]),
    getters: {
        getAll(state){
            return state.map(v => json2Component(v))
        }
    },
    mutations: {
        ['add'](state, payload){
            if(isArray(payload)){
                payload.map(v => state.push(v))
            } else {
                state.push(payload)
            }
        },
        ['init'](state, payload){
            map(payload, layer => {
                state.push(layer)
            })
        },
    }
}

const json2Component = (json) => {
    const {
        active: visible = false,
        title: name = 'None',
        type,
        control,
        options = {}
    } = json


    let props = {
        name,
        visible,
        'layer-type': control === 'basemap' ? 'base' : 'overlay',
        options: omit(options, ['url'])
    }

    if(type === 'wms'){
        props['base-url'] = options.url
    } else {
        props.url = options.url
    }

    switch (type) {
        case 'wms':
            props.component = 'l-wms-tile-layer'
            props.transparent = true
            props.format = 'image/png'
            break
        default:
            props.component = 'l-tile-layer'
            break
    }

    return props
}

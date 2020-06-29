<template>
    <div style="height: 350px;">
        <l-map :bounds="bounds" v-bind="mapOptions" >
            <component :is="i.component" v-for="(i, k) in controls" :key="k"></component>
            <component :is="i.component" v-for="(i, k) in layers" :key="k" v-bind="i"></component>
            <div>
                <l-marker :key="k" :lat-lng="i.latlng" v-for="(i, k) in cabenhs" v-bind="getMarkerOptions(i, k)">
                    <l-popup>
                        <div><span class="font-bold">Họ tên</span>: {{i.hoten}}</div>
                        <div><span class="font-bold">Ngày mắc bênh</span>: {{i.ngaymacbenh}}</div>
                    </l-popup>
                </l-marker>
            </div>
            <div>
                <l-circle :key="k" :lat-lng="i.latlng" :radius="distance" v-for="(i, k) in cabenhs"/>
            </div>
        </l-map>
    </div>
</template>
<script>
    import { LMap, LTileLayer, LMarker, LCircle, LGeoJson, LPopup, LControlLayers, LWMSTileLayer } from 'vue2-leaflet'
    import Bus from '../bus'
    import circle from '@turf/circle'

    import L from 'leaflet'
    import 'leaflet-extra-markers'
    import {reverse, clone, includes, uniqBy, map, pick} from 'lodash-es'
    import { get } from 'vuex-pathify'

    let extraLayers = map(window.pageData.map.layers, v => {
        return {
            component: 'l-wms-tile-layer',
            'layer-type': 'overlay',
            'base-url': v.options.url,
            layers: v.options.layers,
            visible: !!v.active,
            name: v.title,
            transparent: true, format: 'image/png',
            options: {
                cql_filter: v.options.cql_filter,
                zIndex: v.options.zIndex,
            }
        }
    })

    export default {
        name: 'p-map',
        data () {
            return {
                layers: this.$store.get('map/layers/getAll').concat(extraLayers),
                cabenhs: this.$store.get('form/getValue', 'cabenhs', []).map(v => {
                    return {
                        ...v,
                        latlng: clone(v.geometry.coordinates).reverse()
                    }
                }),
                distance: 200,
                selectedIndex: null,
                bounds: null,
            };
        },
        components: {
            LMap, LTileLayer, LMarker, LCircle, LGeoJson, LPopup, LControlLayers, 'l-wms-tile-layer': LWMSTileLayer
        },
        computed: {
            mapOptions: get('map/mapOptions'),
            controls: get('map/controls/getAll'),
        },
        mounted(){
            let bounds = this.getBounds(this.cabenhs.map(v => v.geometry.coordinates), 200)
            if(bounds){
                this.bounds = bounds
            }

            Vuexy.$on(`@map/SHOW_POPUP`, ({index}) => {
                this.selectedIndex = index
                this.setCenter(this.cabenhs[index].latlng)
            })
        },
        methods: {
            getMarkerOptions(item, index){
                return {
                    icon: index === this.selectedIndex ? this.getIcon('orange'): this.getIcon(),
                    options: {
                        zIndexOffset: index === this.selectedIndex ? 2 : 0
                    }
                }
            },
            getIcon(color = 'cyan'){
                return L.ExtraMarkers.icon({
                    icon: 'fa-circle',
                    markerColor: color,
                    prefix: 'fa'
                })
            },
            setCenter(center){
                this.mapOptions.center = center
            },
            getBounds(data, radius){
                return L.featureGroup(data.map(c => L.geoJSON(circle(c, radius/1000, {units: 'kilometers'})))).getBounds()
            },
            // getFeatures(){
            //     let filtered = uniqBy(this.cabenhs, (v) => JSON.stringify(v.geometry)).filter((v, k)=> v.geometry)
            //     return filtered.map(v => circle(v.geometry.coordinates, this.distance, {units: 'meters'}))
            // },
            // getGeoJSON(){
            //     let features = this.getFeatures()
            //         // .filter((v, k) => includes([0,1,4,5], k)), (v) => JSON.stringify(v.geometry))
            //     console.log(features)
            //     return union(features[1], features[4], features[5])
            // }
        }
    }
</script>

<style>
</style>
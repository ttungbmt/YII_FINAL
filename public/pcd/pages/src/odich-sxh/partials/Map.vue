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
    import { LMap, LTileLayer, LMarker, LCircle, LGeoJson, LPopup, LControlLayers } from 'vue2-leaflet'
    import Bus from '../bus'
    import circle from '@turf/circle'

    import L from 'leaflet'
    import 'leaflet-extra-markers'
    import {reverse, clone, includes, uniqBy} from 'lodash-es'
    import { get } from 'vuex-pathify'


    export default {
        name: 'p-map',
        data () {
            return {
                distance: 200,
                selectedIndex: null,
                bounds: null,
            };
        },
        components: {
            LMap, LTileLayer, LMarker, LCircle, LGeoJson, LPopup, LControlLayers
        },
        computed: {
            mapOptions: get('map/mapOptions'),
            controls: get('map/controls/getAll'),
            layers: get('map/layers/getAll'),
            cabenhs(){
                return this.$store.get('form/getValue', 'cabenhs', []).map(v => {
                    return {
                        ...v,
                        latlng: clone(v.geometry.coordinates).reverse()
                    }
                })
            }
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
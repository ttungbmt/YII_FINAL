<template>
    <div style="height: 350px;">
        <l-map v-bind="mapOptions">
            <l-tile-layer :url="url"></l-tile-layer>
            <div>
                <l-marker :key="k" :lat-lng="i.latlng" v-for="(i, k) in cabenhs" v-bind="getMarkerOptions(i, k)">
                    <l-popup>
                        <div><span class="font-bold">Họ tên</span>: {{i.hoten}}</div>
                    </l-popup>
                </l-marker>
            </div>
          <!--  <div>
                <l-geo-json :geojson="getGeoJSON()"/>
            </div>-->
            <l-circle :key="k" :lat-lng="i.latlng" :radius="distance" v-for="(i, k) in cabenhs"/>
        </l-map>
    </div>
</template>
<script>
    import { LMap, LTileLayer, LMarker, LCircle, LGeoJson, LPopup,  } from 'vue2-leaflet'
    import Bus from '../bus'
    import circle from '@turf/circle'
    // import union from '@turf/union'
    // import {feature} from '@turf/helpers'
    import L from 'leaflet'
    import 'leaflet-extra-markers'
    import {reverse, clone, includes, uniqBy} from 'lodash-es'
    import { get } from 'vuex-pathify'

    export default {
        name: 'p-map',
        data () {
            return {
                distance: 200,
                mapOptions: {
                    zoom: 15,
                    center: [10.802842, 106.640002],
                    style: 'height: 100%; width: 100%',
                    bounds: null,
                },
                url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                markerLatLng: [10.802842, 106.640002],
                selectedIndex: null
            };
        },
        components: {
            LMap, LTileLayer, LMarker, LCircle, LGeoJson, LPopup
        },
        computed: {
            cabenhs(){
                return this.$store.get('form.cabenhs').map(v => {
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
                this.mapOptions.bounds = bounds
            }

            Bus.$on(`@map/SHOW_POPUP`, ({index}) => {
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
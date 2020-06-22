<template>
    <div style="height: 350px;">
        <l-map v-bind="mapOptions">
            <l-tile-layer :url="url"></l-tile-layer>
            <div>
                <l-marker :key="k" :lat-lng="i.latlng" v-for="(i, k) in cabenhs"></l-marker>
            </div>
            <l-circle :key="k" :lat-lng="i.latlng" :radius="distance" v-for="(i, k) in cabenhs"/>
        </l-map>
    </div>
</template>
<script>
    import { LMap, LTileLayer, LMarker, LCircle } from 'vue2-leaflet'
    import circle from '@turf/circle'
    import L from 'leaflet'
    import {reverse, clone} from 'lodash-es'
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
                markerLatLng: [10.802842, 106.640002]
            };
        },
        components: {
            LMap, LTileLayer, LMarker, LCircle
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
        },
        methods: {
            getBounds(data, radius){
                return L.featureGroup(data.map(c => L.geoJSON(circle(c, radius/1000, {units: 'kilometers'})))).getBounds()
            }
        }
    }
</script>
<template>
    <div>
        <div class="mb-2" style="height: 400px;">
            <l-map v-bind="mapOptions" ref="map">
                <component :is="i.component" v-for="(i, k) in controls" :key="k"></component>
                <component :is="i.component" v-for="(i, k) in layers" :key="k" v-bind="i"></component>

                <l-feature-group ref="features">
                    <l-geojson :geojson="form.geometry" v-if="form.geometry"></l-geojson>
                </l-feature-group>
            </l-map>
        </div>
        <b-alert show dismissible class="m-2 border-0" variant="warning" v-if="!_.isEmpty(errors)">
            <ul class="m-0">
                <li v-for="i in errors">{{_.get(i, 0, '')}}</li>
            </ul>
        </b-alert>

        <slot v-bind:form="form"/>
    </div>

</template>
<script>
    import L from 'leaflet'
    import {isEmpty, clone, get} from 'lodash-es'
    import '@ttungbmt/vue-leaflet'
    import { get as pGet } from 'vuex-pathify'
    import $ from 'jquery'

    export default {
        name: 'page-to-dp',
        components: {
        },
        data() {
            return {
                ...window.pageData,
                layers: this.$store.get('map/layers/getAll'),
                errors: []
            }
        },
        computed: {
            mapOptions: pGet('map/mapOptions'),
            controls: pGet('map/controls/getAll'),
        },
        mounted(){
            $("#form-to-dp").submit(this.onSubmit)

            this.$nextTick(() => {
                const map = this.$refs.map.mapObject,
                    drawnItems = this.$refs.features.mapObject

                let geometry = this.form.geometry

                if(geometry) drawnItems.addLayer(L.geoJson(geometry))

                let drawControl = new L.Control.Draw({
                    edit: {
                        featureGroup: drawnItems
                    },
                    draw: {
                        polyline: false,
                        polygon: {
                            allowIntersection: false,
                            showArea:true
                        },
                        rectangle: false,
                        circle: false,
                        marker: false,
                        circlemarker: false,
                    }
                })

                map.addControl(drawControl);

                let popup =  L.popup()

                const addPopup = ({latlng}) => {
                    popup
                        .setLatLng(latlng)
                        .setContent('<b>Nhâp ranh từ lớp ranh tổ cũ</b>: <button id="btn-draw-to-dp">Vẽ</button>')
                        .openOn(map)

                    $('#btn-draw-to-dp').click(() => this.getRanhgioi(latlng))
                }

                map
                    .on(L.Draw.Event.CREATED, (event) => {
                        drawnItems.clearLayers()

                        let layer = event.layer;
                        drawnItems.addLayer(layer)
                        this.form.source = 1
                    })
                    .on('click', addPopup)
                    .on(L.Draw.Event.TOOLBAROPENED, function(event) {
                        map.off('click', addPopup)
                    })
                    .on(L.Draw.Event.TOOLBARCLOSED, function(event) {
                        map.on('click', addPopup)
                    })

            });
        },
        methods: {
            onSubmit(e){
                e.preventDefault()
                e.stopImmediatePropagation()
                this.errors = []
                let data = clone(this.form),
                    geometry = get(this.$refs.features.mapObject.toGeoJSON(), 'features.0.geometry')

                if(geometry) data.geom = geometry.type === 'MultiPolygon' ? geometry.coordinates[0] : geometry.coordinates

                $.post($(e.target).attr('action'), {DmToDp: data}, (data) => {
                    if(data.redirectUrl) {
                        window.location.href = data.redirectUrl
                        return null
                    }

                    if(data.errors) this.errors = data.errors
                })
            },
            getRanhgioi(latlng){
                $.post('/dm/to-dp/ranhgioi', {latlng: [latlng.lat, latlng.lng]}).then(({data}) => {
                    const drawItems = this.$refs.features.mapObject

                    drawItems.clearLayers()
                    drawItems.addLayer(L.geoJson(data));
                    this.form.source = 0
                })
            },
        },

    }
</script>









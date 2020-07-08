<template>
    <div>
        <div class="mb-2" style="height: 350px;">
            <l-map v-bind="mapOptions" ref="map">
                <component :is="i.component" v-for="(i, k) in controls" :key="k"></component>
                <component :is="i.component" v-for="(i, k) in layers" :key="k" v-bind="i"></component>

            </l-map>
        </div>
        <slot v-bind:form="form"/>
    </div>

</template>
<script>
    import L from 'leaflet'
    import {isEmpty} from 'lodash-es'
    import '@ttungbmt/vue-leaflet'
    import { get as pGet } from 'vuex-pathify'

    export default {
        name: 'page-to-dp',
        components: {
        },
        data() {
            return {
                ...window.pageData,
                layers: this.$store.get('map/layers/getAll')
            }
        },
        computed: {
            mapOptions: pGet('map/mapOptions'),
            controls: pGet('map/controls/getAll'),
        },
        mounted(){
            this.$nextTick(() => {
                const map = this.$refs.map.mapObject

                let drawnItems = new L.FeatureGroup();
                map.addLayer(drawnItems);
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

                map.on(L.Draw.Event.CREATED, function(event) {
                    let layer = event.layer;
                    drawnItems.addLayer(layer);
                });


                const addPopup = ({latlng}) => {
                    let popup =  L.popup()
                    popup
                        .setLatLng(latlng)
                        .setContent('<b>Nhâp ranh từ lớp ranh tổ cũ</b>: <button>Vẽ</button>')
                        .openOn(map)
                }

                map.on('click', addPopup)

                map.on('draw:drawstop', function(event) {
                    map.on('click', addPopup)
                }).on('draw:drawstart', function(event) {
                    map.off('click', addPopup)
                });






            });
        },
        methods: {
            onSubmit(){
                // this.$wait.start('thongke');
                // this.info = ''
                //
                // let data = this.form
                //
                // this.$http.post(window.location.href, data).then(({data}) => {
                //     this.fields = data.fields.map(v => {
                //         v.thAttr = function (value, key, item, type) {
                //             return {
                //                 'data-f-bold': true
                //             }
                //         }
                //
                //         return v
                //     })
                //     this.data = data.data
                //
                //     if(isEmpty(this.data)) this.info = 'Không có dữ liệu'
                //
                //     this.$wait.end('thongke');
                // }).catch((e) => {
                //     this.$wait.end('thongke');
                //     this.info = 'Error'
                // })
            },

        },

    }
</script>









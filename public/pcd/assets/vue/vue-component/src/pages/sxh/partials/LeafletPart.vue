<template>
    <div>
        <l-map id="map" ref="map" style="height: 80%; width: 100%" v-bind="mapOptions">
            <l-control-layers position="topright"></l-control-layers>
            <component
                :key="k"
                v-for="(l, k) in layerItems"
                v-bind:is="l.layerComponent"
                v-bind="l"
            />
            <l-feature-group ref="features" layer-type="overlay" name="Ca bệnh điều tra">
                <!--<l-marker :lat-lng="mapOptions.center"></l-marker>-->
            </l-feature-group>
            <l-control-locate/>
            <l-control-draw ref="drawControl"/>
        </l-map>
    </div>
</template>
<script>
    import { LMap, LTileLayer, LMarker, LControlLayers, LWMSTileLayer, LFeatureGroup } from 'vue2-leaflet'
    import { LGoogleLayer, LLocateControl, LControlDraw } from '../map'
    import { set, isEmpty } from 'lodash-es'
    import L from 'leaflet'

    export default {
        name: 'leaflet-part',
        components: {
            'l-map': LMap,
            'l-tile-layer': LTileLayer,
            'l-wms-tile-layer': LWMSTileLayer,
            [LGoogleLayer.name]: LGoogleLayer,
            'l-marker': LMarker,
            'l-control-layers': LControlLayers,
            'l-feature-group': LFeatureGroup,
            [LLocateControl.name]: LLocateControl,
            [LControlDraw.name]: LControlDraw,
        },
        computed: {
            layerItems() {
                let vueLeaflet = {
                    TileLayer: 'l-tile-layer',
                    WMSTileLayer: 'l-wms-tile-layer',
                    GoogleLayer: 'l-google-layer',
                }

                return this.tileProviders.map(({type, title, checked = false, component}) => {
                    const {url, name, cql_filter, ...options} = component
                    const layerComponent = vueLeaflet[name] ? vueLeaflet[name] : 'l-wms-tile-layer'
                    let store = {
                        ...options,
                        'layer-type': type ? type : 'overlay',
                        name: title,
                        visible: checked,
                        url,
                        'base-url': url,
                        layerComponent
                    }
                    if (cql_filter) set(store, 'options.cql_filter', cql_filter)

                    return store
                });
            }
        },
        data() {
            return {
                latlng: [],
                tileProviders: [],
                mapOptions: {
                    zoom: 14,
                    center: [10.801585, 106.650736],
                }

            };
        },
        mounted() {
            this.tileProviders = window.appData.map.layers
            this.mapOptions = {
                ...this.mapOptions,
                ...window.appData.map.mapOptions
            }
            this.$nextTick(() => {
                let markerLatlng = window.appData.map.marker.latlng,
                    map = this.$refs.map.mapObject,
                    featureGroup = this.$refs.features.mapObject,
                    options = {
                        ...this.$refs.drawControl.mapObject.options,
                        edit: {
                            featureGroup
                        },
                    }

                map.removeControl(this.$refs.drawControl.mapObject)
                this.$refs.drawControl.mapObject = new L.Control.Draw(options)
                map.addControl(this.$refs.drawControl.mapObject)

                if(!isEmpty(markerLatlng)){
                    featureGroup.addLayer(L.marker(markerLatlng))
                    map.panTo(markerLatlng)
                }

                map
                    .on(L.Draw.Event.CREATED, (event) => {
                        let layer = event.layer;
                        featureGroup.clearLayers()
                        featureGroup.addLayer(layer);
                        let latlng = layer.getLatLng()
                        this.$store.commit('UPDATE_LATLNG', layer.getLatLng())
                    })
                    .on(L.Draw.Event.EDITED, ({layers}) => {
                        layers.eachLayer(l => {
                            this.$store.commit('UPDATE_LATLNG', l.getLatLng())
                        })
                    });
            })
        }
    }
</script>
<style lang="css" scoped>
    #map {
        height: 400px !important;
    }
</style>
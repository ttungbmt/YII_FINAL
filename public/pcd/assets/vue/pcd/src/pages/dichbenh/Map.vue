<template>
    <l-map ref="map" style="height: 500px" v-bind="mapOptions">
        <l-control-layers position="topright"></l-control-layers>
        <l-tile-layer
                v-for="l in tileProviders"
                :key="l.name"
                :name="l.name"
                :visible="l.visible"
                :url="l.url"
                layer-type="base"/>

        <l-control position="bottomleft">
            <div class="leaflet-legend info legend">
                <div v-for="l in range">
                    <i :style="'background:'+l.color"></i>: {{l.label}}
                </div>
            </div>
        </l-control>

        <l-layer-group ref="labelGroup" name="Label" layer-type="overlay">
            <l-marker :lat-lng="f.center" v-for="f in ranh_hc">
                <l-icon
                        :iconAnchor="[f.tenquan.length*3.5, 0]"
                        class-name="label-poly">
                    <div>{{f.tenquan}}</div>
                </l-icon>
            </l-marker>
        </l-layer-group>

        <l-geo-json
                name="Ranh quận" layer-type="overlay"
                :geojson="ranh_hc.map(v => v.geometry)"
                :optionsStyle="styles"
        >
        </l-geo-json>

     <!--   <l-choropleth-layer
                v-if="stat"
                :geojson="{type: 'FeatureCollection', features: ranh_hc.map(({geometry, ...v}) => ({type: 'Feature', properties: v, geometry}))}"
                :data="stat"
                idKey="maquan"
                geojsonIdKey="maquan"
                :value="value"
        >

        </l-choropleth-layer>-->


    </l-map>
</template>

<script>
    import L from 'leaflet'
    import { LMap, LTileLayer, LMarker, LControlLayers, LControl, LGeoJson, LLayerGroup, LPopup, LIcon } from 'vue2-leaflet'
    import { get, isEmpty, find, sumBy, max, min, round } from 'lodash-es'

    // import 'leaflet-easyprint'
    // import { InfoControl, ReferenceChart, ChoroplethLayer } from 'vue-choropleth'

    Vue.component('l-map', LMap);
    Vue.component('l-tile-layer', LTileLayer);
    Vue.component('l-marker', LMarker);
    Vue.component('l-control-layers', LControlLayers)
    Vue.component('l-control', LControl)
    Vue.component('l-geo-json', LGeoJson)
    Vue.component('l-marker', LMarker)
    Vue.component('l-layer-group', LLayerGroup)
    Vue.component('l-popup', LPopup)
    Vue.component('l-icon', LIcon)


    export default {
        props: ['resp'],
        // components: {
        //     'l-info-control': InfoControl,
        //     'l-reference-chart': ReferenceChart,
        //     'l-choropleth-layer': ChoroplethLayer
        // },

        data() {
            return {
                range: [],
                stat: [],
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                mapOptions: {
                    preferCanvas: true,
                    center: [10.801103, 106.649921],
                    zoom: 10
                },
                tileProviders: [
                    {
                        name: 'None',
                        visible: true,
                        url: ''
                    },
                    {
                        name: 'OpenStreetMap',
                        visible: false,
                        url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
                    },
                ],
                ranh_hc: window.ranh_hc.map(({geometry, center, ...v}) => ({
                    ...v,
                    center: JSON.parse(center),
                    geometry: JSON.parse(geometry)
                })),
                styles: {
                    weight: 1,
                    dashArray: '3',
                    color: '#03a4ec',
                    fillOpacity: 0.1
                },
                value: {
                    key: "count",
                    metric: "%"
                },
                info: {}
            };
        },
        mounted() {
            this.$nextTick(() => {
                this.$map = this.$refs.map.mapObject
                this.$printer = L.easyPrint({
                    sizeModes: ['Current', 'A4Landscape', 'A4Portrait'],
                    filename: 'my-map',
                    exportOnly: true,
                    hideControlContainer: true
                }).addTo(this.$map)

                this.$info = L.control();
                this.$info.onAdd = function (map) {
                    this._div = L.DomUtil.create('div', 'info');
                    this.update();
                    return this._div;
                }

                this.$info.update = function (props) {
                    if(props) this._div.innerHTML = `<b>${props.tenquan}</b>: ${props.count}`
                    return ''
                }
                this.$info.addTo(this.$map)
            })
        },
        methods: {
            exportMap(){
                this.$printer.printMap('CurrentSize', 'MyManualPrint')
            },
            highlightFeature(e){
                let layer = e.target

                layer.setStyle({
                    weight: 3,
                    color: '#03a4ec',
                    dashArray: '',
                    fillOpacity: 0.7
                })
                this.$info.update(layer.feature.properties)
            },
            resetHighlight(e){
                this.$chart.resetStyle(e.target);
                this.$info.update()
            }
        },
        watch: {
            resp: function (val) {
                if (!isEmpty(val) && val){
                    let map = this.$refs.map.mapObject,
                        tmp = [],
                        statFeatures = this.ranh_hc.map(({geometry, ...v}) => {
                        let count = sumBy(get(find(val, {maquan: v.maquan}), 'thangs'), 'count')
                        v.count = count
                        tmp.push(count)
                        return {type: 'Feature', geometry, properties: v}
                    })

                    let dis = round((max(tmp)-min(tmp))/5),
                        r0 = min(tmp),
                        r1 = r0+dis,
                        r2 = r1+dis,
                        r3 = r2+dis,
                        r4 = r3+dis

                    if(this.$legend){
                        this.$map.removeControl(this.$legend)
                    }
                    this.$legend = L.control({position: 'bottomright'});
                    this.$legend.onAdd = function (map) {
                        let div = L.DomUtil.create('div', 'info legend'),
                            labels = [
                                `<i style="background:#fff7ec"></i> ${r0} - ${r1}`,
                                `<i style="background:#fdd49e"></i> ${r1} - ${r2}`,
                                `<i style="background:#fc8d59"></i> ${r2} - ${r3}`,
                                `<i style="background:#d7301f"></i> ${r3} - ${r4}`,
                                `<i style="background:#7f0000"></i> ${r4}`,
                            ]

                        div.innerHTML = labels.join('<br>');
                        return div;
                    };

                    this.$legend.addTo(this.$map);


                    statFeatures = {type: 'FeatureCollection', features: statFeatures}

                    if(this.$chart){
                        map.removeLayer(this.$chart)
                    }

                    this.$chart = L.choropleth(statFeatures, {
                        valueProperty: 'count', // which property in the features to use
                        scale: ["#fff7ec", "#fdd49e", "#fc8d59", "#d7301f", "#7f0000"], // chroma.js scale - include as many as you like
                        steps: 5, // number of breaks or steps in range
                        mode: 'q', // q for quantile, e for equidistant, k for k-means
                        style: {
                            weight: 2,
                            opacity: 1,
                            color: 'white',
                            dashArray: '3',
                            fillOpacity: 0.7,
                        },
                        onEachFeature: (feature, layer) => {
                            layer.on({
                                mouseover: this.highlightFeature,
                                mouseout: this.resetHighlight,
                            });
                        }
                    })
                    this.$chart.addTo(map)
                }
            }
        }
    }
</script>

<style>
    .label-poly {
        white-space: nowrap;
        text-shadow: 0 0 0.1em white, 0 0 0.1em white,
        0 0 0.1em white, 0 0 0.1em white, 0 0 0.1em;
        color: #e21d60;
        font-weight: bold;
    }

    .leaflet-legend {
        background: #fff;
        border-radius: 3px;
        padding: 2px 5px;
    }

    .info { padding: 6px 8px; font: 14px/16px Arial, Helvetica, sans-serif; background: white; background: rgba(255, 255, 255, 0.8); box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); border-radius: 5px; }

    .info h4 { margin: 0 0 5px; color: #777; }

    .legend { text-align: left; line-height: 18px; color: #555; }

    .legend i { width: 18px; height: 18px; float: left; margin-right: 8px; opacity: 0.7; }
</style>
<template>
    <div style="display: none;">
        <slot v-if="ready"></slot>
    </div>
</template>

<script>
    import L, { tileLayer } from 'leaflet'
    import 'leaflet.gridlayer.googlemutant'
    import { findRealParent, propsBinder } from 'vue2-leaflet'

    const props = {
        options: {
            type: Object,
            default() {
                return {};
            },
        },
        apikey: {
            type: String,
            default() { return 'AIzaSyCLabehdilVD5BsAyl_Ogd9XJnmzaBenb8' },
        },
        type: {
            type: String,
            default() { return 'roadmap'},
        },
        tiled: {
            type: Boolean,
            default() { return true},
        },
        name: {
            type: String,
            default: 'Google Maps'
        },
        layerType: {
            type: String,
            default: 'base'
        },
        visible: {
            type: Boolean,
            default: true,
        },
    };
    export default {
        name: 'l-google-layer',
        props,
        data() {
            return {
                ready: false,
            };
        },
        mounted() {
            let type = this.convertType(this.type)

            this.mapObject = this.tiled ?
                tileLayer(`http://{s}.google.com/vt/lyrs=` + type + `&x={x}&y={y}&z={z}`, {
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '&copy; Google Maps',
                    ...this.options
                }) :
                gridLayer.googleMutant(this.options);

            L.DomEvent.on(this.mapObject, this.$listeners);
            propsBinder(this, this.mapObject, props);
            // if (!(typeof google === 'object' && typeof google.maps === 'object')) {
            //     let googleapisscript = document.createElement('script');
            //     googleapisscript.setAttribute('src', 'https://maps.googleapis.com/maps/api/js?key=' + this.apikey);
            //     document.head.appendChild(googleapisscript);
            // }
            this.ready = true;
            this.parentContainer = findRealParent(this.$parent);
            this.parentContainer.addLayer(this, !this.visible);
        },
        beforeDestroy() {
            this.parentContainer.removeLayer(this);
        },
        methods: {
            addLayer(layer, alreadyAdded) {
                if (!alreadyAdded) {
                    this.mapObject.addLayer(layer.mapObject);
                }
            },
            removeLayer(layer, alreadyRemoved) {
                if (!alreadyRemoved) {
                    this.mapObject.removeLayer(layer.mapObject);
                }
            },
            convertType(mapType) {
                /*
                 h = roads only
                 m = standard roadmap
                 p = terrain
                 r = somehow altered roadmap
                 s = satellite only
                 t = terrain only
                 y = hybrid
                 */

                switch (mapType) {
                    case 'roadmap':
                        return 'm';
                    case 'satellite':
                        return 's';
                    case 'terrain':
                        return 't';
                    case 'hybrid':
                        return 'y';
                    default:
                        return mapType;
                }
            }
        },
    };
</script>
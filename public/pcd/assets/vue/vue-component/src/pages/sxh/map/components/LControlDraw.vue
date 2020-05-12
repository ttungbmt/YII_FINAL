<template>
    <div style="display: none;">
        <slot v-if="ready"></slot>
    </div>
</template>

<script>
    import L, { DomEvent } from 'leaflet'
    import { findRealParent, propsBinder } from 'vue2-leaflet'
    import 'leaflet-draw'
    import leafletMixin from './mixin'

    const props = {
        featureGroup: {
            type: Object,
            default() { return L.featureGroup(); },
        },
        position: {
            type: String,
            default() { return 'topright'; },
        },
        options: {
            type: Object,
            default() { return {
                draw: {
                    circlemarker: false,
                    circle: false,
                    polyline: false,
                    rectangle: false,
                    polygon: false,
                }
            }; },
        },
        visible: {
            type: Boolean,
            custom: true,
            default: true
        }
    }

    export default {
        name: 'l-control-draw',
        mixins: [leafletMixin],
        props,
        data() {
            return {
                ready: false
            }
        },
        mounted() {
            this.mapObject = new L.Control.Draw(this.getOptions());
            DomEvent.on(this.mapObject, this.$listeners);
            propsBinder(this, this.mapObject, props);
            this.ready = true;
            this.parentContainer = findRealParent(this.$parent);
            this.mapObject.addTo(this.parentContainer.mapObject, !this.visible);
        },
        beforeDestroy() {
            this.parentContainer.removeLayer(this);
        },
        methods: {
            getOptions(){
                return {
                    position: this.position,
                    // edit: {
                    //     // featureGroup: this.featureGroup,
                    // },
                    ...this.options
                }
            }
        }
    }
</script>

<style lang="scss">

</style>
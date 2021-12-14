<template>
    <div style="display: none;">
        <slot v-if="ready"></slot>
    </div>
</template>

<script>
    import L, { DomEvent } from 'leaflet'
    import { findRealParent, propsBinder } from 'vue2-leaflet'
    import 'leaflet.locatecontrol'

    const props = {
        position: {
            type: String,
            default() { return 'bottomright'; },
        },
        options: {
            type: Object,
            default() { return {}; },
        },
        visible: {
            type: Boolean,
            custom: true,
            default: true
        }
    }
    export default {
        name: 'l-control-locate',
        props,
        data() {
            return {
                ready: false
            }
        },
        beforeDestroy() {
            this.parentContainer.removeLayer(this);
        },
        mounted() {
            this.mapObject = L.control.locate(this.getOptions());
            DomEvent.on(this.mapObject, this.$listeners);
            propsBinder(this, this.mapObject, props);
            this.ready = true;
            this.parentContainer = findRealParent(this.$parent);
            this.mapObject.addTo(this.parentContainer.mapObject, !this.visible);
        },
        methods: {
            getOptions(){
                return {
                    position: this.position,
                    ...this.options
                }
            }
        }
    }
</script>

<style>
    @import "~leaflet.locatecontrol/dist/L.Control.Locate.css";
</style>
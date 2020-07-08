import Vue from 'vue'

import { LMap, LTileLayer, LMarker, LCircle, LGeoJson, LPopup, LControlLayers, LWMSTileLayer, LFeatureGroup } from 'vue2-leaflet'
import LDrawToolbar from 'vue2-leaflet-draw-toolbar'

Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);
Vue.component('l-cirlce', LCircle);
Vue.component('l-geojson', LGeoJson);
Vue.component('l-feature-group', LFeatureGroup);
Vue.component('l-popup', LPopup);
Vue.component('l-control-layers', LControlLayers);
Vue.component('l-wms-tile-layer', LWMSTileLayer);
Vue.component('l-draw-toolbar', LDrawToolbar);

export {
    LMap, LTileLayer, LMarker, LCircle, LGeoJson, LPopup, LControlLayers, LWMSTileLayer
}
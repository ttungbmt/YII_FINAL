import Vue from 'vue'
import VueResource from 'vue-resource'
import Map from './Map'
import BtnExport from './BtnExport'

Vue.use(VueResource)

Vue.component('btn-export', BtnExport)
Vue.component('v-map', Map)
Vue.component('v-app', {
    template: '<div><slot></slot></div>',
})

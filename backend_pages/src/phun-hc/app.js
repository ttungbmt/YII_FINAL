import Vue from 'vue'
import './plugins'
import VueFormulate from '@braid/vue-formulate'
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'
import VueWait from 'vue-wait'
import VueFormulateExtended from './VueFormulateExtended'

import vi from './vi'
import './themes/snow.scss'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import './components'

Vue.use(VueFormulate, {
    plugins: [vi, VueFormulateExtended],
    locale: 'vi'
})
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueWait)

Vue.config.productionTip = false

;(function () {
    let app = new Vue({
        el: '#page-app',
        wait: new VueWait(),
    })
}.call(window))

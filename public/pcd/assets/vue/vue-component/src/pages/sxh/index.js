import '@babel/polyfill'
import Vue from 'vue'
import VueWait from 'vue-wait'


// import Vuex from 'vuex'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import FormPlugin from './form/FormPlugin'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import store from './store'
import './components'
import './filters'

Vue.config.devtools = true;
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(FormPlugin)
Vue.use(window.Vuex)
Vue.use(VueWait)


$(function () {
    let app = new Vue({
        el: '#vueApp',
        wait: new VueWait({
            useVuex: true,
        }),
        store,
    })
})



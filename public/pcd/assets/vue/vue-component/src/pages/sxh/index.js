import '@babel/polyfill'
import Vue from 'vue'
// import Vuex from 'vuex'

import BootstrapVue from 'bootstrap-vue'
import FormPlugin from './form/FormPlugin'
import store from './store'
import './components'
import './filters'

Vue.config.devtools = true;
Vue.use(BootstrapVue)
Vue.use(FormPlugin)
Vue.use(window.Vuex)

$(function () {
    let app = new Vue({
        el: '#vueApp',
        store
    })
})



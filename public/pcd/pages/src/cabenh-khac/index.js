import Vue from 'vue'
import PageCabenhKhac from './Page'
import {VuexForm} from '@ttungbmt/vuex-form'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import store from './store'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VuexForm)

const pageApp = new Vue({
    el: '#page-app',
    store,
    components: {
        PageCabenhKhac
    }
})
import Vue from 'vue'
import Page from './Page'
import VueFormulate from '@braid/vue-formulate'
import {BootstrapVue} from 'bootstrap-vue'


// import '@braid/vue-formulate/dist/snow.css'
import './style.scss'
import VueForm from '@ttungbmt/vue-form'

Vue.use(BootstrapVue)
Vue.use(VueForm)



let pageApp = new Vue({
    el: '#pageApp',
    data: {
        pageData: window.pageData
    },
    components: {
        [Page.name]: Page
    }
})
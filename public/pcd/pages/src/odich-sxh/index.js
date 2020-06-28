// import Vue from 'vue'
// import Page from './Page.vue'
// import Vuexy from '@ttungbmt/vuexy'
// import VueForm from '@ttungbmt/vue-form'
// import VueWait from 'vue-wait'
//
// import store from './store'
// import './style.scss'
//
// Vue.use(VueForm)
// Vue.use(Vuexy)
//
// Vue.config.productionTip = false
//
// let vueApp = new Vue({
//     el: '#page-app',
//     store,
//     wait: new VueWait(),
//     data:{
//
//     },
//     components: {
//         [Page.name]: Page
//     }
// })
//


import Vue from 'vue'
import {createVuexy} from '@ttungbmt/vuexy'
import Page from './Page.vue'
import schema from './schema'

import './style.scss'

Vue.config.productionTip = false

window.Vuexy = new createVuexy()

Vuexy.liftOff({
    el: '#page-app',
    components: {
        [Page.name]: Page
    },
    created() {
        this.$store.commit('cat/initPageData')
        this.$store.commit('form/init', {
            values: window.pageData.form,
            schema
        })
    }
})


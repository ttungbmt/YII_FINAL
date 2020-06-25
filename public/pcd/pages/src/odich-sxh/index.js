import Vue from 'vue'
import Page from './Page.vue'
import Vuexy from '@ttungbmt/vuexy'
import VueForm from '@ttungbmt/vue-form'
import VueWait from 'vue-wait'

import store from './store'
import './style.scss'

Vue.use(VueForm)
Vue.use(Vuexy)

Vue.config.productionTip = false

let vueApp = new Vue({
    el: '#page-app',
    store,
    wait: new VueWait(),
    data:{

    },
    components: {
        [Page.name]: Page
    }
})


import Vue from 'vue'
import Vue2Filters from 'vue2-filters'
import VueWait from 'vue-wait'
import VueLodash from 'vue-lodash'
import VueAxios from './plugins/axios'
import lodash from 'lodash-es'
import Vuex from 'vuex'
import VueNoty from 'vuejs-noty'
// import PortalVue from 'portal-vue'
// import AsyncComputed from 'vue-async-computed'
import VueForm from '@ttungbmt/vue-form'
import Vuexy from './Vuexy'
import 'vuejs-noty/dist/vuejs-noty.css'


// --- Vuexy plugin ---
const VuexyPlugin = {
    install(Vue, config = {}){
        Vue.use(VueAxios)
        Vue.use(VueLodash, { lodash })
        Vue.use(VueWait)
        Vue.use(Vue2Filters)
        Vue.use(VueNoty, {
            theme: 'nest'
        })
        // Vue.use(PortalVue)
        // Vue.use(AsyncComputed)

    },
}

export const createVuexy = (config) => {
    Vue.use(VuexyPlugin)
    Vue.use(VueForm)

    return new Vuexy(config)
}


export default Vuexy
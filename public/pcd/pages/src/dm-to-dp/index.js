import Vue from 'vue'
import {createVuexy} from '@ttungbmt/vuexy'
import Page from './Page.vue'

Vue.config.productionTip = false

window.Vuexy = new createVuexy()
Vuexy.liftOff({
    el: '#page-app',
    components: {
        [Page.name]: Page
    },
    created(){
        this.$store.dispatch('map/builder', window.pageData.map)
    }
})

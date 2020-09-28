import Vue from 'vue'
import {createVuexy} from '@ttungbmt/vuexy'
import Page from './Page.vue'
import './style.scss'

Vue.config.productionTip = false

window.Vuexy = new createVuexy()
Vuexy.liftOff({
    el: '#page-app',
    components: {
        [Page.name]: Page
    },
    created() {
        this.$store.commit('cat/init', {...window.pageData.cat, px: []})
    }
})

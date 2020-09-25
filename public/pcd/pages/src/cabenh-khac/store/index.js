import Vuex from 'vuex'
import Vue from 'vue'
import {createStore} from '@ttungbmt/vuex-toolkit'

import form from './modules/form'

Vue.use(Vuex)

export default createStore({
    modules: {
        form,
    }
})

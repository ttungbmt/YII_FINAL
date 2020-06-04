import '@babel/polyfill'
import Vue from 'vue'
import VueResource from 'vue-resource'
import * as components from './components';
import * as filters from './filters';
import * as mixins from './mixins'

import 'jquery-serializeobject';


if (typeof Vue !== 'undefined') {
    Vue.use(VueResource)

    for (const name in filters) {
        Vue.filter(name, filters[name])
    }

    for (const name in components) {
        Vue.component(name, components[name])
    }
}

export {
    mixins
}

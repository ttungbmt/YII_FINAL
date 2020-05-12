import Vue2Filters from 'vue2-filters'
import VueResource from 'vue-resource'
import LaddaComponent from 'vue-ladda'
import VueTippy, { TippyComponent } from "vue-tippy"
import NotyPlugin from './plugins/NotyPlugin'
import LodashPlugin from './plugins/LodashPlugin'
import VeeValidatePlugin from './plugins/VeeValidatePlugin'

import * as inputs from './inputs'
import * as mixins from './mixins'
import * as directives from './directives'
import * as components from './components'

import { map } from 'lodash-es'

export default {
    install(Vue, options) {
        Vue.use(Vue2Filters)
        Vue.use(VeeValidatePlugin)
        Vue.use(LodashPlugin)
        Vue.use(VueResource)
        Vue.use(VueTippy)
        Vue.use(NotyPlugin)

        Vue.component("tippy", TippyComponent);
        Vue.component('v-ladda', LaddaComponent)

        map(components, component => Vue.component(component.name, component))
        // Register Inputs
        map(inputs, component => Vue.component(component.name, component))
        map(mixins, fns => Vue.mixin(fns))
        map(directives, directive => Vue.directive(directive.name, directive))
    }
}

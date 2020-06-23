import Page from './Page.vue'
import Vuexy from '@ttungbmt/vuexy'
import VueWait from 'vue-wait'
import draggable from 'vuedraggable'

import Heading from './components/Heading.vue'
import Grid from './components/Grid.vue'
import Row from './components/Row.vue'
import Table from './components/Table.vue'
import Html from './components/Html.vue'
import Field from './components/Field.vue'
import Date from './components/fields/Date'
import Editor from './components/fields/Editor'
import List from './components/List'

import store from './store'
import './style.scss'

Vue.use(Vuexy)

Vue.component(Heading['name'], Heading)
Vue.component(Grid['name'], Grid)
Vue.component(Row['name'], Row)
Vue.component(Table['name'], Table)
Vue.component(Html['name'], Html)
Vue.component(Field['name'], Field)
Vue.component(Date['name'], Date)
Vue.component(Editor['name'], Editor)
Vue.component(List['name'], List)

Vue.component('v-draggable', draggable)

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


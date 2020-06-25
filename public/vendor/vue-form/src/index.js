import { BootstrapVue } from 'bootstrap-vue'
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

const NAME = 'VueForm'

const VueForm = {
    install(Vue, config = {}){
        Vue.use(BootstrapVue)

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

    },
    NAME
}


export default VueForm
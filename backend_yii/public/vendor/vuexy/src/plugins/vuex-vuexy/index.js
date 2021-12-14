import {get, has, replace} from 'lodash-es'
import vueDeepSet  from 'vue-set-value'

export default (store) => {
    store.setIn = (path, value) => vueDeepSet(store.state, path, value)
    store.getIn = (path, value, defaultValue) => get(store.state, path, defaultValue)
    store.has = (path, value, defaultValue) => has(store.state, replace(path, '/', '.'), defaultValue)
}
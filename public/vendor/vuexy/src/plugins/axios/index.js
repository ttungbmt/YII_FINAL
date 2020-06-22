import axios from 'axios'

export default {
    install(Vue){
        const initOptions = {
            headers: {'X-Requested-With': 'XMLHttpRequest'},
        }
        const service = axios.create(initOptions)
        Vue.prototype.$http = service
    }
}
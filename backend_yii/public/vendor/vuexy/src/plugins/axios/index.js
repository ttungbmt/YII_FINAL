import axios from 'axios'

export default {
    install(Vue){
        const initOptions = {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.head.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
        }
        const instance = axios.create(initOptions)

        instance.interceptors.response.use(
            response => response,
            error => {
                const { status } = error.response

                // Show the user a 500 error
                if (status >= 500) {

                }

                // Handle Session Timeouts
                if (status === 401) {

                }

                // Handle Forbidden
                if (status === 403) {

                }

                // Handle Token Timeouts
                if (status === 419) {

                }

                return Promise.reject(error)
            }
        )

        Vue.prototype.$http = instance
    }
}
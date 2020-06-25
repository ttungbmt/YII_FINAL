import {createStore} from '@ttungbmt/vuexy'

const options = {
    mutations: {
    },
    state: {
        cat: window.pageData.cat,
        form: {
            ...window.pageData.form,
        },
        schema: [

        ]
    },
}

export default createStore(options)

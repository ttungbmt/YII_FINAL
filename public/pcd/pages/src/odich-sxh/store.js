import {isNil, cloneDeep} from 'lodash-es'
import {createStore} from '@ttungbmt/vuexy'

import Bus from './bus'

const options = {
    mutations: {
        updateForm(state, {path, value}){
            this.setIn(path, cloneDeep(value))
        },
        deleteForm(state, {path, value}){
            this.setIn(path, this.getIn(path).filter((v, k) => k !== value))
        },
        resetModal(state, {path, value = {}}){
            this.setIn(path, value)
        },
        updateModal(state, {path, value}){
            this.setIn(path, value)
        },
    },
    state: {
        cat: window.pageData.cat,
        form: {
            ...window.pageData.form,
        },
        formModal: {

        },
     },
}

export default createStore(options)

import {get} from 'lodash-es'
import { make } from 'vuex-pathify'
import Vue from 'vue'

export default {
    name: 'form',
    namespaced: true,
    state: () => ({
        defaultValues: {

        },
        values: {

        },
        schema: [],

        modal: {
            defaultValues: {

            },
            values: {

            },
            schema: [],
        }
    }),

    getters: {
        getValue: (state) => (field, defaultValue = null) => {
            return get(state.values, field, defaultValue)
        },
        getModalValue: (state) => (field, defaultValue = null) => {
            return get(state.modal.values, field, defaultValue)
        },
    },

    actions: {

    },

    mutations: {
        ...make.mutations(['schema', 'values', 'defaultValues']),
        init(state, payload) {
           const {schema, values} = payload
            state.values = values
            state.schema = schema
        },
        remove(state, payload){

        },
        updateModal(state, payload){
            state.modal.values = payload
        },
        resetModal(state, payload){
            state.modal.values = {}
        },
        resetForm(){

        }
    },
}

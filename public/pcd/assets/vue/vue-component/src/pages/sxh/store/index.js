import Vue from 'vue'
import Vuex from 'vuex'
import xacminh from './xacminh'
import schema from './schema'
import { map, isArray, last, takeRight, head, includes } from 'lodash-es'

Vue.use(Vuex)

const store = new Vuex.Store({
    strict: true,
    modules: {
        xacminh
    },
    state: {
        dm: {},
        form: {},
        disabled_px1: false,
        disabled_px2: false,
        shownDieutra: false,
        is_xacminh: false,
        schema,
        user: {},
        loading: false,
    },
    getters: {
        loai_xm_cb({xacminh, dm, form}){
            let val = xacminh.items,
                danhmuc = dm.xacminh_cb,
                lastXm = last(val),
                preLastXm = head(takeRight(val, 2)),
                status = null

            if(val.length % 2 == 0){
                if(lastXm.is_diachi == 0){
                    if(preLastXm.tinh != lastXm.tinh || (preLastXm.tinh == lastXm.tinh && preLastXm.qh == lastXm.qh && preLastXm.px == lastXm.px)){
                        status = 3
                        console.log(`xm-${1}`)
                    }

                    if(preLastXm.qh != lastXm.qh && preLastXm.tinh == lastXm.tinh){
                        status = 2
                        console.log(`xm-${2}`)
                    }

                    if(preLastXm.px != lastXm.px && preLastXm.qh == lastXm.qh){
                        status = 1
                        console.log(`xm-${3}`)
                    }
                }

                if(lastXm.is_diachi == 1){
                    if(preLastXm.tinh == lastXm.tinh && preLastXm.qh == lastXm.qh && preLastXm.px == lastXm.px){
                        status = form.chuandoan == 1 ? 8: 7
                        console.log(`xm-${4}`)
                    }

                    if(preLastXm.tinh != lastXm.tinh){
                        status = 6
                        console.log(`xm-${5}`)
                    }

                    if(preLastXm.qh != lastXm.qh && preLastXm.tinh == lastXm.tinh){
                        status = 5
                        console.log(`xm-${6}`)
                    }

                    if(preLastXm.px != lastXm.px && preLastXm.qh == lastXm.qh){
                        status = 4
                        console.log(`xm-${7}`)
                    }
                }
            }

            // 1, 3, 5
            if(val.length % 2 != 0){
                if(val.length == 1 && lastXm.is_diachi && lastXm.is_benhnhan){
                    status = form.chuandoan == 1 ? 8: 7
                    console.log(`xm-${8}`)
                }

                if(val.length > 1) {
                    // 7,8
                    if(lastXm.is_diachi && lastXm.is_benhnhan && (preLastXm.tinh == lastXm.tinh && preLastXm.qh == lastXm.qh && preLastXm.px == lastXm.px)){
                        status = form.chuandoan == 1 ? 8: 7
                        console.log(`xm-${9}`)
                    }

                    if(preLastXm.tinh != lastXm.tinh){
                        status = 6
                        console.log(`xm-${10}`)
                    }

                    if(preLastXm.qh != lastXm.qh && preLastXm.tinh == lastXm.tinh){
                        status = 5
                        console.log(`xm-${11}`)
                    }

                    if(preLastXm.px != lastXm.px && preLastXm.qh == lastXm.qh){
                        status = 4
                        console.log(`xm-${12}`)
                    }
                }
            }

            return status
        }
    },

    mutations: {
        LOADING(state){
            state.loading = true
        },
        LOADED(state){
            state.loading = false
        },
        UPDATE_LATLNG(state, {lat, lng}){
            state.form.lat = lat
            state.form.lng = lng
        },
        UPDATE_FORM(state, {xacminh, ...form}){
            state.form = {...state.form, ...form}
        },
        UPDATE_STORE(state) {
            const {dm, form, schema, xacminh, user} = window.appData
            state.user = user

            map(dm, (v, k) => {
                state.dm[k] = isArray(v) ? v : map(v, (v1, k1) => ({value: k1, text: v1}))
            })
            state.form = form
            map(schema, (v, k) => {
                state.schema[v.name] = v
            })

            if (xacminh) {
                let lastXm = last(xacminh)
                state.xacminh.items = xacminh
                if (xacminh.length == 1 && lastXm.is_diachi && lastXm.is_benhnhan) {
                    state.shownDieutra = true
                }

                if (lastXm.is_diachi) {
                    if (xacminh.length == 1 && lastXm.is_diachi && lastXm.is_benhnhan) {
                        state.shownDieutra = true
                    }
                    if (xacminh.length > 1) {
                        let preLastXm = head(takeRight(xacminh, 2))

                        if (lastXm.tinh == preLastXm.tinh && lastXm.qh == preLastXm.qh && lastXm.px == preLastXm.px && lastXm.is_diachi) {
                            if (xacminh.length % 2 != 0 && lastXm.is_benhnhan) {
                                // 3,5
                                state.shownDieutra = true
                            }
                            if (xacminh.length % 2 == 0) {
                                // 2,4,6
                                state.shownDieutra = true
                            }
                        } else {
                            if(lastXm.tinh == 'HCM'){
                                let disabled = false
                                let user = state.user

                                if(includes(user.roles, 'phuong') && lastXm.px !== user.maphuong){
                                    disabled = true
                                }

                                state.xacminh.items.push({
                                    ...lastXm,
                                    disabled,
                                    is_diachi: null,
                                    is_benhnhan: null,
                                })
                            }
                        }

                    }
                }
            } else {

            }
        },
        CHECK_DISABLED(state) {
            let xms = state.xacminh.items
            if (xms.length > 2) {
                state.disabled_px1 = true
            }
        },
        SHOWN_DIEUTRA(state, payload) {
            state.shownDieutra = payload
        },
        XACMINH(state) {
            state.is_xacminh = true
        }
    }
})

export default store
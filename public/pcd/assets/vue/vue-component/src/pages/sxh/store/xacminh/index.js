import Vue from 'vue'
import { isNull, last, takeRight, head } from 'lodash-es'

const module = {
    // namespaced: true,
    state: {
        items: [
            // {is_diachi: null, is_benhnhan: null, dienthoai: '', sonha: '', tenduong: '', to_kp: '', khupho: '', tinh: '', qh: '', px: '', tinh_dc_khac: '', disabled: false},
        ]
    },
    getters: {
        lastXm: (state, getters) => {
            if(last(state)) return last(state)

            return {
                is_diachi: null,
                is_benhnhan: null
            }
        },
        // preLastXm: (state, getters) => {
        //     return head(takeRight(state.items, 2))
        // },
        // prepreLastXm: (state, getters) => {
        //     return head(takeRight(state.items, 3))
        // },
        // shownChuyenca(state, {lastXm, preLastXm}){
        //     return state.items.length > 1 && (
        //         lastXm.tinh == 'HCM' &&
        //         (
        //             preLastXm.tinh !== lastXm.tinh ||
        //             preLastXm.qh !== lastXm.qh ||
        //             preLastXm.px !== lastXm.px
        //         )
        //     );
        // }
    },
    mutations: {
        PREPEND_XACMINHS(state, payload){
            state.items = [
                ...payload,
                ...state.items
            ]
        },
        ADD_XM(state) {
            state.items.push({
                id: null,
                is_diachi: null,
                is_benhnhan: null,
                dienthoai: '',
                sonha: '',
                tenduong: '',
                to_kp: '',
                khupho: '',
                tinh: '',
                qh: null,
                px: null,
                tinh_dc_khac: null,
            })
            this.commit('XACMINH')

        },
        REMOVE_XM(state) {
            state.items.splice(state.items.length - 1, 1)
        }
    },
    actions: {
        onChangeXacminh: {
            root: true,
            handler({commit, state, rootState}, {after}) {
                let val = after.items,
                    lastXm = last(val),
                    preLastXm = head(takeRight(val, 2)),
                    prepreLastXm = head(takeRight(val, 3))

                if (lastXm.is_benhnhan == 0 && !isNull(lastXm.is_diachi)) {
                    commit('ADD_XM')
                    console.log(1);
                }

                if (val.length > 1) {
                    if (preLastXm.is_benhnhan == 1) {
                        commit('REMOVE_XM')
                        console.log(2);
                    }

                    if (
                        (lastXm.is_diachi == 1 && val.length % 2 == 0) &&
                        (
                            (lastXm.tinh && (lastXm.tinh != preLastXm.tinh)) ||
                            (lastXm.qh && (lastXm.qh != preLastXm.qh)) ||
                            (lastXm.px && (lastXm.px != preLastXm.px))
                        )
                    ) {
                        rootState.is_xacminh || commit('ADD_XM')
                        console.log(4);
                    }

                    if (
                        val.length % 2 != 0 &&
                        (isNull(lastXm.is_diachi) && isNull(lastXm.is_benhnhan))
                    ) {
                        commit('REMOVE_XM')
                        console.log(6);
                    }

                    if(
                        lastXm.is_diachi &&
                        (
                            (lastXm.tinh && (lastXm.tinh == preLastXm.tinh)) &&
                            (lastXm.qh && (lastXm.qh == preLastXm.qh)) &&
                            (lastXm.px && (lastXm.px == preLastXm.px))
                        )
                    ){
                        console.log('SHOWN_DIEUTRA');
                        !rootState.shownDieutra && commit('SHOWN_DIEUTRA', true)
                    } else {
                        rootState.shownDieutra && commit('SHOWN_DIEUTRA', false)
                    }
                }

                if(val.length == 1){
                    if(lastXm.is_diachi && lastXm.is_benhnhan){
                        !rootState.shownDieutra && commit('SHOWN_DIEUTRA', true)
                    } else {
                        rootState.shownDieutra && commit('SHOWN_DIEUTRA', false)
                    }
                }

                Vue.nextTick(() => {
                    state.items.map((v, k) => {
                        if (k % 2 == 0) {
                            if (state.items[k].is_diachi === 0 && state.items[k].is_benhnhan == 1) {
                                state.items[k].is_benhnhan = null
                            }
                        }
                    })
                })

            }
        }
    }
}

export default module
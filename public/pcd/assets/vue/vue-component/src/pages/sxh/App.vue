<template>
    <div id="cabenhForm">
        <v-alert :messages="errors" variant="danger"/>
        <v-alert :messages="warnings"  class="text-violet-800 alpha-violet"
                 label="Vui lòng nhập đầy đủ thông tin để hoàn tất phiếu - ĐÃ ĐIỀU TRA"/>

        <div v-html="respHtml"></div>

        <validation-observer ref="observer" v-slot="{ passes, handleSubmit }">
            <b-form @submit.prevent="onSubmit" id="sxh-form" ref="form">
                <b-card no-body>
                    <leaflet-part/>
                    <header-part :shownChuyenca="shownChuyenca"/>
                    <b-card-body>
                        <map-part/>
                        <div class="phieu-body pr-0 pl-0 ">
                            <xacminh-part/>
                            <div v-if="shownDieutra">
                                <dieutra-part/>
                                <xuly-part/>
                            </div>
                        </div>
                        <b-row>
                            <b-col>
                                <field-sxh name="nguoidieutra"/>
                            </b-col>
                            <b-col>
                                <field-sxh name="nguoidieutra_sdt"/>
                            </b-col>
                        </b-row>


                    </b-card-body>

                    <b-card-footer>
                        <chuyenca-part v-if="!_.isEmpty(form.list_chuyenca)"/>
                    </b-card-footer>
                </b-card>
            </b-form>
        </validation-observer>
    </div>
</template>
<script>
    import * as partials from './partials'
    import { mapKeys, last, takeRight, head, isString, isPlainObject, isEmpty  } from 'lodash-es'
    import { mapState, mapGetters } from 'vuex'

    const noty = () => {
        return {
            show(){

            },
            success(){

            },
            error(){

            },
            warning(){

            },
            info(){

            },
        }
    }

    const components = {
        ...mapKeys(partials, 'name'),
    }

    export default {
        name: 'SxhForm',
        components: {
            ...components,
        },
        computed: {
            ...mapGetters(['loai_xm_cb']),
            ...mapState(['form', 'xacminh', 'shownDieutra', 'schema', 'dm', 'loading']),
            shownChuyenca() {
                let xacminh = this.xacminh.items,
                    lastXm = last(xacminh),
                    preLastXm = head(takeRight(xacminh, 2))

                return xacminh.length > 1 && (
                    lastXm.tinh == 'HCM' &&
                    (
                        (lastXm.tinh && preLastXm.tinh != lastXm.tinh) ||
                        (lastXm.qh && preLastXm.qh != lastXm.qh) ||
                        (lastXm.px && preLastXm.px != lastXm.px)
                    )
                )
            }
        },
        watch: {
            'form.cachidiem': function (val) {
                if(val == 0) {
                    this.setNullFormAttrs(['dietlangquang', 'giamsattheodoi', 'xulyonho', 'xulyorong'])
                    this.form.cathuphat = 1
                } else {
                    this.form.cathuphat = 0
                }
            },
            'form.cathuphat': function (val) {
                if(val == 0) {
                    this.setNullFormAttrs(['odichmoi', 'odichcu', 'xuly', 'xuly_ngay'])
                }
            },
        },
        data() {
            return {
                respHtml: '',
                errors: {},
                warnings: {},
            }
        },
        created() {
            // this.$store.commit('PREPEND_XACMINHS', [
            //     {is_diachi: '1', is_benhnhan: '0', dienthoai: '', sonha: '', tenduong: '', to_kp: '', khupho: '', tinh: '', qh: '760', px: '', disabled: false},
            //     {is_diachi: '1', is_benhnhan: null, dienthoai: '', sonha: '', tenduong: '', to_kp: '', khupho: '', tinh: '', qh: '760', px: '', disabled: false},
            // ])

            this.$store.commit('UPDATE_STORE')
            this.$store.commit('CHECK_DISABLED')

            this.$store.watch(
                (state, getters) => {
                    return JSON.stringify(state.xacminh)
                },
                (val, oldVal) => {
                    let after = val ? JSON.parse(val) : [],
                        before = oldVal ? JSON.parse(oldVal) : []

                    if (after.length === before.length) {
                        this.$store.dispatch('onChangeXacminh', {after, before})
                    }
                },
            );
        },
        mounted() {
        },
        methods: {
            setNullFormAttrs(attrs) {
                attrs.map(name => {this.form[name] = null})
            },

            makeToast(variant = null) {
                this.$bvToast.toast('Toast body content', {
                    title: `Variant ${variant || 'default'}`,
                    variant: variant,
                    solid: true
                })
            },
            submitForm(e) {
                e.preventDefault()
                this.$refs.form.submit()
                return false
            },
            onSubmit(e) {
                e.preventDefault()
                this.getPost()
            },

            resetForm() {

            },
            resetMessages(){
                this.errors = []
                this.warnings = []
            },
            setMessages({errors, warnings}) {
                this.errors = errors
                this.warnings = warnings

                this.$refs.observer.reset()

                this.$refs.observer.setErrors({
                    ...errors,
                    ...warnings
                })

                if(!isEmpty(errors)){
                    this.$noty.error(`Cập nhật <b class="text-uppercase">không thành công</b> <br/> Vui lòng nhập các thông tin bắt buộc`)
                }

                if(isEmpty(errors) && !isEmpty(warnings)){
                    this.$noty.warning('Vui lòng nhập <b class="text-uppercase">đầy đủ thông tin</b> để hoàn tất quá trình điều tra')
                }

                if(isEmpty(errors) && isEmpty(warnings)){
                    this.$noty.info('Đã cập nhật <b class="text-uppercase">thành công</b> phiếu điều tra')
                }
            },
            async getPost() {
                let SxhForm = $('#sxh-form').serializeObject()
                let url = new URL(window.location.href),
                    search_params = new URLSearchParams(url.search),
                    id = search_params.get('id')

                let data = {
                    SxhForm: {
                        ...SxhForm,
                        loai_xm_cb: this.loai_xm_cb,
                    },
                    status: {
                        is_dieutra: this.shownDieutra,
                        is_chuyenca: this.shownChuyenca,
                    },
                    [window.appData.csrf.param]: window.appData.csrf.token
                }

                this.$store.commit('LOADING')
                this.resetMessages()

                try {
                    const {body: resp} = await this.$http.post(`/sxh/default/save?id=` + (id ? id : ''), data)
                    if(isPlainObject(resp)){
                        this.setMessages(resp)
                        this.$store.commit('UPDATE_FORM', resp.model)
                    }
                    if(isString(resp)) {
                        this.respHtml = resp
                    } else {
                        this.respHtml = ''
                    }

                    this.$store.commit('LOADED')

                    if(resp.redirect_url) {
                        window.location.href = resp.redirect_url;
                        // window.open(resp.redirect_url, "_blank");
                    }
                }
                catch (err) {
                    this.$store.commit('LOADED')
                    console.log(err)
                }

            }

        }
    }
</script>

<style lang="scss">
    .custom-control {
        padding-left: 8px
    }

    .custom-radio .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #2196f3;
    }

    .ladda-button {
        font-size: 13px;
        padding: 8px 16px;
        background: #2196f3;
        &:hover {
            background-color: #098bf3;
        }
    }

</style>


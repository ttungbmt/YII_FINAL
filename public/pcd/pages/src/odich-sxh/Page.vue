<template>
    <b-card header-class="p-0">
        <template v-slot:header>
            <p-map></p-map>
        </template>

        <b-card-text>
            <m-form @submit="handleSubmit" v-bind="formOptions">
                <component v-bind:is="i.component" v-for="(i, k) in schema" v-bind="i" :key="k"></component>

                <b-button-group class="mx-1">
                    <b-button variant="primary" type="submit"><i v-if="loading" class="icon-spinner2 spinner"></i> Lưu kết quả</b-button>
                    <b-button variant="success" type="button" @click="exportWord" v-if="odich_id" title="Xuất biên bản"><i class="icon-file-download2"></i></b-button>
                </b-button-group>
            </m-form>
        </b-card-text>
    </b-card>
</template>
<script>
    import {map, isEmpty, get, last, sortBy} from 'lodash-es'
    import {get as pGet} from 'vuex-pathify'
    import moment from 'moment'

    import Map from './partials/Map.vue'
    import Phamvi from './partials/Phamvi.vue'
    import HanhChinh from './partials/HanhChinh.vue'

    export default {
        name: 'page-form-odich',
        components: {
            [Map.name]: Map,
            [Phamvi.name]: Phamvi,
            [HanhChinh.name]: HanhChinh,
        },

        computed: {
            schema: pGet('form.schema'),
            odich_id: pGet('form.values.id'),
            cabenhs: pGet('form.values.cabenhs'),
            modal: pGet('modal'),
        },
        data() {
            return {
                formOptions: {
                    method: 'POST',
                    options: {
                        model: 'form.values'
                    }
                },

                loading: false,
            }
        },
        watch: {
            cabenhs: {
                handler(val, old){
                    let cathuphat = get(val, '1.ngaybaocao'),
                        cacc = last(sortBy(val, v => moment(v.ngaymacbenh, 'DD/MM/YYYY'))),
                        formatDate = 'DD/MM/YYYY'

                    if(cathuphat) this.$store.commit('updateField', {path: 'form.values.ngayxacdinh', value: cathuphat})
                    if(cacc) this.$store.commit('updateField', {path: 'form.values.ngaydukien_kt', value: moment(cacc.ngaymacbenh, formatDate).add(30, 'days').format(formatDate)})
                },
                immediate: true
            },
        },
        mounted() {

        },
        methods: {
            handleSubmit(values, {errors, $form}){
                let data = values,
                    message = `Biên bản xử lý có một số thông tin nhập chưa đúng. Xin vui lòng kiểm tra lại biên bản`

                data.dncs_count = data.dncs.length
                let tt_fields = ['phun_hcs', 'diet_lqs', 'khaosat_cts']

                map(tt_fields, name => {
                    data[name] = map(data[name], (v, k) => ({...v, tt: k+1}))
                })

                if(!isEmpty(errors)){
                    this.$noty.error(message)
                    return null
                }

                this.loading = true
                this.$http.post(window.location.href, data).then(({data}) => {
                    this.loading = false
                    if(data.errors) {
                        $form.setErrors(data.errors)
                        this.$noty.error(data.message)

                        return false
                    }

                    if(data.redirectUrl) window.location.href = data.redirectUrl
                    if(data.message) this.$noty.info(data.message)

                })
            },
            exportWord(){
                window.open('/sxh/odich/export-word?id='+this.odich_id)
            }
        }
    }
</script>









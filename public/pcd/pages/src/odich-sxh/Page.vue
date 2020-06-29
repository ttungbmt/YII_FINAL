<template>
    <b-card header-class="p-0">
        <template v-slot:header>
            <p-map></p-map>
        </template>

        <b-card-text>
            <m-form @submit="handleSubmit" v-bind="formOptions">
                <component v-bind:is="i.component" v-for="(i, k) in schema" v-bind="i" :key="k"></component>
                <b-button variant="primary" type="submit"><i v-if="loading" class="icon-spinner2 spinner"></i> Lưu kết quả</b-button>
            </m-form>
        </b-card-text>
    </b-card>
</template>
<script>
    import {map, isEmpty} from 'lodash-es'
    import {get} from 'vuex-pathify'

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
            schema: get('form.schema'),
            modal: get('modal'),
        },
        data() {
            return {
                value: '123',
                formOptions: {
                    method: 'POST',
                    options: {
                        model: 'form.values'
                    }
                },

                loading: false,
            }
        },
        mounted() {

        },
        methods: {
            handleSubmit(values, {errors, $form}){
                let data = values,
                    message = `Biên bản xử lý có một số thông tin nhập chưa đúng. Xin vui lòng kiểm tra lại biên bản`

                data.dncs_count = data.dncs.length

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
            }
        }
    }
</script>









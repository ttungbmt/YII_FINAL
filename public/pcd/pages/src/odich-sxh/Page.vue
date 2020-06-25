<template>
    <b-card header-class="p-0">
        <template v-slot:header>
            <p-map></p-map>
        </template>

        <b-card-text>
            <form method="POST" @submit.prevent="handleSubmit">
                <component v-bind:is="i.component" v-for="(i, k) in schema" v-bind="i" :key="k"></component>
                <b-button variant="primary" type="submit"><i v-if="loading" class="icon-spinner2 spinner"></i> Lưu kết quả</b-button>
            </form>
        </b-card-text>
    </b-card>
</template>
<script>
    import Map from './partials/Map.vue'
    import DsCabenh from './partials/DsCabenh.vue'
    import Phamvi from './partials/Phamvi.vue'
    import TbDnc from './partials/TbDnc.vue'

    import {get, sync} from 'vuex-pathify'
    import {mapFields} from 'vuex-map-fields'

    export default {
        name: 'page-form-odich',
        components: {

            [Map.name]: Map,
            [DsCabenh.name]: DsCabenh,
            [TbDnc.name]: TbDnc,
            [Phamvi.name]: Phamvi,
        },
        computed: {
            schema: get('schema'),
            form: get('form'),
            formModal: get('formModal'),
        },
        data() {
            return {
                loading: false,
                fields: [
                    {
                        key: 'tt1',
                        type: 'serial',
                        label: 'tt1',
                    },
                    {
                        key: 'tt2',
                        label: 'tt2',
                        format: 'html',
                        value({index}){
                            return `<b>Lần ${index+1}</b>`
                        }
                    },
                    {
                        key: 'name',
                        label: 'Label'
                    }
                ],
                items: [
                    { age: 32, first_name: 'Cyndi', name: 'hello' },
                    { age: 27, first_name: 'Havij' },
                    { age: 42, first_name: 'Robert' }
                ],
                list: [
                    'Cyndi',
                    'Havij',
                    'Robert',
                ]
            }
        },
        mounted() {

        },
        methods: {
            handleSubmit(){
                this.loading = true
                let data = this.form

                data.dncs_count = this.form.dncs.length

                this.$http.post(window.location.href, data).then(({data}) => {
                    this.loading = false

                    if(!this.form.id){
                        this.$noty.success(`Đã thêm mới thành công`)
                        window.location.href = '/sxh/odich'
                    } else {
                        this.$noty.success(`Đã cập nhật thành công`)
                    }
                })
            }
        }
    }
</script>









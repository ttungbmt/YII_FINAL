<template>
    <div>
        <FormulateInput
            v-model="items"
            :options="options"
            type="select"
            @search="onSearch"
            :reduce="option => option"
            placeholder="Chọn điểm nguy cơ..."
            label="Điểm nguy cơ"
            multiple
            :loading="loading"
            :filterable="false"
            validation="required"
            validation-name="Điểm nguy cơ"
        />

        <div v-show="!isEmpty(items)">
            <div class="mb-2">Số lượng điểm nguy cơ: {{items.length}}</div>
            <FormulateInput type="table" name="phamvi_dncs" hover :fields="fields" outlined ref="table"></FormulateInput>
        </div>
    </div>
</template>
<script>
    import {isEmpty, debounce, includes, toNumber} from 'lodash'
    import axios from 'axios'
    import vSelect from "vue-select"

    export default {
        data(){
            return {
                loading: false,
                options: [],
                items: [],
                resources: [],
                fields: [
                    {key: 'ten_cs', label: 'Tên', asHtml: true, formatter: (value, key, item) => `<a href="/pt_nguyco/default/update?id=${item.id}" target="_blank">${item.ten_cs}</a>`},
                    {key: 'diachi', label: 'Địa chỉ'},
                    {key: 'tenquan', label: 'Quận huyện'},
                    {key: 'tenphuong', label: 'Phường xã'},
                    {key: 'loaihinh', label: 'Loại hình'},
                    {key: 'nhom', label: 'Nhóm'},
                ]
            }
        },
        components: {
            vSelect
        },
        inject: {
            getFormValues: {default: () => () => ({})},
        },
        computed: {
            formValues(){
                return this.getFormValues(this)
            },
        },
        watch: {
            items(newVal){
                if(this.$refs.table) this.$refs.table.context.model = newVal
            }
        },
        methods: {
            isEmpty,
            onSearch(text, loading){
                let maquan = this.formValues.qh,
                    maphuong = this.formValues.px

                if(text.length) {
                    loading(true)
                    this.handleSearch(loading, {maquan, maphuong, term: text}, this);
                }
            },
            handleSearch: debounce((loading, params, vm) => {
                axios.get('/api/dm/dnc', {params}).then(({data}) => {
                    loading(false);
                    let resources = data.filter(i => i.ten_cs !== '')
                    vm.resources = resources
                    vm.options = resources.map(i => ({...i, value: i.id, label: i.ten_cs}))
                })
            }, 350)
        }
    }

</script>
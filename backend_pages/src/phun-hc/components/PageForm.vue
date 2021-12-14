<template>
    <div>
        <b-card>
            <FormulateForm
                    v-model="formValues"
                    @submit="onSubmit"
                    name="page"
                    :schema="schema"
                    #default="{isLoading}"
            >
                <FormulateErrors />

                <FormulateInput
                        type="submit"
                        :disabled="isLoading"
                        :label="isLoading ? 'Loading...' : 'Lưu biên bản'"
                />
            </FormulateForm>

            <!--<input type="text" class="form-control krajee-datepicker" name="OdichSearch[date_to]"/>-->
        </b-card>
    </div>
</template>

<script>
    import schema from '../schema'
    import {defaults} from 'lodash'
    import {toFormulateSchema} from '../utils';
    import $ from 'jquery'


    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    export default {
        name: 'page-form',
        data() {
            return {
                schema: toFormulateSchema(schema),
                formValues: defaults(window.pageData.form || {}, {
                    // maquan: null,
                    // maphuong: null,
                    // loai_xl: '2',
                    // phamvi_dncs: [],
                    // hoatdong_xl: [
                    //     'khaosat_ct',
                    //     'diet_lq',
                    //     'phun_hc',
                    // ],
                    // khaosat_cts: [
                    //
                    // ],
                    // diet_lqs: [],
                    // phun_hcs: [],
                }),
            }
        },
        mounted() {

        },
        methods: {
            invalidMessage(fields) {
                const fieldNames = Object.keys(fields)
                const listOfNames = fieldNames.map(fieldName => fieldName.replace('_', ' '))
                return `Invalid fields: ${listOfNames}`
            },
            async onSubmit(values){
                try {
                    const {data} = await $.post(window.location.href, {PhunCdForm: values})
                } catch (e) {

                }
                // await sleep(300);

                // this.$formulate.handle({
                //     inputErrors: { name: 'This address doesn’t appear valid' },
                //     formErrors: ['Also, this form isn’t hooked up yet']
                // }, 'page')
            },
        }
    }
</script>

<style>
    .btn-sm {
        padding: 4px 8px;
        text-transform: inherit;
    }
</style>
<template>
    <div>
        <button type="button" @click="showModal">Thêm mới</button>
        <b-table hover :items="computedItems" :fields="fields"></b-table>

        <b-modal ref="modal" title="Using Component Methods" hide-footer>
            <FormulateForm
                    v-if="form"
                    v-model="formValues"
                    @submit="onSubmit"
                    :name="form.name"
                    :schema="toFormulateSchema(form.schema)"
                    #default="{isLoading}"
            >
                <FormulateErrors />

                <div class="flex content-between">
                    <FormulateInput type="button" @click="hideModal" label="Close"/>

                    <FormulateInput
                            type="submit"
                            class="ml-auto"
                            :disabled="isLoading"
                            :label="isLoading ? 'Loading...' : 'Save'"
                    />
                </div>
            </FormulateForm>
        </b-modal>
    </div>
</template>

<script>
    import {get} from 'lodash'
    import {toFormulateSchema} from '../utils'

    export default {
        inheritAttrs: false,
        props: {
            name: String,
            fields: {
                type: Array,
                default: []
            },
            items: {
                type: Array,
                default: function () {
                    return []
                }
            },
            form: Object
        },
        data(){
            return {
                innerItems: this.items,
                formValues: {

                },
            }
        },
        inject: {
            getFormValues: {default: () => () => ({})},
        },
        computed: {
            computedItems(){
                let items = get(this.getFormValues(this), this.name, [])

                return items.concat(this.innerItems)
            }
        },
        methods: {
            showModal() {
                this.$refs['modal'].show()
            },
            hideModal() {
                this.$refs['modal'].hide()
            },
            resetForm(){
                this.$formulate.reset(this.name, {})
            },
            onSubmit(values){
                this.hideModal()
                this.resetForm()
            },
            toFormulateSchema
        }
    }
</script>
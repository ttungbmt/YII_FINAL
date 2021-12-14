<template>
    <div>
        <div class="flex mb-2">
            <div>

            </div>
            <div class="ml-auto" >
                <b-button variant="outline-primary" @click="createItem" size="sm" v-if="hasButton('create')">Thêm mới</b-button>
            </div>
        </div>

        <b-table hover :items="computedItems" :fields="fields" v-bind="computedAttributes" :busy="loading">
            <template #cell()="row">
                <div v-if="row.field.type === `action`">
                    <b-button size="sm" variant="link" class="p-1" @click="editItem(row)"><i class="icon-pencil7"></i></b-button>
                    <b-button size="sm" variant="link" class="p-1 text-danger" @click="deleteItem(row)"><i class="icon-bin"></i></b-button>
                </div>
                <div v-else>
                    <div v-if="isHtml(row)" v-html="cellValue(row)"></div>
                    {{isHtml(row) ? '' : cellValue(row)}}
                </div>
            </template>

         <!--   <template #empty="scope">
                <h4>123</h4>
            </template>

            <template #emptyfiltered="scope">
                <h4>456</h4>
            </template>-->

            <template #table-caption v-if="attributes.caption"><div v-html="attributes.caption"></div></template>

            <template #table-busy>
                <b-progress :value="100" :max="100" animated class="mt-2"></b-progress>
            </template>
        </b-table>

       <b-modal ref="modal" :title="form.title" hide-footer>
           <FormulateForm
                   v-if="form"
                   v-model="formValues"
                   @submit="onSubmit"
                   :name="form.name"
                   :schema="computedSchema"
                   #default="{isLoading}"
           >
               <FormulateErrors />

               <div class="flex content-between">
                   <FormulateInput type="button" @click="e => hideModal()" label="Close"/>

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
    import {get, omit, isArray, isPlainObject, isUndefined, defaults, includes} from 'lodash'
    import {setId, toFormulateSchema} from '../utils'

    export default {
        inheritAttrs: false,
        props: {
            context: {
                type: Object,
                required: true
            }
        },
        data(){
            return {
                loading: false,
                innerItems: get(this.context, 'attributes.items', []),
                formValues: get(this.form, 'defaultValues', {}),
            }
        },
        inject: {
            getFormValues: {default: () => () => ({})},
        },
        computed: {
            attributes(){
                return this.context.attributes
            },
            name(){
                return this.attributes.name
            },
            fields(){
                return this.attributes.fields || []
            },
            form(){
                return this.attributes.form || {}
            },
            computedAttributes(){
                return defaults(omit(this.attributes, ['form']), {
                    outlined: true,
                    hover: true,
                    responsive: true,
                })
            },
            computedItems(){
                let items = get(this.getFormValues(this), this.name, [])

                return items.concat(this.innerItems).map((i, k) => setId(i))
            },
            computedSchema(){
                if(!this.form.schema) return []

                return toFormulateSchema(this.form.schema)
            }
        },
        methods: {
            hasButton(name){
                return includes(this.attributes.buttons, name)
            },
            isHtml({field}){
                return field.asHtml || field.format === 'html'
            },
            optionLabel(value, key, item){
                let field = this.form.schema.find(i => i.name === key)
                if(isArray(field.options)) {
                    if(!isUndefined(get(field, 'options.0.value'))) return get(field, 'options.0.label')
                    return get(field.options, value)
                }
                if(isPlainObject(field.options)) return get(field.options, value)
                return null
            },
            cellValue(row){
                const {field, index, value} = row
                if(field.type === 'serial') return [field.prefix, index+1, field.suffix].join('')
                if(field.value) return field.value(row)

                return [field.prefix, value, field.suffix].join('')
            },
            createItem(){
                this.formValues = get(this.form, 'defaultValues', {})
                this.showModal()
            },
            editItem({item, index}){
                this.formValues = {...item, __id: item.__id, __index: index}
                this.showModal()
            },
            deleteItem({item, index}){
                this.context.model = this.context.model.filter((item, k) => k === index ? false : item)
            },
            showModal(name = 'modal') {
                this.$refs[name].show()
            },
            hideModal(name = 'modal') {
                this.$refs[name].hide()
            },
            resetForm(){
                this.$formulate.reset(this.name, {})
            },
            onSubmit(values){
                if(this.formValues.__id) {
                    let index = this.formValues.__index
                    this.context.model.splice(index, 1, setId(omit(values, ['__index', '__id']), this.context.model[index].__id))
                } else {
                    this.context.model.push(setId(values))
                }

                this.hideModal()
                this.resetForm()
            },
        }
    }
</script>
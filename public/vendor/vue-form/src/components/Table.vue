<template>
    <div>
        <b-table v-bind="tbOptions" :fields="fields" :items="innerItems" @row-clicked="onRowClicked">
            <template v-slot:[`cell(${i.key})`]="data" v-for="i in fields">
                {{isFormatHtml(data) ? '' : cellValue(data)}}
                <div v-if="isFormatHtml(data)" v-html="cellValue(data)"></div>

                <b-button-group v-if="isMatchField(data.field, {type: 'action'})">
                    <b-button size="sm" variant="link" class="p-0 pr-2" @click="editItem(data)" v-if="shownBtnAction(data, 'update')"><i class="icon-pencil7"></i></b-button>
                    <b-button size="sm" variant="link" class="p-0 text-danger" @click="deleteItem(data)" v-if="shownBtnAction(data, 'delete')"><i class="icon-bin"></i></b-button>
                </b-button-group>
            </template>
        </b-table>

        <v-wait :for="keyLoading" v-if="hasBtn('getList')">
            <template slot="waiting">
                <b-progress :value="100" :max="100" animated></b-progress>
            </template>
        </v-wait>

        <div class="btn-group" v-if="!_.isEmpty(buttons)">
            <button type="button" class="btn-small mt-2" @click="openModal" v-if="hasBtn('create')">Thêm mới</button>
            <button type="button" class="btn-small mt-2" @click="showModal('modal-order')" v-if="hasBtn('order')">{{getBtn('order', 'label')}}</button>
            <button type="button" class="btn-small mt-2" @click="getList" v-if="hasBtn('getList')">{{getBtn('getList', 'label')}}</button>
        </div>

        <b-modal ref="modal-table" :title="form.title" v-if="form" v-bind="modalOptions">
            <m-form :options="{model: form.path}">
                <component v-bind:is="i.component" v-for="(i, k) in form.schema" v-bind="i" :key="k"></component>
            </m-form>
            <div class="mt-3 text-right">
                <b-button variant="danger" @click="hideModal('modal-table')">Hủy</b-button>
                <b-button variant="primary" @click="handleOk">Lưu</b-button>
            </div>
        </b-modal>

        <b-modal ref="modal-order" :title="getBtn('order', 'title', '')" hide-footer>
            <div>
                <m-list :itemsPath="itemsPath" :formatter="getBtn('order', 'formatter')" @ordered="onOrdered"></m-list>
            </div>
            <div class="mt-3 text-right">
                <b-button variant="danger" @click="hideModal('modal-order')">Hủy</b-button>
                <b-button variant="primary" @click="handleOrderOk">Lưu</b-button>
            </div>
        </b-modal>
    </div>

</template>
<script>
    import {cloneDeep, isBoolean, has, get, includes, isNull, isString, isPlainObject, isEmpty, filter, head, isArray, isMatch } from 'lodash-es'
    import modalMixin from '../mixins/modal'

    const KEY_LOADING = 'table'

    export default {
        inheritAttrs: false,
        mixins: [modalMixin],
        name: 'm-table',
        props: {
            id: String,
            buttons: Array,
            fields: Array,
            items: Array,
            itemsPath: String,
            form: Object,
            onRowClicked: {
                type: Function,
                default: function (item, index, event) {

                }
            },
            options: Object
        },

        data(){
            return {
                keyLoading: KEY_LOADING,
                modelIndex: null,
                tbOptions: {
                    id: this.id,
                    responsive: true,
                    hover: true,
                    small: 'small',
                    'head-variant': 'light',
                    ...this.options,
                },
                modalOptions: {
                    'ok-title': 'Lưu',
                    'cancel-title': 'Hủy',
                    'hide-footer': true,
                    size: get(this.form, 'size', 'md')
                },
                ordered: []
            }
        },
        computed: {
            innerItems(){
                if(this.items) return this.items
                if(this.itemsPath) return this.$store.get(this.itemsPath)
                return []
            },

        },
        methods: {
            isMatchField(field, options){
                return isMatch(field, options)
            },
            isFormatHtml(data){
                return this.isMatchField(data.field, {format: 'html'})
            },
            shownBtnAction(data, btn){
                let visibleBtn = get(data, `field.visibleButtons.${btn}`)

                if(isBoolean(visibleBtn)) return visibleBtn

                return true
            },
            cellValue(data){
                if(data.field.type) return this.getTypeValue(data)
                if(data.field.value) return data.field.value(data)
                if(data.field.filter) {
                    let filter = this.$store.get(data.field.filter)
                    return get(filter, data.value, '')
                }

                return data.value
            },
            getTypeValue(data){
                const {field, value} = data

                switch (field.type) {
                    case 'serial':
                        return data.index+1
                    case 'data':
                        return data.index+1
                }

                return value
            },
            hasBtn(name){
                return !isEmpty(filter(this.buttons, (v, k) => {
                    if(isString(v) && v === name) return true
                    if(has(v, 'type') && v.type === name) return true
                    return false
                }))
            },
            getBtn(name, attr = '', defaultValue = {}){
                return get(filter(this.buttons, v => this.hasBtn(name)), '0'+(attr ? '.'+attr : ''), defaultValue)
            },
            editItem({index}){
                this.modelIndex = index
                let value = cloneDeep(get(this.innerItems, index))

                this.showModal('modal-table')

                setTimeout(() => {
                    this.$store.commit('form/updateModal', value)
                }, 200)

            },
            deleteItem({index}){
                this.$store.commit('removeField', {
                    path: this.itemsPath,
                    value: index,
                })
            },
            openModal(){
                this.modelIndex = null
                this.$store.commit('form/resetModal')
                this.showModal('modal-table')
            },

            handleOk(){
                let old = this.innerItems,
                    value = cloneDeep(this.$store.get(this.form.path))

                if(isNull(this.modelIndex)){
                    this.updateForm({
                        value: old.concat(value),
                    })
                } else {
                    this.updateForm({
                        path: [this.itemsPath, this.modelIndex].join('.'),
                        value,
                    })

                }
                this.hideModal('modal-table')
            },
            getList(){
                let attrs = this.getBtn('getList'),
                    postData = attrs.data.bind(this)

                this.$wait.start(KEY_LOADING);

                this.$http.post(attrs.url, postData(attrs)).then(({data}) => {
                    try {
                        if(isArray(data.data)) this.updateForm({value: data.data})
                        this.$wait.end(KEY_LOADING);
                    } catch (e) {
                        this.updateForm({value: []})

                        this.$wait.end(KEY_LOADING);
                        console.warn(e)
                    }
                })
            },

            handleOrderOk(){
                let items = []

                if(!isEmpty(this.ordered)){
                    this.ordered.map(index => items.push(this.innerItems[index]))
                    this.updateForm({value: items})
                }

                this.hideModal('modal-order')
            },
            updateForm({path, value}){
                this.$store.commit('updateField', {
                    path: path ? path : this.itemsPath,
                    value,
                })
            },
            onOrdered(payload){
                this.ordered = payload
            },

        }
    }
</script>

<style scoped lang="scss">



</style>
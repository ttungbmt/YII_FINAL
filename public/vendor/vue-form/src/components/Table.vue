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
            <button type="button" class="btn-small mt-2" @click="openOrderModal" v-if="hasBtn('order')">{{getBtn('order', 'label')}}</button>
            <button type="button" class="btn-small mt-2" @click="getList" v-if="hasBtn('getList')">{{getBtn('getList', 'label')}}</button>
        </div>

        <b-modal ref="modal-table" :title="form.title" v-if="form" v-bind="modalOptions">
            <div>
                <component v-bind:is="i.component" v-for="(i, k) in form.schema" v-bind="i" :key="k"></component>
            </div>
            <div class="mt-3 text-right">
                <b-button variant="danger" @click="handleCancel('modal-table')">Hủy</b-button>
                <b-button variant="primary" @click="handleOk">Lưu</b-button>
            </div>
        </b-modal>

        <b-modal ref="modal-order" :title="getBtn('order', 'title', '')" hide-footer>
            <div>
                <v-list :itemsPath="itemsPath" :formatter="getBtn('order', 'formatter')" @ordered="onOrdered"></v-list>
            </div>
            <div class="mt-3 text-right">
                <b-button variant="danger" @click="handleCancel('modal-order')">Hủy</b-button>
                <b-button variant="primary" @click="handleOrderOk">Lưu</b-button>
            </div>
        </b-modal>
    </div>

</template>
<script>
    import {cloneDeep, isBoolean, has, get, includes, isNull, isString, isPlainObject, isEmpty, filter, head, isArray, isMatch } from 'lodash-es'

    const KEY_LOADING = 'table'

    export default {
        inheritAttrs: false,
        name: 'v-table',
        props: {
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
            labelLan(data){
                let name = get(this, 'form.name')
                if(includes(['khaosat_cts', 'diet_lqs', 'phun_hcs'], name)) return 'Lần'
                return ''
            },
            editItem({index}){
                this.modelIndex = index
                let value = cloneDeep(get(this.innerItems, index))
                this.$store.commit('updateModal', {path: 'formModal', value})
                this.$refs['modal-table'].show()
            },
            deleteItem({index}){
                this.$store.commit('deleteForm', {
                    path: this.itemsPath,
                    value: index,
                })
            },
            openModal(){
                this.modelIndex = null
                this.$store.commit('resetModal', {path: 'formModal', value: {}})
                this.$refs['modal-table'].show()
            },
            handleCancel(name){
                this.$refs[name].hide()
            },
            handleOk(){
                let old = this.innerItems,
                    value = this.$store.getIn(this.form.path)

                if(isNull(this.modelIndex)){
                    this.$store.commit('updateForm', {
                        path: this.itemsPath,
                        value: old.concat(value),
                    })
                } else {
                    this.$store.commit('updateForm', {
                        path: [this.itemsPath, this.modelIndex].join('.'),
                        value,
                    })
                }

                this.$refs['modal-table'].hide()
            },
            getList(){
                let attrs = this.getBtn('getList'),
                    postData = attrs.data.bind(this)

                this.$wait.start(KEY_LOADING);

                this.$http.post(attrs.url, postData(attrs)).then(({data}) => {
                    try {
                        if(isArray(data.data)){
                            this.$store.commit('updateForm', {
                                path: this.itemsPath,
                                value: data.data,
                            })
                        }
                        this.$wait.end(KEY_LOADING);
                    } catch (e) {
                        this.$store.commit('updateForm', {
                            path: this.itemsPath,
                            value: [],
                        })
                        this.$wait.end(KEY_LOADING);
                        console.warn(e)
                    }
                })
            },
            openOrderModal(){
                this.$refs['modal-order'].show()
            },
            handleOrderOk(){
                let items = []

                if(!isEmpty(this.ordered)){
                    this.ordered.map(index => items.push(this.innerItems[index]))
                    this.updateForm({value: items})
                }

                this.$refs['modal-order'].hide()
            },
            updateForm({path, value}){
                this.$store.commit('updateForm', {
                    path: path ? path : this.itemsPath,
                    value,
                })
            },
            onOrdered(payload){
                this.ordered = payload
            }
        }
    }
</script>

<style scoped lang="scss">



</style>
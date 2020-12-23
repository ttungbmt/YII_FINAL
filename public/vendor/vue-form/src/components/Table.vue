<template>
    <div>
        <b-table v-bind="tbOptions" :fields="fields" :items="innerItems" @row-clicked="onRowClicked">
            <template #thead-top="data">
                <b-tr v-if="hasGroup(data)">
                    <b-th data-f-bold="true" :colspan="i.count" v-for="i in getGroup(data)" class="text-center">{{i.value}}</b-th>
                </b-tr>
            </template>

            <template v-slot:[`cell(${i.key})`]="data" v-for="i in fields">
                {{isFormatHtml(data) ? '' : cellValue(data)}}
                <div v-if="isFormatHtml(data)" v-html="cellValue(data)"></div>

                <b-button-group v-if="isMatchField(data.field, {type: 'action'})">
                    <b-button size="sm" variant="link" class="p-0 pr-2" @click="editItem(data)" v-if="shownBtnAction(data, 'update')"><i class="icon-pencil7"></i></b-button>
                    <b-button size="sm" variant="link" class="p-0 text-danger" @click="deleteItem(data)" v-if="shownBtnAction(data, 'delete')"><i class="icon-bin"></i></b-button>
                </b-button-group>
            </template>
        </b-table>

        <v-wait :for="keyLoading" v-if="hasBtnType('getList')">
            <template slot="waiting">
                <b-progress :value="100" :max="100" animated class="mt-2"></b-progress>
            </template>
        </v-wait>

        <div class="btn-group" v-if="!_.isEmpty(buttons)">
            <button type="button" class="btn-small mt-2 mr-1 cursor-pointer" v-on="b.listeners" v-for="b in innerButtons">{{b.label}}</button>
        </div>

        <b-modal ref="modal-table" :title="form.title" v-if="form" v-bind="modalOptions">
            <m-form :options="{model: form.path}" ref="modal-table-form">
                <component v-bind:is="i.component" v-for="(i, k) in form.schema" v-bind="i" :key="k"></component>
                <button type="submit" class="hidden btn-modal-table-form-submit">Submit</button>
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

        <b-modal ref="modal-search" :title="getBtn('search', 'label', '')" hide-footer>
            <div>
                <b-alert :show="suggestions.alert" dismissible variant="success" class="border-0">Đã thêm vào danh sách</b-alert>

                <b-input-group class="mb-2">
                    <template #prepend>
                        <div class="flex items-center"><i class="icon-search4"></i></div>
                    </template>

                    <b-form-input placeholder="Tìm kiếm..." v-model="suggestions.text"></b-form-input>
                </b-input-group>

                <v-wait for="suggestions">
                    <template slot="waiting">
                        <b-progress :value="100" animated></b-progress>
                    </template>
                    <b-table hover :items="suggestions.items" :fields="suggestions.fields" select-mode="single" selectable @row-clicked="onSearchRowClicked"></b-table>
                </v-wait>
            </div>
            <div class="mt-3 text-right">
                <b-button variant="danger" @click="hideModal('modal-search')">Hủy</b-button>
                <b-button variant="primary" @click="handleSearch">OK</b-button>
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
                ordered: [],
                suggestions: {
                    text: '',
                    alert: false,
                    fields: [],
                    items: []
                }
            }
        },
        computed: {
            innerItems(){
                if(this.items) return this.items
                if(this.itemsPath) return this.$store.get(this.itemsPath)
                return []
            },
            innerButtons(){
                return this.buttons.map(v => {
                    if(v === 'create') return {label: 'Thêm mới', type: 'create', listeners: {click: this.openModal}}
                    if(v.type === 'order') return {...v, listeners: {click: () => this.showModal('modal-order')}}
                    if(v.type === 'getList') return {...v, listeners: {click: this.getList}}
                    if(v.type === 'search') return {...v, listeners: {click: () => this.showModal('modal-search')}}

                    return v
                })
            }
        },
        watch: {
            'suggestions.text': _.debounce(function (newVal) {
                let attrs = this.getBtn('search')

                if(_.trim(newVal) === '') {
                    this.suggestions.fields = []
                    this.suggestions.items = []

                    return null
                }


                this.$wait.start('suggestions')

                $.get(URI(attrs.url).setSearch('input', newVal).toString()).then(res => {
                    this.suggestions.fields = res.fields
                    this.suggestions.items = res.items

                    this.$wait.end('suggestions')
                })
            }, 300)
        },
        methods: {
            handleSearch(){
                let attrs = this.getBtn('search')
                console.log(attrs)
            },
            onSearchRowClicked(items){
                let data = Object.assign([], this.innerItems).concat([items])
                this.updateForm({value: data})

                this.suggestions.alert = true
                clearTimeout(this.alertTimer)

                this.alertTimer = setTimeout(() => {
                    this.suggestions.alert = false
                }, 2000)
            },
            hasGroup({fields}){
                return !isEmpty(filter(fields, f => f.group))
            },
            getGroup({fields: data}){
                if (data === null || data.length === 0) return [];

                let result = [];
                let prevEle = get(data, `0.group`, '');
                let count = 0;
                for (let i = 1; i < data.length; i++) {
                    const ele = get(data, `${i}.group`, '');

                    if (ele === prevEle) {
                        if(i === 1) count +=2
                        else count +=1
                    } else {
                        console.log(ele, prevEle)
                        result.push({ count: count, value: prevEle });
                        count = 1;
                    }
                    prevEle = ele;
                }
                result.push({ count: count, value: prevEle });

                return result;
            },
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
            hasBtnType(type){
                return !isEmpty(filter(this.innerButtons, b => b.type === type))
            },
            getBtn(type, attr = '', defaultValue = {}){
                return get(filter(this.innerButtons, v => v.type === type), '0'+(attr ? '.'+attr : ''), defaultValue)
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
                $('.btn-modal-table-form-submit').trigger('click')

                setTimeout(() => {
                    if(isEmpty(this.$refs['modal-table-form'].getErrors())){
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
                    }
                }, 300)
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
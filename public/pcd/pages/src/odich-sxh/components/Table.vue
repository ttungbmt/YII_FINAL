<template>
    <div class="mt-2">
        <b-table v-bind="options" :fields="fields" :items="innerItems" style="max-height: 500px">
<!--            <template v-slot:cell(tt)="data">-->
<!--                <span>{{labelLan(data)}}</span> {{ data.index + 1 }}-->
<!--            </template>-->

            <template v-slot:[`cell(${i.key})`]="data" v-for="i in fields">
                {{data.value}}
            </template>

            <template v-slot:cell(actions)="data">
                <b-button-group>
                    <b-button size="sm" variant="link" class="p-0 pr-2" @click="editItem(data)"><i class="icon-pencil7"></i></b-button>
                    <b-button size="sm" variant="link" class="p-0 text-danger" @click="deleteItem(data)"><i class="icon-bin"></i></b-button>
                </b-button-group>
            </template>

            <template v-slot:cell()="data">
                <i>{{ data.value }}</i>
            </template>
        </b-table>

        <v-wait :for="keyLoading" v-if="hasBtn('getList')">
            <template slot="waiting">
                <b-progress :value="100" :max="100" animated></b-progress>
            </template>

        </v-wait>

        <div class="btn-group">
            <button type="button" class="btn-small mt-2" @click="openModal" v-if="hasBtn('create')">Thêm mới</button>
            <button type="button" class="btn-small mt-2" @click="getList" v-if="hasBtn('getList')">{{getBtn('getList', 'label')}}</button>
        </div>


        <b-modal ref="modal-table" :title="form.title" v-if="form" v-bind="modalOptions">
            <div>
                <component v-bind:is="i.component" v-for="(i, k) in form.schema" v-bind="i" :key="k"></component>
            </div>
            <div class="mt-3 text-right">
                <b-button variant="danger" @click="handleCancel">Hủy</b-button>
                <b-button variant="primary" @click="handleOk">Lưu</b-button>
            </div>
        </b-modal>
    </div>

</template>
<script>
    import {has, get, includes, isNull, isString, isPlainObject, isEmpty, filter, head, isArray } from 'lodash-es'
    const KEY_LOADING = 'table'

    export default {
        inheritAttrs: false,
        name: 'v-table',
        props: [
            'buttons',
            'fields',
            'items',
            'itemsPath',
            'form'
        ],
        data(){
            return {
                keyLoading: KEY_LOADING,
                modelIndex: null,
                options: {
                    responsive: true,
                    hover: true,
                    small: 'small',
                    'head-variant': 'light'
                },
                modalOptions: {
                    'ok-title': 'Lưu',
                    'cancel-title': 'Hủy',
                    'hide-footer': true,
                    size: get(this.form, 'size', 'md')
                },
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
            hasBtn(name){
                return !isEmpty(filter(this.buttons, (v, k) => {
                    if(isString(v) && v === name) return true
                    if(has(v, 'key') && v.key === name) return true
                    return false
                }))
            },
            getBtn(name, attr = ''){
                return get(filter(this.buttons, v => this.hasBtn(name)), '0'+(attr ? '.'+attr : ''), {})
            },
            labelLan(data){
                let name = get(this, 'form.name')
                if(includes(['khaosat_cts', 'diet_lqs', 'phun_hcs'], name)) return 'Lần'
                return ''
            },
            editItem({index}){
                this.modelIndex = index
                let value = get(this.innerItems, index)
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
            handleCancel(){
                this.$refs['modal-table'].hide()
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
            }
        }
    }
</script>

<style scoped lang="scss">



</style>
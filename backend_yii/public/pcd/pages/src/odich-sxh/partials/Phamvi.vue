<template>
    <div>
        <div class="font-bold text-base underline text-pink-600">Phạm vi ổ dịch cần xử lý trên hệ thống GIS:</div>
        <v-wait :for="keyLoading">
            <template slot="waiting">
                <b-progress :value="100" :max="100" animated></b-progress>
            </template>
            <div v-html="html">

            </div>
        </v-wait>

        <button type="button" class="btn-small mt-2" @click="updatePhamviGis">Cập nhật phạm vi trên GIS</button>

        <div class="font-bold mt-2 text-base underline text-pink-600">Phạm vi ổ dịch cần xử lý:</div>
        <div id="phamvi-px-html">
            <div class="wrapper-col-pv" style="columns: auto 2">
                <div v-for="i in getPhamVi(1)">
                    <span class="font-bold">Khu phố/ấp {{i.khupho}} ({{i.to_dp | countToDp}}):</span> {{i.to_dp}}
                </div>
                <div v-if="!_.isEmpty(getPhamVi(2))">
                    <div class="font-bold uppercase underline mt-2">Liên Phường xã:</div>
                    <div v-for="pxs in _.groupBy(getPhamVi(2), 'maphuong')">
                        <div class="font-bold underline text-warning">
                            {{getTenPx(pxs)}}
                        </div>
                        <div v-for="kp in pxs"><span class="font-bold">Khu phố/ấp {{kp.khupho}} ({{kp.to_dp | countToDp}}): </span> {{kp.to_dp}}</div>
                    </div>
                </div>
                <div v-if="!_.isEmpty(getPhamVi(3))">
                    <div class="font-bold uppercase underline my-2">Liên Quận huyện:</div>
                    <div v-for="qhs in _.groupBy(getPhamVi(3), 'maquan')">
                        <div class="font-bold underline text-danger uppercase">
                            {{getTenQh(qhs)}}
                        </div>
                        <div v-for="pxs in _.groupBy(qhs, 'maphuong')">
                            <div class="font-bold underline text-warning">
                                {{getTenPx(pxs)}}
                            </div>
                            <div v-for="kp in pxs">
                                <span class="font-bold">Khu phố/ấp {{kp.khupho}} ({{kp.to_dp | countToDp}}): </span> {{kp.to_dp}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn-small mt-2" @click="updatePhamvi">Nhập phạm vi xử lý</button>

        <div v-if="phamvi_px_panel">
            <table class="table table-borderless">
                <thead>
                <tr>
                    <th style="width: 150px">Khu phố / ấp</th>
                    <th>Tổ</th>
                    <th style="width: 30px"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(i, k) in phamvis[1]">
                    <td class="td-cell-phamvi"><m-field v-model="i.khupho"></m-field></td>
                    <td class="td-cell-phamvi"><m-field v-model="i.to_dp"></m-field></td>
                    <td class="td-cell-phamvi pl-2 pr-2"><button type="button" class="btn btn-link" @click="deletePhamvi(1, k)"><i class="icon-bin text-danger"></i></button></td>
                </tr>
                </tbody>
            </table>
            <div v-if="!_.isEmpty(phamvis[2])">
                <div class="font-semibold uppercase ml-3 mt-3">
                    Liên phường/ xã
                </div>
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th style="width: 150px">Phường xã</th>
                        <th style="width: 150px">Khu phố / ấp</th>
                        <th>Tổ</th>
                        <th style="width: 30px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(i, k) in phamvis[2]">
                        <td class="td-cell-phamvi"><m-field v-model="i.maphuong" type="select" :items="dm_px" placeholder="Chọn phường xã..." :filterBy="{path: 'extra.maquan', value: maquan}"></m-field></td>
                        <td class="td-cell-phamvi"><m-field v-model="i.khupho"></m-field></td>
                        <td class="td-cell-phamvi"><m-field v-model="i.to_dp"></m-field></td>
                        <td class="td-cell-phamvi pl-2 pr-2"><button type="button" class="btn btn-link" @click="deletePhamvi(2, k)"><i class="icon-bin text-danger"></i></button></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div v-if="!_.isEmpty(phamvis[3])">
                <div class="font-semibold uppercase ml-3 mt-3">
                    Liên quận/ huyện
                </div>
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th style="width: 180px">Quận huyện</th>
                        <th style="width: 180px">Phường xã</th>
                        <th style="width: 150px">Khu phố / ấp</th>
                        <th>Tổ</th>
                        <th style="width: 30px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(i, k) in phamvis[3]">
                        <td class="td-cell-phamvi"><m-field v-model="i.maquan" type="select" :items="dm_qh" placeholder="Chọn quận huyện..."></m-field></td>
                        <td class="td-cell-phamvi"><m-field v-model="i.maphuong" type="select" :items="dm_px" placeholder="Chọn phường xã..." :filterBy="{path: 'extra.maquan', value: i.maquan}" @change="onChange"></m-field></td>
                        <td class="td-cell-phamvi"><m-field v-model="i.khupho"></m-field></td>
                        <td class="td-cell-phamvi"><m-field v-model="i.to_dp"></m-field></td>
                        <td class="td-cell-phamvi pl-2 pr-2"><button type="button" class="btn btn-link" @click="deletePhamvi(3, k)"><i class="icon-bin text-danger"></i></button></td>
                    </tr>
                    </tbody>
                </table>
            </div>


            <div class="flex mt-2 pl-3">
                <m-field :items="dm_phamvi" type="select" v-model="phamvi" style="width: 130px"></m-field>

                <div class="ml-2">
                    <button type="button" class="btn-small mt-2" @click="addPhamvi">Thêm mới</button>
                </div>
            </div>

            <div class="mt-3 text-right">
                <b-button variant="danger" @click="handleCancel()">Hủy</b-button>
                <b-button variant="success" @click="handleAutoToAn()"> <i class="icon-spinner2 spinner" v-if="$wait.is('auto-to-ah')"></i> Nhập tự động</b-button>
                <b-button variant="primary" @click="handleOk()">Lưu</b-button>
            </div>
        </div>
    </div>
</template>
<script>
    import {map, get, includes, keys, isEmpty, isEqual, cloneDeep, find } from 'lodash-es'
    import {get as pGet} from 'vuex-pathify'
    import $ from 'jquery'

    const KEY_LOADING = 'ranhto'

    export default {
        name: 'p-phamvi',
        computed: {
            dm_qh: pGet('cat.qh'),
            dm_px: pGet('cat.px'),
            maquan: pGet('form/values.maquan'),
            maphuong: pGet('form/values.maphuong'),
            phamvi_px: pGet('form/values.phamvi_px'),
            cabenhIds(){
                return map(this.$store.get('form/values.cabenhs'), 'gid')
            },
            postToAhData(){
                return {
                    cabenhIds: this.cabenhIds,
                    maquan: this.maquan,
                    maphuong: this.maphuong,
                }
            }
        },
        filters: {
            countToDp(value){
                if(value) return value.split(',').length
                return ''
            }
        },
        data () {
            return {
                keyLoading: KEY_LOADING,
                html: this.$store.get('form/values.phamvi_gis'),
                modalRef: 'modal-phamvi',
                modalOptions: {
                    'ok-title': 'Lưu',
                    'cancel-title': 'Hủy',
                    'hide-footer': true,
                    size: 'lg'
                },
                dm_phamvi: {
                    1: 'Trong phường/ xã',
                    2: 'Liên phường/ xã',
                    3: 'Liên quận/ huyện',
                },
                phamvis: {
                    1: [],
                    2: [],
                    3: [],
                },
                phamvi: 1,
                phamvi_px_panel: false,
            };
        },
        methods: {
            handleAutoToAn(){
                this.$wait.start('auto-to-ah');
                let data = {
                    ...this.postToAhData,
                    html: false,
                }
                this.$http.post(`/sxh/odich/to-ah`, data).then(({data}) => {
                    this.phamvis = data
                    this.$wait.end('auto-to-ah');
                })
            },
            handleCancel(name){
                this.phamvi_px_panel = false
                name && this.$refs[name].hide()
            },
            handleOk(name){
                let phamvis = this.phamvis
                phamvis[1] = phamvis[1].filter(v => v.khupho && v.to_dp)
                phamvis[2] = phamvis[2].filter(v => v.maphuong && v.khupho && v.to_dp)
                phamvis[3] = phamvis[3].filter(v => v.maquan && v.maphuong && v.khupho && v.to_dp)
                console.log(phamvis)

                this.$store.commit('updateField', {path: 'form/values.phamvi_px', value: phamvis})
                this.phamvi_px_panel = false
                name && this.$refs[name].hide()
                // this.$nextTick.then(function () {
                //     this.$store.commit('updateField', {path: 'form/values.phamvi_px_html', value: })
                // })
            },
            updatePhamviGis(){
                this.$wait.start(KEY_LOADING);
                let data = this.postToAhData

                this.$http.post(`/sxh/odich/to-ah`, data).then(({data}) => {
                    this.html = data

                    this.$store.commit('updateField', {
                        path: 'form/values.phamvi_gis',
                        value: data,
                    })

                    this.$wait.end(KEY_LOADING);
                })
            },
            getPhamVi(key){
                let pv = get(this.phamvi_px, key);
                return pv ? pv : []
            },
            updatePhamvi(){
                this.phamvis = isEqual(keys(this.phamvi_px), ['1', '2', '3']) ? cloneDeep(this.phamvi_px) : { 1: [], 2: [], 3: []}
                this.phamvi_px_panel = !this.phamvi_px_panel
            },

            addPhamvi(){
                this.phamvis[this.phamvi] = this.phamvis[this.phamvi].concat({maquan: null, maphuong: null, khupho: null, to_dp: null})
            },
            getTenPx(i){
                let value = get(i, '0.maphuong')
                return get(find(this.dm_px, {value}), 'label', value)
            },
            getTenQh(i){
                let value = get(i, '0.maquan')
                return get(find(this.dm_qh, {value}), 'label', value)
            },
            deletePhamvi(group, index){
                this.phamvis[group] = this.phamvis[group].filter((v, k) => k !== index)
            }
        }
    }
</script>


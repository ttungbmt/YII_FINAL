<template>
    <div>
        <vue-form @submit="onSubmit" name="form_bc">
            <div class="flex">
                <div class="flex flex-col flex-auto items-center text-base">
                    <div class="font-bold">SỞ Y TẾ TP. HỒ CHÍ MINH</div>
                    <div class="font-bold">TRUNG TÂM KIỂM SOÁT BỆNH TẬT</div>
                    <div>Số…………..</div>
                </div>
                <div class="flex flex-col flex-auto items-center text-base">
                    <div class="font-bold">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</div>
                    <div class="font-bold">Độc lập - Tự do - Hạnh phúc</div>
                </div>
            </div>
            <div class="text-right">
                TP. Hồ Chí Minh, ngày ….. tháng ….. năm 20……
            </div>

            <div class="text-center">
                <div class="text-xl  font-bold">
                    BÁO CÁO
                </div>
                <div class="text-base  font-bold">
                    Tổng hợp kết quả kiểm tra chất lượng nước sạch
                </div>
                <div class="mt-1">
                    <field-input
                            v-model="form.thoigian"
                            type="b-radio"
                            :options="cat.thoigian"
                            name="thoigian"
                            label="Báo cáo"
                            class="f-baocao"
                    />
                </div>
            </div>

            <div style="margin: 30px 0 20px 0">
                <div class="badge badge-light badge-striped badge-striped-left border-left-primary font-bold mb-2"
                     style="font-size: 13px">Danh sách đơn vị cung cấp nước
                </div>
                <field-input type="b-select" v-model="form.donvi_bc" name="donvi_bc" :options="cat.donvi_bc"
                             placeholder="Chọn đơn vị báo cáo..." @input="onChangeDonviBc"/>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th style="min-width: 140px">Tên đơn vị cấp nước</th>
                            <th>Số hộ gia đình được cung cấp nước sạch hoặc công suất</th>
                            <th>Lập hồ sơ</th>
                            <th>Hồ sơ đầy đủ theo quy định </th>
                            <th>Nếu không đầy đủ thì thiếu tài liệu gì</th>
                            <th>Số lượng mẫu và các thông số thử nghiệm nội kiểm trong kỳ báo cáo </th>
                            <th>Tần suất thực hiện nội kiểm </th>
                            <th>Chế độ báo cáo</th>
                            <th>Chế độ thông tin báo cáo</th>
                            <th>Các biện pháp khắc phục</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="(i, k) in form.donvi_cns">
                            <td>{{k+1}}</td>
                            <td>{{getCat(i.ten_dv, 'donvi_cn')}}</td>
                            <td>{{i.soho}}</td>
                            <td>{{getCatYn(i.lap_hs)}}</td>
                            <td>{{getCatYn(i.hs_daydu)}}</td>
                            <td>{{i.thieu_hs}}</td>
                            <td>{{getCatYnQd(i.somau)}}</td>
                            <td>{{getCatYnQd(i.tanxuat)}}</td>
                            <td>{{getCatYnQd(i.chedo_bc)}}</td>
                            <td>{{getCatYnQd(i.chedo_tt)}}</td>
                            <td>{{getCatYn(i.bienphap)}}</td>
                            <td style="padding: 0">
                                <b-button-group>
                                    <button type="button" class="btn btn-link" style="padding: 0 15px 0 10px"
                                            @click="editDv(k)"><i class="icon-pencil7 text-primay"></i></button>
                                    <button type="button" class="btn btn-link" style="padding: 0 10px 0 0"
                                            @click="removeDvCn(k)"><i class="icon-bin text-danger"></i></button>
                                </b-button-group>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div>
                    <b-button @click="showModalDv" class="btn-default btn-small mt-2" variant="light"> Thêm mới đơn vị
                        cấp nước
                    </b-button>
                </div>
            </div>

            <div>
                <div class="font-bold">A. TÌNH HÌNH CHUNG</div>
                <ul>
                    <li>
                        <div>Tổng số đơn vị cấp nước: {{form.donvi_cns.length}}</div>
                        <ul>
                            <li v-if="tk_cs1">{{tk_cs1}} cơ sở cung cấp nước có công suất thiết kế từ 1000 m3/ ngày đêm
                                trở lên;
                            </li>
                            <li v-if="tk_cs2">{{tk_cs2}} cơ sở cung cấp nước có công suất thiết kế dưới 1000 m3/ ngày
                                đêm;
                            </li>
                            <li v-if="tk_nhamay">{{tk_nhamay}} nhà máy nước.</li>
                        </ul>
                    </li>
                    <li>Tổng số HGĐ được cung cấp nước: {{tk_ho_gd_ccn}}/
                        <field-input type="b-text" v-model="form.ho_gd" style="width: 100px" class="inline-flex"/>  HGĐ. Chiếm tỷ lệ: {{tk_tyle_ho_gd}} %
                    </li>
                    <li>Tổng số đơn vị cấp nước được kiểm tra trong kỳ báo cáo: {{tk_tong_dvbc}} đơn vị.</li>
                </ul>

                <div class="font-bold">B. KẾT QUẢ THỰC HIỆN NGOẠI KIỂM CỦA TRUNG TÂM Y TẾ DỰ PHÒNG TP.HCM</div>
                <div>
                    <ul>
                        <li class="flex mt-2">Số cơ sở thực hiện ngoại kiểm/ Tổng số cơ sở: 8/36 đơn vị</li>
                        <li class="flex">
                            <div class="self-center mr-2">Số kinh phí được cấp cho công tác ngoại kiểm:</div>
                            <field-input type="b-text" v-model="form.sokinhphi"/>
                        </li>
                        <li class="flex mt-1">
                            <div class="mr-2">Kinh phí ngoại kiểm so với năm trước:</div>
                            <field-input type="b-radio" v-model="form.kinhphi_nk" :options="cat.tanggiam"/>
                        </li>
                        <li class="flex">
                            <div class="mr-2">Thực hiện báo cáo kết quả ngoại kiểm và công khai thông tin:</div>
                            <field-input type="b-radio" v-model="form.thuchien_bc" :options="cat.yesno_qd1"/>
                        </li>
                    </ul>
                </div>

                <div class="font-bold">C. KẾT QUẢ NỘI KIỂM CỦA CÁC ĐƠN VỊ CẤP NƯỚC</div>
                <div class="font-bold">1. Hồ sơ theo dõi, quản lý chất lượng nước, tần suất thực hiện nội kiểm và chế độ
                    thông tin báo cáo
                </div>
                <div class="font-bold">2. Kết quả thử nghiệm nước nội kiểm</div>
                <table>
                    <tbody>
                    <tr>
                        <td style="min-width: 244px">Tổng số mẫu nước làm thử nghiệm</td>
                        <td><field-input type="b-text" v-model="form.maunuoc_tn" style="margin: 0"/></td>
                    </tr>
                    <tr>
                        <td>Tổng số mẫu đạt quy chuẩn</td>
                        <td><field-input type="b-text" v-model="form.maunuoc_dqc" style="margin: 0"/></td>
                    </tr>
                    <tr style="height: 35px"><td>Tỷ lệ mẫu đạt quy chuẩn</td><td>{{tk_tyle_dqc}}%</td></tr>
                    <tr style="height: 35px"><td>Tổng số mẫu không đạt quy chuẩn</td><td>{{tk_mau_kdqd}}</td></tr>
                    <tr style="height: 35px"><td>Tỷ lệ mẫu không đạt quy chuẩn</td><td>{{tk_tylemau_kdqd}}</td></tr>
                    </tbody>
                </table>
                <div class="font-bold">Thông số không đạt</div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th></th>
                            <th style="min-width: 170px">Tên cơ sở cấp nước</th>
                            <th>pH</th>
                            <th>Độ đục (NTU)</th>
                            <th>Clo dư (mg/l)</th>
                            <th>Clorua (mg/l)</th>
                            <th>Nitrit (mg/l)</th>
                            <th>Nitrat (mg/l)</th>
                            <th>Sulphat (mg/l)</th>
                            <th>Độ cứng, tính theo CaCO3 (mg/l)</th>
                            <th>Pec (mg/l)</th>
                            <th>Fe tổng (mg/l)</th>
                            <th>Mn tổng (mg/l)</th>
                            <th>Màu (TCU)</th>
                            <th>Mùi, vị Không có mùi, vị lạ</th>
                            <th>Coli tổng vk/100ml</th>
                            <th>Ecoli vk/100ml</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(i, k) in form.coso_cns">
                            <td style="padding: 0; text-align: center">
                                <button type="button" class="btn btn-link" style="padding: 0 5px"
                                        @click="removeItem(k, 'coso_cns')"><i class="icon-bin text-danger"></i></button>
                            </td>
                            <td><field-input type="b-text" v-model="i.ten_cs"/></td>
                            <td><field-input type="b-text" v-model="i.ph"/></td>
                            <td><field-input type="b-text" v-model="i.doduc"/></td>
                            <td><field-input type="b-text" v-model="i.clodu"/></td>
                            <td><field-input type="b-text" v-model="i.clorua"/></td>
                            <td><field-input type="b-text" v-model="i.nitrit"/></td>
                            <td><field-input type="b-text" v-model="i.nitrat"/></td>
                            <td><field-input type="b-text" v-model="i.sulphat"/></td>
                            <td><field-input type="b-text" v-model="i.docung"/></td>
                            <td><field-input type="b-text" v-model="i.pec"/></td>
                            <td><field-input type="b-text" v-model="i.fe"/></td>
                            <td><field-input type="b-text" v-model="i.mn"/></td>
                            <td><field-input type="b-text" v-model="i.mau"/></td>
                            <td><field-input type="b-text" v-model="i.mui"/></td>
                            <td><field-input type="b-text" v-model="i.coli"/></td>
                            <td><field-input type="b-text" v-model="i.ecoli"/></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <b-button @click="addItem('coso_cns')" class="btn-default btn-small mt-2" variant="light">
                    Thêm mới cơ sở cấp nước
                </b-button>

               
                <div class="font-bold mt-6">D. KẾT QUẢ NGOẠI KIỂM NƯỚC SẠCH CỦA TRUNG TÂM Y TẾ DỰ PHÒNG TP.HCM</div>
                <ol>
                    <li>Số đơn vị cấp nước được ngoại kiểm/ Tổng số đơn vị cấp nước: 106/134 đơn vị; Tỷ lệ: 79,01%</li>
                    <li>Số lần ngoại kiểm/ Số đơn vị cấp nước được ngoại kiểm: 146 lần/ 106 đơn vị cấp nước được ngoại kiểm.</li>
                    <li>Liệt kê các đơn vị thực hiện ngoại kiểm</li>
                </ol>
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>TT</th>
                        <th>Tên đơn vị thực hiện ngoại kiểm</th>
                        <th>Số lần ngoại kiểm</th>
                        <th>Nội dung ngoại kiểm</th>
                        <th style="width: 150px">Thử nghiệm các thông số chất lượng nước (có, không)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(i, k) in form.donvi_thnks">
                        <td style="padding: 0; text-align: center">
                            <button type="button" class="btn btn-link" style="padding: 0 5px"
                                    @click="removeItem(k, 'donvi_thnks')"><i class="icon-bin text-danger"></i></button>
                        </td>
                        <td>{{k+1}}</td>
                        <td><field-input type="b-text" v-model="i.ten_dv"/></td>
                        <td><field-input type="b-text" v-model="i.solan"/></td>
                        <td><field-input type="b-text" v-model="i.noidung"/></td>
                        <td><field-input type="b-select" v-model="i.thunghiem" :options="cat.yesno" placeholder="Chọn..."/></td>
                    </tr>
                    </tbody>
                </table>
                <b-button @click="addItem('donvi_thnks')" class="btn-default btn-small mt-2" variant="light">
                    Thêm mới đơn vị
                </b-button>

                <div class="font-bold mt-6"> 4. Kết quả ngoại kiểm</div>

                <table class="table">
                    <thead>
                    <tr>
                        <th>TT</th>
                        <th>Nội dung ngoại kiểm</th>
                        <th>Đạt (Số lượng, tỷ lệ %)</th>
                        <th>Không đạt (Số lượng, tỷ lệ %)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1.</td>
                        <td>
                            <div>Hồ sơ theo dõi, quản lý chất lượng nước</div>
                            <ul>
                                <li>Lập hồ sơ</li>
                                <li>Hồ sơ đầy đủ theo quy định</li>
                            </ul>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>
                            <div>Thử nghiệm các thông số chất lượng nước nội kiểm</div>
                            <ul>
                                <li>Số mẫu</li>
                                <li>Kết quả (số mẫu, tỷ lệ %)</li>
                                <li>Các thông số không đạt</li>
                            </ul>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>
                            <div>Thực hiện báo cáo, công khai thông tin</div>
                            <ul>
                                <li>Báo cáo</li>
                                <li>Công khai thông tin</li>
                                <li>Các thông số không đạt</li>
                            </ul>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Thực hiện các biện pháp khắc phục (43 đơn vị cần khắc phục)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>
                            <div>Kết quả thử nghiệm thông số chất lượng nước của cơ quan ngoại kiểm</div>
                            <ul>
                                <li>Số mẫu</li>
                                <li>Kết quả (số mẫu, tỷ lệ %)</li>
                                <li>Các thông số không đạt</li>
                            </ul>
                        </td>
                        <td>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
                <div class="font-bold">E. KIẾN NGHỊ</div>
                <textarea v-model="form.kiennghi" rows="5" class="form-control mb-6"></textarea>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </vue-form>

        <b-modal ref="modal-dv" title="Đơn vị cấp nước" @ok="handleOk" ok-title="Ok" cancel-title="Hủy">
            <vue-form v-model="form_dv" name="form_dv">
                <field-input type="b-select" name="ten_dv" label="Tên đơn vị cấp nước" :options="cat.donvi_cn"
                             placeholder="Chọn đơn vị cấp nước..."/>
                <field-input type="b-text" name="soho" label="Số hộ gia đình được cung cấp nước sạch hoặc công suất"/>
                <div class="row">
                    <div class="col-md-6">
                        <field-input type="b-radio" name="lap_hs" :options="cat.yesno" label="Lập hồ sơ"/>
                    </div>
                    <div class="col-md-6">
                        <field-input type="b-radio" name="hs_daydu" :options="cat.yesno"
                                     label="Hồ sơ đầy đủ theo quy định "/>
                    </div>
                </div>

                <field-input type="b-text" name="thieu_hs" label="Nếu không đầy đủ thì thiếu tài liệu gì"/>

                <field-input type="b-radio" name="somau" :options="cat.yesno_qd"
                             label="Số lượng mẫu và các thông số thử nghiệm nội kiểm trong kỳ báo cáo "/>
                <field-input type="b-radio" name="tanxuat" :options="cat.yesno_qd"
                             label="Tần suất thực hiện nội kiểm "/>
                <field-input type="b-radio" name="chedo_bc" :options="cat.yesno_qd" label="Chế độ báo cáo"/>
                <field-input type="b-radio" name="chedo_tt" :options="cat.yesno_qd" label="Chế độ thông tin báo cáo"/>
                <field-input type="b-radio" name="bienphap" :options="cat.yesno" label="Các biện pháp khắc phục"/>
            </vue-form>
        </b-modal>

    </div>
</template>

<script>
    import {map, sortBy, get, find, isArray, omit, sum, isNil} from 'lodash-es'
    import axios from 'axios'
    import uniqid from 'uniqid'

    export default {
        name: 'page',
        inheritAttrs: false,
        data() {
            let form = this.$attrs.form,
                restData = omit(form.data, ['donvi_cns', 'coso_cns'])

            return {
                cat: {
                    ...this.$attrs.cat
                },
                form: {
                    donvi_cns: get(form, 'data.donvi_cns', []),
                    coso_cns: get(form, 'data.coso_cns', []),
                    donvi_thnks: get(form, 'data.donvi_thnks', []),
                    ...restData,
                    ...omit(form, ['data']),
                },
                form_dv: {}
            }
        },
        mounted() {
        },
        computed: {
            tk_tyle_ho_gd() {
                if(!this.form.ho_gd) return 0
                return ((this.tk_ho_gd_ccn/this.form.ho_gd)*100).toFixed(2)
            },
            tk_ho_gd_ccn() {
                return sum(this.form.donvi_cns.map(v => parseInt(v.soho)), 'soho')
            },
            tk_cs1() {
                return this.form.donvi_cns.filter(v => v.loaimau_id === 6).length
            },
            tk_cs2() {
                return this.form.donvi_cns.filter(v => v.loaimau_id === 11).length
            },
            tk_nhamay() {
                return this.form.donvi_cns.filter(v => v.loaimau_id === 1).length
            },
            tk_tong_dvbc(){
                return this.form.donvi_cns.filter(v => !v.lap_hs).length
            },
            tk_tyle_dqc(){
                if(!this.form.maunuoc_tn || isNil(this.form.maunuoc_dqc)) return ''
                return (this.form.maunuoc_dqc*100/this.form.maunuoc_tn).toFixed(0)
            },
            tk_mau_kdqd(){
                if(!this.form.maunuoc_tn) return ''
                return this.form.maunuoc_tn-this.form.maunuoc_dqc
            },
            tk_tylemau_kdqd(){
                if(!this.form.maunuoc_tn || isNil(this.tk_mau_kdqd)) return ''
                return (this.tk_mau_kdqd*100/this.form.maunuoc_tn).toFixed(0)
            }
        },
        methods: {
            onSubmit(values) {
                let data = this.form,
                    id = this.form.id,
                    url = '/admin/baocao-cln/' + (id ? `update?id=${id}` : 'create')

                axios.post(url, data, {
                    headers: {'X-Requested-With': 'XMLHttpRequest'}
                }).then(({data}) => {
                    alert('Đã lưu thành công')
                    if(!id) window.location.href = '/admin/baocao-cln'
                })
            },
            addItem(name){
                this.form[name].push({})
            },
            removeItem(index, name){
                this.form[name].splice(index, 1);
            },
            getCat(value, name) {
                let cat = this.cat[name]
                if (isArray(cat)) return get(find(cat, {value}), 'label')

                return get(cat, value)
            },
            onChangeDonviBc(val) {
                this.form.donvi_cns = []

                axios.get('/api/dm/donvi-cn?donvi_bc_id=' + val).then(({data}) => {
                    this.cat.donvi_cn = sortBy(data, ['label'])
                })
            },
            getCatYnQd(v) {
                return this.cat.yesno_qd[v]
            },
            getCatYn(v) {
                return this.cat.yesno[v]
            },
            showModalDv() {
                this.form_dv = {}
                this.$refs['modal-dv'].show()
            },
            editDv(index) {
                this.form_dv = this.form.donvi_cns[index]
                this.$refs['modal-dv'].show()
            },
            removeDvCn(index) {
                this.form.donvi_cns.splice(index, 1);
            },
            handleOk(e) {
                this.form_dv.loaimau_id = get(find(this.cat.donvi_cn, {value: this.form_dv.ten_dv}), 'extra.loaimau_id')

                if (this.form_dv._id) {
                    let index = _.findIndex(this.form.donvi_cns, {_id: this.form_dv._id})
                    this.$set(this.form.donvi_cns, index, this.form_dv)
                } else {
                    this.form.donvi_cns.push({
                        _id: uniqid(),
                        ...this.form_dv
                    })
                }

                this.$refs['modal-dv'].hide()
            }
        }
    }
</script>

<style lang="scss">
    .modal-backdrop {
        background-color: #75757566;
    }

    .dv-repeater .formulate-input-group-repeatable {
        display: flex;

        .formulate-input-group-repeatable-remove {
            order: 1;
        }
    }

    .dv_capnuoc {
        display: flex;

        .formulate-input {
            margin-right: 10px;
        }
    }

    .btn-small {
        font-size: 11px;
        padding: 3px 6px;
        text-transform: none;
    }
</style>
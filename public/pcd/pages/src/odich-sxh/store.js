import {isNil, cloneDeep} from 'lodash-es'
import {createStore} from '@ttungbmt/vuexy'

import Bus from './bus'

const options = {
    mutations: {
        updateForm(state, {path, value}){
            this.setIn(path, cloneDeep(value))
        },
        deleteForm(state, {path, value}){
            this.setIn(path, this.getIn(path).filter((v, k) => k !== value))
        },
        resetModal(state, {path, value = {}}){
            this.setIn(path, value)
        },
        updateModal(state, {path, value}){
            this.setIn(path, value)
        },
    },
    state: {
        cat: window.pageData.cat,
        form: {
            ...window.pageData.form,
        },
        formModal: {

        },
        schema: [
            {component: 'v-heading', type: 'heading', serial: 'I', title: 'Tổng quan về ổ dịch', class: 'text-lg'},
            {component: 'v-html', html: `<div class="mt-2 font-semibold"><div class="text-base uppercase">Danh sách ca bệnh trong ổ dịch</div></div>`},
            {
                component: 'v-table',
                class: 'mb-2',
                fields: [
                    {key: 'action', label: '', type: 'action', visibleButtons: {update: false}},
                    {key: 'tt', label: 'STT', type: 'serial'},
                    {key: 'hoten', label: 'Họ tên'},
                    {key: 'tuoi', label: 'Tuổi'},
                    {key: 'to_dp', label: 'Tổ'},
                    {key: 'khupho', label: 'Khu phố'},
                    {key: 'px', label: 'Phường xã'},
                    {key: 'qh', label: 'Quận huyện'},
                    {key: 'ngaymacbenh', label: 'Ngày mắc bệnh'},
                    {key: 'ngaybaocao', label: 'Ngày báo cáo'},
                ],
                itemsPath: 'form.cabenhs',
                buttons: [{
                    type: 'order',
                    label: 'Thay đổi thứ tự sắp xếp',
                    title: 'Thay đổi thứ tự sắp xếp ca bệnh trong ổ dịch',
                    formatter: function (item, index) {
                        return `${index+1} - <b>${item.hoten}</b> (${item.ngaymacbenh_nv})`
                    }
                }],
                onRowClicked: function (item, index) {
                    Bus.$emit('@map/SHOW_POPUP', {index, item});
                }
            },
            {component: 'v-field', label: 'Loại ổ dịch', type: 'select', items: 'cat.loai_od', placeholder: 'Chọn...', model: 'form.loai_od'},
            {
                component: 'v-grid',
                type: 'group',
                schema: [
                    {component: 'v-field', label: 'Ngày xác định ổ dịch', model: 'form.ngayxacdinh', type: 'date', placeholder: 'DD/MM/YYYY'},
                    {component: 'v-field', label: 'Ngày phát hiện ổ dịch', model: 'form.ngayphathien', type: 'date', placeholder: 'DD/MM/YYYY'},
                    {component: 'v-field', label: 'Ngày dự kiến kết thúc', model: 'form.ngaydukien_kt', type: 'date', placeholder: 'DD/MM/YYYY'},
                ]
            },
            {component: 'v-heading', type: 'heading', serial: 'II', title: 'Kết quả xử lý', class: 'text-lg'},
            {component: 'v-heading', type: 'heading', serial: '1', title: 'Phạm vi khoanh vùng xử lý', class: 'text-base', pill: true},
            {component: 'p-phamvi'},
            {component: 'v-field', label: 'Số nhà (nóc gia trong phạm vi ổ dịch đã xác định): ', model: 'form.sonocgia', type: 'integer', class: 'mt-2'},
            {component: 'v-heading', type: 'heading', serial: '2', title: 'Khảo sát côn trùng', class: 'text-base', pill: true},
            {
                component: 'v-table',
                fields: [
                    {key: 'action', label: '', type: 'action'},
                    {key: 'tt', label: 'Lần khảo sát', class: 'p-2', value: ({index}) => {
                        return `Lần ${index+1}`
                    }},
                    {key: 'ngay_ks', label: 'Ngày khảo sát'},
                    {key: 'loai_ks', label: 'Loại khảo sát', filter: 'cat.loai_ks'},
                    {
                        key: 'noi_ks', label: 'Nơi khảo sát', formatter(value) {
                            return `Tổ: ${value}`
                        }
                    },
                    {key: 'sonha_ks', label: 'Số nhà khảo sát'},
                    {
                        key: 'ketqua_ks', label: 'Kết quả', format: 'html', formatter: (value, key, item) => {
                            let m = (name) => isNil(item[name]) ? '' : item[name]

                            let str = ``

                            if(!isNil(item.loai_ks)) {

                                str = str + `
                                <span>BI=${m('bi')}</span><br>
                                <span>CI%=${m('ci')}</span><br>
                                <span>HILQ%=${m('hilq')}</span><br>
                            `
                            }

                            if(item.loai_ks == 2){

                                str = str+`
                                <span>DI=${m('di')}</span><br>
                                <span>HI muỗi=${m('hi_muoi')}</span><br>
                            `
                            }

                            return str
                        },
                    }
                ],
                buttons: ['create'],
                itemsPath: 'form.khaosat_cts',
                form: {
                    name: 'khaosat_cts',
                    path: 'formModal',
                    title: 'Khảo sát côn trùng',
                    schema: [
                        {key: 'action', label: '', class: 'p-2', type: 'action'},
                        {component: 'v-field', label: 'Ngày khảo sát', model: 'formModal.ngay_ks', type: 'date', placeholder: 'DD/MM/YYYY'},
                        {component: 'v-field', label: 'Loại khảo sát', model: 'formModal.loai_ks', type: 'select', items: 'cat.loai_ks', placeholder: 'Chọn...'},
                        {component: 'v-field', label: 'Nơi khảo sát (Tổ)', model: 'formModal.noi_ks'},
                        {component: 'v-field', label: 'Số nhà khảo sát', model: 'formModal.sonha_ks', type: 'integer'},
                        {
                            component: 'v-grid',
                            cols: 3,
                            schema: [
                                {component: 'v-field', label: 'BI', model: 'formModal.bi', type: 'integer'},
                                {component: 'v-field', label: 'CI%', model: 'formModal.ci', type: 'integer'},
                                {component: 'v-field', label: 'HILQ%', model: 'formModal.hilq', type: 'integer'},
                            ]
                        },
                        {
                            component: 'v-grid',
                            cols: 2,
                            cond_if: function () {
                                return this.$store.get('formModal.loai_ks') == 2
                            },
                            schema: [
                                {component: 'v-field', label: 'DI', model: 'formModal.di', type: 'integer'},
                                {component: 'v-field', label: 'HI_muoi', model: 'formModal.hi_muoi', type: 'integer'},
                            ]
                        },

                    ]
                }
            },
            {component: 'v-heading', type: 'heading', serial: '3', title: 'Diệt lăng quăng và kiểm soát điểm nguy cơ', class: 'text-base', pill: true},
            {
                component: 'v-row',
                class: 'ml-1',
                schema: [
                    {component: 'v-html', html: '<div class="mt-2 font-bold">a. Hoạt động diệt lăng quăng tại ổ dịch</div>'}
                ]
            },
            {
                component: 'v-table',
                fields: [
                    {key: 'action', label: '', class: 'p-2', type: 'action'},
                    {key: 'tt', label: 'Lần DLQ', value: ({index}) => {
                            return `Lần ${index+1}`
                    }},
                    {key: 'ngayxuly', label: 'Ngày DLQ'},
                    {key: 'khupho', label: 'Khu phố DLQ'},
                    {key: 'to_dp', label: 'Tổ DLQ'},
                    {key: 'sonha', label: 'Số nhà DLQ (vãng gia)'},
                    {key: 'songuoi', label: 'Số người tham gia'},
                ],
                buttons: ['create'],
                itemsPath: 'form.diet_lqs',
                form: {
                    name: 'diet_lqs',
                    title: 'Diệt lăng quăng ',
                    path: 'formModal',
                    schema: [
                        {component: 'v-field', label: 'Ngày DLQ', model: 'formModal.ngayxuly', type: 'date', placeholder: 'DD/MM/YYYY'},
                        {component: 'v-field', label: 'Khu phố DLQ', model: 'formModal.khupho'},
                        {component: 'v-field', label: 'Tổ DLQ', model: 'formModal.to_dp'},
                        {component: 'v-field', label: 'Số nhà DLQ (vãng gia)', model: 'formModal.sonha', type: 'integer'},
                        {component: 'v-field', label: 'Số người tham gia', model: 'formModal.songuoi', type: 'integer'},
                    ]
                }
            },
            {

                component: 'v-row',
                class: 'ml-1',
                schema: [
                    {component: 'v-html', html: '<div class="mt-2 font-bold">b. Hoạt động giám sát, xử lý điểm nguy cơ tại OD</div>'},
                    {
                        component: 'v-html', html: function () {
                            return  `<div class="mt-2">Số điểm nguy cơ trong ổ dịch: `+this.$store.get('form.dncs').length+`</div>`
                        }},
                    {
                        component: 'v-table',
                        fields: [
                            {key: 'action', label: '', type: 'action', visibleButtons: {update: false}},
                            {key: 'tt', label: '#', type: 'serial'},
                            {key: 'ten_cs', label: 'Tên điểm'},
                            {key: 'nhom', label: 'Nhóm'},
                            {key: 'loaihinh', label: 'Loại hình'},
                            {key: 'khupho', label: 'Khu phố'},
                            {key: 'to_dp', label: 'Tổ'},
                            {key: 'tenphuong', label: 'Phường xã'},
                            {key: 'tenquan', label: 'Quận huyện'},
                            {key: 'diachi', label: 'Địa chỉ'},
                        ],
                        itemsPath: 'form.dncs',
                        buttons: [
                            {
                                type: 'getList',
                                url: '/sxh/odich/dncs',
                                data(){
                                    return {
                                        cabenhIds: this.$store.get('form.cabenhs').map(v => v.gid),
                                        odich_id: this.$store.get('form.id'),
                                    }
                                },
                                label: 'Cập nhật danh sách ĐNC'
                            }
                        ]
                    },
                    {
                        component: 'v-grid',
                        class: 'mt-2',
                        cols: 2,
                        schema: [
                            {component: 'v-field', label: 'Ngày bắt đầu giám sát', model: 'form.ngaybatdau_gs', type: 'date', placeholder: 'DD/MM/YYYY'},
                        ]
                    },
                ]
            },
            {component: 'v-heading', type: 'heading', serial: '4', title: 'Hoạt động phun hóa chất', class: 'text-base', pill: true},
            {
                component: 'v-table',
                fields: [
                    {key: 'action', label: '', class: 'p-2', type: 'action'},
                    {
                        key: 'tt', label: 'Lần PHC', value: ({index}) => {
                            return `Lần ${index + 1}`
                        }
                    },
                    {key: 'khupho', label: 'Khu phố/ấp'},
                    {key: 'to_dp', label: 'Tổ dân phố'},
                    {key: 'sonocgia_tt', label: 'Số nóc gia thực tế'},
                    {key: 'sonocgia_xl', label: 'Số nóc gia xử lý'},
                    {key: 'somaylon', label: 'Số máy nhỏ'},
                    {key: 'somaynho', label: 'Số máy lớn'},
                    {key: 'loai_hc', label: 'Loại hóa chất'},
                    {key: 'solit_hc', label: 'Số lít hóa chất chưa pha (lít)'},
                    {key: 'songuoi_tg', label: 'Số người tham gia'},
                ],
                buttons: ['create'],
                itemsPath: 'form.phun_hcs',
                form: {
                    name: 'phun_hcs',
                    title: 'Phun hóa chất',
                    path: 'formModal',
                    size: 'lg',
                    schema: [
                        {
                            component: 'v-grid', cols: 2,
                            schema: [
                                {component: 'v-field', label: 'Tổ dân phố', model: 'formModal.to_dp'},
                                {component: 'v-field', label: 'Khu phố/ấp', model: 'formModal.khupho'},
                            ]
                        },
                        {
                            component: 'v-grid', cols: 2,
                            schema: [
                                {component: 'v-field', label: 'Số nóc gia thực tế', type: 'integer', model: 'formModal.sonocgia_tt'},
                                {component: 'v-field', label: 'Số nóc gia xử lý', type: 'integer', model: 'formModal.sonocgia_xl'},
                            ]
                        },
                        {
                            component: 'v-grid', cols: 2,
                            schema: [
                                {component: 'v-field', label: 'Số máy nhỏ', type: 'integer', model: 'formModal.somaylon'},
                                {component: 'v-field', label: 'Số máy lớn', type: 'integer', model: 'formModal.somaynho'},
                            ]
                        },
                        {component: 'v-field', label: 'Loại hóa chất', model: 'formModal.loai_hc'},
                        {
                            component: 'v-grid', cols: 2,
                            schema: [
                                {component: 'v-field', label: 'Số lít hóa chất chưa pha (lít)', type: 'integer', model: 'formModal.solit_hc'},
                                {component: 'v-field', label: 'Số người tham gia', type: 'integer', model: 'formModal.songuoi_tg'},
                            ]
                        },
                    ]
                }
            },
            {component: 'v-heading', type: 'heading', serial: '5', title: 'Hoạt động truyền thông', class: 'text-base', pill: true},
            {
                component: 'v-grid',
                type: 'group',
                schema: [
                    {component: 'v-field', label: 'Hình thức truyền thông', model: 'form.hdtt_hinhthuc'},
                    {component: 'v-field', label: 'Thời gian', model: 'form.hdtt_thoigian'},
                    {component: 'v-field', label: 'Địa điểm', class: 'col-span-2', model: 'form.hdtt_diadiem'},
                ]
            },
            {component: 'v-heading', type: 'heading', serial: '6', title: 'Đánh giá, đề xuất, kết luận', class: 'text-base', pill: true},
            {component: 'v-field', label: 'Ổ dịch kết thúc theo dõi ngày', type: 'date', model: 'form.ngayketthuc_td', placeholder: 'DD/MM/YYYY'},
            {component: 'v-field', label: 'Đánh giá, đề xuất, kết luận', type: 'editor', model: 'form.danhgia'},
            {
                component: 'v-grid',
                type: 'group',
                cols: 2,
                schema: [
                    {component: 'v-field', label: 'Người thực hiện', columns: 6, model: 'form.nguoithuchien'},
                    {component: 'v-field', label: 'Số điện thoại', columns: 6, model: 'form.dienthoai'},
                ]
            },
        ]
    },
}

export default createStore(options)

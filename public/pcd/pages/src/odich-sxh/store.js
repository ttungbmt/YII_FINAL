import {unset} from 'lodash-es'
import {createStore} from '@ttungbmt/vuexy'

const options = {
    mutations: {
        updateForm(state, {path, value}){
            this.setIn(path, value)
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
                    {key: 'tt', label: 'STT'},
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
            },
            {component: 'v-field', label: 'Loại ổ dịch', type: 'select', items: 'cat.loai_od', placeholder: 'Chọn...', model: 'form.loai_od'},
            {
                component: 'v-grid',
                type: 'group',
                schema: [
                    {component: 'v-field', label: 'Ngày xác định ổ dịch', model: 'form.ngayxacdinh', type: 'date', placeholder: 'DD/MM/YYYY'},
                    {component: 'v-field', label: 'Ngày phát hiện ổ dịch', model: 'form.ngayphathien', type: 'date', placeholder: 'DD/MM/YYYY'},
                    {component: 'v-field', label: 'Ngày dự kiến kết thúc', model: 'form.ngaydukien_kt', type: 'date', placeholder: 'DD/MM/YYYY'},
                    {component: 'v-field', label: 'Ngày kết thúc', model: 'form.ngayketthuc', type: 'date', placeholder: 'DD/MM/YYYY'},
                ]
            },
            {component: 'v-heading', type: 'heading', serial: 'II', title: 'Kế hoạch xử lý', class: 'text-lg'},
            {component: 'v-heading', type: 'heading', serial: '1', title: 'Phạm vi khoanh vùng xử lý', class: 'text-base', pill: true},
            {component: 'p-phamvi'},
            {component: 'v-heading', type: 'heading', serial: '2', title: 'Khảo sát côn trùng', class: 'text-base', pill: true},
            {
                component: 'v-table',
                fields: [
                    {key: 'actions', label: ''},
                    {key: 'tt', label: 'Lần khảo sát', class: 'p-2', formatter: (value, key, item) => {
                        console.log(value, key, item)
                        return `Lần ${key+1}`
                    }},
                    {key: 'ngay_ks', label: 'Ngày khảo sát'},
                    {key: 'loai_ks', label: 'Loại khảo sát'},
                    {key: 'noi_ks', label: 'Nơi khảo sát'},
                    {key: 'sonha_ks', label: 'Số nhà khảo sát'},
                    {
                        key: 'ketqua_ks', label: 'Kết quả', formatter: (value, key, item) => {
                            console.log(value, key, item)

                            return `<div>123</div>`
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
                        {key: 'actions', label: '', class: 'p-2'},
                        {component: 'v-field', label: 'Ngày khảo sát', model: 'formModal.ngay_ks', type: 'date', placeholder: 'DD/MM/YYYY'},
                        {component: 'v-field', label: 'Loại khảo sát', model: 'formModal.loai_ks', type: 'select', items: 'cat.loai_ks', placeholder: 'Chọn...'},
                        {component: 'v-field', label: 'Nơi khảo sát', model: 'formModal.noi_ks'},
                        {component: 'v-field', label: 'Số nhà khảo sát', model: 'formModal.sonha_ks', type: 'integer'},
                        {
                            component: 'v-grid',
                            cols: 3,
                            cond_if: function () {
                                return this.$store.get('formModal.loai_ks') == 1
                            },
                            schema: [
                                {component: 'v-field', label: 'BI', model: 'formModal.bi', type: 'integer'},
                                {component: 'v-field', label: 'CI%', model: 'formModal.ci', type: 'integer'},
                                {component: 'v-field', label: 'HILQ%', model: 'formModal.hilq', type: 'integer'},
                            ]
                        },
                        {
                            component: 'v-grid',
                            cond_if: function () {
                                return this.$store.get('formModal.loai_ks') == 2
                            },
                            cols: 2,
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
                    {key: 'actions', label: '', class: 'p-2'},
                    {key: 'tt', label: 'Lần DLQ'},
                    {key: 'ngay_dlq', label: 'Ngày DLQ'},
                    {key: 'khupho_dlq', label: 'Khu phố DLQ'},
                    {key: 'to_dp_dlq', label: 'Tổ DLQ'},
                    {key: 'sonha_dlq', label: 'Số nhà DLQ (vãng gia)'},
                    {key: 'songuoi_dlq', label: 'Số người tham gia'},
                ],
                buttons: ['create'],
                itemsPath: 'form.diet_lqs',
                form: {
                    name: 'diet_lqs',
                    title: 'Diệt lăng quăng ',
                    path: 'formModal',
                    schema: [
                        {component: 'v-field', label: 'Ngày DLQ', model: 'formModal.ngay_dlq', type: 'date', placeholder: 'DD/MM/YYYY'},
                        {component: 'v-field', label: 'Khu phố DLQ', model: 'formModal.khupho_dlq'},
                        {component: 'v-field', label: 'Tổ DLQ', model: 'formModal.to_dp_dlq'},
                        {component: 'v-field', label: 'Số nhà DLQ (vãng gia)', model: 'formModal.sonha_dlq', type: 'integer'},
                        {component: 'v-field', label: 'Số người tham gia', model: 'formModal.songuoi_dlq', type: 'integer'},
                    ]
                }
            },
            {

                component: 'v-row',
                class: 'ml-1',
                schema: [
                    {component: 'v-html', html: '<div class="mt-2 font-bold">b. Hoạt động giám sát, xử lý điểm nguy cơ tại OD</div>'},
                    {
                        component: 'v-table',
                        fields: [
                            {key: 'tt', label: '#'},
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
                                key: 'getList',
                                url: '/sxh/odich/dncs',
                                data(){
                                    return {cabenhIds: this.$store.get('form.cabenhs').map(v => v.gid)}
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
                            {component: 'v-field', label: 'Đơn vị xử phạt (nếu có)', model: 'form.donvi_xp'},
                        ]
                    },
                ]
            },
            {component: 'v-heading', type: 'heading', serial: '4', title: 'Hoạt động phun hóa chất', class: 'text-base', pill: true},
            {
                component: 'v-table',
                fields: [
                    {key: 'actions', label: '', class: 'p-2'},
                    {key: 'tt', label: 'Lần PHC'},
                    {key: 'to_dp', label: 'Khu phố/ấp'},
                    {key: 'khupho', label: 'Tổ dân phố'},
                    {key: 'sonocgia_tt', label: 'Số nóc gia thực tế'},
                    {key: 'sonocgia_xl', label: 'Số nóc gia xử lý'},
                    {key: 'somaylon', label: 'Số máy nhỏ'},
                    {key: 'somaynho', label: 'Số máy lớn'},
                    {key: 'loai_hc', label: 'Loại hóa chất'},
                    {key: 'solit_hc', label: 'Số lít hóa chất (lít)'},
                    {key: 'songuoi_tg', label: 'Số người tham gia'},
                ],
                buttons: ['create'],
                itemsPath: 'form.phun_hcs',
                form: {
                    name: 'phun_hcs',
                    title: 'Diệt lăng quăng ',
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
                                {component: 'v-field', label: 'Số lít hóa chất (lít)', type: 'integer', model: 'formModal.solit_hc'},
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

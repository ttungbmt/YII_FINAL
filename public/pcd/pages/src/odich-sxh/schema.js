import {isNil, isArray, toNumber} from 'lodash-es'

let ruleDate = `before_or_equal:today`,
    ruleInteger = 'integer|min_value:0',
    ruleNumber = 'min_value:0',
    cabenh_ids = window.pageData.form.cabenhs.map(v => v.gid).join(',')


export default [
    {component: 'validation-provider', vid: 'has_cabenhs'},
    {component: 'validation-provider', vid: 'dup_odich'},
    {component: 'validation-provider', vid: 'diet_lqs'},
    {component: 'validation-provider', vid: 'khaosat_cts'},
    {component: 'validation-provider', vid: 'phun_hcs'},

    {component: 'm-heading', type: 'heading', serial: 'I', title: 'Tổng quan về ổ dịch', class: 'text-lg'},
    {component: 'm-html', html: `<div class="mt-2 mb-2 font-semibold"><a href="/admin/cabenh-sxh?cabenh_ids=${cabenh_ids}" title="Mở danh sách chi tiết ca bệnh" target="_blank" class="flex"><div class="text-base uppercase">Danh sách ca bệnh trong ổ dịch</div> <i class="ml-2 mt-1 icon-link"></i></a></div>`},
    {
        component: 'm-table',
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
        itemsPath: 'form/values.cabenhs',
        buttons: [{
            type: 'order',
            label: 'Thay đổi thứ tự sắp xếp',
            title: 'Thay đổi thứ tự sắp xếp ca bệnh trong ổ dịch',
            formatter: function (item, index) {
                return `${index+1} - <b>${item.hoten}</b> (${item.ngaymacbenh_nv})`
            }
        }],
        onRowClicked: function (item, index) {
            Vuexy.$emit('@map/SHOW_POPUP', {index, item})
        }
    },
    {component: 'p-hanhchinh'},
    {
        component: 'm-grid',
        type: 'group',
        schema: [
            {component: 'm-field', label: 'Loại ổ dịch', type: 'select', items: 'cat.loai_od', placeholder: 'Chọn...', model: 'loai_od'},
            {component: 'm-field', label: 'Ngày xác định ổ dịch', model: 'ngayxacdinh', type: 'date', placeholder: 'DD/MM/YYYY', rules: ruleDate},
            {component: 'm-field', label: 'Ngày phát hiện ổ dịch', model: 'ngayphathien', type: 'date', placeholder: 'DD/MM/YYYY', rules: ruleDate},
            {component: 'm-field', label: 'Ngày dự kiến kết thúc', model: 'ngaydukien_kt', type: 'date', placeholder: 'DD/MM/YYYY'},
        ]
    },
    {component: 'm-heading', type: 'heading', serial: 'II', title: 'Kết quả xử lý', class: 'text-lg'},
    {component: 'm-heading', type: 'heading', serial: '1', title: 'Phạm vi khoanh vùng xử lý', class: 'text-base', pill: true},
    {component: 'p-phamvi'},
    {component: 'm-field', label: 'Số nhà (nóc gia trong phạm vi ổ dịch đã xác định): ', model: 'sonocgia', type: 'integer', class: 'mt-2', rules: ruleInteger},
    {component: 'm-heading', type: 'heading', serial: '2', title: 'Khảo sát côn trùng', class: 'text-base', pill: true},
    {
        component: 'm-table',
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
        itemsPath: 'form/values.khaosat_cts',
        form: {
            name: 'khaosat_cts',
            path: 'form/modal.values',
            title: 'Khảo sát côn trùng',
            schema: [
                {key: 'action', label: '', class: 'p-2', type: 'action'},
                {component: 'm-field', label: 'Ngày khảo sát', model: 'ngay_ks', type: 'date', placeholder: 'DD/MM/YYYY', rules: `${ruleDate}|required`},
                {component: 'm-field', label: 'Loại khảo sát', model: 'loai_ks', type: 'select', items: 'cat.loai_ks', placeholder: 'Chọn...', rules: `required`},
                {component: 'm-field', label: 'Nơi khảo sát (Tổ)', model: 'noi_ks', rules: `required`},
                {component: 'm-field', label: 'Số nhà khảo sát', model: 'sonha_ks', type: 'integer', rules: `${ruleInteger}|required`},
                {
                    component: 'm-grid',
                    cols: 3,
                    schema: [
                        {component: 'm-field', label: 'BI', model: 'bi', type: 'integer', rules: `${ruleInteger}|required`},
                        {component: 'm-field', label: 'CI%', model: 'ci', type: 'integer', rules: `${ruleInteger}|required`},
                        {component: 'm-field', label: 'HILQ%', model: 'hilq', type: 'integer', rules: `${ruleInteger}|required`},
                    ]
                },
                {
                    component: 'm-grid',
                    cols: 2,
                    cond_if: function () {
                        return this.$store.get('form/getModalValue', 'loai_ks') == 2
                    },
                    schema: [
                        {component: 'm-field', label: 'DI', model: 'di', type: 'integer', rules: `${ruleNumber}|required`},
                        {component: 'm-field', label: 'HI_muoi', model: 'hi_muoi', type: 'integer', rules: `${ruleInteger}|required`},
                    ]
                },

            ]
        }
    },
    {component: 'm-heading', type: 'heading', serial: '3', title: 'Diệt lăng quăng và kiểm soát điểm nguy cơ', class: 'text-base', pill: true},
    {
        component: 'm-row',
        class: 'ml-1',
        schema: [
            {component: 'm-html', html: '<div class="mt-2 font-bold">a. Hoạt động diệt lăng quăng tại ổ dịch</div>'}
        ]
    },
    {
        component: 'm-table',
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
        itemsPath: 'form/values.diet_lqs',
        form: {
            name: 'diet_lqs',
            title: 'Diệt lăng quăng ',
            path: 'form/modal.values',
            schema: [
                {component: 'm-field', label: 'Ngày DLQ', model: 'ngayxuly', type: 'date', placeholder: 'DD/MM/YYYY', rules: `${ruleDate}|required`},
                {component: 'm-field', label: 'Khu phố DLQ', model: 'khupho', rules: `required`},
                {component: 'm-field', label: 'Tổ DLQ', model: 'to_dp'},
                {component: 'm-field', label: 'Số nhà DLQ (vãng gia)', model: 'sonha', type: 'integer', rules: `${ruleInteger}|required`},
                {component: 'm-field', label: 'Số người tham gia', model: 'songuoi', type: 'integer', rules: `${ruleInteger}|required`},
            ]
        }
    },
    {

        component: 'm-row',
        class: 'ml-1',
        schema: [
            {component: 'm-html', html: '<div class="mt-2 font-bold">b. Hoạt động giám sát, xử lý điểm nguy cơ tại OD</div>'},
            {
                component: 'm-html', html: function () {
                    return  `<div class="mt-2">Số điểm nguy cơ trong ổ dịch: `+this.$store.get('form/getValue', 'dncs').length+`</div>`
                }},
            {
                component: 'm-table',
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
                itemsPath: 'form/values.dncs',
                buttons: [
                    {
                        type: 'getList',
                        url: '/sxh/odich/dncs',
                        data(){
                            return {
                                cabenhIds: this.$store.get('form/getValue', 'cabenhs').map(v => v.gid),
                                odich_id: this.$store.get('form/getValue', 'id'),
                            }
                        },
                        label: 'Cập nhật danh sách ĐNC'
                    },
                    {
                        type: 'search',
                        url: '/sxh/odich/suggestion-dncs',
                        label: 'Thêm ĐNC vào danh sách',
                    }
                ]
            },
            {component: 'm-field', label: 'Nhận định kết quả giám sát, xử lý điểm nguy cơ trong ổ dịch', model: 'nhandinh_gs', type: 'editor', class: 'mt-4',},
            {
                component: 'm-grid',
                cols: 2,
                schema: [
                    {component: 'm-field', label: 'Ngày bắt đầu giám sát', model: 'ngaybatdau_gs', type: 'date', placeholder: 'DD/MM/YYYY'},
                ]
            },
        ]
    },
    {component: 'm-heading', type: 'heading', serial: '4', title: 'Hoạt động phun hóa chất', class: 'text-base', pill: true},
    {
        component: 'm-table',
        fields: [
            {key: 'action', label: '', class: 'p-2', type: 'action'},
            {
                key: 'tt', label: 'Lần PHC', value: ({index}) => {
                    return `Lần ${index + 1}`
                }
            },
            {key: 'ngayxuly', label: 'Ngày PHC'},
            {key: 'khupho', label: 'Khu phố/ấp'},
            {key: 'to_dp', label: 'Tổ dân phố'},
            {key: 'sonocgia_tt', label: 'Số nóc gia thực tế'},
            {key: 'sonocgia_xl', label: 'Số nóc gia xử lý'},
            {key: 'somaynho', label: 'Số máy nhỏ'},
            {key: 'somaylon', label: 'Số máy lớn'},
            {key: 'loai_hc', label: 'Loại hóa chất', value: ({field, item}) => {
                    if(isArray(item[field.key])) return item[field.key].join(', ')
                    return item[field.key]
                }},
            {key: 'solit_hc', label: 'Số lít hóa chất chưa pha (lít)'},
            {key: 'songuoi_tg', label: 'Số người tham gia'},
        ],
        buttons: ['create'],
        itemsPath: 'form/values.phun_hcs',
        form: {
            name: 'phun_hcs',
            title: 'Phun hóa chất',
            path: 'form/modal.values',
            size: 'lg',
            schema: [
                {component: 'm-field', label: 'Ngày PHC', model: 'ngayxuly', type: 'date', rules: `${ruleDate}|required`},
                {
                    component: 'm-grid', cols: 2,
                    schema: [
                        {component: 'm-field', label: 'Khu phố/ấp', model: 'khupho', rules: `required`},
                        {component: 'm-field', label: 'Tổ dân phố', model: 'to_dp'},
                    ]
                },
                {
                    component: 'm-grid', cols: 2,
                    schema: [
                        {
                            component: 'm-field',
                            label: 'Số nóc gia thực tế',
                            type: 'integer',
                            model: 'sonocgia_tt',
                            rules: function (v) {
                                let value = toNumber($('input[name="sonocgia"]').val())
                                if(value) return `${ruleInteger}|required|max_value:${value}`
                                return `${ruleInteger}|required`
                            }
                        },
                        {
                            component: 'm-field',
                            label: 'Số nóc gia xử lý',
                            type: 'integer',
                            model: 'sonocgia_xl',
                            rules: `required|max_field_value:sonocgia_tt`


                        },
                    ]
                },
                {
                    component: 'm-grid', cols: 2,
                    schema: [
                        {component: 'm-field', label: 'Số máy nhỏ', type: 'integer', model: 'somaynho', rules: `${ruleInteger}|required`},
                        {component: 'm-field', label: 'Số máy lớn', type: 'integer', model: 'somaylon', rules: `${ruleInteger}|required`},
                    ]
                },
                {component: 'm-field', label: 'Loại hóa chất (nếu không có trong danh sách, vui lòng liên hệ với admin để thêm mới)', type: 'v-select', items: 'cat.hoachat', model: 'loai_hc', placeholder: 'Chọn...', multiple: true, rules: `required`},
                {
                    component: 'm-grid', cols: 2,
                    schema: [
                        {component: 'm-field', label: 'Số lít hóa chất chưa pha (lít)', type: 'integer', model: 'solit_hc', rules: `${ruleNumber}|required`},
                        {component: 'm-field', label: 'Số người tham gia', type: 'integer', model: 'songuoi_tg', rules: `${ruleInteger}|required`},
                    ]
                },
            ]
        }
    },
    {component: 'm-heading', type: 'heading', serial: '5', title: 'Hoạt động truyền thông', class: 'text-base', pill: true},
    {component: 'm-field', label: 'Hình thức truyền thông', type: 'editor', model: 'hdtt_hinhthuc'},
    {
        component: 'm-grid',
        type: 'group',
        schema: [
            {component: 'm-field', label: 'Thời gian', model: 'hdtt_thoigian'},
            {component: 'm-field', label: 'Địa điểm', class: 'col-span-2', model: 'hdtt_diadiem'},
        ]
    },
    {component: 'm-heading', type: 'heading', serial: '6', title: 'Đánh giá, đề xuất, kết luận', class: 'text-base', pill: true},
    {component: 'm-field', label: 'Ổ dịch kết thúc theo dõi ngày', type: 'date', model: 'ngayketthuc_td', placeholder: 'DD/MM/YYYY', rules: ruleDate},
    {component: 'm-field', label: 'Đánh giá, đề xuất, kết luận', type: 'editor', model: 'danhgia'},
    {
        component: 'm-grid',
        type: 'group',
        cols: 2,
        schema: [
            {component: 'm-field', label: 'Người thực hiện', columns: 6, model: 'nguoithuchien'},
            {component: 'm-field', label: 'Số điện thoại', columns: 6, model: 'dienthoai'},
        ]
    },
]
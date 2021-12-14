import {get, isNil, toNumber} from 'lodash'


const optsDb = (name) => get(window.pageData, `cat.${name}`, [])

export default [
    {component: 'h2', children: 'Biên bản phun chủ động', class: 'font-bold uppercase text-blue-600 text-center mb-10'},
    {
        component: 'm-grid', cols: 2, children: [
            {name: 'maquan', type: 'select', rules: 'required', options: optsDb('qh'), label: 'Quận huyện', placeholder: 'Chọn quận huyện'},
            {name: 'maphuong', type: 'select', rules: 'required', options: optsDb('px'), label: 'Phường xã', placeholder: 'Chọn phường xã', dependsOn: 'qh', dependKey: 'extra.maquan'},
        ]
    },
    {component: 'h6', children: 'Kết quả xử lý', class: 'font-bold uppercase text-blue-700'},

    {component: 'h6', children: '1. Lý do phun chủ động', class: 'font-bold text-blue-600'},
    {name: 'loai_xl', type: 'select', placeholder: 'Loại xử lý', rulesName: 'Loại xử lý', rules: 'required', options: optsDb('loai_xl')},

    {component: 'h6', children: '2. Phạm vi xử lý', class: 'font-bold text-blue-600'},
    {
        component: 'm-container', if: `loai_xl == '2'`,
        class: 'mb-2',
        children: [
            {name: 'khuphos', label: 'Khu phố/ấp và tổ dân phố'},
        ]
    },
    {
        component: 'm-container', if: `loai_xl == '1'`,
        class: 'mb-2',
        children: [
            {component: 'phamvi-dnc'},
        ]
    },

    {name: 'sonocgia', type: 'number', label: 'Số nhà (số nóc gia trong phạm vi xử lý đã xác định)', rulesName: 'Số nhà', rules: 'required', placeholder: 'Số nhà'},
    {
        type: 'checkbox',
        name: 'hoatdong_xl',
        label: 'Các hoạt động xử lý',
        options: {khaosat_ct: 'Khảo sát côn trùng', diet_lq: 'Diệt lăng quăng', phun_hc: 'Phun hóa chất'},
        rules: 'required',
    },
    {
        component: 'm-container', key: 'part-1', if: `window._.includes(hoatdong_xl, 'khaosat_ct')`,
        children: [
            {component: 'h6', children: '3. Khảo sát côn trùng', class: 'font-bold text-blue-600'},
            {
                type: 'table',
                stickyHeader: true,
                small: true,
                rulesName: 'Khảo sát công trùng',
                class: 'mb-4',
                name: 'khaosat_cts',
                rules: 'required',
                fields: [
                    {key: 'action', label: '', type: 'action'},
                    {key: 'tt', label: 'Lần khảo sát', class: 'p-2', type: 'serial', prefix: 'Lần '},
                    {key: 'ngay_ks', label: 'Ngày khảo sát'},
                    {key: 'loai_ks', label: 'Loại khảo sát', formatter: 'optionLabel'},
                    {key: 'noi_ks', label: 'Nơi khảo sát', formatter: (value) => value ? `Tổ: ${value}` : ''},
                    {key: 'sonha_ks', label: 'Số nhà khảo sát'},
                    {
                        key: 'ketqua_ks', label: 'Kết quả', asHtml: true, formatter: (value, key, item) => {
                            let m = (name) => isNil(item[name]) ? '' : item[name],
                                str = ''
                            if(!isNil(item.loai_ks)) str += [`<span>BI=${m('bi')}</span>`, `<span>CI%=${m('ci')}</span>`, `<span>HILQ%=${m('hilq')}</span><br>`].join('<br>')
                            if(item.loai_ks === '2') str += [`<span>DI=${m('di')}</span>`, `<span>HI muỗi=${m('hi_muoi')}</span>`].join('<br>')
                            return str
                        }
                    }
                ],
                buttons: ['create'],
                form: {
                    name: 'khaosat_cts',
                    title: 'Khảo sát côn trùng',
                    defaultValues: {
                        loai_ks: null
                    },
                    schema: [
                        {label: 'Ngày khảo sát', name: 'ngay_ks', type: 'date', placeholder: 'DD/MM/YYYY', dateFormat: 'd/m/Y', rules: `required`, autocomplete: 'off'},
                        {label: 'Loại khảo sát', name: 'loai_ks', type: 'select', placeholder: 'Chọn...', rules: `required`, options: optsDb('loai_ks')},
                        {label: 'Nơi khảo sát (Tổ)', name: 'noi_ks', rules: `required`},
                        {label: 'Số nhà khảo sát', name: 'sonha_ks', rules: `required|integer|min:0`},
                        {
                            component: 'm-grid',
                            cols: 3,
                            children: [
                                {label: 'BI', name: 'bi', type: 'number', rules: `required|integer|min:0`},
                                {label: 'CI%', name: 'ci', type: 'number', rules: `required|integer|min:0`},
                                {label: 'HILQ%', name: 'hilq', type: 'number', rules: `required|integer|min:0`},
                            ]
                        },
                        {
                            component: 'm-container',
                            class: 'grid grid-cols-3 gap-3',
                            if: `loai_ks == '2'`,
                            children: [
                                {label: 'DI', name: 'di', type: 'text', rules: `required|number`},
                                {label: 'HI_muoi', name: 'hi_muoi', type: 'text', rules: `required|integer|min:0`},
                            ]
                        },
                    ]
                }
            }
        ]
    },
    {
        component: 'm-container', if: `window._.includes(hoatdong_xl, 'diet_lq')`,
        children: [
            {component: 'h6', children: '4. Diệt lăng quăng', class: 'font-bold text-blue-600'},
            {
                type: 'table',
                stickyHeader: true,
                small: true,
                rulesName: 'Diệt lăng quăng',
                class: 'mb-4',
                name: 'diet_lqs',
                rules: 'required',
                fields: [
                    {key: 'action', label: '', class: 'p-2', type: 'action'},
                    {key: 'tt', label: 'Lần DLQ', class: 'p-2', type: 'serial', prefix: 'Lần '},
                    {key: 'ngayxuly', label: 'Ngày DLQ'},
                    {key: 'khupho', label: 'Khu phố DLQ'},
                    {key: 'to_dp', label: 'Tổ DLQ'},
                    {key: 'sonha', label: 'Số nhà DLQ (vãng gia)'},
                    {key: 'songuoi', label: 'Số người tham gia'},
                ],
                buttons: ['create'],
                form: {
                    title: 'Diệt lăng quăng',
                    schema: [
                        {label: 'Ngày DLQ', name: 'ngayxuly', type: 'date', placeholder: 'DD/MM/YYYY', dateFormat: 'd/m/Y', rules: `required`, autocomplete: 'off'},
                        {label: 'Khu phố DLQ', name: 'khupho', rules: `required`},
                        {label: 'Tổ DLQ', name: 'to_dp'},
                        {label: 'Số nhà DLQ (vãng gia)', name: 'sonha', type: 'number', rules: `required|integer|min:0`},
                        {label: 'Số người tham gia', name: 'songuoi', type: 'number', rules: `required|integer|min:0`},
                    ]
                }
            }
        ]
    },
    {
        component: 'm-container', if: `window._.includes(hoatdong_xl, 'phun_hc')`,
        children: [
            {component: 'h6', children: '5. Hoạt động phun hóa chất', class: 'font-bold text-blue-600'},
            {
                type: 'table',
                stickyHeader: true,
                small: true,
                rulesName: 'Hoạt động phun hóa chất',
                class: 'mb-4',
                name: 'phun_hcs',
                rules: 'required',
                buttons: ['create'],
                fields: [
                    {key: 'action', label: '', class: 'p-2', type: 'action'},
                    {key: 'tt', label: 'Lần PHC', class: 'p-2', type: 'serial', prefix: 'Lần '},
                    {key: 'ngayxuly', label: 'Ngày PHC'},
                    {key: 'khupho', label: 'Khu phố/ấp'},
                    {key: 'to_dp', label: 'Tổ dân phố'},
                    {key: 'sonocgia_tt', label: 'Số nóc gia thực tế'},
                    {key: 'sonocgia_xl', label: 'Số nóc gia xử lý'},
                    {key: 'somaynho', label: 'Số máy nhỏ'},
                    {key: 'somaylon', label: 'Số máy lớn'},
                    {
                        key: 'loai_hc', label: 'Loại hóa chất', value: ({field, item}) => {
                            if (isArray(item[field.key])) return item[field.key].join(', ')
                            return item[field.key]
                        }
                    },
                    {key: 'solit_hc', label: 'Số lít hóa chất chưa pha (lít)'},
                    {key: 'songuoi_tg', label: 'Số người tham gia'},
                ],
                form: {
                    title: 'Hoạt động phun hóa chất',
                    schema: [
                        {label: 'Ngày PHC', name: 'ngayxuly', type: 'date', placeholder: 'DD/MM/YYYY', dateFormat: 'd/m/Y', rules: `required`, autocomplete: 'off'},
                        {
                            component: 'm-grid', cols: 2,
                            children: [
                                {label: 'Khu phố/ấp', model: 'khupho', rules: `required`},
                                {label: 'Tổ dân phố', model: 'to_dp', rules: `required`},
                            ]
                        },
                        {
                            component: 'm-grid', cols: 2,
                            children: [
                                {
                                    label: 'Số nóc gia thực tế',
                                    type: 'number',
                                    name: 'sonocgia_tt',
                                    validationRules: {
                                        maxNocgia: ({ value }) => {
                                            let nocgiaVal = toNumber($('input[name="sonocgia"]').val())
                                            if(nocgiaVal) return value <= nocgiaVal
                                            return true
                                        }
                                    },
                                    rules: 'required|integer|min:0|maxNocgia',
                                    validationMessages: {
                                        maxNocgia: ({name, value}) => {
                                            let nocgiaVal = toNumber($('input[name="sonocgia"]').val())
                                            return `${name} phải nhỏ hơn ${nocgiaVal}`
                                        }
                                    }
                                },
                                {label: 'Số nóc gia xử lý', type: 'number', name: 'sonocgia_xl', rules: `required|^max_value:sonocgia_tt`},
                            ]
                        },
                        {
                            component: 'm-grid', cols: 2,
                            children: [
                                {label: 'Số máy nhỏ', type: 'number', name: 'somaynho', rules: `required|integer|min:0`},
                                {label: 'Số máy lớn', type: 'number', name: 'somaylon', rules: `required|integer|min:0`},
                            ]
                        },
                        {type: 'select', options: optsDb('hoachat'), name: 'loai_hc', placeholder: 'Chọn...', multiple: true, rules: `required`, label: 'Loại hóa chất (nếu không có trong danh sách, vui lòng liên hệ với admin để thêm mới)', },
                        {
                            component: 'm-grid', cols: 2,
                            children: [
                                {label: 'Số lít hóa chất chưa pha (lít)', type: 'number', name: 'solit_hc', rules: `required|number|min:0`},
                                {label: 'Số người tham gia', type: 'number', name: 'songuoi_tg', rules: `required|integer|min:0`},
                            ]
                        },
                    ]
                }
            }
        ]
    },
]
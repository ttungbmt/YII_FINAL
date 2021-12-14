export default [
    {component: 'h1', children: 'Phiếu điều tra ca bệnh nghi sốt thương hàn', class: 'font-bold uppercase text-blue-600 text-center mb-12'},

    {component: 'h5', children: 'I. Thông tin bệnh viện', class: 'font-bold uppercase text-blue-600'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', model: 'info_benhvien.ten_bv', type: 'text', label: 'Tên bệnh viện'},
            {component: 'm-field', model: 'info_benhvien.tentinh', type: 'text', label: 'Tên tỉnh'},
            {component: 'm-field', model: 'info_benhvien.ten_bs', type: 'text', label: 'Tên bác sỹ khám bệnh'},
            {component: 'm-field', model: 'info_benhvien.masobenhan', type: 'text', label: 'Mã số bệnh án'},
        ]
    },

    {component: 'h5', children: 'II. Thông tin trung tâm y tế dự phòng', class: 'font-bold uppercase text-blue-600'},
    {
        component: 'm-grid', children: [
            {model: 'info_ttytdp.ten_tt', type: 'text', label: 'Tên TTYTDP', outerClass: ['col-span-2']},
            {model: 'info_ttytdp.sdt_tt', type: 'text', label: 'Số điện thoại trung tâm'},
            {model: 'info_ttytdp.fax_tt', type: 'text', label: 'Fax'},
        ]
    },
    {
        component: 'm-grid', cols: 2, children: [
            {model: 'info_ttytdp.ten_ndt', type: 'text', label: 'Tên người điều tra'},
            {model: 'info_ttytdp.sdt_ndt', type: 'text', label: 'Số điện thoại người điều tra'},
        ]
    },

    {component: 'h5', children: 'III. Thông tin bệnh nhân', class: 'font-bold uppercase text-blue-600'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', model: 'info_benhnhan.ten_bn', type: 'text', label: 'Tên'},
            {component: 'm-field', model: 'info_benhnhan.gioitinh', type: 'm-radio', label: 'Giới', items: 'gioitinh'},
            {component: 'm-field', model: 'info_benhnhan.ngaysinh', type: 'date', label: 'Ngày sinh', placeholder: 'DD/MM/YYYY'},
            {component: 'm-field', model: 'info_benhnhan.tuoi', type: 'number', label: 'Tuổi'},
        ]
    },
    {
        component: 'm-grid', children: [
            {model: 'info_benhnhan.dienthoai', type: 'text', label: 'Điện thoại'},
            {model: 'info_benhnhan.dantoc', type: 'text', label: 'Dân tộc'},
            {model: 'info_benhnhan.quoctich', type: 'text', label: 'Quốc tịch'},
            {model: 'info_benhnhan.nghenghiep', type: 'text', label: 'Nghề nghiệp'},
        ]
    },
    {
        component: 'm-grid', children: [
            {model: 'info_benhnhan.sonha', type: 'text', label: 'Số nhà'},
            {model: 'info_benhnhan.tenduong', type: 'text', label: 'Đường'},
            {model: 'info_benhnhan.qh', type: 'text', label: 'Quận/Huyện'},
            {model: 'info_benhnhan.px', type: 'text', label: 'Phường/Xã'},
        ]
    },
    {
        component: 'm-grid', children: [
            {model: 'info_benhnhan.ten_chame', type: 'text', label: 'Tên Cha/Mẹ (<15 tuổi)'},
            {component: 'm-field', model: 'info_benhnhan.lvlq_chebien', type: 'm-radio', label: 'Làm việc liên quan chế biến thực phẩm', items: 'yesno'},
            {component: 'm-field', model: 'info_benhnhan.lvlq_trenho', type: 'm-radio', label: 'Làm việc liên quan đến trẻ nhỏ/ người già/ hệ thống y tế', items: 'yesno', outerClass: ['col-span-2']},
        ]
    },

    {component: 'h5', children: 'IV. Triệu trứng lâm sàng', class: 'font-bold uppercase text-blue-600'},
    {
        component: 'm-grid', cols: 2, children: [
            {model: 'tt_lamsang.ngaykhoibenh', type: 'date', label: 'Ngày khởi bệnh', placeholder: 'DD/MM/YYYY'},
            {model: 'tt_lamsang.ngaynhapvien', type: 'date', label: 'Ngày nhập viện', placeholder: 'DD/MM/YYYY'},
        ]
    },
    {
        component: 'm-grid', cols: 2, children: [
            {component: 'm-field', model: 'tt_lamsang.sotkeodai', type: 'm-radio', label: 'Sốt kéo dài ít nhất 3 ngày', items: 'yesno', wrapperClass: ['flex gap-4'], labelClass: ['w-48']},
            {component: 'm-field', model: 'tt_lamsang.tt_tieuchay', type: 'm-radio', label: 'Tiêu chảy', items: 'yesno', wrapperClass: ['flex gap-4'], labelClass: ['w-48']},
            {component: 'm-field', model: 'tt_lamsang.tt_chanan', type: 'm-radio', label: 'Chán ăn', items: 'yesno', wrapperClass: ['flex gap-4'], labelClass: ['w-48']},
            {component: 'm-field', model: 'tt_lamsang.tt_taobon', type: 'm-radio', label: 'Táo bón', items: 'yesno', wrapperClass: ['flex gap-4'], labelClass: ['w-48']},
            {component: 'm-field', model: 'tt_lamsang.tt_hokhan', type: 'm-radio', label: 'Ho khan', items: 'yesno', wrapperClass: ['flex gap-4'], labelClass: ['w-48']},
            {component: 'm-field', model: 'tt_lamsang.tt_machcham', type: 'm-radio', label: 'Mạch chậm', items: 'yesno', wrapperClass: ['flex gap-4'], labelClass: ['w-48']},
            {component: 'm-field', model: 'tt_lamsang.tt_lachto', type: 'm-radio', label: 'Lách to', items: 'yesno', wrapperClass: ['flex gap-4'], labelClass: ['w-48']},
            {component: 'm-field', model: 'tt_lamsang.tt_hongban', type: 'm-radio', label: 'Hồng ban', items: 'yesno', wrapperClass: ['flex gap-4'], labelClass: ['w-48']},
            {component: 'm-field', model: 'tt_lamsang.tt_oohcp', type: 'm-radio', label: 'Ọp ẹp hố chậu phải', items: 'yesno', wrapperClass: ['flex gap-4'], labelClass: ['w-48']},
            {component: 'm-field', model: 'tt_lamsang.tt_lomo', type: 'm-radio', label: 'Lơ mơ', items: 'yesno', wrapperClass: ['flex gap-4'], labelClass: ['w-48']},
            {component: 'm-field', model: 'tt_lamsang.tt_xhtieuhoa', type: 'm-radio', label: 'Xuất huyết tiêu hóa', items: 'yesno', wrapperClass: ['flex gap-4'], labelClass: ['w-48']},
            {component: 'm-field', model: 'tt_lamsang.tt_thungruot', type: 'm-radio', label: 'Thủng ruột', items: 'yesno', wrapperClass: ['flex gap-4'], labelClass: ['w-48']},
            {component: 'm-field', model: 'tt_lamsang.dt_khangsinh', type: 'm-radio', label: 'Điều trị kháng sinh', items: 'yesno', wrapperClass: ['flex gap-4'], labelClass: ['w-48']},
            {component: 'm-field', model: 'tt_lamsang.nonoi', type: 'text', label: 'Tên kháng sinh', wrapperClass: ['flex gap-4'], labelClass: ['w-48']},
        ]
    },
    {
        component: 'm-grid', cols: 2, children: [
            {model: 'tt_lamsang.tinhtrang_xv', type: 'text', label: 'Tình trạng xuất viện'},
            {model: 'tt_lamsang.ngayxuatvien', type: 'date', label: 'Ngày xuất viện'},
        ]
    },

    {component: 'h5', children: 'V. Tiền sử tiêm vắc xin', class: 'font-bold uppercase text-blue-600'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', model: 'tiensu_tvx.vx_thuonghan', type: 'm-radio', label: 'Tiêm Vắc xin Thương Hàn?', items: 'yesno'},
            {component: 'm-field', model: 'tiensu_tvx.ten_vx', type: 'm-radio', label: 'Tên Vắc xin', items: 'thuonghan_xv'},
            {model: 'tiensu_tvx.solieu', type: 'number', label: 'Số liều'},
        ]
    },
    {
        component: 'm-grid', cols: 2, children: [
            {model: 'tiensu_tvx.ngaynhan_lc', type: 'date', label: 'Ngày nhận liều cuối'},
            {model: 'tiensu_tvx.nguon_tt', type: 'text', label: 'Nguồn thông tin'},
        ]
    },

    {component: 'h5', children: 'VI. Thông tin dịch tễ', class: 'font-bold uppercase text-blue-600'},
    {component: 'h6', children: '1. Trong vòng 1 tháng gần đây', class: 'font-semibold text-blue-600'},
    {model: 'tiensu_tvx.ngaynhan_lc', type: 'm-radio', label: 'Bệnh nhân có đi nơi khác không?', items: 'yesno'},
    {model: 'tiensu_tvx.nguon_tt', type: 'text', label: 'Địa chỉ nơi đến (nếu có)', outerClass: ['col-span-3']},
    {
        component: 'm-grid', children: [
            {component: 'm-field', model: 'tiensu_tvx.ngaynhan_lc', type: 'm-radio', label: 'Có tiếp xúc với ai mắc bệnh tương tự không', items: 'yesno'},
            {model: 'tiensu_tvx.nguon_tt', type: 'text', label: 'Tiếp xúc với ai (nếu có)?'},
        ]
    },
    {model: 'tiensu_tvx.nguon_tt', type: 'text', label: 'Ở đâu?'},

    {component: 'h6', children: '2. Điều kiện sinh sống, vệ sinh, môi trường', class: 'font-semibold text-blue-600'},
    {
        component: 'm-grid', cols: 2, children: [
            {model: 'dkss.songuoi_tn', type: 'text', label: 'Số người sống trong nhà (người)'},
            {model: 'dkss.matdo', type: 'text', label: 'Mật độ (người/m2)'},
        ]
    },
    {component: 'm-field', model: 'dkss.songgan', type: 'm-radio', label: 'Sống gần', items: 'songgan'},
    {component: 'm-field', model: 'dkss.songgan_khac', type: 'text', label: 'Khác (ghi rõ)'},
    {component: 'm-field', model: 'dkss.nguonnuoc', type: 'm-radio', label: 'Nguồn nước sử dụng', items: 'nguonnuoc'},
    {model: 'dkss.nguonnuoc_khac', type: 'text', label: 'Khác (ghi rõ)'},
    {
        component: 'div', class: 'flex mt-10', children: [
            {
                component: 'div', class: 'w-1/2 ml-auto flex gap-4', children: [
                    {model: 'dkss.ky_ngay', type: 'text', label: 'Ngày', outerClass: ['ml-2']},
                    {model: 'dkss.ky_thang', type: 'text', label: 'Tháng'},
                    {model: 'dkss.ky_nam', type: 'text', label: 'Năm'},
                ]
            }
        ]
    },

    {
        component: 'm-grid', cols: 2, children: [
            {model: 'dieutravien', type: 'text', label: 'Điều tra viên', labelClass: ['font-semibold']},
            {model: 'thutruong', type: 'text', label: 'Thủ trưởng cơ quan', labelClass: ['font-semibold']},
        ]
    },
]
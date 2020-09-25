export default [
    {component: 'h2', children: 'Phiếu điều tra trường hợp ho gà', class: 'font-bold uppercase text-blue-600 text-center mb-10'},
    {
        component: 'm-grid', children: [
            {model: 'tinh', type: 'text', label: 'Tỉnh thành'},
            {model: 'qh', type: 'text', label: 'Quận huyện'},
            {model: 'px', type: 'text', label: 'Phường xã'},
        ]
    },

    {model: 'so_cb.ddt_benhvien', type: 'text', label: 'Đoàn điều tra tại bệnh viện'},
    {component: 'h5', children: 'I. Sổ xác định ca bệnh', class: 'font-bold uppercase text-blue-600'},
    {
        component: 'm-grid', children: [
            {model: 'so_cb.nam_mb', type: 'number', label: 'Năm mắc bệnh'},
            {model: 'so_cb.maso_tinh', type: 'text', label: 'Mã số của tỉnh'},
            {model: 'so_cb.stt', type: 'text', label: 'Số thứ tự trong sổ'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', model: 'so_cb.nguon_tb', type: 'm-radio', label: 'Nguồn thông báo', items: 'hoga.nguon_tb'},
            {component: 'm-field', model: 'so_cb.thuoc_vd', type: 'm-radio', label: 'Thuộc vụ dịch', items: 'yesno'},
        ]
    },


    {component: 'h5', children: 'II. Thông tin cá nhân', class: 'font-bold uppercase text-blue-600'},
    {
        component: 'm-grid', children: [
            {model: 'so_cb.hoten', type: 'text', label: 'Họ tên bệnh nhân'},
            {component: 'm-field', model: 'so_cb.gioitinh', type: 'm-radio', label: 'Giới', items: 'gioitinh'},
        ]
    },
    {
        component: 'm-grid', children: [
            {model: 'so_cb.ngaysinh', type: 'date', label: 'Ngày sinh'},
            {model: 'so_cb.tuoi', type: 'number', label: 'Tuổi'},
            {model: 'so_cb.thangtuoi', type: 'number', label: 'Tháng tuổi'},
        ]
    },
    {
        component: 'm-grid', children: [
            {model: 'so_cb.hoten_chame', type: 'text', label: 'Họ và tên mẹ (hoặc bố)'},
            {model: 'so_cb.dienthoai1', type: 'text', label: 'Điện thoại'},
        ]
    },
    {
        component: 'm-grid', children: [
            {model: 'so_cb.sonha', type: 'text', label: 'Số nhà'},
            {model: 'so_cb.tenduong', type: 'text', label: 'Đường'},
            {model: 'so_cb.to_dp', type: 'text', label: 'Tổ'},
            {model: 'so_cb.khupho', type: 'text', label: 'Khu phố/ấp'}
        ]
    },
    {
        component: 'm-grid', children: [
            {model: 'so_cb.nghenghiep', type: 'text', label: 'Nghề nghiệp'},
            {model: 'so_cb.diachi_ct', type: 'text', label: 'Địa chỉ nơi học tập/ công tác'},
            {model: 'so_cb.dienthoai2', type: 'text', label: 'Điện thoại'},
        ]
    },


    {component: 'h5', children: 'III. Tiền sử tiêm vắc xin', class: 'font-bold uppercase text-blue-600'},
    {component: 'm-field', model: 'so_cb.info_cn.tiem_vx', type: 'm-radio', label: 'Có tiêm vắc xin DPT / vắc xin phối hợp khác phòng bệnh BH-UV-HG ... không?', items: 'yesnonull'},
    {
        component: 'm-grid', cols: 2, children: [
            {component: 'm-field', type: 'number', label: 'Số mũi tiêm'},
            {component: 'm-field', type: 'text', label: 'Lần tiêm sau cùng cách đây bao lâu', items: 'yesnonull'},
        ]
    },

    {component: 'h5', children: 'IV. Lâm sàng', class: 'font-bold uppercase text-blue-600'},
    {component: 'm-field', type: 'date', label: 'Ngày khởi bệnh'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'text', label: 'Nơi khám'},
            {component: 'm-field', type: 'date', label: 'Ngày khám'},
            {component: 'm-field', type: 'text', label: 'Chuẩn đoán'},
            {component: 'm-field', type: 'm-radio', label: 'Kháng sinh', items: 'yesno'},
            {component: 'm-field', type: 'text', label: 'Kháng sinh'},
        ]
    },
    {component: 'm-field', type: 'text', label: 'Triệu chứng'},
    {component: 'm-field', type: 'text', label: 'Biến chứng'},
    {component: 'm-field', type: 'text', label: 'Điều trị'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'text', label: 'Chẩn đoán'},
            {component: 'm-field', type: 'date', label: 'Ngày ra viện'},
            {component: 'm-field', type: 'm-radio', label: 'Tình trạng', items: 'hoga.tinhtrang_ls'},
        ]
    },

    {component: 'h5', children: 'V. Xét nghiệm', class: 'font-bold uppercase text-blue-600'},

    {component: 'h5', children: 'VI. Dịch tễ', class: 'font-bold uppercase text-blue-600'},
    {component: 'm-field', type: 'date', label: 'Ngày điều tra'},

    {component: 'h5', children: 'Nguồn truyền nhiễm - tiền sử phơi nhiễm', class: 'font-bold'},
    {component: 'h6', children: 'Trong vòng 3 tuần trước khi phát bệnh, có tiếp xúc với', class: 'font-bold'},
    {
        component: 'm-grid', cols: 2, children: [
            {component: 'm-field', type: 'm-radio', label: 'Người bệnh ho gà không?', items: 'yesnonull'},
            {component: 'm-field', type: 'm-radio', label: 'Người bệnh ho kéo dài không?', items: 'yesnonull'},
        ]
    },

    {component: 'h6', children: 'Nếu có'},
    {
        component: 'm-grid', cols: 2, children: [
            {component: 'm-field', type: 'date', label: 'Ngày tiếp xúc'},
            {component: 'm-field', type: 'text', label: 'Tiếp xúc tại đâu'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'text', label: 'Họ tên người tiếp xúc'},
            {component: 'm-field', type: 'text', label: 'Tuổi'},
            {component: 'm-field', type: 'text', label: 'Địa chỉ'},
            {component: 'm-field', type: 'text', label: 'Nghề nghiệp'},
        ]
    },
    {
        component: 'm-grid', cols: 2, children: [
            {component: 'm-field', type: 'm-radio', label: 'Người bệnh là thuộc ổ dịch', items: 'yesnonull'},
            {component: 'm-field', type: 'text', label: 'Nếu có, địa chỉ ổ dịch'},
        ]
    },

    {component: 'h6', children: 'Trong vòng 3 tuần trước khi phát bệnh, có đi đến những nơi nào?', class: 'font-bold'},
    {component: 'm-field', type: 'm-radio', items: 'hoga.dt_3tuan_pb'},


    {component: 'h5', children: 'Tiếp xúc gia đình', class: 'font-bold'},
    {component: 'h5', children: 'Tiếp xúc lây bệnh người khác', class: 'font-bold'},
    {component: 'h6', children: 'Từ người tiếp xúc điều tra, lập danh sách tiếp xúc để quản lí, theo dõi 21 ngày kể từ ngày tiếp xúc sau cùng'},
    {component: 'h5', children: 'VII. Kết luận', class: 'font-bold uppercase text-blue-600'},
    {component: 'm-field', type: 'm-radio', items: 'hoga.ketluan'},

    {component: 'div', class: 'mt-10'},
    {
        component: 'm-grid', cols: 2, class: 'mt-10', children: [
            {component: 'm-field', type: 'date', outerClass: ['col-end-3']},

        ]
    },
    {
        component: 'm-grid', cols: 2, children: [
            {model: 'dieutravien', type: 'text', label: 'Điều tra viên', labelClass: ['font-semibold']},
            {model: 'thutruong', type: 'text', label: 'Thủ trưởng cơ quan', labelClass: ['font-semibold uppercase']},
        ]
    },
]
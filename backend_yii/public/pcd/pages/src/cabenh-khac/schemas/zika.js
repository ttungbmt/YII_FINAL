export default [
    {component: 'h1', children: 'Phiếu điều tra ca bệnh ZIKA', class: 'font-bold uppercase text-blue-600 text-center mb-12'},
    {component: 'h5', children: 'Thông tin - báo cáo', class: 'font-bold uppercase text-blue-600'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', model: 'info_bc.donvi_bc', type: 'text', label: 'Đơn vị thông báo'},
            {component: 'm-field', model: 'info_bc.ngay', type: 'date', label: 'Ngày'},
            {component: 'm-field', model: 'info_bc.ngaydieutra', type: 'date', label: 'Ngày điều tra'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', model: 'info_bc.dieutravien', type: 'text', label: 'Điều tra viên'},
            {component: 'm-field', model: 'info_bc.dienthoai', type: 'text', label: 'Điện thoại'},
            {component: 'm-field', model: 'info_bc.donvi', type: 'text', label: 'Đơn vị'},
        ]
    },

    {component: 'h5', children: 'Thông tin ca bệnh', class: 'font-bold uppercase text-blue-600'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'text', label: 'Họ tên'},
            {component: 'm-field', type: 'm-radio', label: 'Giới', items: 'gioitinh'},
            {component: 'm-field', type: 'date', label: 'Ngày sinh'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'text', label: 'Họ tên bố/mẹ/người chăm sóc'},
            {component: 'm-field', type: 'text', label: 'Điện thoại'},
        ]
    },

    {component: 'h5', children: 'Địa chỉ'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'text', label: 'Số'},
            {component: 'm-field', type: 'text', label: 'Đường'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'text', label: 'QH'},
            {component: 'm-field', type: 'text', label: 'PX'},
            {component: 'm-field', type: 'text', label: 'KP-ấp'},
            {component: 'm-field', type: 'text', label: 'Tổ'},
        ]
    },

    {component: 'm-field', model: 'tt_lamsang.tt_tieuchay', type: 'm-radio', label: 'Nhà ca bệnh', items: 'yesno'},
    {component: 'm-field', type: 'm-radio', label: 'Nếu có, bệnh nhân cư ngụ tại', items: 'zika.bn_cungutai'},
    {component: 'm-field', type: 'text', label: 'Địa chỉ cư ngụ hiện nay (nếu ở nơi khác/TP hoặc Tỉnh)'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'text', label: 'PX'},
            {component: 'm-field', type: 'text', label: 'QH'},
            {component: 'm-field', type: 'text', label: 'Tỉnh-TP'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Nghề nghiệp', items: 'zika.nghenghiep'},
            {component: 'm-field', type: 'text', label: 'Khác'},
            {component: 'm-field', type: 'text', label: 'Điện thoại'},
        ]
    },
    {component: 'm-field', type: 'text', label: 'Tên và địa chỉ trường học & nơi làm việc'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'date', label: 'Ngày nhập viện'},
            {component: 'm-field', type: 'text', label: 'hoặc ngày khám bệnh'},
            {component: 'm-field', type: 'date', label: 'Ngày chuẩn đoán'},
            {component: 'm-field', type: 'text', label: 'Bệnh viện/phòng khám'},
        ]
    },

    {component: 'h5', children: 'Tiền sử sức khỏe', class: 'font-bold uppercase text-blue-600'},
    {component: 'm-field', type: 'm-radio', label: 'Từng mắc bệnh do muỗi truyền (SXH, VNNB, ...)', items: 'yesnonull'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Nếu có', items: 'zika.benhdomuoi', outerClass: ['col-span-2']},
            {component: 'm-field', type: 'text', label: 'Khác'},
        ]
    },
    {component: 'm-field', type: 'date', label: 'Ngày mắc bệnh'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Đã tiêm vắc xin VNNB', items: 'yesnonull'},
            {component: 'm-field', type: 'm-radio', label: 'Đã tiêm vắc xin sốt vàng', items: 'yesnonull'},
            {component: 'm-field', type: 'm-radio', label: 'Có bệnh lý khác đi kèm', items: 'yesnonull'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Nếu có', items: 'zika.benhlykhac', outerClass: ['col-span-3']},
            {component: 'm-field', type: 'text', label: 'Khác'},
        ]
    },

    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Có thai', items: 'yesnonull'},
            {component: 'm-field', type: 'm-radio', label: 'Nếu có, biến chứng thai kỳ nghi do Zika virus?', items: 'yesnonull', outerClass: ['col-span-3']},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Nếu có', items: 'zika.bienchung', outerClass: ['col-span-3']},
            {component: 'm-field', type: 'text', label: 'Khác'},
        ]
    },

    {component: 'h5', children: 'Khám bệnh', class: 'font-bold uppercase text-blue-600'},
    {component: 'm-field', type: 'm-radio', label: 'Có đi khám bệnh không?', items: 'yesnonull'},
    {component: 'h6', children: 'Nếu có, ghi chi tiết', class: 'font-bold'},
    // -------------
    {component: 'm-field', type: 'text', label: 'Phòng khám'},
    {component: 'm-field', type: 'text', label: 'Ngày khám'},
    {component: 'm-field', type: 'text', label: 'Ngày chuyển/xuất viện'},
    {component: 'm-field', type: 'text', label: 'Chuẩn đoán xuất viện'},

    {component: 'h5', children: 'Lâm sàng', class: 'font-bold uppercase text-blue-600'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Có triệu chứng', items: 'yesnonull'},
            {component: 'm-field', type: 'date', label: 'Ngày khởi bệnh'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Sốt', items: 'yesno'},
            {component: 'm-field', type: 'text', label: 'Nếu có, nhiệt độ (°C)'},
        ]
    },

    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Phát ban'},
            {component: 'm-field', type: 'm-radio', label: 'Nếu có, dạng ban', items: 'zika.dangban', outerClass: ['col-span-2']},
            {component: 'm-field', type: 'text', label: 'Khác'},
        ]
    },

    {component: 'm-field', type: 'text', label: 'Kiểu xuất hiện'},
    {component: 'm-field', type: 'm-radio', label: 'Triệu chứng khác', items: 'zika.trieutrungkhac'},

    {component: 'h6', children: 'Trong trường hợp bệnh nhân có thai', class: 'font-bold'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'date', label: 'Ngày kỳ kinh cuối'},
            {component: 'm-field', type: 'date', label: 'Dự kiến ngày sinh'},
            {component: 'm-field', type: 'number', label: 'Số tuần còn lại'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Có siêu âm thai nhi', items: 'yesnonull'},
            {component: 'm-field', type: 'number', label: 'Nếu có, tuổi thai (tuần)'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Kết quả siêu âm', items: 'zika.kq_sieuam', outerClass: ['col-span-3']},
            {component: 'm-field', type: 'text', label: 'Khác'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'date', label: 'Sinh đẻ? Ngày sinh'},
            {component: 'm-field', type: 'm-radio', label: 'Kết quả', items: 'zika.kq_thai', outerClass: ['col-span-3']},
        ]
    },

    {component: 'h6', children: 'Trong trường hợp bệnh nhân có nghi ngờ hội chứng Guillain-Baré hoặc yếu cơ', class: 'font-bold'},
    {component: 'm-field', type: 'date', label: 'Ngày xuất hiện các dấu hiệu thần kinh'},
    {component: 'h6', children: 'Trong trường hợp bệnh nhân là trẻ mới sinh', class: 'font-bold'},
    {component: 'm-field', type: 'm-radio', label: 'Tình trạng', items: 'zika.tt_tremoisinh'},
    {component: 'h6', children: 'Trường hợp trẻ sống', class: 'font-bold'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Tật đầu nhỏ', items: 'yesnonull'},
            {component: 'm-field', type: 'number', label: 'Tuổi thai lúc sinh (tuần)'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Hóa vôi nội sọ', items: 'yesnonull'},
            {component: 'm-field', type: 'number', label: 'Vòng đầu trán-chẩm (cm)'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Phát hiện thính giác bất thường ', items: 'yesnonull'},
            {component: 'm-field', type: 'text', label: 'Cân nặng (gram)'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Phát hiện mắt bất thường', items: 'yesnonull'},
            {component: 'm-field', type: 'number', label: 'Chiều dài (cm)'},
        ]
    },
    {
        component: 'm-grid', cols: 2, children: [
            {component: 'm-field', type: 'text', label: 'Chẩn đoán hình ảnh não'},
            {component: 'm-field', type: 'text', label: 'Các phát hiện khi khám mắt'},
        ]
    },
    {
        component: 'm-grid', cols: 2, children: [
            {component: 'm-field', type: 'm-radio', label: 'Tiền sử mẹ: có dấu hiệu, triệu chứng của bệnh Zika khi mang thai?', items: 'yesnonull'},
            {component: 'm-field', type: 'm-radio', label: 'Có xét nghiệm phát hiện virus', items: 'yesnonull'},
            {component: 'm-field', type: 'm-radio', label: 'Nếu có, kết quả', items: 'duongamnull'},
        ]
    },

    {component: 'h5', children: 'Xét nghiệm', class: 'font-bold uppercase text-blue-600'},
    {
        component: 'm-grid', children: [
            {component: 'h6', class: 'font-bold', children: 'Loại xét nghiệm'},
            {component: 'h6', class: 'font-bold', children: 'Ngày lấy mẫu'},
            {component: 'h6', class: 'font-bold', children: 'Ngày kết quả'},
            {component: 'h6', class: 'font-bold', children: 'Kết quả'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'h5', children: 'Mac-Elisa'},
            {component: 'm-field', type: 'date'},
            {component: 'm-field', type: 'date'},
            {component: 'm-field', type: 'm-radio', items: 'zika.duongamkxd'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'h5', children: 'PCR'},
            {component: 'm-field', type: 'date'},
            {component: 'm-field', type: 'date'},
            {component: 'm-field', type: 'm-radio', items: 'zika.duongamkxd'},
        ]
    },
    {component: 'h6', children: '(mẫu xét nghiệm: huyết thanh, dịch não tủy, máu cuống rốn, dịch ối, …)', class: 'italic'},

    // ------------------------------
    {component: 'h5', children: 'Dịch tễ', class: 'font-bold uppercase text-blue-600'},
    {component: 'h6', children: 'Trong vòng 1 tháng trước, kể từ ngày khởi bệnh', class: 'font-bold'},
    {component: 'm-field', type: 'm-radio', label: 'Có quan hệ tình dục với người nghi nhiễm / nhiễm Zika?', items: 'yesnonull'},
    {component: 'm-field', type: 'm-radio', label: 'Có quan hệ tình dục với người từ vùng dịch Zika?', items: 'yesnonull'},
    {component: 'm-field', type: 'm-radio', label: 'Nếu có, tình dục an toàn trong tất cả những lần quan hệ?', items: 'yesnonull'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Gia đình có người có các triệu chứng như phát ban, sốt, mắt đỏ, đau khớp … / có người nghi nhiễm / nhiễm Zika', items: 'yesnonull', outerClass: ['col-span-3']},
            {component: 'm-field', type: 'date', label: 'Ngày mắc bệnh'},
        ]
    },
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Ở chung quanh, có người có các triệu chứng như phát ban, sốt, mắt đỏ, đau khớp …', items: 'yesnonull', outerClass: ['col-span-3']},
            {component: 'm-field', type: 'text', label: 'Tên, Địa chỉ'},
        ]
    },

    {component: 'h6', children: 'Trong vòng 2 tuần trước, kể từ ngày khởi bệnh', class: 'font-bold'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'm-radio', label: 'Có tiếp xúc với người có các triệu chứng như phát ban, sốt, mắt đỏ, đau khớp … / người nghi nhiễm / nhiễm Zika', items: 'yesnonull', outerClass: ['col-span-3']},
            {component: 'm-field', type: 'date', label: 'Ngày tiếp xúc'},
        ]
    },

    {component: 'm-field', type: 'm-radio', label: 'Có bị muỗi đốt tại nhà?', items: 'yesnonull'},
    {component: 'h6', children: 'Có đi đến những nơi nào và có ghi nhận bị muỗi đốt?'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'text', label: 'Đến đâu'},
            {component: 'm-field', type: 'date', label: 'Ngày đến'},
            {component: 'm-field', type: 'text', label: 'Thời gian ở lại (phút / giờ / ngày)'},
        ]
    },


    {component: 'm-field', type: 'm-radio', label: 'Trong vòng 1 tháng qua, kể từ ngày khởi bệnh: có nhận máu / sản phẩm của máu?', items: 'yesnonull'},
    {component: 'm-field', type: 'm-radio', label: 'Kể từ ngày khởi bệnh đến nay, có an toàn trong tất cả những quan hệ?', items: 'yesnonull'},
    {component: 'h6', children: 'Kể từ ngày khởi bệnh cho đến 7 ngày sau, có đến đâu và có ghi nhận bị muỗi đốt?'},
    {
        component: 'm-grid', children: [
            {component: 'm-field', type: 'text', label: 'Đến đâu'},
            {component: 'm-field', type: 'date', label: 'Ngày đến'},
            {component: 'm-field', type: 'text', label: 'Thời gian ở lại (phút / giờ / ngày)'},
        ]
    },

    {component: 'h5', children: 'Kết luận', class: 'font-bold uppercase text-blue-600'},
    {
        component: 'm-grid', cols: 2, children: [
            {component: 'm-field', type: 'm-radio', label: 'Ca bệnh', items: 'zika.kl_cb'},
            {component: 'm-field', type: 'm-radio', label: 'Có thai', items: 'yesnonull'},
        ]
    },
    {component: 'm-field', type: 'm-radio', label: 'Thai nhi', items: 'zika.kl_thainhi'},

    {component: 'h6', children: 'Ghi chú', class: 'font-bold'},
    {component: 'div', children: `<div><div>Điều tra ca bệnh đi cùng với các điều tra khác & xử lý môi trường trong vòng bán kính 200 m</div><ul><li>Điều tra dịch tễ mở rộng: phát hiện & giám sát ca phát ban trong vòng 1 tháng qua.</li><li>Điều tra vectơ muỗi & lăng quăng.</li><li>Xử lý môi trường: truyền thông, diệt lăng quăng, muỗi.</li></ul></div>`},
]
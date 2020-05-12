<?php
namespace pcd\modules\sxh\forms;

trait SxhAttrTrait {
    public function fields() {
        $fields = [
            'id',
            'lat',
            'lng',
            'chuandoan_bd',
            'chuandoan_bd_khac',
            'me',
            'ngaybaocao',
            'ma_icd',
            'shs',
            'ht_dieutri',
            'ngaynhanthongbao',
            'ngaydieutra',
            'maso',
            'hoten',
            'phai',
            'ngaysinh',
            'tuoi',
            'vitri',
            'to_dp',
            'khupho',
            'px',
            'qh',
            'tinh',
            'tinh_dc_khac',

            'benhnoikhac',
            'sonhakhac',
            'duongkhac',
            'tokhac',
            'khuphokhac',
            'tinhkhac',
            'qhkhac',
            'pxkhac',
            'tinhnoikhac',
            'songuoicutru',
            'cutruduoi15',
            'tpbv',
            'tpbv_bv',
            'phcd',
            'nhapvien',
            'nhapvien_bv',
            'ngaymacbenh',
            'ngaynhapvien',
            'nghenghiep',
            'xetnghiem',
            'ngaylaymau',
            'loai_xn',
            'ketqua_xn',
            'dclamviec',
            'dclamviec_tinh',
            'dclamviecqh',
            'dclamviecpx',
            'noilamviec_sxh',
            'nhacobnsxh',
            'nhaconguoibenh',
            'bvpk',
            'nhatho',
            'dinh',
            'congvien',
            'noihoihop',
            'noixd',
            'cafe',
            'noichannuoi',
            'noibancay',
            'vuaphelieu',
            'noikhac',
            'noikhac_ghichu',
            'diemden_px',
            'diemden_pxkhac',
            'diemden_qhkhac',
            'gdcosxh',
            'gdsonguoisxh',
            'gdso15t',
            'gdthuocsxh',
            'gdthuocsxhsonguoi',
            'gdthuocsxh15t',
            'bi',
            'ci',
            'cachidiem',
            'dietlangquang',
            'giamsattheodoi',
            'xulyonho',
            'xulyorong',
            'cathuphat',
            'odichmoi',
            'odichcu',
            'odichcu_xuly',
            'xuly',
            'xuly_ngay',
            'xuatvien',
            'ngayxuatvien',
            'chuandoan',
            'chuandoan_khac',
            'nguoidieutra',
            'nguoidieutra_sdt',

            'xacminh',
            'loaidieutra',
            'loaicabenh',
            'loai_xm_cb',
            'chuyenca',
            'list_chuyenca',
            'ngaymacbenh_nv',
        ];

        return $fields;
    }

    public function attributeLabels() {
        return [
            'lat'               => 'Vĩ độ (Lat)',
            'lng'               => 'Kinh độ (Lng)',
            'chuandoan_bd'      => 'Bệnh',
            'chuandoan_bd_khac' => 'Tên bệnh khác',
            'me'                => 'Mẹ',
            'ngaybaocao'        => 'Ngày báo cáo',
            'ma_icd'            => 'Mã ICD',
            'shs'               => 'Số hồ sơ(SHS)',
            'ht_dieutri'        => 'Hình thức điều trị',
            'ngaynhanthongbao'  => 'Ngày nhận thông báo',
            'ngaydieutra'       => 'Ngày điều tra',
            'maso'              => 'Mã số',
            'hoten'             => 'Họ tên',
            'phai'              => 'Giới tính',
            'ngaysinh'          => 'Ngày sinh',
            'tuoi'              => 'Tuổi',
            'is_diachi'         => 'Địa chỉ',
            'is_benhnhan'       => 'Bệnh nhân',
            'dienthoai'         => 'Điện thoại',
            'sonha'             => 'Số nhà',
            'duong'             => 'Đường',
            'to_dp'             => 'Tổ',
            'khupho'            => 'Khu phố',
            'tinh'              => 'Tỉnh',
            'tinh_dc_khac'      => 'Địa chỉ',
            'qh'                => 'Quận huyện',
            'px'                => 'Phường xã',
            'benhnoikhac'       => 'Bệnh nơi khác',
            'sonhakhac'         => 'Số nhà',
            'duongkhac'         => 'Đường',
            'tokhac'            => 'Tổ',
            'khuphokhac'        => 'Khu phố',
            'tinhkhac'          => 'Tỉnh',
            'tinhnoikhac'       => 'Địa chỉ',
            'qhkhac'            => 'Quận huyện',
            'pxkhac'            => 'Phường xã',
            'songuoicutru'      => 'Số người cư trú trong gia đình',
            'cutruduoi15'       => 'Trong đó số dưới 15 tuổi',
            'tpbv'              => 'TP báo về(TPBV)',
            'tpbv_bv'           => 'Bệnh viện',
            'phcd'              => 'Phát hiện cộng đồng(PHCD)',
            'nhapvien'          => 'Nhập viện',
            'nhapvien_bv'       => 'Tên bệnh viện',
            'ngaymacbenh'       => 'Ngày mắc bệnh',
            'ngaynhapvien'      => 'Ngày nhập viện',
            'nghenghiep'        => 'Nghề nghiệp',
            'xetnghiem'         => 'Có xét nghiệm hay không ?',
            'ngaylaymau'        => 'Ngày lấy mẫu',
            'loai_xn'           => 'Loại xét nghiệm',
            'ketqua_xn'         => 'Kết quả',
            'dclamviec'         => 'Địa chỉ nơi làm việc',
            'dclamviec_tinh'    => 'Tỉnh',
            'dclamviecqh'       => 'Quận huyện',
            'dclamviecpx'       => 'Phường xã',
            'nhacobnsxh'        => 'Nhà có BN SXH',
            'nhaconguoibenh'    => 'Nhà có người bệnh',
            'bvpk'              => 'BV PK',
            'nhatho'            => 'Nhà thờ',
            'dinh'              => 'Đình chùa',
            'congvien'          => 'Công viên',
            'noihoihop'         => 'Nơi hội họp',
            'noixd'             => 'Nơi xây dựng',
            'cafe'              => 'Quán cà phê / internet',
            'noichannuoi'       => 'Nơi chăn nuôi',
            'noibancay'         => 'Nơi bán cây cảnh',
            'vuaphelieu'        => 'Vựa phế liệu',
            'noikhac'           => 'Khác',
            'noikhac_ghichu'    => 'Ghi chú',
            'diemden_px'        => 'PX',
            'diemden_pxkhac'    => 'PX khác',
            'diemden_qhkhac'    => 'QH khác',
            'gdcosxh'           => 'Có người mắc bệnh SXH không ? ',
            'gdsonguoisxh'      => 'Tại gia đình, số người bị SXH',
            'gdso15t'           => 'Tại gia đình, số người < 15 tuổi',
            'gdthuocsxh'        => 'Có người mắc bệnh sốt hoặc có uống thuốc hạ sốt ? ',
            'gdthuocsxhsonguoi' => 'Tại gia đình, số người mắc bệnh',
            'gdthuocsxh15t'     => 'Tại gia đình, số người mắc bệnh < 15 tuổi',
            'bi'                => 'BI',
            'ci'                => 'CI',
            'cachidiem'         => '1. Ca bệnh chỉ điểm / ca bệnh đầu tiên',
            'dietlangquang'     => 'Diệt lăng quăng diệt muỗi / gia đình',
            'giamsattheodoi'    => 'Giám sát theo dõi',
            'xulyonho'          => 'Xử lý ổ dịch',
            'xulyorong'         => 'Xử lý diện rộng',
            'cathuphat'         => '2. Ca bệnh thứ phát',
            'odichmoi'          => 'Ổ dịch mới',
            'odichcu'           => 'Ổ dịch cũ đã xác định',
            'odichcu_xuly'      => 'Xử lý(ngày)',
            'xuly'              => 'Ổ dịch cũ đã xác định',
            'xuly_ngay'         => 'Xử lý(ngày)',
            'xuatvien'          => 'Xuất viện',
            'ngayxuatvien'      => 'Ngày xuất viện',
            'chuandoan'         => 'Chuẩn đoán',
            'chuandoan_khac'    => 'Tên bệnh',
            'nguoidieutra'      => 'Người điều tra',
            'nguoidieutra_sdt'  => 'Số điện thoại',
        ];
    }

}
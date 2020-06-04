<?php
namespace pcd\modules\sxh\forms;

use pcd\supports\RoleHc;

trait SxhTrait {
    public $id;
    public $lat;
    public $lng;
    public $chuandoan_bd;
    public $chuandoan_bd_khac;
    public $me;
    public $ngaybaocao;
    public $ma_icd;
    public $shs;
    public $ht_dieutri;
    public $ngaynhanthongbao;
    public $ngaydieutra;
    public $maso;
    public $hoten;
    public $phai;
    public $ngaysinh;
    public $tuoi;
    public $vitri;
    public $sonha;
    public $duong;
    public $to_dp;
    public $khupho;
    public $px;
    public $qh;
    public $tinh;
    public $tinh_dc_khac;
    public $benhnoikhac;
    public $sonhakhac;
    public $duongkhac;
    public $tokhac;
    public $khuphokhac;
    public $tinhkhac;
    public $qhkhac;
    public $pxkhac;
    public $tinhnoikhac;
    public $songuoicutru;
    public $cutruduoi15;
    public $tpbv;
    public $tpbv_bv;
    public $phcd;
    public $nhapvien;
    public $nhapvien_bv;
    public $ngaymacbenh;
    public $ngaynhapvien;
    public $ngaymacbenh_nv;
    public $nghenghiep;
    public $xetnghiem;
    public $ngaylaymau;
    public $loai_xn;
    public $ketqua_xn;
    public $dclamviec;
    public $dclamviec_tinh;
    public $dclamviecqh;
    public $dclamviecpx;
    public $noilamviec_sxh;
    public $nhacobnsxh;
    public $nhaconguoibenh;
    public $bvpk;
    public $nhatho;
    public $dinh;
    public $congvien;
    public $noihoihop;
    public $noixd;
    public $cafe;
    public $noichannuoi;
    public $noibancay;
    public $vuaphelieu;
    public $noikhac;
    public $noikhac_ghichu;
    public $diemden_px;
    public $diemden_pxkhac;
    public $diemden_qhkhac;
    public $gdcosxh;
    public $gdsonguoisxh;
    public $gdso15t;
    public $gdthuocsxh;
    public $gdthuocsxhsonguoi;
    public $gdthuocsxh15t;
    public $bi;
    public $ci;
    public $cachidiem;
    public $dietlangquang;
    public $giamsattheodoi;
    public $xulyonho;
    public $xulyorong;
    public $cathuphat;
    public $odichmoi;
    public $odichcu;
    public $odichcu_xuly;
    public $xuly;
    public $xuly_ngay;
    public $xuatvien;
    public $ngayxuatvien;
    public $chuandoan;
    public $chuandoan_khac;
    public $nguoidieutra;
    public $nguoidieutra_sdt;

    public $xacminh;

    public $loaidieutra;
    public $loaicabenh;
    public $loai_xm_cb;
    public $chuyenca;
    public $list_chuyenca;

    public $dates = [
        'ngaybaocao',
        'ngaynhanthongbao',
        'ngaymacbenh',
        'ngaynhapvien',
        'ngayxuatvien',
        'ngaysinh',
        'ngaymacbenh_nv',
        'ngaylaymau'
    ];

    public function setDefaultModel()
    {
//        'chuyenca', 'loaidieutra', 'maquan', 'maphuong', 'chuandoan_bd', 'ht_dieutri', 'ngaybaocao', 'ngaymacbenh_nv'
//        $this->chuyenca = 0;
        $this->loaidieutra = 0;
        $this->loaicabenh = 0;
        $this->chuyenca = 0;
        $this->chuandoan_bd = 'SXH';
        $this->ht_dieutri = 1;
        $this->ngaybaocao = date('d/m/Y');
        $this->tinhkhac = 'HCM';
        if($this->tpbv_bv) $this->tpbv = 1;
    }


    public function schema() {
        $id = request('id');
        $maphuong = userInfo()->maphuong;
        $maquan = userInfo()->maquan;
        $qh1 = opt(head($this->xacminh))->qh; $px1 = opt(head($this->xacminh))->px;
        $qh2 = opt(last($this->xacminh))->qh; $px2 = opt(last($this->xacminh))->px;

        $disabled_px1 = $id ? true : false;
        $disabled_px2 = $id ? true : false;

        if($maphuong == $px1 || (role('quan') && $maquan == $qh1)) $disabled_px1 = false;
        if($maphuong == $px2 || (role('quan') && $maquan == $qh2)) $disabled_px2 = false;

        return [
            [
                'name'  => 'lat',
                'label' => 'Vĩ độ (Lat)', 'rules' => 'min_value:0', 'number' => true, 'md' => 3,
            ],
            [
                'name'  => 'lng',
                'label' => 'Kinh độ (Lng)', 'rules' => 'min_value:0', 'number' => true, 'md' => 3,
            ],
            [
                'name'  => 'chuandoan_bd',
                'label' => 'Bệnh', 'component' => 'field-select', 'options' => 'chuandoan_bd', 'rules' => 'required', 'disabled' => $disabled_px1, 'prompt' => true
            ],
            [
                'name'  => 'chuandoan_bd_khac',
                'label' => 'Tên bệnh khác', 'rules' => 'required', 'disabled' => $disabled_px1,
            ],
            [
                'name'  => 'me',
                'label' => 'Mẹ', 'trim' => true, 'disabled' => $disabled_px1,
            ],
            [
                'name'  => 'ngaybaocao',
                'label' => 'Ngày báo cáo', 'rules' => 'required|date|date_to', 'widget' => 'datepicker', 'disabled' => $disabled_px1,
            ],
            [
                'name'  => 'ma_icd',
                'label' => 'Mã ICD', 'disabled' => true,
            ],
            [
                'name'  => 'shs',
                'label' => 'Số hồ sơ(SHS)', 'disabled' => true,
            ],
            [
                'name'  => 'ht_dieutri',
                'label' => 'Hình thức điều trị', 'component' => 'field-radio', 'options' => 'ht_dieutri', 'disabled' => $disabled_px1,
            ],
            [
                'name'  => 'ngaynhanthongbao',
                'label' => 'Ngày nhận thông báo', 'rules' => 'required|date|date_to', 'widget' => 'datepicker', 'disabled' => $disabled_px1,
            ],
            [
                'name'  => 'ngaydieutra',
                'label' => 'Ngày điều tra', 'rules' => 'required|date|date_to', 'widget' => 'datepicker', 'disabled' => $disabled_px1,
            ],
            [
                'name'  => 'maso',
                'label' => 'Mã số', 'disabled' => true,
            ],
            [
                'name'  => 'hoten',
                'label' => 'Họ tên', 'rules' => 'required', 'trim' => true, 'disabled' => $disabled_px1,
            ],
            [
                'name'  => 'phai',
                'label' => 'Giới tính', 'component' => 'field-radio', 'options' => 'phai', 'rules' => 'required', 'disabled' => $disabled_px1,
            ],
            [
                'name' => 'ngaysinh',
                'vid'  => 'ngaysinh', 'label' => 'Ngày sinh', 'rules' => 'required_if_field:tuoi,@tuoi|date|date_to', 'widget' => 'datepicker', 'disabled' => $disabled_px1,
            ],
            [
                'name' => 'tuoi',
                'vid'  => 'tuoi', 'label' => 'Tuổi', 'rules' => 'integer|between:0,120|required_if_field:ngaysinh,@ngaysinh', 'type' => 'number', 'min' => 1, 'max' => 150, 'step' => 1, 'disabled' => $disabled_px1,
            ],
            [
                'name'  => 'is_diachi',
                'label' => 'Địa chỉ', 'component' => 'field-radio', 'options' => 'yesno', 'rules' => 'required'
            ],
            [
                'name'  => 'is_benhnhan',
                'label' => 'Bệnh nhân', 'component' => 'field-radio', 'options' => 'yesno', 'rules' => 'required'
            ],
            [
                'name'  => 'dienthoai',
                'label' => 'Điện thoại'
            ],
            [
                'name'  => 'sonha',
                'label' => 'Số nhà',
            ],
            [
                'name'  => 'duong',
                'label' => 'Đường',
            ],
            [
                'name'  => 'to_dp',
                'label' => 'Tổ',
            ],
            [
                'name'  => 'khupho',
                'label' => 'Khu phố',
            ],
            [
                'name'  => 'tinh',
                'label' => 'Tỉnh', 'component' => 'field-select', 'options' => 'tinh', 'md' => 6, 'rules' => 'required',
            ],
            [
                'name'  => 'tinh_dc_khac',
                'label' => 'Địa chỉ', 'rules' => 'required',
            ],
            [
                'name'  => 'qh',
                'label' => 'Quận huyện', 'component' => 'field-select', 'options' => 'qh', 'rules' => 'required', 'prompt' => true
            ],
            [
                'name'  => 'px',
                'label' => 'Phường xã', 'component' => 'field-select', 'depends' => ['field-qh'], 'url' => '/api/dm/phuong', 'rules' => 'required', 'prompt' => true
            ],
            [
                'name'  => 'benhnoikhac',
                'label' => 'Bệnh nơi khác', 'component' => 'field-radio', 'options' => 'yesno',
            ],
            [
                'name'  => 'sonhakhac',
                'label' => 'Số nhà',
            ],
            [
                'name'  => 'duongkhac',
                'label' => 'Đường', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'tokhac',
                'label' => 'Tổ', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'khuphokhac',
                'label' => 'Khu phố', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'tinhkhac',
                'label' => 'Tỉnh', 'component' => 'field-select', 'options' => 'tinh', 'md' => 6, 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'tinhnoikhac',
                'label' => 'Địa chỉ', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'qhkhac',
                'label' => 'Quận huyện', 'component' => 'field-select', 'options' => 'qh', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'pxkhac',
                'label' => 'Phường xã', 'component' => 'field-select', 'depends' => ['field-qhkhac'], 'url' => '/api/dm/phuong', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'songuoicutru',
                'label' => 'Số người cư trú trong gia đình', 'rules' => 'integer|min_value:0', 'type' => 'number', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'cutruduoi15',
                'label' => 'Trong đó số dưới 15 tuổi', 'rules' => 'integer|min_value:0', 'type' => 'number', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'tpbv',
                'label' => 'TP báo về(TPBV)', 'component' => 'field-radio', 'options' => 'yesno', 'disabled' => $disabled_px2
            ],
            [
                'name'  => 'tpbv_bv',
                'label' => 'Bệnh viện', 'component' => 'field-select', 'options' => 'benhvien', 'md' => 3, 'prompt' => true, 'disabled' => $disabled_px2
            ],
            [
                'name'  => 'phcd',
                'label' => 'Phát hiện cộng đồng(PHCD)', 'component' => 'field-radio', 'options' => 'yesno', 'disabled' => $disabled_px2
            ],
            [
                'name'  => 'nhapvien',
                'label' => 'Nhập viện', 'component' => 'field-radio', 'options' => 'yesno', 'disabled' => $disabled_px2
            ],
            [
                'name'  => 'nhapvien_bv',
                'label' => 'Tên bệnh viện', 'disabled' => $disabled_px2
            ],
            [
                'name'  => 'ngaymacbenh',
                'label' => 'Ngày mắc bệnh', 'rules' => 'date|date_to', 'widget' => 'datepicker', 'md' => 3, 'disabled' => $disabled_px2
            ],
            [
                'name'  => 'ngaynhapvien',
                'label' => 'Ngày nhập viện', 'rules' => 'date|date_to', 'widget' => 'datepicker', 'md' => 3, 'disabled' => $disabled_px2
            ],
            [
                'name'  => 'nghenghiep',
                'label' => 'Nghề nghiệp', 'disabled' => $disabled_px2
            ],
            [
                'name'  => 'xetnghiem',
                'label' => 'Có xét nghiệm hay không ? ', 'component' => 'field-radio', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'ngaylaymau',
                'label' => 'Ngày lấy mẫu', 'rules' => 'date|date_to', 'widget' => 'datepicker', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'loai_xn',
                'label' => 'Loại xét nghiệm', 'component' => 'field-select', 'options' => 'loai_xn', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'ketqua_xn',
                'label' => 'Kết quả', 'component' => 'field-select', 'options' => 'kq_xn', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'dclamviec',
                'label' => 'Địa chỉ nơi làm việc', 'rules' => 'required', 'md' => 3, 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'dclamviec_tinh',
                'label' => 'Tỉnh', 'component' => 'field-select', 'options' => 'tinhdieutra', 'rules' => 'required', 'md' => 3, 'prompt' => true, 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'dclamviecqh',
                'label' => 'Quận huyện', 'component' => 'field-select', 'options' => 'qh', 'md' => 3, 'prompt' => true, 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'dclamviecpx',
                'label' => 'Phường xã', 'component' => 'field-select', 'depends' => ['field-dclamviecqh'], 'url' => '/api/dm/phuong', 'md' => 3, 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'noilamviec_sxh',
                'label' => 'Tại nơi làm việc, trong vòng 2 tuần qua có ai bị SXH / nghi ngờ SXH / sốt không?', 'component' => 'field-radio', 'options' => 'yesnonull', 'disabled' => $disabled_px2,
            ],
            [
                'name'        => 'nhacobnsxh',
                'labelInline' => 'Nhà có BN SXH', 'component' => 'field-radio', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'        => 'nhaconguoibenh',
                'labelInline' => 'Nhà có người bệnh', 'component' => 'field-radio', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'        => 'bvpk',
                'labelInline' => 'BV PK', 'component' => 'field-radio', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'        => 'nhatho',
                'labelInline' => 'Nhà thờ', 'component' => 'field-radio', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'        => 'dinh',
                'labelInline' => 'Đình chùa', 'component' => 'field-radio', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'        => 'congvien',
                'labelInline' => 'Công viên', 'component' => 'field-radio', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'noihoihop',
                'component' => 'field-radio', 'labelInline' => 'Nơi hội họp', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'noixd',
                'component' => 'field-radio', 'labelInline' => 'Nơi xây dựng', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'cafe',
                'component' => 'field-radio', 'labelInline' => 'Quán cà phê / internet', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'noichannuoi',
                'component' => 'field-radio', 'labelInline' => 'Nơi chăn nuôi', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'noibancay',
                'component' => 'field-radio', 'labelInline' => 'Nơi bán cây cảnh', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'vuaphelieu',
                'component' => 'field-radio', 'labelInline' => 'Vựa phế liệu', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'noikhac',
                'component' => 'field-radio', 'labelInline' => 'Khác', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'        => 'noikhac_ghichu',
                'placeholder' => 'Nhập tên nơi khác', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'diemden_px',
                'component' => 'field-radio', 'labelInline' => 'PX', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'diemden_pxkhac',
                'component' => 'field-radio', 'labelInline' => 'PX khác', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'diemden_qhkhac',
                'component' => 'field-radio', 'labelInline' => 'QH khác', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'gdcosxh',
                'component' => 'field-radio', 'label' => 'Có người mắc bệnh SXH không ? ', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'gdsonguoisxh',
                'label' => 'Tại gia đình, số người bị SXH', 'type' => 'number', 'rules' => 'integer', 'min' => 0, 'step' => 1, 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'gdso15t',
                'label' => 'Tại gia đình, số người < 15 tuổi', 'type' => 'number', 'rules' => 'integer', 'min' => 0, 'step' => 1, 'disabled' => $disabled_px2,
            ],
            [
                'name' => 'gdthuocsxh', 'component' => 'field-radio', 'label' => 'Có người mắc bệnh sốt hoặc có uống thuốc hạ sốt ? ', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'gdthuocsxhsonguoi',
                'label' => 'Tại gia đình, số người mắc bệnh', 'type' => 'number', 'rules' => 'integer', 'min' => 0, 'step' => 1, 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'gdthuocsxh15t',
                'label' => 'Tại gia đình, số người mắc bệnh < 15 tuổi', 'type' => 'number', 'rules' => 'integer', 'min' => 0, 'step' => 1, 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'bi',
                'label' => 'BI', 'rules' => 'min_value:0', 'type' => 'number', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'ci',
                'label' => 'CI', 'rules' => 'min_value:0', 'type' => 'number', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'cachidiem',
                'component' => 'field-radio', 'labelInline' => '1. Ca bệnh chỉ điểm / ca bệnh đầu tiên', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'dietlangquang',
                'component' => 'field-radio', 'labelInline' => 'Diệt lăng quăng diệt muỗi / gia đình', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'giamsattheodoi',
                'component' => 'field-radio', 'labelInline' => 'Giám sát theo dõi', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'xulyonho',
                'component' => 'field-radio', 'labelInline' => 'Xử lý ổ dịch', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'xulyorong',
                'component' => 'field-radio', 'labelInline' => 'Xử lý diện rộng', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'cathuphat',
                'component' => 'field-radio', 'labelInline' => '2. Ca bệnh thứ phát', 'options' => 'yes', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'odichmoi',
                'component' => 'field-radio', 'labelInline' => 'Ổ dịch mới', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'odichcu',
                'component' => 'field-radio', 'labelInline' => 'Ổ dịch cũ đã xác định', 'options' => 'yesno', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'odichcu_xuly',
                'label' => 'Xử lý(ngày)', 'type' => 'number', 'rules' => 'integer|min_value = 0', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'xuly',
                'component' => 'field-radio', 'labelInline' => 'Ổ dịch cũ đã xác định', 'options' => 'xuly', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'xuly_ngay',
                'label' => 'Xử lý(ngày)', 'type' => 'number', 'rules' => 'integer|min_value = 0', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'xuatvien',
                'component' => 'field-radio', 'label' => 'Xuất viện', 'options' => 'xuatvien', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'ngayxuatvien',
                'label' => 'Ngày xuất viện', 'rules' => 'date|date_to', 'widget' => 'datepicker', 'disabled' => $disabled_px2,
            ],
            [
                'name'      => 'chuandoan',
                'component' => 'field-radio', 'label' => 'Chuẩn đoán', 'options' => 'chuandoan', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'chuandoan_khac',
                'label' => 'Tên bệnh', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'nguoidieutra',
                'label' => 'Người điều tra', 'disabled' => $disabled_px2,
            ],
            [
                'name'  => 'nguoidieutra_sdt',
                'label' => 'Số điện thoại NĐT', 'disabled' => $disabled_px2,
            ]
        ];
    }



}


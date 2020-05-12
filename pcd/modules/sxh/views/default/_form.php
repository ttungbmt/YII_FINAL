<?php

use kartik\depdrop\DepDropExtAsset;
use pcd\models\Benhvien;
use kartik\depdrop\DepDropAsset;
use pcd\models\HcQuan;
use pcd\models\Loaibenh;
use pcd\supports\RoleHc;
DepDropAsset::register($this);
DepDropExtAsset::register($this);

$role = RoleHc::init();
$dm = [
    'qh'           => api('/dm/quan'),
    'chuandoan_bd' => Loaibenh::pluck('tenbenh', 'mabenh'),
    'phai'         => api('dm_phai'),
    'yesno'        => [1 => 'Có', 0 => 'Không'],
    'yesnonull'    => [1 => 'Có', 0 => 'Không', 9 => 'Không rõ'],
    'ht_dieutri'   => api('dm_ht_dieutri'),
    'loaidieutra'  => api('dm_loaidieutra'),
    'xacminh_cb'   => api('dm_xacminh_cb'),
    'benhvien'     => Benhvien::pluck('tenbenhvien', 'tenvt'),
    'tinh'         => [
        'HCM'      => 'Hồ Chí Minh',
        'TinhKhac' => 'Tỉnh khác',
    ],
    'tinhdieutra'  => ['01' => 'Thành phố Hà Nội', '02' => 'Tỉnh Hà Giang', '04' => 'Tỉnh Cao Bằng', '06' => 'Tỉnh Bắc Kạn', '08' => 'Tỉnh Tuyên Quang', '10' => 'Tỉnh Lào Cai', '11' => 'Tỉnh Điện Biên', '12' => 'Tỉnh Lai Châu', '14' => 'Tỉnh Sơn La', '15' => 'Tỉnh Yên Bái', '17' => 'Tỉnh Hoà Bình', '19' => 'Tỉnh Thái Nguyên', '20' => 'Tỉnh Lạng Sơn', '22' => 'Tỉnh Quảng Ninh', '24' => 'Tỉnh Bắc Giang', '25' => 'Tỉnh Phú Thọ', '26' => 'Tỉnh Vĩnh Phúc', '27' => 'Tỉnh Bắc Ninh', '30' => 'Tỉnh Hải Dương', '31' => 'Thành phố Hải Phòng', '33' => 'Tỉnh Hưng Yên', '34' => 'Tỉnh Thái Bình', '35' => 'Tỉnh Hà Nam', '36' => 'Tỉnh Nam Định', '37' => 'Tỉnh Ninh Bình', '38' => 'Tỉnh Thanh Hoá', '40' => 'Tỉnh Nghệ An', '42' => 'Tỉnh Hà Tĩnh', '44' => 'Tỉnh Quảng Bình', '45' => 'Tỉnh Quảng Trị', '46' => 'Tỉnh Thừa Thiên Huế', '48' => 'Thành phố Đà Nẵng', '49' => 'Tỉnh Quảng Nam', '51' => 'Tỉnh Quảng Ngãi', '52' => 'Tỉnh Bình Định', '54' => 'Tỉnh Phú Yên', '56' => 'Tỉnh Khánh Hoà', '58' => 'Tỉnh Ninh Thuận', '60' => 'Tỉnh Bình Thuận', '62' => 'Tỉnh Kon Tum', '64' => 'Tỉnh Gia Lai', '66' => 'Tỉnh Đắk Lắk', '67' => 'Tỉnh Đắk Nông', '68' => 'Tỉnh Lâm Đồng', '70' => 'Tỉnh Bình Phước', '72' => 'Tỉnh Tây Ninh', '74' => 'Tỉnh Bình Dương', '75' => 'Tỉnh Đồng Nai', '77' => 'Tỉnh Bà Rịa - Vũng Tàu', '79' => 'Thành phố Hồ Chí Minh', '80' => 'Tỉnh Long An', '82' => 'Tỉnh Tiền Giang', '83' => 'Tỉnh Bến Tre', '84' => 'Tỉnh Trà Vinh', '86' => 'Tỉnh Vĩnh Long', '87' => 'Tỉnh Đồng Tháp', '89' => 'Tỉnh An Giang', '91' => 'Tỉnh Kiên Giang', '92' => 'Thành phố Cần Thơ', '93' => 'Tỉnh Hậu Giang', '94' => 'Tỉnh Sóc Trăng', '95' => 'Tỉnh Bạc Liêu', '96' => 'Tỉnh Cà Mau'],
    'xuly'         => [1 => 'Chưa xử lý', 2 => 'trong thời gian xử lý', 3 => 'Sau thời gian xử lý'],
    'chuandoan'    => [1 => 'Bệnh SXH/ Theo dõi SXH', 2 => 'Sốt/Nhiễm siêu vi', 3 => 'Bệnh khác'],
    'loai_xn'      => api('dm_loai_xn'),
    'kq_xn'        => api('dm_kq_xn'),
    'xuatvien' => api('dm_xuatvien')
];

foreach ($dm as $k => $v) {
    $item = collect($v)->map(function ($v1, $k1) {
        return ['text' => $v1, 'value' => $k1];
    })->values();

    $dm[$k] = $item->all();
}

$appData = [
    'user'    => [
        'roles'     => array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())),
        'maquan'   => userInfo()->maquan,
        'maphuong' => userInfo()->maphuong,
    ],
    'dm'      => $dm,
    'form'    => $model->toArray(),
    'schema'  => $model->schema(),
    'xacminh' => $model->xacminh,
    'csrf' => [
        'token' => Yii::$app->request->csrfToken,
        'param' => Yii::$app->request->csrfParam,
    ],
    'map' => $model->getMap(),
];
?>

<?php $this->beginBlock('styles'); ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-draw@1.0.4/dist/leaflet.draw.css">
<?php $this->endBlock(); ?>

<?php if(role('quan|phuong')):?>
<div class="alert alert-primary border-0 alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
    <span class="font-weight-semibold text-uppercase">Thông báo!</span>
    Quý anh/chị cập nhật phiếu điều tra, nếu không cập nhật được, bị lỗi hoặc thắc mắc về phần nhập phiếu và phần mềm cần hỗ trợ kỹ thuật. Vui lòng gửi mail thông tin liên hệ và hình ảnh chụp lỗi cho TÙNG (ttungbmt@gmail.com - 0796628733) để được xử lỷ ngay
</div>
<?php endif;?>

<div id="vueApp">
    <sxh-form/>
</div>

<?php $this->beginBlock('scripts'); ?>
    <script src="/libs/bower/jquery-sticky/jquery.sticky.js"></script>
    <link rel="stylesheet" href="<?= asset('assets/vue/vue-component/dist/page-sxh.css') ?>">
    <script src="<?= asset('assets/vue/vue-component/dist/page-sxh.js') ?>"></script>
    <script>
        window.appData = <?=json_encode($appData)?>;
        console.log(window.appData);
    </script>
<?php $this->endBlock(); ?>
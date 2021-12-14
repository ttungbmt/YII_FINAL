<?php

use Carbon\Carbon;
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use pcd\models\Benhvien;
use pcd\models\Loaibenh;
use pcd\models\XacminhCb;
use yii\helpers\Html;

$this->title = ($model->getId() ? lang('Update') : lang('Create')) . ' Ca bệnh - Sốt xuất huyết';

$dm_loai_dt = api('dm_loaidieutra');
$dm_xacminh_cb = api('dm_xacminh_cb');
$dm_benh = Loaibenh::pluck('tenbenh', 'mabenh')->all();
$dm_ht_dieutri = api('dm_ht_dieutri');
$dm_phai = api('dm_phai');
$yesno = [1 => 'Có', 0 => 'Không'];
$yesnonull = [1 => 'Có', 0 => 'Không', 9 => 'Không rõ'];
$benhvien = Benhvien::pluck('tenbenhvien', 'tenvt')->all();
$dmTinh = ['01' => 'Thành phố Hà Nội', '02' => 'Tỉnh Hà Giang', '04' => 'Tỉnh Cao Bằng', '06' => 'Tỉnh Bắc Kạn', '08' => 'Tỉnh Tuyên Quang', '10' => 'Tỉnh Lào Cai', '11' => 'Tỉnh Điện Biên', '12' => 'Tỉnh Lai Châu', '14' => 'Tỉnh Sơn La', '15' => 'Tỉnh Yên Bái', '17' => 'Tỉnh Hoà Bình', '19' => 'Tỉnh Thái Nguyên', '20' => 'Tỉnh Lạng Sơn', '22' => 'Tỉnh Quảng Ninh', '24' => 'Tỉnh Bắc Giang', '25' => 'Tỉnh Phú Thọ', '26' => 'Tỉnh Vĩnh Phúc', '27' => 'Tỉnh Bắc Ninh', '30' => 'Tỉnh Hải Dương', '31' => 'Thành phố Hải Phòng', '33' => 'Tỉnh Hưng Yên', '34' => 'Tỉnh Thái Bình', '35' => 'Tỉnh Hà Nam', '36' => 'Tỉnh Nam Định', '37' => 'Tỉnh Ninh Bình', '38' => 'Tỉnh Thanh Hoá', '40' => 'Tỉnh Nghệ An', '42' => 'Tỉnh Hà Tĩnh', '44' => 'Tỉnh Quảng Bình', '45' => 'Tỉnh Quảng Trị', '46' => 'Tỉnh Thừa Thiên Huế', '48' => 'Thành phố Đà Nẵng', '49' => 'Tỉnh Quảng Nam', '51' => 'Tỉnh Quảng Ngãi', '52' => 'Tỉnh Bình Định', '54' => 'Tỉnh Phú Yên', '56' => 'Tỉnh Khánh Hoà', '58' => 'Tỉnh Ninh Thuận', '60' => 'Tỉnh Bình Thuận', '62' => 'Tỉnh Kon Tum', '64' => 'Tỉnh Gia Lai', '66' => 'Tỉnh Đắk Lắk', '67' => 'Tỉnh Đắk Nông', '68' => 'Tỉnh Lâm Đồng', '70' => 'Tỉnh Bình Phước', '72' => 'Tỉnh Tây Ninh', '74' => 'Tỉnh Bình Dương', '75' => 'Tỉnh Đồng Nai', '77' => 'Tỉnh Bà Rịa - Vũng Tàu', '79' => 'Thành phố Hồ Chí Minh', '80' => 'Tỉnh Long An', '82' => 'Tỉnh Tiền Giang', '83' => 'Tỉnh Bến Tre', '84' => 'Tỉnh Trà Vinh', '86' => 'Tỉnh Vĩnh Long', '87' => 'Tỉnh Đồng Tháp', '89' => 'Tỉnh An Giang', '91' => 'Tỉnh Kiên Giang', '92' => 'Thành phố Cần Thơ', '93' => 'Tỉnh Hậu Giang', '94' => 'Tỉnh Sóc Trăng', '95' => 'Tỉnh Bạc Liêu', '96' => 'Tỉnh Cà Mau'];
$xuly = [1 => 'Chưa xử lý', 2 => 'trong thời gian xử lý', 3 => 'Sau thời gian xử lý'];
$xacdinh = [1 => 'Bệnh SXH/ Theo dõi SXH', 2 => 'Sốt/Nhiễm siêu vi', 3 => 'Bệnh khác'];
$loai_xn = api('dm_loai_xn');
$ketqua_xn = api('dm_kq_xn');
$disabled = false;
$dm_quan = api('/dm/quan');
$url_phuong = url(['/api/dm/phuong']);
$dm_tinh = [
    'HCM'      => 'Hồ Chí Minh',
    'TinhKhac' => 'Tỉnh khác',
];
$locked = false;
$maquan = userInfo()->ma_quan;
$maphuong = userInfo()->ma_phuong;
$disabled_dc3 = false;
if (count($xacminhCbs) > 4) {
    $locked = true;
}
$chCas = $model->getChuyenCas()->with(['nhan', 'chuyen'])->all();
$last_chca = array_last($chCas);
if($last_chca){
    $model->nguoidieutra = data_get($last_chca, 'nguoinhan');
    $model->nguoidieutra_sdt = data_get($last_chca, 'sdt_nhan');
}

$warnings = Yii::$app->session->getFlash('warnings');
if($warnings){
    $model->addErrors($warnings);
}
//dd($xacminhCbs);
?>

<div id="cabenh-wrapper">

    <?php $form = ActiveForm::begin([
        'id' => 'cabenhForm',
        'validateOnSubmit' => $model->validateOnSubmit,
    ]) ?>

    <?= $form->errorSummary($model, [
        'header' => '<span class="font-weight-semibold">Vui lòng điền các thông tin sau:</span>',
        'class' => 'error-summary alert alert-danger border-0 alert-dismissible'
    ]); ?>

    <div class="card">
        <?php include_once(__DIR__ . '/partials/_bando.php') ?>
        <div class="card-header bg-white header-elements-inline">
            <?php include_once(__DIR__ . '/partials/_header.php') ?>
        </div>
        <div class="card-body">
            <?php include_once(__DIR__ . '/partials/_0_bandau.php') ?>

            <fieldset>
                <legend class="font-weight-semibold text-uppercase font-size-sm">
                    <i class="icon-file-text2 mr-2"></i>
                    Phiếu điều tra
                    <a href="#" class="float-right text-default" data-toggle="collapse" data-target="#phieusxh">
                        <i class="icon-circle-down2"></i>
                    </a>
                </legend>

                <div class="collapse show" id="phieusxh">
                    <header>
                        <p class="text-primary">Phiếu điều tra</p>
                        <p class="text-primary">Ca bệnh sốt xuất huyết Dengue</p>
                    </header>
                    <div class="phieu-body">
                        <?php include_once(__DIR__ . '/partials/_1_xacminh.php') ?>
                        <div v-if="hide_dieutra">
                            <?php include_once(__DIR__ . '/partials/_2_dieutra.php') ?>
                            <?php include_once(__DIR__ . '/partials/_3_xuly.php') ?>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-6">
                                <?= $form->field($model, 'nguoidieutra') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'nguoidieutra_sdt') ?>
                            </div>
                        </div>
                        <?php
                        $last_id = data_get(array_last($chCas), 'id');
                        ?>

                        <div class="row" v-if="shownBtnCc">
                            <div class="offset-md-6 col-md-6">
                                <button type="button" id="btnCcAccept" @click="acceptCc(<?=$last_id?>)" class="float-right btn bg-warning-400 btn-labeled btn-labeled-left btn-rounded legitRipple"> <b><i class="icon-file-check"></i></b> Cho phép chuyển ca</button>
                            </div>
                        </div>

                        <?php if (count($chCas) > 0): ?>
                            <hr>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <h6 class="text-info">Danh sách thông tin chuyển ca</h6>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">STT</th>
                                            <th colspan="4">Chuyển ca</th>
                                            <th colspan="4">Nhận ca</th>
                                            <th rowspan="2">Thời gian</th>
                                        </tr>
                                        <tr>
                                            <th>Quận</th>
                                            <th>Phường</th>
                                            <th>Người điều tra</th>
                                            <th>Số điện thoại</th>
                                            <th>Quận</th>
                                            <th>Phường</th>
                                            <th>Người điều tra</th>
                                            <th>Số điện thoại</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($chCas as $k => $i): ?>
                                            <tr>
                                                <td><?= $k + 1 ?></td>
                                                <td><?= data_get($i, 'chuyen.tenquan') ?></td>
                                                <td><?= data_get($i, 'chuyen.tenphuong') ?></td>
                                                <td><?= data_get($i, 'nguoichuyen') ?></td>
                                                <td><?= data_get($i, 'sdt_chuyen') ?></td>
                                                <td><?= data_get($i, 'nhan.tenquan') ?></td>
                                                <td><?= data_get($i, 'nhan.tenphuong') ?></td>
                                                <td><?= data_get($i, 'nguoinhan') ?></td>
                                                <td><?= data_get($i, 'sdt_nhan') ?></td>
                                                <td><?= $i->datetime?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </fieldset>


        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>

<?php $this->beginBlock('scripts'); ?>
<link rel="stylesheet" href="<?=url('/libs/bower/leaflet.markercluster/dist/MarkerCluster.css')?>">
<link rel="stylesheet" href="<?=url('/libs/bower/leaflet.markercluster/dist/MarkerCluster.Default.css')?>">
<script src="<?=url('/libs/bower/leaflet.markercluster/dist/leaflet.markercluster.js')?>"></script>
<?php include_once(__DIR__ . '/partials/_scripts.php') ?>
<?php $this->endBlock(); ?>


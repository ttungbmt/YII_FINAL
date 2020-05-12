<?php

use kartik\widgets\DatePicker;
use pcd\models\VCabenh1;
use pcd\models\XulyOdsxh;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$inpDate = ['class' => 'form-control i-datepicker', 'placeholder' => 'DD/MM/YYYY', 'disabled' => true];
$ids = array_filter(explode(',', request()->get('macabenhs', '')));

$cbRes = $ids ? VCabenh1::find()->andFilterWhere(['macabenh' => $ids])->indexBy('macabenh')->all(): [];
$cabenhs = collect($ids)->map(function ($i) use($cbRes){return data_get($cbRes, $i);});
$cabenhs = $model->v_cbsxh ? $model->v_cbsxh : $cabenhs;

$loaiodich = [
    1 => 'Ổ dịch nhỏ',
    2 => 'Ổ dịch vừa',
    3 => 'Ổ dịch lớn',
    4 => 'Ổ dịch lan rộng',
];
?>

<div class="odich-sxh-form card card-body">
    <?php $form = ActiveForm::begin([
        'id' => 'frmOdich'
    ]); ?>

    <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
    <h5 class="text-primary bold">
        <span class="badge badge-flat border-primary text-primary">I</span> CA BỆNH TRONG Ổ DỊCH
    </h5>
    <div class="clearfix"></div>
    <div class="table-responsive">
        <table class="table" id="tbCabenh">
            <thead>
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Tuổi</th>
                <th>Tổ</th>
                <th>Khu phố</th>
                <th>Phường xã</th>
                <th>Quận huyện</th>
                <th>Ngày mắc bệnh</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="listCabenh">
            <?php if(!empty($cabenhs) ):?>
                <?php foreach ($cabenhs as $k => $val): ?>
                    <tr id="<?= $val['macabenh'] ?>">
                        <td><?= $val['macabenh'] ?></td>
                        <td><?= $val['hoten'] ?> </td>
                        <td><?= $val['tuoi'] ?> </td>
                        <td><?= $val['to1'] ?></td>
                        <td><?= $val['khupho1'] ?></td>
                        <td><?= $val['ten_phuong'] ?></td>
                        <td><?= $val['ten_quan'] ?></td>
                        <td><?= date_format(date_create($val['ngaymacbenh']), 'd/m/Y') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif;?>
            </tbody>
        </table>
    </div>

    <h5 class="text-primary bold">
        <span class="badge badge-flat border-primary text-primary mt-3">II</span> QUẢN LÝ VÀ XỬ LÝ Ổ DỊCH
    </h5>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'loaiodich')->dropDownList($loaiodich, ['prompt' => 'Chọn loại ổ dịch...', 'disabled' => true])
            ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ngayxacdinh')->widget(DatePicker::classname(), ['disabled' => true]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'ngayphathien')->widget(DatePicker::classname(), ['disabled' => true]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ngaydukienkt')->widget(DatePicker::classname(), ['disabled' => true])?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ngaykt')->widget(DatePicker::classname(), ['disabled' => true])?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'dientichdk')->textInput(['type' => 'number', 'placeholder' => 'Diện tích ổ dịch dự kiến', 'disabled' => true])->label('Diện tích dự kiến') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Chỉ số ban đầu:
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'BI_bandau')->textInput(['disabled' => true]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'CI_bandau')->textInput(['disabled' => true]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'HI_bandau')->textInput(['disabled' => true]); ?>
        </div>
    </div>

    <?php foreach ($model->xulyOdsxhs as $k => $val) : ?>
        <?php $lanxl = $val->lanxl; $i = $val->id ?>
        <?= $form->field($val, "[$i]lanxl")->hiddenInput()->label(false) ?>
        <h6 class="text-primary bold">
            <span class="badge badge-flat border-primary text-primary"><?= $lanxl ?></span> Xử lý lần <?= $lanxl ?> <br>
        </h6>
        <h6 class="text-primary bold">
            Diệt lăng quăng lần <?= $lanxl ?>
        </h6>
        <div class="row">
            <div class="col-md-12">Ngày diệt lăng quăng <?= $lanxl ?>:</div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]tungaydlq")->textInput($inpDate)->label('Từ ngày'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]denngaydlq")->textInput($inpDate)->label('Đến ngày'); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($val, "[$i]sotodlq")->textInput(['disabled' => true])->label('Số tổ DLQ ' . $lanxl); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($val, "[$i]tentodlq")->textInput(['disabled' => true])->label('Tên tổ DLQ ' . $lanxl); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($val, "[$i]sokhuphodlq")->textInput(['disabled' => true])->label('Số khu phố DLQ ' . $lanxl); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($val, "[$i]tenkhuphodlq")->textInput(['disabled' => true])->label('Tên khu phố DLQ ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]sonhadukiendlq")->textInput(['disabled' => true])->label('Số nhà trong các tổ dự kiến DLQ ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]sonhaduocdlq")->textInput(['disabled' => true])->label('Số nhà được DLQ ' . $lanxl); ?>
            </div>
            <div class="col-md-3">
                Chỉ số trước phun <?= $lanxl ?>:
            </div>
            <div class="col-md-3">
                <?= $form->field($val, "[$i]truoc_bi")->textInput(['disabled' => true])->label('BI_' . $lanxl); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($val, "[$i]truoc_ci")->textInput(['disabled' => true])->label('CI_' . $lanxl); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($val, "[$i]truoc_hi")->textInput(['disabled' => true])->label('HI_' . $lanxl); ?>
            </div>
        </div>

        <h6 class="text-primary bold">
            Phun hóa chất <?= $lanxl ?>
        </h6>
        <div class="row">
            <div class="col-md-12">
                Ngày PHC <?= $lanxl ?>:
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]tungayphc")->textInput($inpDate)->label('Từ ngày'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]denngayphc")->textInput($inpDate)->label('Đến ngày'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]sotophc")->textInput(['disabled' => true])->label('Số tổ PHC ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]tentophc")->textInput(['disabled' => true])->label('Tên tổ PHC ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]sokhuphophc")->textInput(['disabled' => true])->label('Số khu phố PHC ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]tenkhuphophc")->textInput(['disabled' => true])->label('Tên khu phố PHC ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]sohodukienphc")->textInput(['disabled' => true])->label('Số hộ dự kiến PHC ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]sohoduocphc")->textInput(['disabled' => true])->label('Số hộ được PHC ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]tenhc1")->textInput(['disabled' => true])->label('Tên HC ' . $lanxl.'_1'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]solithc1")->textInput(['disabled' => true])->label('Số lít ' . $lanxl.'_1'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]tenhc2")->textInput(['disabled' => true])->label('Tên HC ' . $lanxl.'_2'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]solithc2")->textInput(['disabled' => true])->label('Số lít ' . $lanxl.'_2'); ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($val, "[$i]tyle")->textInput(['disabled' => true])->label('Tỷ lệ hộ dân mở cửa lần ' . $lanxl); ?>
            </div>
        </div>

    <?php endforeach; ?>

    <?php ActiveForm::end(); ?>
</div>


<script src="<?=url('/pcd/resources/public_html/libs/bower/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>
<script src="<?=url('/pcd/resources/public_html/libs/bower/bootstrap-datepicker/dist/locales/bootstrap-datepicker.vi.min.js')?>"></script>


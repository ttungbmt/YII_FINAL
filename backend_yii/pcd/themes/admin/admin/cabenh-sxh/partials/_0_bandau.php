<?php
use kartik\helpers\Html;
use kartik\widgets\DatePicker;
use pcd\models\Loaibenh;
?>

<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'lat')->textInput(['id' => 'inpLat'])->label('Vĩ độ (Lat)') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'lng')->textInput(['id' => 'inpLng'])->label('Kinh độ (Lng)') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'chuandoan_bd')->dropDownList($dm_benh, [
            'v-model' => 'm.chuandoan_bd',
            'prompt' => 'Chọn bệnh...',
            'disabled' => $locked
        ]) ?>
    </div>
    <div class="col-md-3" v-if="m.chuandoan_bd=='KHAC'">
        <?= $form->field($model, 'chuandoan_bd_khac')->textInput(['required' => 'required'])->label('Tên bệnh khác'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'me')->textInput(['disabled' => $locked]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'ngaybaocao')->widget(DatePicker::className(), ['disabled' => $locked]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'ma_icd')->textInput(['disabled' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'shs')->textInput(['class' => 'form-control', 'disabled' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'ht_dieutri')->radioList($dm_ht_dieutri, ['inline'=>true, 'itemOptions' => ['v-model.number' => 'm.ht_dieutri', 'disabled' => $locked]]) ?>
    </div>
</div>

<div id="cungnha-wrapper" class="mb-2">
    <button type="button" class="btn btn-outline bg-primary-400 text-primary-400 border-primary-400 btn-sm" @click="openTbCungnha(<?=$model->gid?>)">Xem ca bệnh cùng nhà</button>
    <div id="cungnha-content" class="mt-2"></div>
</div>

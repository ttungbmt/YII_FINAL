<?php
use pcd\modules\pcd\models\Loaibenh;
use pcd\modules\role_phuongquan\services\PQService;
use pcd\services\DichteApi;
use yii\helpers\Html;

$disabled = $psxh->chuyenca1 && PQService::getRolePQOfCurrentUser()->cap_hanhchinh == 'phuong' ? true : false;
$loaibenh = Loaibenh::find()->pluck('tenbenh', 'mabenh');
?>

<div class="row">
    <div class="col-md-3">
        <?= $form->field($psxh, 'geo_y')->textInput(['id' => 'geo_y', 'class' => 'form-control', 'v-model' => 'psxh.geo_y'])->label('Vĩ độ (Lat)') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($psxh, 'geo_x')->textInput(['id' => 'geo_x', 'class' => 'form-control', 'v-model' => 'psxh.geo_x'])->label('Kinh độ (Lng)') ?>
    </div>
    <div class="col-md-3">
        <?php
        if (is_null($psxh->chuandoanbd)) {
            $cdbd = null;
        } else {
            $cdbd = in_array($psxh->chuandoanbd, array_keys($loaibenh)) ? $psxh->chuandoanbd : 'KHAC';
        }
        ?>
        <?= $form->field($psxh, 'chuandoanbd')->dropDownList($loaibenh, [
            'v-model' => 'psxh.chuandoanbd',
//            'prompt' => 'Chọn...',
            'options' => [
                $cdbd => ['Selected' => true],
            ]
        ])->label('Chẩn đoán ban đầu'); ?>
    </div>
    <div class="col-md-3" v-if="psxh.chuandoanbd=='KHAC'">
        <?= $form->field($psxh, 'chuandoanbd')->textInput(['required' => 'required'])->label('Tên bệnh khác'); ?>
    </div>
</div>

<div class="row ">
    <div class="col-md-3">
        <?= $form->field($psxh, 'me')->textInput() ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($psxh, 'ngaybaocao')->textInput(['class' => 'form-control i-datepicker', 'placeholder' => 'DD/MM/YYYY']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($psxh, 'ma_icd')->textInput(['disabled' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($psxh, 'shs')->textInput(['class' => 'form-control', 'disabled' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($psxh, 'loaibc')->radioList([0 => 'Ca ngoại trú', 1 => 'Ca nội trú'], [
            'item' => function ($index, $label, $name, $checked, $value) use($disabled) {
                return Html::radio($name, $checked, ['disabled' => $disabled, 'v-model' => 'psxh.loaibc', 'number'=>'true', 'value' => $value, 'label' => Html::encode($label),]);
            },
        ]) ?>
    </div>
</div>

<script !src="">
    $(function () {

        $('#geo_y').change(function () {
            var latlng = $('#geo_y').val().split(",");

            $('#geo_y').val(latlng[0])
            latlng[1] ? $('#geo_x').val(latlng[1]) : null;
        });

    });
</script>

<template id="leaflet">
    <div id="map-wrapper">
        <div id="map"
             :style="style"
        ></div>
        <div id="geocomplete-wrapper">
            <input id="geocomplete" v-model="address" class="form-control" @keyup.enter="geoSearch" type="text"
                   placeholder="Nhập vị trí tìm kiếm"/>
        </div>
        <div id="sliderbar-wrapper" style="display: none;">
            <input type="text" id="sliderbar">
        </div>


        <style>
            #map { position: absolute; width: 100%; height: 100% }

            #geocomplete-wrapper {
                position: absolute;
                top: 7px;
                left: 40px;
                z-index: 1000;
                width: 245px;
            }

            #geocomplete { background-color: rgba(255, 255, 255, 0.8); }

            #sliderbar-wrapper {
                margin: auto;
                position: absolute;
                left: 0; bottom: 20px; right: 0;
                width: 355px;
                z-index: 1000;
            }

            .irs-from, .irs-single, .irs-to { left: 0; white-space: nowrap; color: #fff; background-color: #22a3ff; }

            .pac-container:after { content: none !important; }
        </style>
    </div>
</template>


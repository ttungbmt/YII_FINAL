<?php

use pcd\assets\AltairAsset;
use pcd\assets\AltairTopAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use ttungbmt\map\Map;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model pcd\models\CabenhSxhNn */
/* @var $form yii\widgets\ActiveForm */

$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' Ca nghi ngờ nhiễm SXH';
$dm_chuandoan_bd = api('dm/chuandoan-bd');
?>

<div class="dm-dichte-form">
    <?php $form = ActiveForm::begin([
    ]); ?>
    <div class="card">
        <?= Map::widget(['model' => $model]) ?>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'lat')->textInput(['maxlength' => true, 'id' => 'inpLat', 'disabled' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'lng')->textInput(['maxlength' => true, 'id' => 'inpLng', 'disabled' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'hoten')->textInput(['maxlength' => true, 'disabled' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'tuoi')->textInput(['disabled' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'benhvien')->textInput(['maxlength' => true, 'disabled' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'chuandoan_bd')->dropDownList($dm_chuandoan_bd, [
                        'prompt' => 'Chọn chuẩn đoán...',
                        'disabled' => true
                    ]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ngaymacbenh_nv')->widget(DatePicker::className(),[
                        'disabled' => true
                    ]) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
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
                    <?= $form->field($model, 'lat')->textInput(['maxlength' => true, 'id' => 'inpLat']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'lng')->textInput(['maxlength' => true, 'id' => 'inpLng']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'hoten')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'tuoi')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'benhvien')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'chuandoan_bd')->dropDownList($dm_chuandoan_bd, ['prompt' => 'Chọn chuẩn đoán...']) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ngaymacbenh_nv')->widget(DatePicker::className()) ?>
                </div>
            </div>

            <?= $form->field($model, 'is_nghingo')->textInput(['value' => 1, 'type' => 'hidden'])->label(false) ?>

            <?php if (!request()->isAjax): ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? lang('Create') : lang('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <?php endif; ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
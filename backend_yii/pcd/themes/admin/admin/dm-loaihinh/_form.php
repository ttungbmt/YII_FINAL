<?php

use pcd\models\DmLoaihinh;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use ttungbmt\map\Map;

/* @var $this yii\web\View */
/* @var $model pcd\models\DmLoaihinh */
/* @var $form yii\widgets\ActiveForm */

$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' Loại hình';

$dm_nhom = DmLoaihinh::find()->orderBy('nhom')->pluck('nhom', 'nhom')->all();
$dm_loaihinh = DmLoaihinh::find()->orderBy('ten_lh')->pluck('ten_lh', 'ten_lh')->all();
?>

<?php $form = ActiveForm::begin(); ?>

<div class="dm-loaihinh-form">
    <?= $form->field($model, 'nhom')->dropDownList($dm_nhom) ?>

    <?= $form->field($model, 'ten_lh')->dropDownList($dm_loaihinh) ?>

    <?= $form->field($model, 'tanxuat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thaydoi')->textInput(['maxlength' => true]) ?>


    <?php if (!request()->isAjax): ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? lang('Create') : lang('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>

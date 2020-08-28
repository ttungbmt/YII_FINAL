<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use ttungbmt\map\Map;

/* @var $this yii\web\View */
/* @var $model pcd\modules\dm\models\DmKhupho */
/* @var $form yii\widgets\ActiveForm */

$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' Hóa chất';
?>

<?php $form = ActiveForm::begin(); ?>

<div class="dm-hoachat-form">
    <?= $form->field($model, 'ten_hc')->textInput(['maxlength' => true]) ?>

    <?php if (!request()->isAjax): ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? lang('Create') : lang('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>

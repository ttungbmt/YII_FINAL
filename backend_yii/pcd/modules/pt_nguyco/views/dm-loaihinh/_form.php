<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = ($model->isNewRecord ? 'Thêm mới Loại hình' : "Cập nhật Loại hình {$model->gid}");
?>

<?php $form = ActiveForm::begin(); ?>

<div class="dm-loaihinh-form">
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'nhom')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ten_lh')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tanxuat')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'thaydoi')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?php if (!request()->isAjax): ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? lang('Create') : lang('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>

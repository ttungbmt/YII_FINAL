<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model pcd\modules\dm\models\DmToDp */
/* @var $form yii\widgets\ActiveForm */

$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' tổ dân phố';

if (($maquan = (string)userInfo()->maquan) && !$model->maquan) {
    $model->maquan = $maquan;
}

if ($maphuong = (string)userInfo()->maphuong && !$model->maphuong) {
    $model->maquan = $maquan;
    $model->maphuong = $maphuong;
}
?>

<?php $form = ActiveForm::begin(); ?>

<div class="dm-to-dp-form">

    <?= $form->field($model, 'maquan')->dropDownList(api('/dm/quan?role=true'), [
        'prompt' => 'Chọn quận...',
        'id' => 'drop-quan',
    ]) ?>

    <?= $form->field($model, 'maphuong')->widget(DepDrop::className(), [
        'options' => ['prompt' => 'Chọn phường...', 'id' => 'drop-phuong'],
        'pluginOptions' => [
            'depends' => ['drop-quan'],
            'url' => url(['/api/dm/phuong?role=true']),
            'initialize' => $model->maquan == true,
            'placeholder' => 'Chọn phường...',
            'ajaxSettings' => ['data' => ['value' => $maphuong]],
        ],
    ]) ?>

    <?= $form->field($model, 'khupho')->widget(DepDrop::className(), [
        'options' => ['prompt' => 'Chọn phường...'],
        'pluginOptions' => [
            'depends' => ['drop-phuong'],
            'url' => url(['/api/dm/khupho']),
            'initialize' => $model->maphuong == true,
            'placeholder' => 'Chọn khu phố...',
            'ajaxSettings' => ['data' => ['value' => $model->khupho]],
        ],
    ]) ?>

    <?= $form->field($model, 'to_dp')->textInput(['maxlength' => true]) ?>

    <?php if (!request()->isAjax): ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? lang('Create') : lang('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use ttungbmt\map\Map;

/* @var $this yii\web\View */
/* @var $model pcd\modules\dm\models\DmKhupho */
/* @var $form yii\widgets\ActiveForm */

$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' Khu phố';
if(($maquan = (string)userInfo()->maquan) && !$model->maquan){
    $model->maquan = $maquan;
}
if($maphuong = (string)userInfo()->maphuong && !$model->maphuong) {
    $model->maquan = $maquan;
    $model->maphuong = $maphuong;
}
?>

<?php $form = ActiveForm::begin(); ?>

<div class="dm-khupho-form">

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
            'ajaxSettings' => ['data' => ['value' => $model->maphuong]],
        ],
    ]) ?>


    <?= $form->field($model, 'khupho')->textInput(['maxlength' => true]) ?>

    <?php if (!request()->isAjax): ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? lang('Create') : lang('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>

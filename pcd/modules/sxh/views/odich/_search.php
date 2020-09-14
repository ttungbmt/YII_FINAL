<?php

use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\depdrop\DepDrop;

$role = \pcd\supports\RoleHc::init();
$role->initFormHc($model);

?>

<?php $form = ActiveForm::begin([
    'method' => 'GET',
    'options' => ['id' => 'cabenh-search', 'data-pjax' => true]
]) ?>
<div class="row">
    <div class="col-md-5">
        <?= $form->field($model, 'maquan')->dropDownList(api('/dm/quan?role=true'), [
            'prompt'  => 'Chọn quận huyện...',
            'id'      => 'drop-quan',
            'options' => [
                $model->maquan => ['Selected' => true],
            ]
        ])->label(false); ?>
    </div>
    <div class="col-md-5">
        <?= $form->field($model, 'maphuong')->widget(DepDrop::className(), [
            'options'       => ['prompt' => 'Chọn phường...'],
            'pluginOptions' => [
                'depends'      => ['drop-quan'],
                'url'          => url(['/api/dm/phuong?role=true']),
                'initialize'   => $model->maquan == true,
                'placeholder'  => 'Chọn phường...',
                'ajaxSettings' => ['data' => ['value' => $model->maphuong]],
            ],
        ])->label(false) ?>
    </div>
    <div class="col-md-2">
        <button type="submit" class="form-control btn btn-primary"><i class="icon-search4 text-size-base"></i></button>
    </div>
    <div class="col-md-5">
        <?= $form->field($model, 'field_date')->dropDownList(api('dm_ngay_odich'))->label(false); ?>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'date_from')->widget(DatePicker::classname(), ['options' => ['placeholder' => 'Từ ngày']])->label(false); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'date_to')->widget(DatePicker::classname(), ['options' => ['placeholder' => 'Đến ngày']])->label(false) ?>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end() ?>

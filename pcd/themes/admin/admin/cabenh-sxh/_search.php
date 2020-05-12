<?php

use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\depdrop\DepDrop;

$maquan = userInfo()->ma_quan;
$maphuong = userInfo()->ma_phuong;
?>

<?php $form = ActiveForm::begin([
    'method' => 'GET',
    'options' => ['id' => 'cabenh-search', 'data-pjax' => true]
]) ?>
<div class="row">
    <div class="col-md-2 col-xs-2">
        <?= $form->field($model, 'maquan')->dropDownList(api('/dm/quan?role=true'), [
            'prompt'  => 'Chọn quận huyện...',
            'id'      => 'drop-quan',
            'options' => [
                userInfo()->ma_quan => ['Selected' => true],
            ]
        ])->label(false); ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'maphuong')->widget(DepDrop::className(), [
            'options'       => ['prompt' => 'Chọn phường...'],
            'pluginOptions' => [
                'depends'      => ['drop-quan'],
                'url'          => url(['/api/dm/phuong?role=true']),
                'initialize'   => $maquan == true,
                'placeholder'  => 'Chọn phường...',
                'ajaxSettings' => ['data' => ['value' => $maphuong]],
            ],
        ])->label(false) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'date_from')
            ->widget(DatePicker::classname(), ['options' => ['placeholder' => 'Từ ngày mắc bệnh']])->label(false); ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'date_to')->widget(DatePicker::classname(), ['options' => ['placeholder' => 'Đến ngày']])->label(false) ?>
    </div>
    <div class="col-md-2">
        <button type="submit" class="form-control btn btn-primary"><i class="icon-search4 text-size-base"></i>
        </button>
    </div>
</div>
<?php ActiveForm::end() ?>

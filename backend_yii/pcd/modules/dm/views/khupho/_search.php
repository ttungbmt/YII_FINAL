<?php

use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\depdrop\DepDrop;
use yii\widgets\Pjax;

$maquan = userInfo()->maquan;
$maphuong = userInfo()->maphuong;
?>


<?php $form = ActiveForm::begin([
    'method' => 'GET',
    'options' => ['id' => 'form-search', 'data-pjax' => true]
]) ?>
<div class="flex">
    <div class="row flex-grow">
        <div class="col-md-6">
            <?= $form->field($model, 'maquan')->dropDownList(api('/dm/quan?role=true'), [
                'prompt'  => 'Chọn quận huyện...',
                'id'      => 'drop-quan1',
            ])->label(false); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'maphuong')->widget(DepDrop::className(), [
                'options'       => ['prompt' => 'Chọn phường...', 'id' => 'drop-phuong1'],
                'pluginOptions' => [
                    'depends'      => ['drop-quan1'],
                    'url'          => url(['/api/dm/phuong?role=true']),
                    'initialize'   => $maquan == true,
                    'placeholder'  => 'Chọn phường...',
                    'ajaxSettings' => ['data' => ['value' => $maphuong]],
                ],
            ])->label(false) ?>
        </div>
    </div>
    <div class="ml-auto pl-2 ">
        <div class="btn-group">
            <button type="reset" class="form-control btn btn-default"><i class="icon-reset text-size-base"></i></button>
            <button type="submit" class="form-control btn btn-primary"><i class="icon-search4 text-size-base"></i></button>
        </div>

    </div>
</div>

<?php ActiveForm::end() ?>

<script>
    // $(document).on('submit', '#form-search[data-pjax]', function(e) {
    //     e.preventDefault()
    //     $.pjax.submit(e, '#crud-datatable-pjax')
    // })
</script>

<?php

use Illuminate\Support\Arr;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;

$model = new \pcd\search\PtNguycoSearch();
$model->maquan = userInfo()->maquan;
$dm_loaihinh = api('pt_nguyco/dm/loaihinh');
$dm_nhom = api('pt_nguyco/dm/nhom');
?>

<?php $form = ActiveForm::begin() ?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'ten_cs')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'nhom')->dropDownList($dm_nhom, ['prompt' => 'Chọn ...']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'loaihinh_id')->dropDownList($dm_loaihinh, ['prompt' => 'Chọn ...']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'sonha')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'tenduong')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'to_dp')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'khupho')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'maquan')->dropDownList(api('/dm/quan?role=true'), [
            'prompt' => 'Chọn ...',
            'id'     => 'drop-quan1',
        ]) ?>
    </div>
    <div class="col-md-6">
        <input id="hidden_maphuong" type="hidden" name="maphuong_val">
        <?= $form->field($model, 'maphuong')->widget(DepDrop::className(), [
            'options'       => ['prompt' => 'Chọn phường...', 'id' => 'drop-phuong1'],
            'pluginOptions' => [
                'depends'      => ['drop-quan1'],
                'url'          => url(['/api/dm/phuong?role=true']),
                'placeholder'  => 'Chọn ...',
                'params' => ['hidden_maphuong'],
                'initialize' => $model->maquan ? true : false,
                'ajaxSettings' => ['data' => ['value' => userInfo()->maphuong]],
            ],
        ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'ngaycapnhat')->widget(\kartik\widgets\DatePicker::className()) ?>
    </div>
</div>
<?php ActiveForm::end() ?>

<script>
    $(function () {
        let $qh = $('#drop-quan1')
        if($qh.val()){
            $qh.trigger('change')
        }

        $('#drop-phuong1').change(function () {
            $('#hidden_maphuong').val($(this).val())
        })
    })
</script>

<?php
//Yii::$app->assetManager->bundles = [
//    'yii\web\YiiAsset' => false,
//    'yii\web\JqueryAsset' => false,
//    'kartik\form\ActiveFormAsset' => false,
//    'yii\widgets\ActiveFormAsset' => false,
//    'yii\bootstrap\BootstrapAsset' => false,
//    'yii\bootstrap\BootstrapPluginAsset' => false,
//    'kartik\depdrop\DepDropAsset' => false,
//    'kartik\depdrop\DepDropExtAsset' => false,
//    'kartik\base\WidgetAsset' => false,
//    'yii\validators\ValidationAsset' => false,
//];
$readyJs = Arr::pull($this->js, \yii\web\View::POS_READY);
if($readyJs){
    $this->registerJs("$(function(){\n" . implode("\n", $readyJs) . "\n});");
}
?>

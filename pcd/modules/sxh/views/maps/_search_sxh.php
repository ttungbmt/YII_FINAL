<?php

use Illuminate\Support\Arr;
use kartik\form\ActiveForm;
use pcd\modules\sxh\models\search\SxhSearch;
use kartik\depdrop\DepDrop;

$model = new SxhSearch();
$dm_loaidieutra = api('dm_loaidieutra');
$dm_ht_dieutri = api('dm_ht_dieutri');
$dm_chuandoan = api('dm_chuandoan');
$model->maquan = userInfo()->maquan;
$model->maphuong = userInfo()->maphuong;
?>
<?php $form = ActiveForm::begin() ?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'hoten')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'loaidieutra')->dropDownList($dm_loaidieutra, ['prompt' => 'Chọn ...']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'sonha')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'duong')->textInput(['maxlength' => true]) ?>
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
        <?= $form->field($model, 'date_type')->dropDownList([
            'ngaynhapvien' => 'Ngày nhập viện',
            'ngayxuatvien' => 'Ngày xuất viện',
            'ngaybaocao' => 'Ngày báo cáo',
            'ngaymacbenh' => 'Ngày mắc bệnh',
        ]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'date_from')->widget(\kartik\widgets\DatePicker::className()) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'date_to')->widget(\kartik\widgets\DatePicker::className()) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'ht_dieutri')->dropDownList($dm_ht_dieutri, ['prompt' => 'Chọn...']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'chuandoan')->dropDownList($dm_chuandoan, ['prompt' => 'Chọn...']) ?>
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

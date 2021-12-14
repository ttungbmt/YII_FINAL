<?php

use kartik\widgets\DatePicker;
use pcd\modules\pcd\services\RolePQSrv;
use pcd\modules\role_phuongquan\services\PQService;
use kartik\depdrop\DepDrop;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\Pjax;
$role = PQService::getRolePQOfCurrentUser();
?>

<div id="cabenh-search" class="mb-10">
    <?php Pjax::begin(['id' => 'frm_filter_cb']) ?>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax' => true ]
    ]) ?>
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <?= $form->field($model, 'globalSearch',[
                'template' => '{input}',
            ])->textInput(['placeholder' => 'Tìm tất cả'])->label(false) ?>
        </div>
        <div class="col-md-2 col-xs-6">
            <?= $form->field($model, 'ma_quan')->dropDownList(RolePQSrv::listQh(),[
                'prompt' => 'Chọn quận huyện...',
                'id' => 'ma_quan',
//                'options' => [
//                    co_pqpx()->selectQH($model->ma_quan) => ['Selected' => true],
//                ]
            ])->label(false); ?>
        </div>
        <div class="col-md-2 col-xs-6">
            <input type="hidden" id="px1_param" value="<?= $model->ma_phuong; ?>">
            <?= $form->field($model, 'ma_phuong')->widget(DepDrop::classname(), [
                'pluginOptions'=>[
                    'depends'=>[
                        'ma_quan'
                    ],
                    'placeholder' => 'Chọn phường xã...',
                    'initialize' => true,
                    'url' => url_home('apis/role-list-px'),
                    'params' => ['px1_param']
                ]
            ])->label(false); ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'ngaybaocao_from')->widget(DatePicker::className(), [
                'type' => DatePicker::TYPE_RANGE,
                'attribute2' => 'ngaybaocao_to',
                'options' => ['placeholder' => 'Từ ngày'],
                'options2' => ['placeholder' => 'Đến ngày'],
                'separator' => '<i class="icon-arrow-right15"></i>',
            ])->label(false) ?>
        </div>

        <div class="col-md-1 col-xs-12">
            <button type="submit" class="form-control btn btn-primary"><i class="icon-search4 text-size-base"></i></button>
        </div>
    </div>
    <?php ActiveForm::end() ?>
    <?php Pjax::end() ?>

</div>

<script>
    $("document").ready(function(){
        $("#frm_filter_cb").on("pjax:end", function() {
            $.pjax.reload({container:"#kv-pjax-container"});  //Reload GridView
        });
    });
</script>
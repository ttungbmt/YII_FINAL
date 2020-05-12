<?php

use kartik\widgets\DatePicker;
use pcd\modules\pcd\services\RolePQSrv;
use pcd\modules\role_phuongquan\services\PQService;
use kartik\depdrop\DepDrop;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\Pjax;

?>

<div id="cabenh-search" class="mb-10">
    <?php $form = ActiveForm::begin([
        'action'  => ['index'],
        'method'  => 'get',
        'options' => [
            'id' => 'frm_filter_cb',
        ]
    ]) ?>
    <div class="row">
        <div class="col-md-2 col-xs-2">
            <?= $form->field($model, 'ma_quan')->dropDownList(RolePQSrv::listQh(), [
                'prompt' => 'Chọn quận huyện...',
                'id'     => 'ma_quan',
//                'options' => [
//                    co_pqpx()->selectQH($model->ma_quan) => ['Selected' => true],
//                ]
            ])->label(false); ?>
        </div>
        <div class="col-md-2 col-xs-4">
            <input type="hidden" id="px1_param" value="<?= $model->ma_phuong; ?>">
            <?= $form->field($model, 'ma_phuong')->widget(DepDrop::classname(), [
                'pluginOptions' => [
                    'depends'     => [
                        'ma_quan'
                    ],
                    'placeholder' => 'Chọn phường xã...',
                    'initialize'  => true,
                    'url'         => url('apis/role-list-px'),
                    'params'      => ['px1_param']
                ]
            ])->label(false); ?>
        </div>

        <div class="col-md-3 col-xs-4">
            <?= $form->field($model, 'date_from')
                ->widget(DatePicker::classname(), ['options' => ['placeholder' => 'Từ ngày xác định ổ dịch']])->label(false); ?>
        </div>
        <div class="col-md-2 col-xs-4">
            <?= $form->field($model, 'date_to')->widget(DatePicker::classname(), ['options' => ['placeholder' => 'Đến ngày']])->label(false) ?>
        </div>
        <div class="col-md-2 col-xs-4">
            <button type="submit" class="form-control btn btn-primary"><i class="icon-search4 text-size-base"></i>
            </button>
        </div>
    </div>
    <?php ActiveForm::end() ?>

</div>

<script>
    //    $("document").ready(function(){
    //        $("#frm_filter_cb").on("pjax:end", function() {
    //            $.pjax.reload({container:"#kv-pjax-container-odich"});  //Reload GridView
    //        });
    //    });
</script>
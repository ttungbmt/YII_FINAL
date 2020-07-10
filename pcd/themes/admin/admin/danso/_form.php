<?php

use kartik\widgets\DepDrop;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model pcd\models\Danso */
/* @var $form yii\widgets\ActiveForm */
$model->uoctinh = is_null($model->uoctinh) ? 0 : $model->uoctinh;
$dm_type = [1 => 'Quận', 2 => 'Phường'];
$model->type = $model->type ? $model->type : request('type');

?>

<div class="card">
    <div class="card-body">
        <div class="danso-form">

            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-6">
                    <?php
                    ?>
                    <?= $form->field($model, 'qh')->dropDownList(api('/dm/quan?role=true'), [
                        'prompt'  => 'Chọn quận huyện...',
                        'id'      => 'drop-quan',
                        'options' => [
                            $model->qh => ['Selected' => true],
                        ]
                    ])->label('Quận huyện'); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'px')->widget(DepDrop::className(), [
                        'options'       => ['prompt' => 'Chọn phường...'],
                        'pluginOptions' => [
                            'depends'      => ['drop-quan'],
                            'url'          => url(['/api/dm/phuong?role=true']),
                            'initialize'   => $model->qh == true,
                            'placeholder'  => 'Chọn phường...',
                            'ajaxSettings' => ['data' => ['value' => $model->px]],
                        ],
                    ])->label('Phường xã') ?>
                </div>
            </div>

            <?= $form->field($model, 'nam')->textInput(['type' => 'number']) ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'danso')->textInput(['type' => 'number']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'uoctinh')->dropDownList([0 => 'Không', 1 => 'Có'])->label('Dữ liệu ước tính') ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>


</div>

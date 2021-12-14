<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
/* @var $this yii\web\View */
/* @var $model pcd\modules\dm\models\search\Ranh tổearch */
/* @var $form yii\widgets\ActiveForm */
$dm_quan = api('/dm/quan?role=true');
$url_phuong = url(['/api/dm/phuong']);
$model->maquan = userInfo()->maquan;
$maphuong = userInfo()->maphuong;
?>

<div class="ranhto-search">

    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => [
                    'data-pjax' => 1
                ],
            ]); ?>
            <div class="row">
                <div class="col-md-3">
                    <?=$form->field($model, "maquan")->dropDownList($dm_quan, [
                        'prompt' => 'Chọn quận huyện...',
                        'id'      => "drop-quan",
                    ])->label("Quận huyện")?>
                </div>
                <div class="col-md-3">
                    <?=$form->field($model, "maphuong")->widget(DepDrop::className(), [
                        'options'       => ['prompt' => 'Chọn phường xã...'],
                        'pluginOptions' => [
                            'depends' => ["drop-quan"],
                            'initialize' => $model->maquan ? true : false,
                            'ajaxSettings' => ['data' => ['value' => $maphuong, 'role' => 'true']],
                            'url'     => $url_phuong,
                        ],
                    ])->label("Phường xã")?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'tento') ?>
                </div>
                <div class="col-md-3">
                    <?=$form->field($model, 'khupho') ?>
                </div>
            </div>


            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Tìm kiếm'), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
                <?= Html::a(Yii::t('app', 'Thêm mới'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

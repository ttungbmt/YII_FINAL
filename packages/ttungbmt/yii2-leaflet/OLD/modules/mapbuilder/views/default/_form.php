<?php

use ttungbmt\leaflet\types\LatLng;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KdRauqua */
/* @var $form yii\widgets\ActiveForm */
$json = json_decode($model->value);
$model->value = $json ?  json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : null;
?>

<div class="mapbuilder-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card">
        <div class="row">
            <div class="col-md-6">
                <?= \ttungbmt\leaflet\widgets\MapBuilder::widget([
                    'key' => $model->key,
                ]) ?>
            </div>
            <div class="col-md-6 mt-2">
                <?=$form->field($model, 'key')->textInput(['disabled' => true])?>
                <?=$form->field($model, 'description')?>

            </div>
        </div>
    </div>

    <div class="card">
        <?=$form->field($model, 'value', ['options' => ['style' => 'margin:0;']])->widget(ttungbmt\ace\Ace::class, [
            'mode' => 'json',
        ])->label('<div class="font-weight-semibold m-2">JSON config</div>')?>
    </div>


    <?php if (!Yii::$app->request->isAjax): ?>
        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
            <?= Yii::$app->request->referrer ? Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) : null ?>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>

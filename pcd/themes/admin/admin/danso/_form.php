<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model pcd\models\Danso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="danso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ma_hc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nam')->textInput() ?>

    <?= $form->field($model, 'danso')->textInput() ?>

    <?= $form->field($model, 'uoctinh')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

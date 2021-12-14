<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model pcd\models\ChitieuHt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card">
    <div class="card-body">
        <div class="chitieu-ht-form">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'benhvien')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'chitieu')->textInput() ?>

            <?= $form->field($model, 'nam')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Lưu', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>


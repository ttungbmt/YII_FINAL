<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Benhvien */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Bệnh viện'
?>

<div class="benhvien-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'maso')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tenbenhvien')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tenvt')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'diachi')->textInput() ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

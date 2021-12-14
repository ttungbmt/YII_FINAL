<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model pcd\modules\pcd\models\Loaibenh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loaibenh-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mabenh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tenbenh')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use ttungbmt\map\Map;

/* @var $this yii\web\View */
/* @var $model pcd\models\Bookmark */
/* @var $form yii\widgets\ActiveForm */

$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' Bookmark';
?>



<?php $form = ActiveForm::begin(); ?>

<div class="bookmark-form">

    <div class="card">
        <div id="mapContainer" style="height: 400px; background-color: #00bcd4"></div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'geom[1]')->textInput(['v-model' => 'm.lat'])->label('Vĩ độ (Lat)') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'geom[0]')->textInput(['v-model' => 'm.lng'])->label('Kinh độ (Lng)') ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

            <?php if (!request()->isAjax): ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? lang('Create') : lang('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <?php endif; ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

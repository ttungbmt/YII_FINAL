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
                    <?= $form->field($model, 'geom[1]')->textInput(['v-model' => 'm.lat', 'disabled' => true])->label('Vĩ độ (Lat)') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'geom[0]')->textInput(['v-model' => 'm.lng', 'disabled' => true])->label('Kinh độ (Lng)') ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'disabled' => true]) ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'ip')->textInput(['maxlength' => true, 'disabled' => true]) ?>
                </div>
            </div>

            <?= $form->field($model, 'description')->textarea(['rows' => 3, 'disabled' => true]) ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

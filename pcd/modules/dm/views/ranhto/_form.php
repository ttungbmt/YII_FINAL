<?php
use kartik\widgets\DepDrop;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use ttungbmt\map\Map;

/* @var $this yii\web\View */
/* @var $model pcd\modules\dm\models\Ranhto */
/* @var $form yii\widgets\ActiveForm */
$dm_quan = api('/dm/quan?role=true');
$url_phuong = url(['/api/dm/phuong']);
?>

<div class="ranhto-form">
    <div class="card">
        <?= Map::widget(['model' => $model]) ?>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-6">
                    <?=$form->field($model, "maquan")->dropDownList($dm_quan, [
                        'prompt' => 'Chọn quận huyện...',
                        'id'      => "drop-quan-khac",
                    ])->label("Quận huyện")?>
                </div>
                <div class="col-md-6">
                    <?=$form->field($model, "maphuong")->widget(DepDrop::className(), [
                        'options'       => ['prompt' => 'Chọn phường xã...'],
                        'pluginOptions' => [
                            'depends' => ["drop-quan-khac"],
                            'initialize' => true,
                            'ajaxSettings' => ['data' => ['value' => $model->maphuong]],
                            'url'     => $url_phuong,
                        ],
                    ])->label("Phường xã")?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'tento')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'khupho')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>

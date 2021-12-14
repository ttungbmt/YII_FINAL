<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use ttungbmt\map\Map;

/* @var $this yii\web\View */
/* @var $model pcd\models\XulyOdsxh */
/* @var $form yii\widgets\ActiveForm */

$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' Xử lý Ổ dịch';
?>



<?php $form = ActiveForm::begin(); ?>

<div class="xuly-odsxh-form">

    <div class="card">

        
        <div class="card-body">
                <?= $form->field($model, 'odichsxh_id')->textInput() ?>

    <?= $form->field($model, 'lanxl')->textInput() ?>

    <?= $form->field($model, 'tungaydlq')->textInput() ?>

    <?= $form->field($model, 'denngaydlq')->textInput() ?>

    <?= $form->field($model, 'sotodlq')->textInput() ?>

    <?= $form->field($model, 'tentodlq')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sokhuphodlq')->textInput() ?>

    <?= $form->field($model, 'tenkhuphodlq')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sonhadukiendlq')->textInput() ?>

    <?= $form->field($model, 'sonhaduocdlq')->textInput() ?>

    <?= $form->field($model, 'truoc_bi')->textInput() ?>

    <?= $form->field($model, 'truoc_ci')->textInput() ?>

    <?= $form->field($model, 'truoc_hi')->textInput() ?>

    <?= $form->field($model, 'sau_bi')->textInput() ?>

    <?= $form->field($model, 'sau_ci')->textInput() ?>

    <?= $form->field($model, 'sau_hi')->textInput() ?>

    <?= $form->field($model, 'tungayphc')->textInput() ?>

    <?= $form->field($model, 'denngayphc')->textInput() ?>

    <?= $form->field($model, 'sotophc')->textInput() ?>

    <?= $form->field($model, 'tentophc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sokhuphophc')->textInput() ?>

    <?= $form->field($model, 'tenkhuphophc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sohodukienphc')->textInput() ?>

    <?= $form->field($model, 'sohoduocphc')->textInput() ?>

    <?= $form->field($model, 'tenhc1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'solithc1')->textInput() ?>

    <?= $form->field($model, 'tenhc2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'solithc2')->textInput() ?>

    <?= $form->field($model, 'tyle')->textInput() ?>


            

            <?php if (!request()->isAjax): ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? lang('Create') : lang('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <?php endif; ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

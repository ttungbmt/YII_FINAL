<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model pcd\models\search\XnHuyetthanhSearch */
/* @var $form yii\widgets\ActiveForm */
$dm_quan = \pcd\models\HcQuan::pluck('tenquan', 'maquan');
?>

<div class="xn-huyetthanh-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <div class="row">
        <div class="col-md-2"><?= $form->field($model, 'maquan')->dropDownList($dm_quan, ['prompt' => 'Tất cả']) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'ngaynhanmau') ?></div>
        <div class="col-md-3"><?= $form->field($model, 'ketqua') ?></div>
        <div class="col-md-2 text-right">
            <div class="form-group">
                <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Xóa', ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

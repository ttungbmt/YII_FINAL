<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model pcd\models\search\DichbenhSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dichbenh-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'gid') ?>

    <?= $form->field($model, 'benhvien') ?>

    <?= $form->field($model, 'chuandoan_bd') ?>

    <?= $form->field($model, 'shs') ?>

    <?= $form->field($model, 'hoten') ?>

    <?php // echo $form->field($model, 'phai') ?>

    <?php // echo $form->field($model, 'tuoi') ?>

    <?php // echo $form->field($model, 'diachi') ?>

    <?php // echo $form->field($model, 'nghenghiep') ?>

    <?php // echo $form->field($model, 'me') ?>

    <?php // echo $form->field($model, 'dienthoai') ?>

    <?php // echo $form->field($model, 'maquan') ?>

    <?php // echo $form->field($model, 'maphuong') ?>

    <?php // echo $form->field($model, 'ngaynhapvien') ?>

    <?php // echo $form->field($model, 'ngaybaocao') ?>

    <?php // echo $form->field($model, 'nam_nv') ?>

    <?php // echo $form->field($model, 'thang_nv') ?>

    <?php // echo $form->field($model, 'tuan_nv') ?>

    <?php // echo $form->field($model, 'nam_bc') ?>

    <?php // echo $form->field($model, 'thang_bc') ?>

    <?php // echo $form->field($model, 'tuan_bc') ?>

    <?php // echo $form->field($model, 'hinhthuc_dt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

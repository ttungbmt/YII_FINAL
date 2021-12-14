<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DieutraSxh */

//$this->title = Yii::t('app', 'Cập nhật {modelClass}: ', [
//    'modelClass' => 'phiếu điều tra SXH',
//]) . ' ' . $model->ma_dt_sxh;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dieutra Sxhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ma_dt_sxh, 'url' => ['view', 'id' => $model->ma_dt_sxh]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="dieutra-sxh-update">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'dieutra_sxh' => $dieutra_sxh,
        'cabenh' => $cabenh,
        'button' => 'Cập nhật'
    ]) ?>

</div>

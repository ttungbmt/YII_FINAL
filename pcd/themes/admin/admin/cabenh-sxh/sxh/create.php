<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DieutraSxh */

$this->title = Yii::t('app', '');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dieutra Sxhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dieutra-sxh-create">

    <?= $this->render('_form', [
        'dieutra_sxh' => $dieutra_sxh,
        'cabenh' => $cabenh,
        'button' => 'Thêm mới'
    ]) ?>

</div>
<style>
    body {
        overflow: auto;
    }
</style>
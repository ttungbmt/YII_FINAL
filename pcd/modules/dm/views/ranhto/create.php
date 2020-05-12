<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pcd\modules\dm\models\Ranhto */

$this->title = Yii::t('app', 'Thêm mới ranh tổ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ranh tổ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ranhto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

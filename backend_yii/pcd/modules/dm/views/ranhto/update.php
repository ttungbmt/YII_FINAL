<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pcd\modules\dm\models\Ranhto */

$this->title = Yii::t('app', 'Cập nhật ranh tổ: {name}', [
    'name' => $model->gid,
]);
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ranhto-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

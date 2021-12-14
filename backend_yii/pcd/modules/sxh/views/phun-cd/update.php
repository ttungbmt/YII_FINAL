<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pcd\modules\sxh\models\PhunCd */

$this->title = 'Cập nhật Phun chủ động: ' . $model->id;
$viewParams = data_get($this->context, 'action.viewParams',  []);
?>
<div class="phun-cd-update">
    <?= $this->render('_form', array_merge(['model' => $model], $viewParams)) ?>
</div>

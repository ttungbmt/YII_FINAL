<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model pcd\models\PhieuGs */
$viewParams = data_get($this->context, 'action.viewParams',  []);
?>
<div class="odich-sxh-create">
    <?= $this->render('_form', array_merge(['model' => $model], $viewParams)) ?>
</div>

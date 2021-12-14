<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pcd\modules\sxh\models\PhunCd */

$this->title = 'Create Phun Cd';
$viewParams = data_get($this->context, 'action.viewParams',  []);
?>
<div class="phun-cd-create">
    <?= $this->render('_form', array_merge(['model' => $model], $viewParams)) ?>
</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\pcd\import\models\Dichbenh */

$this->title = 'Cập nhật: ' . $model->gid;
?>
<div class="dichbenh-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

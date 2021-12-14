<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pcd\models\ChitieuHt */

$this->title = 'Cập nhật chỉ tiêu ' . $model->id;
?>
<div class="chitieu-ht-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

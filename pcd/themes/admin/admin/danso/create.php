<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pcd\models\Danso */

$this->title = Yii::t('app', 'Thêm mới');
?>
<div class="danso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

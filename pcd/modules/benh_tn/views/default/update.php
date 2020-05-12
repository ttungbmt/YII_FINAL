<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pcd\modules\benh_tn\models\BenhTn */

$this->title = 'Cập nhật: ' . $model->gid;
?>
<div class="dichbenh-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

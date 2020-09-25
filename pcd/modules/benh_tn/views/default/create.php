<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pcd\modules\benh_tn\models\BenhTn */

$this->title = 'Thêm mới ca bệnh';
?>
<div class="dichbenh-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

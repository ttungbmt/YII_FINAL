<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pcd\modules\benh_tn\models\BenhTn */

$this->title = 'Thêm mới';
$this->params['breadcrumbs'][] = ['label' => 'Dichbenhs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dichbenh-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model pcd\modules\pcd\models\Loaibenh */
?>
<div class="loaibenh-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'mabenh',
            'tenbenh',
        ],
    ]) ?>

</div>

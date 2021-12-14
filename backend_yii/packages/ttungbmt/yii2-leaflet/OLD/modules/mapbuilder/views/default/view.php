<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\KdRauqua */
?>
<div class="kd-rauqua-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gid',
            'ten',
            'diachi',
            'dienthoai',
            'nguoidaidi',
            'created_at',
            'updated_at',
            'status',
            'lat',
            'lng',
            'maquan',
            'maphuong',
            'data',
            'rau_kd',
            'sonha',
            'tenduong',
            'tenphuong',
            'tenquan',
            'email:email',
            'geom',
        ],
    ]) ?>

</div>

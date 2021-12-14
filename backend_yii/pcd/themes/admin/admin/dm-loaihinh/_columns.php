<?php
use kartik\grid\GridView;
use pcd\models\DmLoaihinh;
use yii\helpers\Url;
return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nhom',
        'filter' => DmLoaihinh::find()->orderBy('nhom')->pluck('nhom', 'nhom')->all(),
        'filterInputOptions' => ['prompt' => 'Tất cả', 'class'  => 'form-control'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ten_lh',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tanxuat',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'thaydoi',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'urlCreator' => function ($action, $model, $key, $index) {
            return url([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => lang('View'), 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => lang('Update'), 'data-toggle' => 'tooltip'],
    ],

];   
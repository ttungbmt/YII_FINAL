<?php

use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'maquan',
        'value' => 'quan.tenquan',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'maphuong',
        'value' => 'phuong.tenphuong',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'khupho',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'to_dp',
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
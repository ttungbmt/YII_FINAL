<?php

$columns = [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'hoten',
        'format'    => 'raw',
        'value'     => function ($model) {
            return \yii\helpers\Html::a(data_get($model, 'cabenhSxh.hoten'), ['/sxh/default/update', 'id' => $model->cabenh_id], ['target' => '_blank', 'data-pjax' => 0]);
        },
        'group'     => true,
    ],
];

$columns[] = [
    'class'     => '\kartik\grid\DataColumn',
    'attribute' => 'qh_chuyen',
    'value'     => 'chuyen.tenquan',
];

$columns[] = [
    'class'     => '\kartik\grid\DataColumn',
    'attribute' => 'px_chuyen',
    'value'     => 'chuyen.tenphuong',
];

$columns[] = [
    'class'     => '\kartik\grid\DataColumn',
    'attribute' => 'sdt_chuyen',
];



$columns[] = [
    'class'     => '\kartik\grid\DataColumn',
    'attribute' => 'qh_nhan',
    'value'     => 'nhan.tenquan',
];

$columns[] = [
    'class'     => '\kartik\grid\DataColumn',
    'attribute' => 'px_nhan',
    'value'     => 'nhan.tenphuong',
];

$columns[] = [
    'class'     => '\kartik\grid\DataColumn',
    'attribute' => 'sdt_nhan',
];

$columns[] = [
    'class'     => '\kartik\grid\DataColumn',
    'attribute' => 'created_at',
    'format' => ['date', 'php:d/m/Y - h:m:i'],
    'label' => 'Thời gian chuyển/nhận'
];

$columns[] = [
    'class'     => '\kartik\grid\DataColumn',
    'attribute' => 'readed_at',
    'format' => ['date', 'php:d/m/Y - h:m:i']

];

return $columns;
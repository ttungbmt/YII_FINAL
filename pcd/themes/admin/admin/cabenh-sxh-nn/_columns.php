<?php

use yii\helpers\Url;
use kartik\grid\GridView;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'hoten',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'tuoi',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'benhvien',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'chuandoan_bd',
    ],
    [
        'class'      => '\kartik\grid\DataColumn',
        'attribute'  => 'ngaymacbenh_nv',
        'filterType' => GridView::FILTER_DATE,
    ],
//    [
//        'class'     => '\kartik\grid\DataColumn',
//        'attribute' => 'lat',
//        'value' => 'geom.1',
//        'format' => ['decimal', 6]
//    ],
//    [
//        'class'     => '\kartik\grid\DataColumn',
//        'attribute' => 'lng',
//        'value' => 'geom.0',
//        'format' => ['decimal', 6]
//    ],
    [
        'class'         => 'kartik\grid\ActionColumn',
        'urlCreator'    => function ($action, $model, $key, $index) {
            return url([$action, 'id' => $key]);
        },
        'viewOptions'   => ['title' => lang('View'), 'data-toggle' => 'tooltip'],
        'updateOptions' => ['title' => lang('Update'), 'data-toggle' => 'tooltip'],
    ],

];   
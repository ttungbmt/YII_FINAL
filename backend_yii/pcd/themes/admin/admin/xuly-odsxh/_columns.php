<?php

use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\DataColumn',
        'label' => '#',
        'attribute' => 'id',
        'group' => true,
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'hoten_cb',
        'group' => true,
        'subGroupOf' => 0,
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'tokp',
        'group' => true,
        'subGroupOf' => 0,
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'ap',
        'group' => true,
        'subGroupOf' => 0,
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'ngayxacdinh',
        'group' => true,
        'subGroupOf' => 0,
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'cabenh_count',
        'group' => true,
        'subGroupOf' => 0,
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'tokp_count',
        'group' => true,
        'subGroupOf' => 0,
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'hogd_count',
        'group' => true,
        'subGroupOf' => 0,
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'loaiodich',
        'group' => true,
        'subGroupOf' => 0,
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'ngayxuly'
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'lanxuly'
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'hodietlq'
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'bi_truoc'
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'bi_sau'
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'tenhoachat'
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'luongsd'
    ],
];


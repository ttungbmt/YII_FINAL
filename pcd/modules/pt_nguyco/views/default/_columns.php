<?php

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'urlCreator' => function ($action, $model, $key, $index) {
            return url([$action, 'id' => $key]);
        },
        'visibleButtons' => [
            'delete'   => function ($model) {
                return role('quan|admin');
            },
            'view' => false,
        ],
        'viewOptions' => ['role' => 'modal-remote', 'title' => lang('View'), 'data-toggle' => 'tooltip'],
        'updateOptions' => ['data-pjax' => 0, 'title' => lang('Update'), 'data-toggle' => 'tooltip'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ten_cs',

    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Địa chỉ',
        'value' => 'diachiText'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'value' => 'quan.tenquan',
        'attribute' => 'maquan',
        'mergeHeader' => true,
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'maphuong',
        'value' => 'phuong.tenphuong',
        'mergeHeader' => true,
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'khupho',
        'width' => '50px'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'to_dp',
        'width' => '50px'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'dienthoai',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nhom',
        'label' => 'Nhóm',
        'width' => '50px',
        'value' => function($model){
            return $model->loaihinh_id ? data_get($model->dm_loaihinh, 'nhom') : $model->nhom;
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'loaihinh',
        'contentOptions' => ['style' => 'max-width:250px;'],
        'value' => function($model){
            return data_get($model->dm_loaihinh, 'ten_lh');
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ngaycapnhat',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ngayxoa',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ghichu',
    ],

];   
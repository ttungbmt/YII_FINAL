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
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'to_dp',
    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'sonha',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'dienthoai',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'loaihinh',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nhom',
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
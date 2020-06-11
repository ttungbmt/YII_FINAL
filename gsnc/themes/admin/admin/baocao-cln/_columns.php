<?php


return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'donvi_bc',
        'value' => 'donviBc.tenquan',
        'label'     => 'Đơn vị báo cáo',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'thoigian',
        'label'     => 'Thời gian',
        'value' => function ($model, $key, $index, $widget) {
            return $model->thoigian ? data_get(api('dm_thoigian'), $model->thoigian) : '';
        },

    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'urlCreator' => function ($action, $model, $key, $index) {
            return url([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => lang('View'), 'data-toggle' => 'tooltip'],
        'updateOptions' => ['data-pjax' => 0, 'title' => lang('Update'), 'data-toggle' => 'tooltip'],
        'deleteOptions' => ['role' => 'modal-remote', 'title' => lang('Delete'),
            'data-confirm' => false,
            'data-method' => false,
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => lang('Are you sure?'),
            'data-confirm-message' => lang('Are you sure want to delete this item')],
        'visibleButtons' => [
            'delete' => function ($model) {
                return role('admin');
            },
            'view' => false,
        ],
    ],
];   
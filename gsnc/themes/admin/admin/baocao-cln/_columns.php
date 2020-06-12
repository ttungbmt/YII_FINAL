<?php


use yii\bootstrap4\Html;

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
        'template' => '{view}{update}{delete}{download}',
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
        'buttons' => [
            'download' => function ($url, $model, $key) {
                return Html::a("<i class='icon-download4'></i>", ['/admin/baocao-cln/export-word', 'id' => $model->id], ['title' => 'Tải phiếu báo cáo', 'data-toggle' => 'tooltip', 'data-pjax' => 0, 'target' => '_blank']);
            }
        ],
    ],
];   
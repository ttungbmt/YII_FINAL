<?php

use yii\helpers\Url;

return [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'class' => 'kartik\grid\ActionColumn',
        'width' => '100px',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
        'deleteOptions' => ['role' => 'modal-remote', 'title' => 'Delete',
            'data-request-method'  => 'post',
            'data-confirm-ok'      => 'Chấp nhận',
            'data-confirm-cancel'  => 'Đóng',
            'data-toggle'          => 'tooltip',
            'data-confirm-title'   => 'Bạn có chắc chắn?',
            'data-confirm-message' => 'Are you sure want to delete this item'],
    ],
    [
        'label' => 'Quận huyện',
        'attribute' => 'qh',
        'value' => function($model){
            if($model->type == 2) return data_get($model, 'phuong.tenquan');
            return data_get($model, 'quan.tenquan');
        },
    ],
    [
        'label' => 'Phường xã',
        'attribute' => 'ma_hc',
        'value' => 'phuong.tenphuong',
    ],
    'nam',
    'danso',
    'uoctinh',
];
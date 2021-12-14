<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'format' => 'html',
    ],
    ['attribute' => 'maso'],
    ['attribute' => 'tenbenhvien'],
    ['attribute' => 'tenvt'],
    ['attribute' => 'diachi'],
    [
        'class'         => 'kartik\grid\ActionColumn',
        'width' => '100px',
        'urlCreator'    => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions'   => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
        'deleteOptions' => ['role'                 => 'modal-remote', 'title' => 'Delete',
                            'data-confirm'         => false, 'data-method' => false,// for overide yii data api
                            'data-request-method'  => 'post',
                            'data-toggle'          => 'tooltip',
                            'data-confirm-title'   => 'Are you sure?',
                            'data-confirm-message' => 'Are you sure want to delete this item'],
    ],

];   
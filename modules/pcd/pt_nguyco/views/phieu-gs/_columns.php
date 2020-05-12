<?php

use yii\helpers\Html;
use yii\helpers\Url;

return [
    [
        'class'         => 'kartik\grid\ActionColumn',
        'urlCreator'    => function ($action, $model, $key, $index) {
            return url([$action, 'id' => $key]);
        },
        'viewOptions'   => ['role' => 'modal-remote', 'title' => lang('View'), 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => lang('Update'), 'data-toggle' => 'tooltip'],
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'dnc.ten_cs',
        'format' => 'raw',
        'group' => true,
        'value' => function($model){
            if(!$model->dnc) return null;
            return Html::a($model->dnc->ten_cs, ['/pt_nguyco/default/update', 'id' => $model->dnc->gid], ['target' => '_blank', 'data-pjax' => 0]);
        }
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'dnc.diachiText',
        'group' => true,
        'value' => function($model){
            $dc = data_get($model, 'dnc.diachiText');
            return $dc ? $dc : $model->dnc->diachi;
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'maquan',
        'value' => 'dnc.quan.tenquan',
        'mergeHeader' => true,
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'maphuong',
        'value' => 'dnc.phuong.tenphuong',
        'mergeHeader' => true,
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'dnc.khupho',
        'group' => true,
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'dnc.to_dp',
        'group' => true,
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'vc_nc',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'vc_lq',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'ngay_gs',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'nguoi_gs',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'mucdich_gs',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'dexuat_xp',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'xuphat',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'ngayxuphat',
    ],
];
<?php

use yii\helpers\Html;
use yii\helpers\Url;

$dm_mucdich_gs = api('dm_mucdich_gs');

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
        'value' => function($model){
            if(!$model->dnc) return null;
            return Html::a($model->dnc->ten_cs, ['/pt_nguyco/default/update', 'id' => $model->dnc->gid], ['target' => '_blank', 'data-pjax' => 0]);
        }
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'dnc.diachiText',
        'value' => function($model){
            $dc = data_get($model, 'dnc.diachiText');
            return $dc ? $dc : $model->dnc->diachi;
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'maquan',
        'value' => 'dnc.quan.tenquan',
        'filter' => false
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'maphuong',
        'value' => 'dnc.phuong.tenphuong',
        'filter' => false
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'dnc.khupho',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'dnc.to_dp',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'nhom',
        'value' => function($model){
            return data_get($model, 'dnc.nhom', '');
        }
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'loaihinh',
        'value' => function($model){
            return data_get($model, 'dnc.dm_loaihinh.ten_lh');
        }
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'ngay_gs',
    ],
    [
        'class'     => '\kartik\grid\DataColumn',
        'attribute' => 'mucdich_gs',
        'value' => function($model) use($dm_mucdich_gs){
            return data_get($dm_mucdich_gs, $model->mucdich_gs);
        }
    ],
    [
        'class'     => '\kartik\grid\BooleanColumn',
        'attribute' => 'vc_nc',
    ],
    [
        'class'     => '\kartik\grid\BooleanColumn',
        'attribute' => 'vc_lq',
    ],
    [
        'class'     => '\kartik\grid\BooleanColumn',
        'attribute' => 'dexuat_xp',
    ],
    [
        'class'     => '\kartik\grid\BooleanColumn',
        'attribute' => 'xuphat',
    ],
];

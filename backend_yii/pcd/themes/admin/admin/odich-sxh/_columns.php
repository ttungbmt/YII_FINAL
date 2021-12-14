<?php

use kartik\helpers\Html;
use pcd\models\OdichSxh;
use yii\helpers\Url;

$groupCols = ['ngayphathien', 'ngaydukienkt', 'ngaykt',];

$cols = [
    [
        'attribute'   => 'odich_id',
        'label'       => '#',
        'mergeHeader' => true,
        'group'       => true,  // enable grouping
        'value'       => function ($model) {
            return $model->odich_id ? $model->odich_id : 'N/A';
        }
    ],
    [
        'label'       => 'Định vị',
        'value'       => function ($model) use($models) {
            $updateUrl = url('/admin/odich-sxh/update?id=' . $model->odich_id);
            $updateOpts = [];
            $urlDelete = url('/admin/odich-sxh/delete?id=' . $model->odich_id);
            $odich = array_merge($model->odich->toArray(), [
                'cabenhs' => $models->get($model->odich_id)
            ]);

            if(request('partial')){
                $updateOpts = ['target' => '_blank', 'data-pjax' => 0, 'home' => 1];
            }

            return (
                Html::a("<i class='icon-location4'></i>", null, ['class'      => 'linkOdichSxh',
                                                                 'data' => $odich
                ]).
                Html::a('<span class="glyphicon glyphicon-pencil"></span>', $updateUrl, $updateOpts).
                Html::a('<span class="glyphicon glyphicon-trash"></span>', $urlDelete, [
                    'role'                 => 'modal-remote',
                    'data-request-method'  => 'post',
                    'data-confirm-ok'      => 'Chấp nhận',
                    'data-confirm-cancel'  => 'Đóng',
                    'data-toggle'          => 'tooltip',
                    'data-confirm-title'   => 'Bạn có chắc chắn?',
                    'data-confirm-message' => 'Bạn có chắc chắn muốn xóa ổ dịch này không" ><span class="glyphicon glyphicon-trash" ></span >',
                ])
            );
        },
        'format'      => 'raw',
        'mergeHeader' => true,
        'group'       => true,
        'subGroupOf'  => 0
    ],
    ['attribute' => 'hoten'],
    ['attribute' => 'tuoi'],
    ['attribute' => 'to1', 'label' => 'Tổ'],
    ['attribute' => 'khupho1', 'label' => 'Khu phố'],
    ['attribute' => 'ma_quan', 'value' => 'ten_quan', 'label' => 'Quận'],
    ['attribute' => 'ma_phuong', 'value' => 'ten_phuong', 'label' => 'Phường'],
    [
        'label' => 'Ngày khởi bệnh',
        'value' => function ($model) {

        }
    ],
    [
        'label'      => 'Ngày xác định ổ dịch',
        'group'      => true,
        'subGroupOf' => 0,
        'attribute'  => 'ngayxacdinh',
    ],
    [
        'label'      => 'Số lần xử lý',
        'group'      => true,
        'subGroupOf' => 0,
        'value'      => function ($model) {
            return $model->odich->getXulys()->count();
        }
    ],
];

foreach ($cols as $k => $val) {
    if ($k == 0) {
        continue;
    }
    $code = array_search('odich_id', $cols);
    if (isset($val['attribute']) && in_array($val['attribute'], $groupCols)) {
        $cols[$k]['group'] = true;
        $cols[$k]['subGroupOf'] = $code;
    }
}

return $cols;
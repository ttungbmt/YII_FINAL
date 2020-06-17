<?php

use kartik\grid\GridView;
use kartik\helpers\Html;
use kartik\widgets\DatePicker;
use yii\helpers\Url;

$dm_loaidieutra = api('dm_loaidieutra');
$dm_loaicabenh = api('dm_loaicabenh');
$dm_loaibaocao = api('dm_loaibaocao');
$dm_chuandoan = api('dm_chuandoan');
$dm_xacminh_cb = api('dm_xacminh_cb');
$dm_benh = \pcd\models\Loaibenh::pluck('tenbenh', 'mabenh')->all();
$dm_phai = api('dm_phai');
$dm_ht_dieutri = api('dm_ht_dieutri');
$dm_loai_xn = api('dm_loai_xn');
$dm_kq_xn = api('dm_kq_xn');

$s_options = ['class' => 'form-control', 'prompt' => 'Tất cả'];

$exportType = request()->post('export_type');
$hasExport = in_array(request()->post('export_type'), ['Excel2007', 'Excel5', 'Xlsx', 'Xls']);
$fmExcelDate = $hasExport ? 'exceldate' : ['date', 'php:d/m/Y'];


return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'label' => 'Vị trí',
        'hiddenFromExport' => true,
        'value' => function ($model, $index, $widget) {
            if ($model->geom) {
                return Html::a('<span class=\'icon-location4\' />', ['/admin/map/v2#/maps/ds-sxh', 'id' => $model->gid], ['target' => '_blank', 'data-pjax' => 0]);
            }
            return '';
        },
        'mergeHeader' => true,
        'format' => 'raw'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{view}{update}{delete}{download}',
        'urlCreator' => function ($action, $model, $key, $index) {
            $dieutra_id = $model->dieutra_id;
            $params = ['id' => $key, 'dieutra_id' => $dieutra_id];

            if ($action === 'update') {
                return url(array_merge(['/sxh/default/update'], $params));
            }

            return url(array_merge([$action, 'id' => $key], $params));
        },
        'viewOptions' => ['title' => lang('View'), 'data-toggle' => 'tooltip'],
        'updateOptions' => ['title' => lang('Update'), 'data-toggle' => 'tooltip'],
        'visibleButtons' => [
            'delete' => function ($model) {
                return role('admin|quan');
            },
            'view' => false,
            'download' => function ($model) {
                return $model->loaidieutra != 1;
            },
            'update' => function ($model) {
                return !role('guest');
            }
        ],
        'buttons' => [
            'download' => function ($url, $model, $key) {
                return Html::a("<i class='icon-download4'></i>", ['/sxh/default/export-dieutra', 'id' => $model->getId()], ['title' => 'Tải phiếu điều tra', 'data-toggle' => 'tooltip', 'data-method' => 'POST', 'data-pjax' => 0, 'target' => '_blank']);
            }
        ],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'loaidieutra',
        'filter' => Html::activeDropDownList($searchModel, 'loaidieutra', $dm_loaidieutra, $s_options),
        'value' => function ($model, $key, $index) use ($dm_loaidieutra) {
            return data_get($dm_loaidieutra, is_null($model->loaidieutra) ? '' : $model->loaidieutra);
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'loaicabenh',
        'filter' => Html::activeDropDownList($searchModel, 'loaicabenh', $dm_loaicabenh, $s_options),
        'value' => function ($model, $key, $index) use ($dm_loaicabenh) {
            return data_get($dm_loaicabenh, is_null($model->loaicabenh) ? '' : $model->loaicabenh);
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'chuandoan_bd',
        'filter' => Html::activeDropDownList($searchModel, 'chuandoan_bd', $dm_benh, $s_options),
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ngaybaocao',
        'filterType' => GridView::FILTER_DATE,
        'format' => 'exceldate',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'hoten',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'phai',
        'filter' => Html::activeDropDownList($searchModel, 'phai', $dm_phai, $s_options),
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tuoi',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'dienthoai',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'sonha',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'duong',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'to_dp',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'khupho',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'maquan',
        'value' => 'hcPhuong.tenquan',
        'filter' => false
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'maphuong',
        'value' => 'hcPhuong.tenphuong',
        'filter' => false
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ngaynhapvien',
        'filterType' => GridView::FILTER_DATE,
        'format' => 'exceldate',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ngayxuatvien',
        'filterType' => GridView::FILTER_DATE,
        'format' => 'exceldate',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Tình trạng'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'chuandoan',
        'filter' => Html::activeDropDownList($searchModel, 'chuandoan', $dm_chuandoan, $s_options),
        'value' => function ($model, $key, $index) use ($dm_chuandoan) {
            if ($model->chuandoan == 3) {
                return data_get($model, 'chuandoan_khac');
            }
            return data_get($dm_chuandoan, is_null($model->chuandoan) ? '' : $model->chuandoan);
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'loaixacminh_cb',
        'filter' => Html::activeDropDownList($searchModel, 'loaixacminh_cb', $dm_xacminh_cb, $s_options),
        'value' => function ($model, $key, $index) use ($dm_xacminh_cb) {
            return data_get($dm_xacminh_cb, is_null($model->loaixacminh_cb) ? '' : $model->loaixacminh_cb);
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nghenghiep',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ht_dieutri',
        'filter' => Html::activeDropDownList($searchModel, 'ht_dieutri', $dm_ht_dieutri, $s_options),
        'value' => function ($model, $key, $index) use ($dm_ht_dieutri) {
            return data_get($dm_ht_dieutri, is_null($model->ht_dieutri) ? '' : $model->ht_dieutri);
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Loại xét nghiệm',
        'attribute' => 'loai_xn',
        'value' => function($model) use($dm_loai_xn){
            return !is_null($model->loai_xn) ? data_get($dm_loai_xn, $model->loai_xn) : '';
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Kết quả xét nghiệm',
        'attribute' => 'ketqua_xn',
        'value' => function($model) use($dm_kq_xn){
            return !is_null($model->ketqua_xn) ? data_get($dm_kq_xn, $model->ketqua_xn) : '';
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Ghi chú',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Lat',
        'value' => 'geom.1',
        'format' => ['decimal', 6]
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Lng',
        'value' => 'geom.0',
        'format' => ['decimal', 6]
    ],
];
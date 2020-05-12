<?php
use pcd\modules\role_phuongquan\models\RolePhuongquan;
use pcd\modules\role_phuongquan\services\PQService;
use pcd\modules\role_phuongquan\services\RolePQConst;
use pcd\services\RolePQService;
use kartik\helpers\Html;
use kartik\widgets\DatePicker;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

$params = Yii::$app->request->queryParams;
$onmap = yii\helpers\ArrayHelper::getValue($params, 'onmap', 'false') == 'true';
$blank = $onmap ?'target="_blank"' : null;

$exportType = request()->post('export_type');
$hasExport = in_array(request()->post('export_type'), ['Excel2007', 'Excel5', 'Xlsx', 'Xls']);
$fmExcelDate = $hasExport ? 'exceldate' : ['date', 'php:d/m/Y'];


$columns = [];

$columns[] = [
    'class' => 'kartik\grid\SerialColumn',
    'width' => '30px',
    'hiddenFromExport' => true,
];

//$columns[] = [
//    'class'     => 'kartik\grid\DataColumn',
//    'attribute' => 'macabenh',
//    'label' => 'macabenh',
//];

$columns[]  = [
    'label' => 'Vị trí',
    'hiddenFromExport' => true,
    'value'       => function ($model, $index, $widget) {
        $modelClass = get_class($model);
        $keyname = $modelClass::primaryKey()[0];
        if ($model->geom_txt !== null) {
//            $results = json_encode(array_only($model->attributes, [
//                'macabenh','hoten', 'phai', 'tuoi', 'to1', 'khupho1', 'sonha1', 'duong1', 'ten_phuong', 'ten_quan', 'ngaymacbenh', 'ngaynhapvien', 'lat', 'lng', 'ma_dt_sxh'
//            ]));

            return Html::a("<i class='icon-location4'></i>", null, ['data' => [
                'layer' => 'layerCabenh',
                'model' => array_merge($model->attributes, [
                    'geometry' => $model->toGeoJSON()
                ])
            ]]);
        } else {
            return '';
        }
    },
    'mergeHeader' => true,
    'format'      => 'raw'
];

# -- ADD NÚT XÓA ----------------------------------------------
$role = PQService::getRolePQOfCurrentUser();
$tempAction = $role->cap_hanhchinh == RolePQConst::$CAP_SO ? '{update}{delete}{download}' : '{update}{download}';
$tempAction = '{update}{delete}{download}';
# -------------------------------------------------------------

$columns[] = [
    'class'         => 'kartik\grid\ActionColumn',
    'hiddenFromExport' => true,
    'width' => '110px',
    'template' => $tempAction, // {view} {update} {delete}
    'dropdown'      => false,
    'vAlign'        => 'middle',
    'urlCreator'    => function ($action, $model, $key, $index) {
        return Url::to([$action, 'id' => $key]);
    },
    'viewOptions'   => ['role'     => 'modal-remote', 'title' => Yii::t('app', 'View'), 'data-toggle' => 'tooltip',
                        'class'    => 'custom-replace-url',
                        'data-url' => \pcd\services\UrlService::getCurrentUrl(),
                        'label' => '<i class="icon-eye"></i>'
    ],
    'visibleButtons' => [
        'delete' => !array_has(user_service()->getRolesByUser(), 'phuong'),
    ],
    'buttons' => [
        'update' => function ($url, $model, $key) use($blank) {
            $url = url_home('dieutra/sxh/create?macabenh=').$model->macabenh;
            return "<a href='$url' {$blank} title='Cập nhật phiếu điêu tra' data-pjax='0'><i class='icon-pencil7'></i></a>";
        },
//        'delete' => function ($url, $model, $key) {
//            $url = url_home('dieutra/sxh/create?macabenh=').$model->macabenh;
//            return "<a href='$url' title='Cập nhật phiếu điêu tra' data-pjax='0'><i class='icon-trash text-danger-600'></i></a>";
//        },
        'download' => function ($url, $model, $key) {
            $download_url = Yii::$app->homeUrl . "dieutra/sxh/word?ma_dt_sxh=" . $model->ma_dt_sxh;
            $link =  "<a class='ml-10' title='Tải phiếu điều tra' href='$download_url'><i class='icon-download4'></i></a>";
            return ($model->ma_dt_sxh ? $link :'');
        }
    ],
    'deleteOptions' => [
        'label'                => '<i class="ml-10 icon-trash text-danger-600"></i>',
//        'role'                 => 'modal-remote', 'title' => Yii::t('app', 'Delete'),
//        'data-confirm'         => FALSE, 'data-method' => FALSE,// for overide yii data api
//        'data-request-method'  => 'post',
//        'data-toggle'          => 'tooltip',
//        'class'                => 'custom-replace-url',
        'data-url'             => \pcd\services\UrlService::getCurrentUrl(),
        'data-confirm-title'   => Yii::t('app', 'Are you sure?'),
        'data-confirm-message' => Yii::t('app', 'Are you sure want to delete this item')],
];
$columns[] = [
    'class'     => 'kartik\grid\DataColumn',
    'attribute' => 'xmcabenh',
    'label'     => 'Điều tra',
    'value'     => function ($model, $key, $index) {

        if($model->xmcabenh==1) {
            return 'Đang điều tra';
        } elseif($model->xmcabenh==2){
            return 'Chưa xuất viện';
        } elseif($model->xmcabenh==3){
            return 'Đã điều tra';
        } else {
            return 'Chưa điều tra';
        }

    },
    'filter'    => Html::activeDropDownList($searchModel, 'xmcabenh', [
        0 => 'Chưa điều tra',
        1 => 'Đang điều tra',
        2 => 'Chưa xuất viện',
        3 => 'Đã điều tra',
    ],['prompt' => 'Tất cả', 'class' => 'form-control']),
    //    'width'     => '300px',
];

$columns[] = [
    'class'     => 'kartik\grid\DataColumn',
    'attribute' => 'chuyenca_filter',
    'label'     => 'Ca bệnh',
    'value'     => function ($model, $key, $index, $column) {
        switch ($model->chuyenca_filter) {
            case 0:
                return 'Ca TP';
                break;
            case 1:
                return 'Ca nhận';
                break;
            case 2:
                return 'Ca trả về';
                break;
            case 3:
                return 'Ca PHCĐ';
                break;
        }

    },
    'filter'    => Html::activeDropDownList($searchModel, 'chuyenca_filter', [
        0 => 'Ca thành phố',
        1 => 'Ca nhận',
        2 => 'Ca trả về',
        3 => 'Ca PHCĐ',
    ],['prompt' => 'Tất cả', 'class' => 'form-control']),
    //    'width'     => '300px',
];

//$columns[] = [
//    'value'  => function ($model, $key, $index) {
//        $loai = isset($model->loai_dich) ? $model->loai_dich : 'sxh';
//        $url = \pcd\services\UrlService::getUrl("dieutra/$loai/create?macabenh={$model->macabenh}");
//        return "<a data-toggle='modal' href='#main_modal' data-event='click'  class='custom-element-request-modal' data-target-div='#main_modal_body' data-url='$url'><i class=\"icon-search4\"></i></a>";
//    },
//    'format' => 'raw'
//];


$columns[] = ['attribute' => 'loaibaocao', 'label' => 'Loại báo cáo'];
$columns[] = ['attribute' => 'chuandoanbd', 'label' => 'Bệnh'];
$columns[] = [
    'attribute' => 'ngaybaocao',
    'format' => $fmExcelDate,
];

$columns[] = ['attribute' => 'hoten', 'width' => '140px',];
$columns[] = [
    'class'     => '\kartik\grid\DataColumn',
    'attribute' => 'phai',
    'label' => 'Phái',
    'filter'    => Html::activeDropDownList($searchModel, 'phai', [
        'T' => 'Trai',
        'G' => 'Gái',
    ],['prompt' => 'Tất cả', 'class' => 'form-control']),
    'width'     => '20px',
];

$columns[] = ['attribute' => 'tuoi', 'width' => '66px',];
$columns[] = ['attribute' => 'dienthoai1', 'label' => 'Điện thoại', 'width' => '100px', ];
$columns[] = ['attribute' => 'sonha1', 'label' => 'Số nhà'];
$columns[] = ['attribute' => 'duong1', 'label' => 'Đường'];
$columns[] = ['attribute' => 'to1', 'label' => 'Tổ', 'width' => '30px'];
$columns[] = ['attribute' => 'khupho1', 'label' => 'Khu phố', 'width' => '70px',];
$columns[] = ['attribute' => 'ten_quan', 'label' => 'Quận', ];
$columns[] = ['attribute' => 'ten_phuong', 'label' => 'Phường', ];
//$columns[] = ['attribute' => 'me', 'label' => 'Mẹ' ];


$columns[] = [
    'class'     => '\kartik\grid\DataColumn',
    'attribute' => 'ngaymacbenh',
    'format' => $fmExcelDate,
];

$columns[] = [
    'class'     => '\kartik\grid\DataColumn',
    'attribute' => 'ngaynhapvien',
    'format' => $fmExcelDate,
];

$columns[] = [
    'class'     => '\kartik\grid\DataColumn',
    'attribute' => 'ngayxuatvien',
    'format' => $fmExcelDate,
];

$columns[] = ['label' => 'Tình trạng'];
$columns[] = ['attribute' => 'chuandoan', 'label' => 'Chẩn đoán'];
$columns[] = ['attribute' => 'xacminh_cb1', 'label' => 'Xác minh địa chỉ'];
$columns[] = ['attribute' => 'nghenghiep', 'label' => 'Nghề nghiệp'];
$columns[] = [
    'attribute' => 'loaibc',
    'label' => 'Hình thức điều trị',
    'filter'    => Html::activeDropDownList($searchModel, 'loaibc', [
        0 => 'Ngoại trú',
        1 => 'Nội trú',
    ],['prompt' => 'Tất cả', 'class' => 'form-control']),
    'value' => function ($model, $key, $index, $column) {
        if($model->loaibc === 0){
            return 'Ngoại trú';
        } elseif($model->loaibc === 1) {
            return 'Nội trú';
        }
    }
];
$columns[] = ['label' => 'Ghi chú'];

$columns[] = [
    'label'     => 'Lat',
    'attribute' => 'lat',
    'visible' => true,
];
$columns[] = [
    'label'     => 'Lng',
    'attribute' => 'lng',
    'visible' => true,
];

return $columns;
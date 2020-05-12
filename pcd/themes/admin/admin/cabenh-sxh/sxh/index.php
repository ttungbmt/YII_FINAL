<?php

use kartik\export\ExportMenu;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
//use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchCabenh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách ca bệnh';

//CrudAsset::register($this);
$params = Yii::$app->request->queryParams;


$panelTemplate = <<<HTML
<div class="{prefix}{type} border-top-lg border-top-info border-bottom-lg border-bottom-info">
    {panelHeading}
    {panelBefore}
    {items}
    {panelAfter}
    {panelFooter}
</div>
HTML;
$panelHeadingTemplate = <<< HTML
    <div class="pull-right">
        {summary}
    </div>
    <h5 class="panel-title text-primary">
        {heading}
    </h5>
    <div class="clearfix"></div>
HTML;


$columns = collect(require(__DIR__ . '/_columns.php'))->filter(function ($item) {
    return !data_get($item, 'hiddenFromExport');
})->all();

$dateColumns = ['ngaymacbenh', 'ngaynhapvien', 'ngayxuatvien', 'ngaybaocao'];

$expMenu = ExportMenu::widget([
    'dataProvider'  => $dataProvider,
    'columns'       => require(__DIR__ . '/_columns.php'),
    'onRenderSheet' => function ($sheet, $widget) use ($dateColumns) {
        $highestCol = $sheet->getHighestColumn();
        $highestRow = $sheet->getHighestRow();

//        $letters = collect($widget->getVisibleColumns())->filter(function ($item) use($dateColumns) {
//            return in_array(data_get($item, 'attribute'), $dateColumns);
//        })
//            ->keys()
//            ->map(function ($index) {
//                return PHPExcel_Cell::stringFromColumnIndex($index);
//            });

        $letters = collect([4, 15, 16, 17])->map(function ($index) {
            return PHPExcel_Cell::stringFromColumnIndex($index);
        });


        foreach ($letters as $letter) {
            $sheet->getStyle("{$letter}2:{$letter}{$highestRow}")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2); //PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2
        }

    },
]);

$dataProvider->pagination->pageSize = 7;
$partial = request()->get('partial') || request()->isAjax;

if ($partial) {
    $fullExportMenu = null;
}
?>
<style>
    #crud-datatable-container .kv-grid-table {
        width: 2500px;
    }

    .container-fluid > .col-md-12 {
        overflow: hidden;
        min-height: 600px;
    }

    .kv-grid-toolbar .dropdown-menu {
        padding: 5px;
    }

    .kv-grid-table thead th {
        color: #2196F3
    }
</style>

<?php if (!$partial): ?>
    <?= $this->render('_search', ['model' => $searchModel]) ?>
<?php endif; ?>

<div class="container-fluid no-padding-right
     <?= !$partial ? "padding-20" : "" ?>     no-wrap no-padding"
    <?= !$partial ? 'id="wrapper"' : '' ?> style="height: 100%">

    <div class="col-md-12 overflow-y-scroll no-padding overflow-x-hidden" style="height: 100%">
        <div class="cabenh-index">
            <div id="ajaxCrudDatatable">
                <?= GridView::widget([
                    'id'               => 'crud-datatable',
                    'dataProvider'     => $dataProvider,
                    'filterModel'      => $searchModel,
                    'pjax'             => TRUE,
                    'pjaxSettings'     => [
                        'options' => [
                            'id'              => 'kv-pjax-container',
                            'enablePushState' => $partial ? false : true,
                        ],
                    ],
                    'formatter'        => [
                        'class' => 'common\supports\MyFormatter',
                        'nullDisplay' => '',
                    ],
                    'columns'          => $gridColumns = require(__DIR__ . '/_columns.php'),
                    'resizableColumns' => FALSE,
//                    'persistResize'   => FALSE,
                    //TABLE STYLING
                    'responsive'       => TRUE,
                    'striped'          => FALSE,
                    'hover'            => FALSE,
                    'responsiveWrap'   => FALSE,
                    'showOnEmpty'      => true, // Ẩn bảng nếu k thấy dữ liệu
                    //'perfectScrollbar' => TRUE,
                    'toolbar'          => [
                        [
                            'content' =>
                                Html::a('<i class="icon-plus3"></i> Thêm mới PHCD', url_home('dieutra/sxh/create'), [
                                    'data-pjax' => 0,
                                    'class'     => 'btn btn-primary',
                                    'title'     => 'Thêm mới phiếu SXH'
                                ]) .
                                Html::a('<i class="icon-reload-alt"></i>', [''],
                                    ['data-pjax' => '1', 'class' => 'btn btn-default ml-5', 'title' => 'Reset Grid'])
                        ],
                        '{toggleData}',
                        '{export}',
                    ],
                    'export'           => [
                        'fontAwesome'      => true,
                        'showConfirmAlert' => false,
                        'target'           => GridView::TARGET_BLANK,
                        'itemsAfter'       => [
                            '<li role="presentation" class="divider"></li>',
                            '<li class="dropdown-header">Xuất tất cả dữ liệu</li>',
                            $expMenu
                        ]
                    ],
                    # ------------------------------------------ Config export --

                    'panel'                => [
                        'type'    => 'white',
                        'heading' => '<i class="icon-three-bars"></i> ' . '<span class="text-uppercase">Danh sách ca bệnh</span>',
                    ],
                    'panelTemplate'        => $panelTemplate,
                    'panelHeadingTemplate' => $panelHeadingTemplate,
                ]) ?>
            </div>
        </div>
    </div>
</div>


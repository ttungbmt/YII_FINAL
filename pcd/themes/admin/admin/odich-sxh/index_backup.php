<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\CrudAsset;
use yii\widgets\PjaxAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OdichSxhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Odich Sxhs');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
PjaxAsset::register($this);

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

// ----- Xử lý OnMap ----
$params = app()->request->queryParams;
$onmap = array_get($params, 'partial') && array_get($params, '_pjax') ? 1 : 0;
$partial = collect($params)->get('partial', false);

$models = collect($dataProvider->getModels())->map(function ($item) {
    return array_merge($item->toArray(), ['geometry' => $item->toGeometry()]);
})->groupBy('odich_id');
?>

<div class="odich-sxh-index" style="margin-top: 10px">
    <?= $this->render('_search', ['model' => $searchModel]) ?>

    <div id="ajaxCrudDatatableOdich">
        <?= GridView::widget([
            'id' => 'crud-datatable-odich',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
            'pjax' => true,
            'pjaxSettings' => [
                'options' => [
                    'formSelector' => '#frm_filter_cb',
                    'id' => 'kv-pjax-container-odich',
                    'enablePushState' => $partial ? false : true,
                ],
            ],
            'columns' => require(__DIR__ . '/_columns.php'),
            'responsiveWrap' => FALSE,
            'resizableColumns' => FALSE,
//            'beforeHeader' =>[
//                ['columns' => [['content' => '132',]]],
//            ],
            'toolbar' => [
                ['content' =>
                     Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                         [
                             'title' => 'Thêm mới ổ dịch', 'class' => 'btn btn-default'
                         ]) .
                     Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                         ['data-pjax' => '1', 'id' => 'reset-odichsxh', 'class' => 'btn btn-default', 'title' => 'Reset Grid']) .
                     '{toggleData}' .
                     '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'white',
                'heading' => '<i class="glyphicon glyphicon-list"></i> <span class="text-uppercase">Danh sách ổ dịch</span>',
            ],
            'panelTemplate' => $panelTemplate,
            'panelHeadingTemplate' => $panelHeadingTemplate,
        ]) ?>


    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>

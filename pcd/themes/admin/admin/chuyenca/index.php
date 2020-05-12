<?php

use johnitvn\ajaxcrud\CrudAsset;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel pcd\search\ChuyencaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
CrudAsset::register($this);

$this->title = "Chuyển ca";
$partial = app('request')->get('partial') || app('request')->isAjax || (isset($partial) ? $partial : false);
$suffix = '-pcd';
$tableId = 'crud-datatable' . $suffix;
?>
<div class="chuyenca-index">
    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id' => $tableId,
            'pjaxSettings' => [
                'options' => [
                    'id' => $pjaxContainer = ('kv-pjax-container' . $suffix),
                    'enablePushState' => $partial ? false : true,
                ],
            ],
            'dataProvider' => $dataProvider,
//            'filterModel' => $searchModel,
            'filterSelector' => 'select[name="pagination"]',
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar' => [
                ['content' =>
                    Html::a('<i class="icon-reload-alt"></i>', [''],
                        ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => lang('Reset Grid')]) .
                    '{toggleData}' .
                    '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => 'Danh sách Chuyển ca',
                'before'  =>  Html::tag('div', (
                    Html::a('Ca chuyển', ['/admin/chuyenca', 'ChuyencaSearch' => ['loaica' => 2]], ['class' => 'btn btn-default btn-raised']).
                    Html::a('Ca nhận', ['/admin/chuyenca', 'ChuyencaSearch' => ['loaica' => 3]], ['class' => 'btn btn-default btn-raised']).
                    Html::a('Ca trả về', ['/admin/chuyenca', 'ChuyencaSearch' => ['loaica' => 4]], ['class' => 'btn btn-default btn-raised'])
                ), ['class' => 'btn-group'])
            ]
        ]) ?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>




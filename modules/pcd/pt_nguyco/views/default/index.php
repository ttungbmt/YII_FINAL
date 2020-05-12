<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;

/* @var $this yii\web\View */
/* @var $searchModel pcd\search\PtNguycoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
CrudAsset::register($this);
$this->title = "Điểm nguy cơ";
$is_partial = request('partial') == true;
?>
<div class="pt-nguyco-index">
    <div id="ajaxCrudDatatable">
        <?= $this->render('_search_gs', ['model' => $searchModel]) ?>

        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'filterSelector' => 'select[name="pagination"]',
            'pjax' => true,
            'pjaxSettings' => [
                'options' => [
                    'enablePushState' => $is_partial ? false : true,
                    'formSelector' => '#ajaxCrudDatatable form[data-pjax]',
                    'scrollTo' => true,
                ],
            ],
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar' => [
                ['content' =>
                    Html::a('Thêm mới', ['create'],
                        ['data-pjax' => 0, 'title' => 'Thêm mới Điểm nguy cơ', 'class' => 'btn btn-default',]) .
                    Html::a('<i class="icon-reload-alt"></i>', [''],
                        ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => lang('Reset Grid')]) .
                    '{toggleData}' .
                    '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'resizableColumns' => false,
            'panel' => [
                'type' => 'primary',
                'heading' => 'Danh sách Điểm nguy cơ',
            ],
            'floatHeader' => false,
            'tableOptions' => ['style' => 'width: 2000px;'],
        ]) ?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>






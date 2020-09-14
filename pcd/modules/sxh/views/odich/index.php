<?php

use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;

/* @var $this yii\web\View */
/* @var $searchModel pcd\search\DmLoaihinhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
CrudAsset::register($this);

$this->title = "Ổ dịch";
$gridColumns = require(__DIR__ . '/_columns.php');
$exportMenu =  ExportMenu::widget(['dataProvider' => $dataProvider, 'columns' => $gridColumns]);
?>
<div class="dm-odich-index">
    <div id="ajaxCrudDatatable">
        <?= $this->render('_search', ['model' => $searchModel]) ?>

        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'filterSelector' => 'select[name="pagination"]',
            'pjax' => true,
            'columns' => $gridColumns,
            'toolbar' => [
                ['content' =>
//                    Html::a('Thêm mới', ['create'],
//                        ['role' => 'modal-remote', 'title' => 'Thêm mới', 'class' => 'btn btn-primary',]) .
                    Html::a('<i class="icon-reload-alt"></i>', [''],
                        ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => lang('Reset Grid')]) .
                    '{toggleData}' .
                    $exportMenu
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => 'Danh sách Ổ dịch',
            ]
        ]) ?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>






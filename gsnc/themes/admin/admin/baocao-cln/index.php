<?php

use johnitvn\ajaxcrud\CrudAsset;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\bootstrap4\Modal;

$this->title = 'Danh sách báo cáo';
CrudAsset::register($this);
?>

<div class="dmloaibv-index">
    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => $gridColumns = require(__DIR__ . '/_columns.php'),
            'toolbar' => [
                ['content' =>
                    Html::a('Thêm mới', ['create'], ['data-pjax' => 0, 'title' => 'Thêm mới loại bệnh viện', 'class' => 'btn btn-primary']) .
                    Html::a('<i class="icon-reload-alt"></i>', [''],
                        ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => lang('Reset Grid')]) .
                    '{toggleData}' .
                    ExportMenu::widget(['dataProvider' => $dataProvider, 'columns' => $gridColumns])
                ],
            ],
            'panel' => [
                'type' => 'primary',
                'heading' => ' Danh sách báo cáo',
            ]
//
        ]); ?>
    </div>
</div>

<?php Modal::begin([
    "id"     => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>

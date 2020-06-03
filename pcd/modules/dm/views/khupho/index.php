<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;

/* @var $this yii\web\View */
/* @var $searchModel pcd\modules\dm\models\search\DmKhuphoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
CrudAsset::register($this);

$this->title = "Khu phố";
?>
<div class="dm-khupho-index">
    <div id="ajaxCrudDatatable">
        <?= $this->render('_search', ['model' => $searchModel]) ?>

        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterSelector' => 'select[name="pagination"]',
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar' => [
                ['content' =>
                    Html::a('Thêm mới', ['create'],
                        ['role' => 'modal-remote', 'title' => 'Thêm mới Khu phố', 'class' => 'btn btn-primary',]) .
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
                'heading' => 'Danh sách Khu phố',
            ]
        ]) ?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>






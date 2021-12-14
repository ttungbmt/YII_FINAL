<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 

/* @var $this yii\web\View */
/* @var $searchModel pcd\search\CabenhSxhNnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
CrudAsset::register($this);

$this->title = "Ca nghi ngờ nhiễm sốt xuất huyết";
?>
<div class="dm-dichte-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=> 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('Thêm mới', ['create'],
                    ['title'=> 'Thêm mới','class'=>'btn btn-default', 'data-pjax' => 0]).
                    Html::a('<i class="icon-reload-alt"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=> lang('Reset Grid')]).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => 'Danh sách ca nghi ngờ',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=> "ajaxCrudModal",
    "footer"=> "",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>






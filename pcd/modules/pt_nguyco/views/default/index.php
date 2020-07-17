<?php
use kartik\export\ExportMenu;
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
$gridColumns = require(__DIR__ . '/_columns.php');
$exportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'dropdownOptions' => [
        'label' => '<i class="icon-database-export"></i>',
        'class' => 'btn btn-default'
    ]
]);
$maquan = $searchModel->maquan;
$maphuong = $searchModel->maphuong;

$null_lh = \pcd\models\PtNguyco::find()
    ->andWhere('loaihinh_id IS NULL')
    ->andFilterWhere(['maquan' => $maquan, 'maphuong' => $maphuong])
    ->count()
;
$null_updated = \pcd\models\PtNguyco::find()
    ->andWhere('updated_by = 1')
    ->andFilterWhere(['maquan' => $maquan, 'maphuong' => $maphuong])
    ->count()
;

$wrong_geom = (new \yii\db\Query())
    ->from('pt_nguyco')->andWhere(new \yii\db\Expression("ST_Intersects(geom , (SELECT ST_Union(geom) geom FROM hc_quan)) = false"))
    ->andFilterWhere(['maquan' => $maquan, 'maphuong' => $maphuong])
    ->count()
;

$null_geom = (new \yii\db\Query())
    ->from('pt_nguyco')->select('gid')->andWhere('geom IS NULL')
    ->andFilterWhere(['maquan' => $maquan, 'maphuong' => $maphuong])
    ->count()
;

$params = request()->queryParams;
$btnClass = function ($key){
    return request()->has($key)  ? ' btn-primary ' : ' btn-default ';
};
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
            'columns' => $gridColumns,
            'toolbar' => [
                ['content' =>
                    Html::a('Thêm mới', ['create'],
                        ['data-pjax' => 0, 'title' => 'Thêm mới Điểm nguy cơ', 'class' => 'btn btn-primary',]) .
                    Html::a('<i class="icon-reload-alt"></i>', [''],
                        ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => lang('Reset Grid')]) .
                    '{toggleData}'.$exportMenu
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'resizableColumns' => false,
            'panel' => [
                'type' => 'primary',
                'heading' => 'Danh sách Điểm nguy cơ',
                'before'  =>  Html::tag('div', (
                    Html::tag('div', (
                            Html::a('Tất cả', ['', 'all' => 1], ['class' => 'btn '.$btnClass('all').' btn-raised']).
                            Html::a('Đã xóa', ['', 'daxoa' => 1], ['class' => 'btn'.$btnClass('daxoa').'btn-raised'])
                    ), ['class' => 'btn-group']).
                    Html::tag('div', (
                        ($null_lh > 0 ? '<a href="'.url(array_merge([''], $params, ['filter_dnc' => 0])).'" class="badge bg-warning-400" target="_blank" data-pjax="0">'.$null_lh.' DNC chưa nhập loại hình</a>' : '').
                        ($null_updated > 0 ? '<a href="'.url(array_merge([''], $params, ['filter_dnc' => 1])).'" class="ml-1 badge bg-danger-400" target="_blank" data-pjax="0">'.$null_updated.' DNC cập nhập dữ liệu</a>' : '').
                        ($wrong_geom > 0 ? '<a href="'.url(array_merge([''], $params, ['filter_dnc' => 2])).'" class="ml-1 badge bg-violet" target="_blank" data-pjax="0">'.$wrong_geom.' Điểm sai tọa độ</a>' : '').
                        ($null_geom > 0 ? '<a href="'.url(array_merge([''], $params, ['filter_dnc' => 3])).'" class="ml-1 badge bg-brown" target="_blank" data-pjax="0">'.$null_geom.' Điểm chưa nhập tọa độ</a>' : '')
                    ), ['class' => 'ml-2 self-center'])
                ), ['class' => 'flex'])
            ],
            'floatHeader' => false,
            'tableOptions' => ['style' => 'width: 2000px;'],
        ]) ?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",
]) ?>
<?php Modal::end(); ?>






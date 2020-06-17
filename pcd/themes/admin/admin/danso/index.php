<?php

use yii\bootstrap4\Modal;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel pcd\models\search\DansoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Dân số');
$this->params['breadcrumbs'][] = $this->title;
$type = role('phuong') ? 2 : 1;
?>
<div class="danso-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'toolbar' => [
            ['content' => (
                Html::a('Thêm mới', ['create', 'type' => $type], ['title' => 'Thêm mới', 'class' => 'btn btn-primary', 'data-pjax' => 0]) .
                '{toggleData}'
            )
            ],
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => 'kartik\grid\ActionColumn',
                'width' => '100px',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to([$action, 'id' => $key]);
                },
                'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
                'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
                'deleteOptions' => ['role' => 'modal-remote', 'title' => 'Delete',
                    'data-request-method'  => 'post',
                    'data-confirm-ok'      => 'Chấp nhận',
                    'data-confirm-cancel'  => 'Đóng',
                    'data-toggle'          => 'tooltip',
                    'data-confirm-title'   => 'Bạn có chắc chắn?',
                    'data-confirm-message' => 'Are you sure want to delete this item'],
            ],
            [
                'label' => 'Quận huyện',
                'attribute' => 'ma_hc',
                'value' => 'quan.tenquan',
            ],
            'nam',
            'danso',
            'uoctinh',
        ],
        'panel' => [
            'type' => 'primary',
            'heading' => 'Dân số',
        ],
    ]); ?>
</div>

<?php Modal::begin([
    "id"     => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>

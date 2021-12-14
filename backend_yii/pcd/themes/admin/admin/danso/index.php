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
$columns = require __DIR__.'/_columns.php'
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
        'columns' => $columns,
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

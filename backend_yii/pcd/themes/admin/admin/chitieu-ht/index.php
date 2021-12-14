<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel pcd\models\search\ChitieuHtSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chỉ tiêu huyết thanh';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chitieu-ht-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Thêm mới chỉ tiêu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            ['class' => 'kartik\grid\ActionColumn'],
            'benhvien',
            'chitieu',
            'nam',

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

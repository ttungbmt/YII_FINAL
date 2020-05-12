<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel pcd\models\search\DansoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Dân số');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="danso-index">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Thêm mới dân số'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            ['class' => 'kartik\grid\ActionColumn'],
            [
                'label' => 'Quận huyện',
                'attribute' => 'ma_hc',
                'value' => 'quan.tenquan',
            ],
            'nam',
            'danso',
            'uoctinh',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

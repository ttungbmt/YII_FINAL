<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel pcd\models\search\XnHuyetthanhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Xét nghiệm huyết thanh';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xn-huyetthanh-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php  // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <a class="btn btn-info" href="<?= url(['admin/xn-huyetthanh']) ?>">Tất cả</a>
        <a class="btn btn-primary" href="<?= url(['admin/xn-huyetthanh', 'XnHuyetthanhSearch[loai_xn]' => 'PCR']) ?>">PCR</a>
        <a class="btn btn-primary"
           href="<?= url(['admin/xn-huyetthanh', 'XnHuyetthanhSearch[loai_xn]' => 'MAC ELISA']) ?>">MAC ELISA</a>
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'kartik\grid\ActionColumn',],
            [
                'attribute' => 'maquan',
                'value'     => 'quan.tenquan',
            ],
            'hoten',
//            'ngaynhanmau',
            'phai',
            'namsinh',
            'diachi',
            'donvi_gui',
            //'duan',
            'yeucau_xn',
            //'ketqua',
            //'ketluan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

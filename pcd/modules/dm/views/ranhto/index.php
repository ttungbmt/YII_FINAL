<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel pcd\modules\dm\models\search\Ranh tổearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ranh tổ');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="ranhto-index">
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => false,
        'columns' => [
            ['class' => \kartik\grid\SerialColumn::className()],
            'hcQuan.tenquan',
            'hcPhuong.tenphuong',
            'khupho',
            'tento',
            ['class' => \kartik\grid\ActionColumn::className()],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel pcd\models\search\BenhTnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bệnh truyền nhiễm';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = require(__DIR__ . '/_columns.php');
?>
<div class="dichbenh-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a class="btn btn-info" href="<?=url(['default'])?>">Tất cả</a>
        <a class="btn btn-primary" href="<?=url(['', 'BenhTnSearch[chuandoan_bd]' => 'HO GA'])?>">Ho gà</a>
        <a class="btn btn-primary" href="<?=url(['', 'BenhTnSearch[chuandoan_bd]' => 'THUONG HAN'])?>">Thương hàn</a>
        <a class="btn btn-primary" href="<?=url(['', 'BenhTnSearch[chuandoan_bd]' => 'ZIKA'])?>">Zika</a>
        <a class="btn btn-primary" href="<?=url(['', 'BenhTnSearch[chuandoan_bd]' => 'TIEU CHAY'])?>">Tiêu chảy</a>
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => $gridColumns,
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php

use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel pcd\models\search\BenhTnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bệnh truyền nhiễm';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = require(__DIR__ . '/_columns.php');
$exportMenu =  ExportMenu::widget(['dataProvider' => $dataProvider, 'columns' => $gridColumns]);
?>
<div class="dichbenh-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div>
        <a class="btn btn-info" href="<?=url(['default'])?>">Tất cả</a>
        <a class="btn btn-primary" href="<?=url(['', 'BenhTnSearch[chuandoan_bd]' => 'HO GA'])?>">Ho gà</a>
        <a class="btn btn-primary" href="<?=url(['', 'BenhTnSearch[chuandoan_bd]' => 'THUONG HAN'])?>">Thương hàn</a>
        <a class="btn btn-primary" href="<?=url(['', 'BenhTnSearch[chuandoan_bd]' => 'ZIKA'])?>">Zika</a>
        <a class="btn btn-primary" href="<?=url(['', 'BenhTnSearch[chuandoan_bd]' => 'TIEU CHAY'])?>">Tiêu chảy</a>

        <div class="btn-group pull-right">
            <button type="button" class="btn bg-success-400 btn-labeled btn-labeled-left dropdown-toggle" data-toggle="dropdown"><b><i class="icon-reading"></i></b> Thêm mới</button>
            <div class="dropdown-menu dropdown-menu-right" style="z-index: 10000;">
                <a data-pjax="0" href="<?=url(['create', 'chuandoan_bd' => 'THUONG HAN'])?>" class="dropdown-item uppercase">Thương hàn</a>
                <a data-pjax="0" href="<?=url(['create', 'chuandoan_bd' => 'HO GA'])?>" class="dropdown-item uppercase">Ho gà</a>
                <a data-pjax="0" href="<?=url(['create', 'chuandoan_bd' => 'TIEU CHAY'])?>" class="dropdown-item uppercase">Tiêu chảy</a>
                <a data-pjax="0" href="<?=url(['create', 'chuandoan_bd' => 'ZIKA'])?>" class="dropdown-item uppercase">Zika</a>
            </div>
        </div>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => $gridColumns,
        'toolbar'          => [
            $exportMenu,
        ],
        'panel' => [
            'type' => 'primary',
            'heading' => 'Danh sách ca bệnh',
        ]
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel pcd\modules\sxh\models\search\PhunCdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phun chủ động';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = require(__DIR__ . '/_columns.php');
$exportMenu = ExportMenu::widget(['dataProvider' => $dataProvider, 'columns' => $gridColumns]);
?>
<div class="phun-cd-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'toolbar' => [
            ['content' =>
                Html::a('Thêm mới', ['create'],
                    ['data-pjax' => 0, 'title' => 'Thêm mới', 'class' => 'btn btn-primary',]) .
                Html::a('<i class="icon-reload-alt"></i>', [''],
                    ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => lang('Reset Grid')]) .
                '{toggleData}' .
                $exportMenu
            ],
        ],
        'panel' => [
            'type' => 'primary',
            'heading' => 'Danh sách ' . $this->title,
        ]
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel pcd\models\search\DichbenhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bệnh truyền nhiễm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dichbenh-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a class="btn btn-info" href="<?=url(['admin/dichbenh'])?>">Tất cả</a>
        <a class="btn btn-primary" href="<?=url(['admin/dichbenh', 'DichbenhSearch[chuandoan_bd]' => 'HO GA'])?>">Ho gà</a>
        <a class="btn btn-primary" href="<?=url(['admin/dichbenh', 'DichbenhSearch[chuandoan_bd]' => 'THUONG HAN'])?>">Thương hàn</a>
        <a class="btn btn-primary" href="<?=url(['admin/dichbenh', 'DichbenhSearch[chuandoan_bd]' => 'ZIKA'])?>">Zika</a>
        <a class="btn btn-primary" href="<?=url(['admin/dichbenh', 'DichbenhSearch[chuandoan_bd]' => 'TIEU CHAY'])?>">Tiêu chảy</a>
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class'      => 'kartik\grid\ActionColumn',],
            'chuandoan_bd',
            'hoten',
            'phai',
            'tuoi',
            'diachi',
            //'nghenghiep',
            //'me',
            //'dienthoai',
            'maquan',
            'maphuong',
            'ngaynhapvien',
            //'ngaybaocao',
            //'nam_nv',
            //'thang_nv',
            //'tuan_nv',
            //'nam_bc',
            //'thang_bc',
            //'tuan_bc',
            'hinhthuc_dt',

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model modules\pcd\import\models\Dichbenh */

$this->title = $model->gid;
$this->params['breadcrumbs'][] = ['label' => 'Dichbenhs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dichbenh-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->gid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->gid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gid',
            'benhvien',
            'chuandoan_bd',
            'shs',
            'hoten',
            'phai',
            'tuoi',
            'diachi',
            'nghenghiep',
            'me',
            'dienthoai',
            'maquan',
            'maphuong',
            'ngaynhapvien',
            'ngaybaocao',
            'nam_nv',
            'thang_nv',
            'tuan_nv',
            'nam_bc',
            'thang_bc',
            'tuan_bc',
            'hinhthuc_dt',
        ],
    ]) ?>

</div>

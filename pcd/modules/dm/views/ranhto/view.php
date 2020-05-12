<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model pcd\modules\dm\models\Ranhto */

$this->title = $model->gid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ranh tổ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ranhto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->gid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->gid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gid',
            'objectid',
            'tenphuong',
            'tenquan',
            'tento',
            'khupho',
            'shape_leng',
            'maquan',
            'maphuong',
            'shape_le_1',
            'shape_area',
            'geom',
        ],
    ]) ?>

</div>

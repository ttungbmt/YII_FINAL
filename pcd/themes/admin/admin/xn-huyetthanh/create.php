<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pcd\models\XnHuyetthanh */

$this->title = 'Thêm mới';
$this->params['breadcrumbs'][] = ['label' => 'Xn Huyetthanhs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xn-huyetthanh-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

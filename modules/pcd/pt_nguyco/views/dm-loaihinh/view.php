<?php
use yii\widgets\DetailView;
?>
<?= DetailView::widget([
    'model'      => $model,
    'attributes' => [
        'id',
        'nhom',
        'ten_lh',
        'tanxuat',
        'thaydoi',
    ],
]) ?>
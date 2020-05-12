<?php
use yii\widgets\DetailView;
?>
<div class="benhvien-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'mabenhvien',
            'maso',
            'tenbenhvien',
            'tenvt',
            'diachi',
        ],
    ]) ?>
</div>

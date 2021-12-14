<?php
use yii\widgets\DetailView;
$this->title = 'Chi tiết Hóa chất';
?>
<div class="dm-hoachat-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ten_hc',
        ],
    ]) ?>
</div>
<?php

use yii\widgets\DetailView;

?>
<div class="dm-to-dp-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'quan.tenquan',
            'phuong.tenphuong',
            'khupho',
            'to_dp',
        ],
    ]) ?>
</div>
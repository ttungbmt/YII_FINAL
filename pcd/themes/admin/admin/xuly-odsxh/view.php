<?php

use yii\widgets\DetailView;
?>
<div class="xuly-odsxh-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'odichsxh_id',
            'lanxl',
            'tungaydlq',
            'denngaydlq',
            'sotodlq',
            'tentodlq:ntext',
            'sokhuphodlq',
            'tenkhuphodlq:ntext',
            'sonhadukiendlq',
            'sonhaduocdlq',
            'truoc_bi',
            'truoc_ci',
            'truoc_hi',
            'sau_bi',
            'sau_ci',
            'sau_hi',
            'tungayphc',
            'denngayphc',
            'sotophc',
            'tentophc:ntext',
            'sokhuphophc',
            'tenkhuphophc:ntext',
            'sohodukienphc',
            'sohoduocphc',
            'tenhc1:ntext',
            'solithc1',
            'tenhc2:ntext',
            'solithc2',
            'tyle',
            'ngayxuly',
        ],
    ]) ?>
</div>

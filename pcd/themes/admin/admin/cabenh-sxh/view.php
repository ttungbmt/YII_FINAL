<?php

use yii\widgets\DetailView;

$this->title = "Chi tiết Ca nghi ngờ nhiễm SXH";
?>
<div class="dm-dichte-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gid',
            'bv',
            't_benh',
            'hoten',
            'tuoi',
            'ng_nv',
            'lat',
            'lng',
        ],
    ]) ?>
</div>

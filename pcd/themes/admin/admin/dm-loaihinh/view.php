<?php

use yii\widgets\DetailView;
?>
<div class="card">
    <div class="card-body">
        <div class="dm-loaihinh-view">

            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                        'id',
            'nhom',
            'ten_lh',
            'tanxuat',
            'thaydoi',
            ],
            ]) ?>
        </div>
    </div>
</div>


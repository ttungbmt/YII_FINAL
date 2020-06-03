<?php

use yii\widgets\DetailView;
?>
<div class="card">
    <div class="card-body">
        <div class="dm-khupho-view">

            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                        'gid',
            'maquan',
            'maphuong',
            'khupho',
            ],
            ]) ?>
        </div>
    </div>
</div>


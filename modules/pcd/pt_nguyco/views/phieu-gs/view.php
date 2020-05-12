<?php

use yii\widgets\DetailView;
?>
<div class="phieu-gs-view">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
    'pt_nguyco_id',
    'vc_nc',
    'vc_lq',
    'ngay_gs',
    'nguoi_gs',
    'mucdich_gs',
    'dexuat_xp',
    'xuphat',
    'ngayxuphat',
    ],
    ]) ?>
</div>


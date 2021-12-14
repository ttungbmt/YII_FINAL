<?php
use yii\helpers\Html;
$this->title = 'Cập nhật ổ dịch';
?>
<div class="card">
    <div class="card-body">
        <div class="odich-sxh-update">
            <?= $this->render('_form', [
                'model' => $model,
                'geomodich' => $geomodich,
                'khXulyOdsxh' => $khXulyOdsxh
            ]) ?>
        </div>
    </div>

</div>

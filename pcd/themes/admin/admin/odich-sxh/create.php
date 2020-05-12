<?php
use yii\helpers\Html;
$this->title = 'Thêm mới ổ dịch';
?>

<div class="card">
    <div class="card-body">
        <div class="odich-sxh-update">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>


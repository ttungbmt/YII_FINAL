<?php
$this->title = 'Cập nhật ca bệnh: #'.request('id');
?>

<div class="sxh-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

<?php
use yii\helpers\ArrayHelper;
?>
<div class="m-2">
    <?php foreach (ArrayHelper::index($to_ah, null, 'tenquan') as $tenquan => $quan): ?>
        <?php $dsPhuong = ArrayHelper::index($quan, null, 'tenphuong')?>
        <span class="font-weight-semibold no-margin text-warning"><?= $tenquan ?> (<?=count($dsPhuong)?> phường)</span>
        <hr class="mt-2 mb-2">
        <?php foreach ($dsPhuong as $tenphuong => $phuong): ?>
            <?php $dsKhupho = ArrayHelper::index($phuong, null,'khupho')?>
            <span class="font-weight-semibold text-primary text-underline"><u><?= $tenphuong ?> (<?=count($dsKhupho)?> khu phố)</u></span> <br>

            <?php foreach ($dsKhupho as $tenkp => $kp): ?>
                <b>Khu phố <?= $tenkp ?> (<?=count($kp)?>):</b> <?= implode(', ', array_pluck($kp, 'tento')) ?> <br>
            <?php endforeach; ?>

        <?php endforeach; ?>

    <?php endforeach; ?>
</div>


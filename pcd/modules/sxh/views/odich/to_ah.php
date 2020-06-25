<?php
use yii\helpers\Html;

$r_khupho = function ($khupho, $p){
    return Html::tag('div', (
        Html::tag('span', "Khu phố / ấp {$khupho} ({$p->count()}): ", ['class' => 'font-bold']).
        $p->sortBy('tento', SORT_NATURAL)->implode('tento', ', ')
    ));
}
?>
<div style="columns: auto 2">
    <?php foreach ($px->groupBy('khupho') as $khupho => $p):?>
        <?= $r_khupho($khupho, $p)?>
    <?php endforeach;?>

    <?php if($lien_px->count() > 0):?>
        <hr class="my-2">
        <div class="font-bold uppercase underline">Liên Phường xã:</div>
        <div>
            <?php foreach ($lien_px->groupBy('maphuong') as $maphuong => $px):?>
                <div>
                    <div class="font-bold underline text-warning">
                        <?=data_get($px, '0.tenphuong')?>:
                    </div>
                    <?php foreach ($px->groupBy('khupho') as $khupho => $p):?>
                        <?= $r_khupho($khupho, $p)?>
                    <?php endforeach;?>
                </div>
            <?php endforeach;?>
        </div>
    <?php endif?>

    <?php if($lien_qh->count() > 0):?>
        <hr class="my-2">
        <div class="font-bold uppercase">Liên Quận huyện</div>
        <?php foreach ($lien_qh->groupBy('maquan') as $maquan => $qh):?>
            <div>
                <div class="font-bold underline text-danger uppercase">
                    <?=data_get($qh, '0.tenquan')?>:
                </div>
                <?php foreach ($qh->groupBy('maphuong') as $maphuong => $px):?>
                    <div>
                        <div class="font-bold underline text-warning">
                            <?=data_get($px, '0.tenphuong')?>:
                        </div>
                        <?php foreach ($px->groupBy('khupho') as $khupho => $p):?>
                            <?= $r_khupho($khupho, $p)?>
                        <?php endforeach;?>
                    </div>
                <?php endforeach;?>
            </div>
        <?php endforeach;?>
    <?php endif?>

</div>


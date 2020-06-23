<div>
<?php foreach ($px->groupBy('khupho') as $khupho => $p):?>
    <div>
        <span class="font-bold">Khu phố/Ấp <?=$khupho?> (<?=$p->count()?>):</span>
        <?=$p->sortBy('tento', SORT_NATURAL)->implode('tento', ', ')?>
    </div>
<?php endforeach;?>
</div>
<?php if($lien_px->count() > 0):?>
    <hr class="my-2">
    <div class="font-bold uppercase">Liên Phường xã</div>
    <div>
        <?php foreach ($lien_px->groupBy('maphuong') as $maphuong => $px):?>
            <div>
                <div class="font-bold underline text-warning">
                    <?=data_get($px, '0.tenphuong')?>:
                </div>
                <?php foreach ($px->groupBy('khupho') as $khupho => $p):?>
                    <div>
                        <span class="font-bold">Khu phố/Ấp <?=$khupho?> (<?=$p->count()?>):</span>
                        <?=$p->sortBy('tento', SORT_NATURAL)->implode('tento', ', ')?>
                    </div>
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
                        <div>
                            <span class="font-bold">Khu phố/Ấp <?=$khupho?> (<?=$p->count()?>):</span>
                            <?=$p->sortBy('tento', SORT_NATURAL)->implode('tento', ', ')?>
                        </div>
                    <?php endforeach;?>
                </div>
            <?php endforeach;?>
        </div>
    <?php endforeach;?>
<?php endif?>


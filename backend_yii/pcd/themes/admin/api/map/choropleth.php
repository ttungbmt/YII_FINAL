<div class="table-responsive mt-2">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>QH</th>
            <?php if($type == 'year'):?>
                <?php foreach ($ys as $y):?>
                    <th>Số ca năm <?=$y?></th>
                    <th>Dân số năm <?=$y?></th>
                    <th>Số ca/100.000 năm <?=$y?></th>
                <?php endforeach;?>
            <?php else:?>
                <th>Số ca</th>
                <th>Dân số</th>
                <th>Số ca/100.000</th>
            <?php endif;?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $l):?>
            <?php $p = $l['properties'] ?>
            <tr>
                <td class="font-weight-semibold"><?=$p['ten_hc']?></td>
                <?php if($type == 'year'):?>
                    <?php foreach ($p['items'] as $i):?>
                        <td><?=$i['count']?></td>
                        <td><?=$i['pop']?></td>
                        <td><?=$i['cp']?></td>
                    <?php endforeach;?>
                <?php else:?>
                    <td><?=$p['count']?></td>
                    <td><?=$p['pop']?></td>
                    <td><?=$p['cp']?></td>
                <?php endif;?>

            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

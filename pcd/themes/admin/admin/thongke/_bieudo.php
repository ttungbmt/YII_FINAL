<?php //dd($tk_sxh) ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <?php if(isset($tk_namsxh) && $tk_namsxh): ?>
                <th>Năm</th>
                <th>Tháng</th>
            <?php endif;?>
            <th>Số ca bệnh</th>
        </tr>
        </thead>
        <tbody>
        <tr>


            <?php foreach($tk_sxh as $item): ?>

                <?php if(isset($tk_namsxh) && $tk_namsxh): ?>
                    <td><?= $item['tk_namsxh']; ?></td>
                    <td><?= $item['tk_thangsxh']; ?></td>
                <?php endif;?>

                <td><?= $item['tongso']; ?></td>
            <?php endforeach; ?>
        </tr>
        </tbody>
    </table>
</div>

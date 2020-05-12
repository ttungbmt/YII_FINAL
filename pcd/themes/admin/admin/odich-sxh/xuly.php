
<table class="table table-bordered">
    <tbody>
    <?php foreach ($data as $k => $m):?>
        <tr>
            <td rowspan="6" class="font-weight-semibold">LẦN <?=$k+1?></td>
            <td rowspan="2" class="font-weight-semibold">Diệt lăng quăng</td>
            <td class="font-weight-semibold">Ngày</td>
            <td><?= "Từ " . $m->tungaydlq . " đến " . $m->denngaydlq ?></td>
        </tr>
        <tr>
            <td class="font-weight-semibold">BI</td>
            <td><?=$m->truoc_bi?></td>
        </tr>
        <tr>
            <td rowspan="4" class="font-weight-semibold">Phun hóa chất</td>
            <td class="font-weight-semibold">Ngày</td>
            <td><?= "Từ " . $m->tungayphc . " đến " . $m->denngayphc ?></td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Hóa chất</td>
            <td><?= "Loại 1: " . $m->tenhc1 . "<br>" . "Loại 2: " . $m->tenhc2 ?></td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Lượng (lít)</td>
            <td><?="Loại 1: " . $m->solithc1 . "<br>" . "Loại 2: " . $m->solithc2 ?></td>
        </tr>
        <tr>
            <td class="font-weight-semibold">Tỷ lệ mở cửa</td>
            <td><?=$m->tyle?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
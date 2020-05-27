<div class="card-body">
    <table class="table">
        <thead>
        <tr>
            <th><?=role('admin') ? 'Quận/huyện' : (role('quan') ? 'Phường/xã' : 'Khu phố')?></th>
            <th>Ca Nhận</th>
            <th>Ca chuyển</th>
            <th>Ca PHCĐ</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tk_chuyenca as $ma => $item):?>
            <tr>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['excepted_tv' => 1, $item['field'] => $ma]])?>"><?=data_get($item, 'ten')? : 'Không rõ'?></a></td>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['excepted_tv' => 1, 'loaicabenh' => 1,$item['field'] => $ma]])?>"><?=data_get($item, 'ca_nhan')?></a></td>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['excepted_tv' => 1, 'loaicabenh' => 2,$item['field'] => $ma]])?>"><?=data_get($item, 'ca_chuyen')?></a></td>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['excepted_tv' => 1, 'loaicabenh' => 3,$item['field'] => $ma]])?>"><?=data_get($item, 'ca_phcd')?></a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot>
        <tr class="table-active table-border-double">
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh'])?>">Tổng</a></td>
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['excepted_tv' => 1, 'loaicabenh' => 1]])?>"><?=$tk_chuyenca->values()->pluck('ca_nhan')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['excepted_tv' => 1, 'loaicabenh' => 2]])?>"><?=$tk_chuyenca->values()->pluck('ca_chuyen')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['excepted_tv' => 1, 'loaicabenh' => 3]])?>"><?=$tk_chuyenca->values()->pluck('ca_phcd')->sum()?></a></td>
        </tr>
        </tfoot>
    </table>
</div>
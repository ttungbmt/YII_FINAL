<div class="card">
    <table class="table">
        <thead>
        <tr>
            <th><?=role('admin') ? 'Quận/huyện' : (role('quan') ? 'Phường/xã' : 'Khu phố')?></th>
            <th>Ca TP</th>
            <th>Ca Nhận</th>
            <th>Ca chuyển</th>
            <th>Ca PHCĐ</th>
            <th>Tổng</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tk_chuyenca as $ma => $item):?>
            <tr>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => [$item['field'] => $ma]])?>"><?=data_get($item, 'ten')?></a></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['chuyenca_filter' => 0,$item['field'] => $ma]])?>"><?=data_get($item, 'ca_tp')?></a></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['chuyenca_filter' => 1,$item['field'] => $ma]])?>"><?=data_get($item, 'ca_nhan')?></a></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['chuyenca_filter' => 2,$item['field'] => $ma]])?>"><?=data_get($item, 'ca_chuyen')?></a></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['chuyenca_filter' => 3,$item['field'] => $ma]])?>"><?=data_get($item, 'ca_phcd')?></a></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => [$item['field'] => $ma]])?>"><?=data_get($item, 'total')?></a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot>
        <tr>
        <tr>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh'])?>">Tổng</a></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['chuyenca_filter' => 0]])?>"><?=$tk_chuyenca->values()->pluck('ca_tp')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['chuyenca_filter' => 1]])?>"><?=$tk_chuyenca->values()->pluck('ca_nhan')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['chuyenca_filter' => 2]])?>"><?=$tk_chuyenca->values()->pluck('ca_chuyen')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['chuyenca_filter' => 3]])?>"><?=$tk_chuyenca->values()->pluck('ca_phcd')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh'])?>"><?=$tk_chuyenca->values()->pluck('total')->sum()?></a></td>
        </tr>
        </tfoot>
    </table>
</div>
<div class="card">
    <table class="table">
        <thead>
        <tr>
            <th><?=role('admin') ? 'Quận/huyện' : (role('quan') ? 'Phường/xã' : 'Khu phố')?></th>
            <th>Đã điều tra</th>
            <th>Đang điều tra</th>
            <th>Chưa xuất viện</th>
            <th>Chưa điều tra</th>
            <th>Tổng</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tk_dieutra as $ma => $item):?>
            <tr>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => [$item['field'] => $ma]])?>"><?=data_get($item, 'ten')?></a></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['xmcabenh' => 3,$item['field'] => $ma]])?>"><?=data_get($item, 'dadt')?></a></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['xmcabenh' => 1,$item['field'] => $ma]])?>"><?=data_get($item, 'dangdt')?></a></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['xmcabenh' => 2,$item['field'] => $ma]])?>"><?=data_get($item, 'chuaxv')?></a></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['xmcabenh' => 0,$item['field'] => $ma]])?>"><?=data_get($item, 'chuadt')?></a></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => [$item['field'] => $ma]])?>"><?=data_get($item, 'total')?></a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot>
        <tr>
        <tr>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh'])?>">Tổng</a></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['xmcabenh' => 3]])?>"><?=$tk_dieutra->values()->pluck('dadt')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['xmcabenh' => 1]])?>"><?=$tk_dieutra->values()->pluck('dangdt')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['xmcabenh' => 2]])?>"><?=$tk_dieutra->values()->pluck('chuaxv')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['xmcabenh' => 0]])?>"><?=$tk_dieutra->values()->pluck('chuadt')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh'])?>"><?=$tk_dieutra->values()->pluck('total')->sum()?></a></td>
        </tr>
        </tfoot>
    </table>
</div>
<div class="card-body">
    <table class="table">
        <thead>
        <tr>
            <th><?=role('admin') ? 'Quận/huyện' : (role('quan') ? 'Phường/xã' : 'Khu phố')?></th>
            <th>Có địa chỉ - Có bệnh nhân	</th>
            <th>Có địa chỉ - Không bệnh nhân</th>
            <th>Không địa chỉ - Không bệnh nhân	</th>
            <th>Tổng</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tk_xacminh as $ma => $item):?>
            <tr>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge([$item['field'] => $ma], $params)])?>"><?=data_get($item, 'ten')? : 'Không rõ'?></a></td>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['group_xm' => 1, $item['field'] => $ma], $params)])?>"><?=data_get($item, 'cdc_cbn')?></a></td>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['group_xm' => 2, $item['field'] => $ma], $params)])?>"><?=data_get($item, 'cdc_kbn')?></a></td>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['group_xm' => 3, $item['field'] => $ma], $params)])?>"><?=data_get($item, 'kdc_kbn')?></a></td>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge([$item['field'] => $ma], $params)])?>"><?=data_get($item, 'total')?></a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot>
        <tr class="table-active table-border-double">
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh'])?>">Tổng</a></td>
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['xmcb' => 1]])?>"><?=$tk_xacminh->values()->pluck('cdc_cbn')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['xmcb' => 2]])?>"><?=$tk_xacminh->values()->pluck('cdc_kbn')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['xmcb' => 3]])?>"><?=$tk_xacminh->values()->pluck('kdc_kbn')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh'])?>"><?=$tk_xacminh->values()->pluck('total')->sum()?></a></td>
        </tr>
        </tfoot>
    </table>
</div>
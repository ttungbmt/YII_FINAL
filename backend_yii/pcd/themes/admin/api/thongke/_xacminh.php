<div class="card-body">
    <table id="tb-xm" class="table">
        <thead>
        <tr>
            <th><?=$field['label']?></th>
            <th>Có địa chỉ - Có bệnh nhân	</th>
            <th>Có địa chỉ - Không bệnh nhân</th>
            <th>Không địa chỉ - Không bệnh nhân	</th>
            <th>Tổng</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tk_xacminh as $ma => $item):?>
            <tr>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge([$field['code'] => $item['code']], $params)])?>"><?=data_get($item, 'name')? : 'Không rõ'?></a></td>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['group_xm' => 1, $field['code'] => $item['code']], $params)])?>"><?=$cdc_cbn = data_get($item, 'cdc_cbn')??0?></a></td>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['group_xm' => 2, $field['code'] => $item['code']], $params)])?>"><?=$cdc_kbn = data_get($item, 'cdc_kbn')??0?></a></td>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['group_xm' => 3, $field['code'] => $item['code']], $params)])?>"><?=$kdc_kbn = data_get($item, 'kdc_kbn')??0?></a></td>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge([$field['code'] => $item['code']], $params)])?>"><?=$cdc_cbn+$cdc_kbn+$kdc_kbn?></a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot>
        <tr class="table-active table-border-double">
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh'])?>">Tổng</a></td>
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['group_xm' => 1], $params)])?>"><?=$total_cdc_cbn = $tk_xacminh->values()->pluck('cdc_cbn')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['group_xm' => 2], $params)])?>"><?=$total_cdc_kbn = $tk_xacminh->values()->pluck('cdc_kbn')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['group_xm' => 3], $params)])?>"><?=$total_kdc_kbn = $tk_xacminh->values()->pluck('kdc_kbn')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh'])?>"><?=$total_cdc_cbn+$total_cdc_kbn+$total_kdc_kbn?></a></td>
        </tr>
        </tfoot>
    </table>
    <div class="text-center mt-2">
        <a class="btn btn-link" download="TkXacMinh.xls" href="#" onclick="return ExcellentExport.excel(this, 'tb-xm');">Xuất excel</a>
    </div>
</div>
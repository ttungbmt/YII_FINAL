<div class="card">
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
        <?php foreach ($tk_dc_bn as $ma => $item):?>
            <tr>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => [$item['field'] => $ma]])?>"><?=data_get($item, 'ten')?></a></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['cdc_cbn_sxh' => 1, 'cdc_cbn_ksxh' => 1,$item['field'] => $ma]])?>"><?=data_get($item, 'cdc_cbn')?></a></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['cdc_kbn_pxk' => 1, 'cdc_kbn_qhk' => 1, 'cdc_kbn_tk' => 1,$item['field'] => $ma]])?>"><?=data_get($item, 'cdc_kbn')?></a></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['kdc_pxk' => 1, 'kdc_qhk' => 1, 'kdc_tk' => 1,$item['field'] => $ma]])?>"><?=data_get($item, 'kdc_kbn')?></a></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => [$item['field'] => $ma]])?>"><?=data_get($item, 'total')?></a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot>
        <tr>
        <tr>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh'])?>">Tổng</a></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['cdc_cbn_sxh' => 1, 'cdc_cbn_ksxh' => 1]])?>"><?=$tk_dc_bn->values()->pluck('cdc_cbn')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['cdc_kbn_pxk' => 1, 'cdc_kbn_qhk' => 1, 'cdc_kbn_tk' => 1]])?>"><?=$tk_dc_bn->values()->pluck('cdc_kbn')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['kdc_pxk' => 1, 'kdc_qhk' => 1, 'kdc_tk' => 1]])?>"><?=$tk_dc_bn->values()->pluck('kdc_kbn')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh'])?>"><?=$tk_dc_bn->values()->pluck('total')->sum()?></a></td>
        </tr>
        </tfoot>
    </table>
</div>
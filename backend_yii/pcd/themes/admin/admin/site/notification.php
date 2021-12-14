<?php
$dieutra = [
    0 => 'Chưa điều tra',
    1 => 'Đang điều tra',
    2 => 'Chưa xuất viện',
    3 => 'Đã điều tra',
];

$dc_bn = [
    'cdc_cbn' => 'Có địa chỉ - Có bệnh nhân',
    'cdc_kbn' => 'Có địa chỉ - Không bệnh nhân',
    'kdc_kbn' => 'Không địa chỉ - Không bệnh nhân',
];

$chuyenca = [
    0 => 'Ca thành phố',
    1 => 'Ca nhận',
    2 => 'Ca trả về',
    3 => 'Ca PHCĐ',
];

?>

<div class="card">
    <table class="table">
        <thead>
        <tr>
            <th>Trạng thái</th>
            <th>Số ca bệnh</th>
            <th>Ghi chú</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tk_dieutra as $item):?>
            <tr>
                <td>
                    <?=data_get($dieutra,$item['xmcabenh'])?>
                </td>
                <td><?=data_get($item, 'count')?></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['xmcabenh' => $item['xmcabenh']]])?>">Chi tiết</a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot>
        <tr>
            <td>TỔNG</td>
            <td><?=$tk_dieutra->pluck('count')->sum()?></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh'])?>">Chi tiết</a></td>
        </tr>
        </tfoot>
    </table>
</div>
<div class="card">
    <table class="table">
        <thead>
        <tr>
            <th>Trạng thái</th>
            <th>Số ca bệnh</th>
            <th>Ghi chú</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tk_dc_bn as $k => $item):?>
            <tr>
                <td>
                    <?=data_get($dc_bn, $k)?>
                </td>
                <td>
                    <?php if($k=='cdc_cbn'):?>
                        <?=($tk_dieutra->pluck('count')->sum() - data_get($tk_dieutra, '0.count')) - (data_get($tk_dc_bn, 1)+data_get($tk_dc_bn, 2))?>
                    <?php else: ?>
                        <?=$item?>
                    <?php endif; ?>
                </td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['dc_bn_type' => $k]])?>">Chi tiết</a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot>
        <tr>
            <td>TỔNG</td>
            <td>
                <?php echo ($tk_dieutra->pluck('count')->sum() - data_get($tk_dieutra, 'count'))?>
                <?php //echo $tk_dc_bn->sum()?>
            </td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['dc_bn_type' => 'tong']])?>">Chi tiết</a></td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="card">
    <table class="table">
        <thead>
        <tr>
            <th>Trạng thái</th>
            <th>Số ca bệnh</th>
            <th>Ghi chú</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tk_chuyenca as $item):?>
            <tr>
                <td>
                    <?=data_get($chuyenca, $item['chuyenca_filter'])?>
                </td>
                <td><?=data_get($item, 'count')?></td>
                <td><a target="_blank" href="<?=url(['/dieutra/sxh', 'SXHSearch' => ['chuyenca_filter' => $item['chuyenca_filter']]])?>">Chi tiết</a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot>
        <tr>
            <td>TỔNG</td>
            <td><?=$tk_chuyenca->pluck('count')->sum()?></td>
            <td><a target="_blank" href="<?=url(['/dieutra/sxh'])?>">Chi tiết</a></td>
        </tr>
        </tfoot>
    </table>
</div>



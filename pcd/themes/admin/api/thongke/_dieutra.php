<div class="card-body">
    <table id="tb-dt" class="table">
        <thead>
        <tr>
            <th><?= $field['label'] ?></th>
            <th>Đã điều tra</th>
            <th>Đang điều tra</th>
            <th>Chưa xuất viện</th>
            <th>Chưa điều tra</th>
            <th>Tổng</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tk_dieutra as $ma => $item): ?>
            <tr>
                <td><a target="_blank"
                       href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge([$item['code'] => $ma], $params)]) ?>"><?= data_get($item, 'name') ?: 'Không rõ' ?></a>
                </td>
                <td><a target="_blank"
                       href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['loaidieutra' => 3, $item['code'] => $ma], $params)]) ?>"><?= $da_dt = data_get($item, 'da_dt') ?? 0 ?></a>
                </td>
                <td><a target="_blank"
                       href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['loaidieutra' => 1, $item['code'] => $ma], $params)]) ?>"><?= $dang_dt = data_get($item, 'dang_dt') ?? 0 ?></a>
                </td>
                <td><a target="_blank"
                       href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['loaidieutra' => 2, $item['code'] => $ma], $params)]) ?>"><?= $chua_xv = data_get($item, 'chua_xv') ?? 0 ?></a>
                </td>
                <td><a target="_blank"
                       href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['loaidieutra' => 0, $item['code'] => $ma], $params)]) ?>"><?= $chua_dt = data_get($item, 'chua_dt') ?? 0 ?></a>
                </td>
                <td><a target="_blank"
                       href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge([$item['code'] => $ma], $params)]) ?>"><?= $da_dt+$dang_dt+$chua_xv+$chua_dt ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr class="table-active table-border-double">
            <td><a target="_blank" href="<?= url(['/admin/cabenh-sxh']) ?>">Tổng</a></td>
            <td><a target="_blank"
                   href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['loaidieutra' => 3], $params)]) ?>"><?= $total_da_dt = $tk_dieutra->values()->pluck('da_dt')->sum() ?></a>
            </td>
            <td><a target="_blank"
                   href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['loaidieutra' => 1], $params)]) ?>"><?= $total_dang_dt = $tk_dieutra->values()->pluck('dang_dt')->sum() ?></a>
            </td>
            <td><a target="_blank"
                   href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['loaidieutra' => 2], $params)]) ?>"><?= $total_chua_xv = $tk_dieutra->values()->pluck('chua_xv')->sum() ?></a>
            </td>
            <td><a target="_blank"
                   href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['loaidieutra' => 0], $params)]) ?>"><?= $total_chua_dt = $tk_dieutra->values()->pluck('chua_dt')->sum() ?></a>
            </td>
            <td><a target="_blank"
                   href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => $params]) ?>"><?= $total_da_dt+$total_dang_dt+$total_chua_xv+$total_chua_dt?></a></td>
        </tr>
        </tfoot>
    </table>
    <div class="text-center mt-2">
        <a class="btn btn-link" download="TkXacMinh.xls" href="#" onclick="return ExcellentExport.excel(this, 'tb-dt');">Xuất excel</a>
    </div>
</div>
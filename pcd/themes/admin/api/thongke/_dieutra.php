<div class="card-body">
    <table class="table">
        <thead>
        <tr>
            <th><?= role('admin') ? 'Quận/huyện' : (role('quan') ? 'Phường/xã' : 'Khu phố') ?></th>
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
                       href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['excepted_tv' => 1, $item['field'] => $ma], $params)]) ?>"><?= data_get($item, 'ten') ?: 'Không rõ' ?></a>
                </td>
                <td><a target="_blank"
                       href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['excepted_tv' => 1, 'loaidieutra' => 3, $item['field'] => $ma], $params)]) ?>"><?= data_get($item, 'da_dt') ?></a>
                </td>
                <td><a target="_blank"
                       href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['excepted_tv' => 1, 'loaidieutra' => 1, $item['field'] => $ma], $params)]) ?>"><?= data_get($item, 'dang_dt') ?></a>
                </td>
                <td><a target="_blank"
                       href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['excepted_tv' => 1, 'loaidieutra' => 2, $item['field'] => $ma], $params)]) ?>"><?= data_get($item, 'chua_xv') ?></a>
                </td>
                <td><a target="_blank"
                       href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['excepted_tv' => 1, 'loaidieutra' => 0, $item['field'] => $ma], $params)]) ?>"><?= data_get($item, 'chua_dt') ?></a>
                </td>
                <td><a target="_blank"
                       href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => array_merge(['excepted_tv' => 1, $item['field'] => $ma], $params)]) ?>"><?= data_get($item, 'total') ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr class="table-active table-border-double">
            <td><a target="_blank" href="<?= url(['/admin/cabenh-sxh']) ?>">Tổng</a></td>
            <td><a target="_blank"
                   href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['excepted_tv' => 1, 'loaidieutra' => 3]]) ?>"><?= $tk_dieutra->values()->pluck('da_dt')->sum() ?></a>
            </td>
            <td><a target="_blank"
                   href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['excepted_tv' => 1, 'loaidieutra' => 1]]) ?>"><?= $tk_dieutra->values()->pluck('dang_dt')->sum() ?></a>
            </td>
            <td><a target="_blank"
                   href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['excepted_tv' => 1, 'loaidieutra' => 2]]) ?>"><?= $tk_dieutra->values()->pluck('chua_xv')->sum() ?></a>
            </td>
            <td><a target="_blank"
                   href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['excepted_tv' => 1, 'loaidieutra' => 0]]) ?>"><?= $tk_dieutra->values()->pluck('chua_dt')->sum() ?></a>
            </td>
            <td><a target="_blank"
                   href="<?= url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['excepted_tv' => 1]]) ?>"><?= $tk_dieutra->values()->pluck('total')->sum() ?></a></td>
        </tr>
        </tfoot>
    </table>
</div>
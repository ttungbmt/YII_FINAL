<div class="card-body">
    <table id="tb-cc" class="table">
        <thead>
        <tr>
            <th><?= $field['label'] ?></th>
            <th>Ca chuyển</th>
            <th>Ca nhận</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tk_chuyenca as $ma => $item):?>
            <tr>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => [$item['code'] => $ma]])?>"><?=data_get($item, 'name')? : 'Không rõ'?></a></td>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 2, $item['code'] => $ma]])?>"><?=$chuyen = data_get($item, 'chuyen')??0?></a></td>
                <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 3, $item['code'] => $ma]])?>"><?=$nhan = data_get($item, 'nhan')??0?></a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot>
        <tr class="table-active table-border-double">
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh'])?>">Tổng</a></td>
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 2]])?>"><?=$tk_chuyenca->values()->pluck('chuyen')->sum()?></a></td>
            <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 3]])?>"><?=$tk_chuyenca->values()->pluck('nhan')->sum()?></a></td>
        </tr>
        </tfoot>
    </table>
    <div class="text-center mt-2">
        <a class="btn btn-link" download="TkXacMinh.xls" href="#" onclick="return ExcellentExport.excel(this, 'tb-cc');">Xuất excel</a>
    </div>
</div>
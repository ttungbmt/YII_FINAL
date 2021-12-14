<table class="table table-bordered" style="min-width: 520px">
    <thead style="background: white">
    <tr>
        <th style="min-width: 56px">#</th>
        <th style="min-width: 130px">Tên điểm</th>
        <th style="min-width: 130px">Loại hình</th>
        <th style="width: 64px">Khu phố</th>
        <th style="width: 57px">Tổ</th>
        <th style="min-width: 85px">Địa chỉ</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($models as $k => $m):?>
        <tr>
            <td>
                <?=$k+1?>
                <input type="hidden" name="OdichSxh[dnc_id][]" value="<?=$m->gid?>">
            </td>
            <td><?=$m->dncText?></td>
            <td><?=$m->loaihinh?></td>
            <td><?=$m->to_dp?></td>
            <td><?=$m->khupho?></td>
            <td><?=$m->diachiText?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php
use yii\helpers\Html;
?>
<table id="tb-cungnha" class="table table-bordered">
    <thead>
        <tr>
            <th>Họ tên</th>
            <th>Ngày mắc bệnh/ nhập viện</th>
            <th>Khoảng cách (m)</th>
            <th>Cùng nhà</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($models as $k => $m):?>
    <?=Html::beginTag('tr', ['data' => ['id' => $m->gid, 'geometry' => $m->toGeometry(), 'hoten' => $m->hoten]])?>
        <td><?=Html::a($m->hoten, ['/admin/cabenh-sxh/update', 'id' => $m->gid], ['target' => '_blank'])?></td>
        <td><?=$m->ngaymacbenh_nv ?></td>
        <td><?=number_format($m->distance, 2) ?></td>
        <td>
            <?=Html::activeRadioList($m, "[{$k}]is_cungnha", [1 => 'Có', 0 => 'Không'])?>
        </td>
    <?=Html::endTag('tr')?>
    <?php endforeach;?>
    </tbody>
</table>
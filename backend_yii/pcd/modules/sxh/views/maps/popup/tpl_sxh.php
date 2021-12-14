<?php
use yii\helpers\Html;
$action = json_encode(['name' => 'addCbToOd', 'params' => [$model->gid]])
?>
<div class="pop-wrapper">
    <div class="pop-title text-uppercase">
        <a href="" target="_blank">
            <div><?=$model->hoten?> (<span class="text-capitalize">Đã điều tra</span>)</div>
        </a>
    </div>
    <div class="pop-body">
        <ul class="list-data mb-10">
            <li><b>Họ tên:</b> <span><?=$model->hoten?></span></li>
            <li><b>Địa chỉ:</b> <span><?=$model->diachi?></span></li>
            <li><b>Khu phố - Tổ:</b> <span><?=$model->khuto_to?></span></li>
            <li><b>Ngày mắc bệnh:</b> <span><?=$model->ngaymacbenh?></span></li>
            <li><b>Ngày xuất viện:</b> <span><?=$model->ngayxuatvien?></span></li>
            <li><b>Ngày báo cáo:</b> <span><?=$model->ngaybaocao?></span></li>
        </ul>
    </div>
    <ul class="list-inline mb-0 mt-1">
        <li class="list-inline-item"><a target="_blank">Chi tiết</a></li>
        <li class="list-inline-item"><?=Html::a('Khoanh vùng', null, [
            'data-react' => '', 'data-action' => $action])?></li>
    </ul>
</div>
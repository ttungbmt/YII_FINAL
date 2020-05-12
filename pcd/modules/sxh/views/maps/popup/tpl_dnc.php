<?php
$model = opt($model);
?>
<div class="pop-wrapper">
    <div class="pop-title text-uppercase">
        <a href="" target="_blank">
            <div><?=$model->ten_cs?></div>
        </a>
    </div>
    <div class="pop-body">
        <ul class="list-data mb-10">
            <li><b>Tên chủ đơn vị/ Người chịu trách nhiệm:</b> <span><?=$model->ten_cs?></span></li>
            <li><b>Địa chỉ:</b> <span><?=$model->diachi?></span></li>
            <li><b>Khu phố - Tổ:</b> <span><?=$model->khuto_to?></span></li>
            <li><b>Nhóm:</b> <span><?=$model->nhom?></span></li>
            <li><b>Loại hình:</b> <span><?=$model->loaihinh?></span></li>
            <li><b>Ngày cập nhật:</b> <span><?=$model->ngaycapnhat?></span></li>
        </ul>
    </div>
    <ul class="list-inline mb-0 mt-1">
        <li class="list-inline-item"><a target="_blank">Chi tiết</a></li>
    </ul>
</div>
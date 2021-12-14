<?php
$role = \pcd\supports\RoleHc::init();
$shownBtn = $model->hasErrors() ? true : $role->showBtnSave($model);
?>

<h6 class="card-title font-weight-semibold text-primary">
    <div class="float-left">
        <i class="icon-map5 position-left"></i> {{m.hoten}}
    </div>
    <div class="float-left limited-text" style="width: 300px">({{diachicuoi}})</div>
    <span v-html="dieutra_badge" class="ml-2"></span>
</h6>
<div class="header-elements">
    <ul class="list-inline mb-0">
        <li class="list-inline-item" v-html="xacminh_cb_badge">
        </li>
        <li class="list-inline-item">
            <a href="#" class="btn badge bg-success" @click="checkOdich">Kiểm tra OD</a>
        </li>
        <?php if($shownBtn || $model->isNewRecord):?>
            <li class="list-inline-item" v-html="btn_save"></li>
        <?php endif;?>
    </ul>
</div>


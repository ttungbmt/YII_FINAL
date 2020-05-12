<?php

use yii\widgets\DetailView;
?>
<div class="card">
    <div class="card-body">
        <div class="pt-nguyco-view">

            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                        'gid',
            'geom',
            'maso',
            'ten_cs',
            'sonha',
            'tenduong',
            'khupho',
            'to_dp',
            'maphuong',
            'maquan',
            'nhom',
            'loaihinh',
            'tochuc_gs',
            'ngaycapnhat',
            'ngayxoa',
            'ghichu',
            'phancap_ql',
            'thuchien',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            ],
            ]) ?>
        </div>
    </div>
</div>


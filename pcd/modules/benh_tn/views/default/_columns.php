<?php

return [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'class' => 'kartik\grid\ActionColumn',
        'visibleButtons' => [
            'delete'   => function ($model) {
                return role('admin');
            },
            'update'   => function ($model) {
                return role('admin');
            },
        ],
    ],
    'chuandoan_bd',
    'hoten',
    'phai',
    'tuoi',
    'diachi',
    //'nghenghiep',
    //'me',
    //'dienthoai',
    'maquan',
    'maphuong',
    'ngaynhapvien',
    //'ngaybaocao',
    //'nam_nv',
    //'thang_nv',
    //'tuan_nv',
    //'nam_bc',
    //'thang_bc',
    //'tuan_bc',
    'hinhthuc_dt',

];
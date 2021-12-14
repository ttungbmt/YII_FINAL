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
    'maquan',
    'maphuong',
    'ngaynhapvien',
    'hinhthuc_dt',
];
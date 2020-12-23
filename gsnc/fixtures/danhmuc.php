<?php

$data['dm_thoigian'] = [
    '6 THANG' => '6 tháng',
    '1 NAM' => '1 năm'
];
$data['dm_yesno'] = [1 => 'Có', 2 => 'Không'];
$data['dm_yesno_qd'] = [1 => 'Đầy đủ theo quy định', 2 => 'Không đầy đủ theo quy định'];
$data['dm_yesno_qd1'] = [1 => 'Đúng quy định', 2 => 'Không đúng quy định'];
$data['dm_tanggiam'] = [1 => 'Tăng', 2 => 'Giảm', 3 => 'Bằng'];
$data['dm_chitieu_kd'] = [
    1 => 'pH',
    2 => 'Độ đục (NTU)',
    3 => 'Clo dư (mg/l)',
    4 => 'Clorua (mg/l)',
    5 => 'Nitrit (mg/l)',
    6 => 'Nitrat (mg/l)',
    7 => 'Sulphat (mg/l)',
    8 => 'Độ cứng, tính theo CaCO3 (mg/l)',
    9 => 'Pec (mg/l)',
    10 => 'Fe tổng (mg/l)',
    11 => 'Mn tổng (mg/l)',
    12 => 'Màu (TCU)',
    13 => 'Mùi, vị Không có mùi, vị lạ',
    14 => 'Coli tổng vk/100ml',
    15 => 'Ecoli vk/100ml',
];

$data['nav_links'] = [
    [
        'path' => '/maps',
        'name' => 'Bản đồ',
        'icon' => 'icon-map5',
    ],
    [
        'path' => '/admin',
        'name' => 'Quản lý dữ liệu',
        'icon' => 'icon-clipboard3',
        'attrs' =>
            [
                'target' => '_blank',
            ],
    ],
    [
        'path' => '/maps/heatmap',
        'name' => 'Heatmap',
        'icon' => 'icon-lifebuoy',
    ],
];

$data['layer_keys'] = [
    'maunc' => 'maunc',
    'poi_benhvien' => 'poi_benhvien',
    'poi_thugomrac' => 'poi_thugomrac',
    'vt_khaosat' => 'vt_khaosat',
    'vt_onhiem' => 'vt_onhiem',
    'mangluoinuoc' => 'mangluoinuoc',
];

$actionLink = function ($params){return array_merge(['component' => 'link-field', 'icon' => 'fal fa-info-circle', 'target' => '_blank', 'text' => 'Chi tiết'], $params);};

$data['layer_tree'] = [
    [
        'title' => 'Địa hình',
        'key' => 'diahinh',
        'folder' => true,
        'children' => [
            [
                'type' => 'wms',
                'title' => 'Quận huyện',
                'key' => 'pg_ranhquan',
                'source' => [
                    'url' => '/geoserver/ows?',
                    'params' => [
                        'layers' => 'dichte:dm_quan',
                    ]
                ],
            ],
            [
                'type' => 'wms',
                'title' => 'Phường xã',
                'key' => 'dm_phuong_vn',
                'source' => [
                    'url' => '/geoserver/ows?',
                    'params' => [
                        'layers' => 'dichte:dm_phuong',
                    ]
                ],
            ],
        ],
    ],
    [
        'title' => 'GSNC',
        'key' => 'gsnc',
        'folder' => true,
        'expanded' => true,
        'children' => [
            [
                'type' => 'wms',
                'title' => 'Mẫu nước',
                'id' => 'maunc',
                'key' => 'maunc',
                'source' => [
                    'url' => '/geoserver/ows?',
                    'params' => [
                        'layers' => 'gsnc:v_maunc',
                    ],
                    'zIndex' => 30,
                ],
                'selected' => true,
                'popup' => [
                    'heading' => '#{{mamau}} {{loaimau}}',
                    'fields' => [
                        'loaimau',
                        'diachi',
                        ['component' => 'date-field', 'attribute' => 'ngaylaymau', 'format' => 'dd.mm.yyyy', 'template' => '<span class="font-bold">Ngày lấy mẫu:</span><span class="pl-3">{{value}}</span>'],
                        ['component' => 'html-field', 'url' => '/api/map/get-tb-chitieu'],
                    ],
                    'attributeLabels' => [
                        'loaimau' => 'Loại mẫu',
                        'diachi' => 'Địa chỉ',
                        'ngaylaymau' => 'Ngày lấy mẫu',
                    ],
                    'actions' => [
                        $actionLink(['url' => '/admin/maunc/update?id={{gid}}'])
                    ]
                ]
            ],
            [
                'type' => 'wms',
                'title' => 'Vị trí khảo sát',
                'key' => 'vt_khaosat',
                'selected' => false,
                'source' => [
                    'url' => '/geoserver/ows?',
                    'params' => [
                        'layers' => 'gsnc:v_vt_khaosat',
                    ],
                    'zIndex' => 20
                ],
                'popup' => [
                    'heading' => '#{{gid}} {{tenchuho}}',
                    'fields' => ['tenchuho', 'ngaykhaosat', 'ngaylaymau', 'diachi', 'tenphuong', 'tenquan',],
                    'attributeLabels' => [
                        'tenchuho' => 'Tên chủ hộ',
                        'ngaykhaosat' => 'Ngày khảo sát',
                        'ngaylaymau' => 'Ngày lấy mẫu',
                        'diachi' => 'Địa chỉ',
                        'tenphuong' => 'Tên phường',
                        'tenquan' => 'Tên quận',
                    ],
                    'actions' => [
                        $actionLink(['url' => '/admin/vt-khaosat/update?id={{gid}}']),
                    ]
                ]
            ],
        ],
    ],
    [
        'title' => 'Khác',
        'key' => 'other',
        'folder' => true,
        'expanded' => true,
        'children' => [
            [
                'type' => 'wms',
                'title' => 'Mạng lưới nước',
                'key' => 'mangluoinuoc',
                'source' => [
                    'url' => '/geoserver/ows?',
                    'params' => [
                        'layers' => 'gsnc:mangluoinuoc',
                    ]
                ],
            ],
            [
                'type' => 'wms',
                'title' => 'Vị trí ô nhiễm',
                'key' => 'vt_onhiem',
                'source' => [
                    'url' => '/geoserver/ows?',
                    'params' => [
                        'layers' => 'gsnc:v_vt_onhiem',
                    ]
                ],
            ],
            [
                'type' => 'wms',
                'title' => 'Điểm thu gom rác',
                'key' => 'poi_thugomrac',
                'source' => [
                    'url' => '/geoserver/ows?',
                    'layers' => 'gsnc:poi_thugomrac',
                ],
                'popup' => [
                    'heading' => '{{ten}}',
                    'fields' => ['diachi'],
                    'attributeLabels' => [
                        'ten' => 'Tên',
                        'diachi' => 'Địa chỉ'
                    ],
                    'actions' => [
                    ]
                ],
                'selected' => false,
            ],
            [
                'type' => 'wms',
                'title' => 'Nước thải bệnh viện',
                'key' => 'poi_benhvien',
                'source' => [
                    'url' => '/geoserver/ows?',
                    'params' => [
                        'layers' => 'gsnc:poi_benhvien',
                    ]
                ],
                'popup' => [
                    'heading' => '{{ten}}',
                    'fields' => ['loaibv', 'diachi'],
                    'attributeLabels' => [
                        'ten' => 'Tên',
                        'diachi' => 'Địa chỉ',
                        'loaibv' => 'Loại bệnh viện',
                    ],
                    'actions' => [
                        $actionLink(['url' => '/admin/poi-benhvien/update?id={{gid}}']),
                    ]
                ],
                'selected' => false,
            ],

            [
                'type' => 'wms',
                'title' => 'IDW PHP',
                'key' => 'idw',
                'source' => [
                    'url' => '/geogis/pcd/ows?',
                    'params' => [
                        'layers' => 'pcd:idw_php',
                    ]
                ],
                'popup' => [
                    'heading' => 'Chỉ tiêu nội suy PHP',
                    'fields' => ['GRAY_INDEX'],
                    'attributeLabels' => [
                        'GRAY_INDEX' => 'Giá trị',
                    ],
                ],
            ],
        ],
    ],


];


return $data;
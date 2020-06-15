<?php

$data['dm_thoigian'] = [
    '6 THANG' => '6 tháng',
    '1 NAM' => '1 năm'
];
$data['dm_yesno'] = [1 => 'Có', 2 => 'Không'];
$data['dm_yesno_qd'] = [1 => 'Đẩy đủ theo quy định', 2 => 'Không đầy đủ theo quy định'];
$data['dm_yesno_qd1'] = [1 => 'Đúng quy định', 2 => 'Không đúng quy định'];
$data['dm_tanggiam'] = [1 => 'Tăng', 2 => 'Giảm', 3 => 'Bằng'];
$data['dm_chitieu_kdat'] = [
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
        'path'  => '/admin',
        'name'  => 'Quản lý dữ liệu',
        'icon'  => 'icon-clipboard3',
        'attrs' =>
            [
                'target' => '_blank',
            ],
    ],
    [
        'path'  => '/maps/heatmap',
        'name'  => 'Heatmap',
        'icon'  => 'icon-lifebuoy',
    ],
];

$data['layer_keys'] = [
    'maunc'         => 'maunc',
    'poi_benhvien'  => 'poi_benhvien',
    'poi_thugomrac' => 'poi_thugomrac',
    'vt_khaosat'    => 'vt_khaosat',
    'vt_onhiem'   => 'vt_onhiem',
    'mangluoinuoc'  => 'mangluoinuoc',
];

$data['layer_tree'] = [
    [
        'title'    => 'Địa hình',
        'key'      => 'diahinh',
        'folder'   => true,
        'children' => [
            [
                'title'     => 'Quận huyện',
                'key'       => 'pg_ranhquan',
                'component' => [
                    'url'    => '/geoserver/ows?',
                    'layers' => 'dichte:dm_quan',
                ],
            ],
            [
                'title'     => 'Phường xã',
                'key'       => 'dm_phuong_vn',
                'component' => [
                    'url'    => '/geoserver/ows?',
                    'layers' => 'dichte:dm_phuong',
                ],
            ],
        ],
    ],
    [
        'title'     => 'Mạng lưới nước',
        'key'       => 'mangluoinuoc',
        'component' => [
            'url'    => '/geoserver/ows?',
            'layers' => 'gsnc:mangluoinuoc',
        ],
    ],
    [
        'title'     => 'Mẫu nước',
        'key'       => 'maunc',
        'checked'   => true,
        'component' => [
            'url'    => '/geoserver/ows?',
            'layers' => 'gsnc:v_maunc',
        ],
        'selected'  => true
    ],
    [
        'title'     => 'Vị trí khảo sát',
        'key'       => 'vt_khaosat',
        'component' => [
            'url'    => '/geoserver/ows?',
            'layers' => 'gsnc:v_vt_khaosat',
        ],
    ],
    [
        'title'     => 'Vị trí ô nhiễm',
        'key'       => 'vt_onhiem',
        'component' => [
            'url'    => '/geoserver/ows?',
            'layers' => 'gsnc:v_vt_onhiem',
        ],
    ],
    [
        'title'     => 'Điểm thu gom rác',
        'key'       => 'poi_thugomrac',
        'component' => [
            'url'    => '/geoserver/ows?',
            'layers' => 'gsnc:poi_thugomrac',
        ],
    ],
    [
        'title'     => 'Nước thải bệnh viện',
        'key'       => 'poi_benhvien',
        'component' => [
            'url'    => '/geoserver/ows?',
            'layers' => 'gsnc:poi_benhvien',
        ],
    ],
];


return $data;
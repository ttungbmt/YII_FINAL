<?php
$data = [];

$data['nav_links'] = [
    [
        'path' => '/maps',
        'name' => 'Trang chủ',
        'icon' => 'icon-home4',
    ],
    [
        'path' => '/maps/odich',
        'name' => 'Ổ dịch',
        'icon' => 'icon-stats-bars ',
    ],
    [
        'path' => '/admin/cabenh-sxh',
        'name' => 'Ca bệnh',
        'icon' => 'icon-brain',
        'attrs' =>
            [
                'target' => '_blank',
            ],
    ],
    [
        'path' => '/maps/choropleth',
        'name' => 'Bản đồ',
        'icon' => 'icon-map5 ',
    ],
];

$data['dm_loaidieutra'] = [
    0 => 'Chưa điều tra',
    1 => 'Đang điều tra',
    2 => 'Chưa xuất viện',
    3 => 'Đã điều tra',
];

$data['dm_xuatvien'] = [
    1 => 'Đã xuất viện',
    0 => 'Chưa xuất viện',
    9 => 'Không rõ',
];

$data['dm_loaicabenh'] = [
    0 => 'Ca TP',
    1 => 'Ca nhận',
    2 => 'Ca trả về',
    3 => 'Ca PHCĐ',
];

$data['dm_loaibaocao'] = [
    1 => 'Nhập viện',
];

$data['dm_phai'] = [
    'T' => 'Trai',
    'G' => 'Gái',
];

$data['dm_chuandoan'] = [
    1 => 'Bệnh SXH',
    2 => 'Sốt/Nhiễm siêu vi/Nghi ngờ sốt xuất huyết',
    3 => 'Bệnh khác',
];

$data['dm_ht_dieutri'] = [
    1 => 'Nội trú',
    0 => 'Ngoại trú',
];

$data['dm_loai_xn'] = [1 => 'PCR', 2 => 'MAC-ELISA', 3 => 'TEST NHANH', 4 => 'KHAC'];

$data['dm_kq_xn'] = [1 => 'Dương tính', 2 => 'Âm tính', 3 => 'KHAC'];

$data['dm_xacminh_cb'] = [
    // Không địa chỉ - không bn
    1 => 'Không địa chỉ tại px, địa chỉ ở PX khác trong QH',
    2 => 'Không địa chỉ tại px, địa chỉ ở QH khác',
    3 => 'Không tìm được địa chỉ',
    // Có địa chỉ - không BN
    4 => 'Có địa chỉ, không BN, ca bệnh ở PX khác trong QH',
    5 => 'Ca bệnh ở QH khác',
    6 => 'Ca bệnh ở tỉnh khác/ không biết',
    // Có địa chỉ có BN
    7 => 'Có địa chỉ, có bệnh nhân, không SXH',
    8 => 'Có địa chỉ, có bệnh nhân, SXH',
];

$data['dm_loaiodich'] = [
    1 => 'Ổ dịch',
    4 => 'Ổ dịch diện rộng',
];

$data['dm_mucdich_gs'] = [
    1 => 'Giám sát định kỳ',
    2 => 'Giám sát ổ dịch',
    3 => 'Tái giám sát',
    4 => 'Giám sát đột xuất',
];


return $data;
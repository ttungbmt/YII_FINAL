<?php

use Carbon\Carbon;
use pcd\supports\RoleHc;
use ttungbmt\map\Map;

$isQuan = role('quan');
$role = RoleHc::init();
$_3mAgo = 'ngaymacbenh_nv >= ' . (Carbon::now())->subMonths(3)->format('Y-m-d');
$fn_cql = function ($cql = '', $hc = null) use ($role) {
    return $role->getGapranhCQL($cql, $hc);
};
$center = [10.804476, 106.639384];
if(userInfo()->maphuong){
    $geometry = \pcd\models\HcPhuong::find()->select('ST_AsGeoJSON(ST_Centroid(geom)) geometry')->asArray()->one();
    $center = array_reverse(json_decode(data_get($geometry, 'geometry'))->coordinates);
}

?>
<?= Map::widget([
    'model'         => $model,
    'center'        => [10.740021, 106.665598],
    'pluginOptions' => [
        'overlay_add' => [
            [
                "title"     => "Quận huyện",
                "key"       => "pg_ranhquan",
                "onControl" => true,
                "selected"  => $isQuan,
                "component" => [
                    "url"        => "/geoserver/ows?",
                    "layers"     => "dichte:hc_quan",
                    "cql_filter" => $fn_cql('', 'quan')
                ],
            ],
            [
                "title"     => "Phường xã",
                "key"       => "dm_phuong_vn",
                "onControl" => true,
                "selected"  => role('phuong'),
                "component" => [
                    "url"        => "/geoserver/ows?",
                    "layers"     => "dichte:hc_phuong",
                    "cql_filter" => $fn_cql('', 'phuong')
                ],
            ],
            [
                "title"     => "Ranh tổ",
                "key"       => "pg_ranhto",
                "onControl" => true,
                "component" => [
                    "url"        => "/geoserver/ows?",
                    "layers"     => "hcm_map:pg_ranhto",
                    "cql_filter" => $fn_cql()
                ],
            ],
        ],
    ]
]) ?>
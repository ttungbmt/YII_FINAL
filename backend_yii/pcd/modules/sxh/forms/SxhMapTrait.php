<?php
namespace pcd\modules\sxh\forms;

use pcd\supports\RoleHc;

trait SxhMapTrait {
    public function getMap(){
        $role = RoleHc::init();
        $fn_cql = function ($cql = '', $hc = null) use ($role) {
            return $role->getGapranhCQL($cql, $hc);
        };

        $center = [10.765245, 106.667372];
        $latlng = [];

        if($this->lat && $this->lng){
            $latlng = [$this->lat, $this->lng];
        } else {
            if(role('phuong')){
                $geometry = \pcd\models\HcPhuong::find()->select('ST_AsGeoJSON(ST_Centroid(geom)) geometry')->andWhere(['maphuong' => userInfo()->maphuong])->asArray()->one();
                $center = $geometry ? array_reverse(json_decode(data_get($geometry, 'geometry'))->coordinates) : [];
            } elseif (role('quan')){
                $geometry = \pcd\models\HcQuan::find()->select('ST_AsGeoJSON(ST_Centroid(geom)) geometry')->andWhere(['maquan' => userInfo()->maquan])->asArray()->one();
                $center = $geometry ?  array_reverse(json_decode(data_get($geometry, 'geometry'))->coordinates) : [];
            }
        }

        return [
            'marker' => [
                'latlng' => $latlng
            ],
            'mapOptions' => [
                'center' => $center
            ],
            'layers' => [
                [
                    'type'      => 'base',
                    'title'     => 'HCMGIS',
                    'component' => [
                        'name'   => 'WMSTileLayer',
                        'url'    => 'https://pcd.hcmgis.vn/geoserver/gwc/service/wms',
                        'layers' => 'hcm_map:hcm_map_all'
                    ]
                ],
                [
                    'type'      => 'base',
                    'title'     => 'Google',
                    'checked'   => true,
                    'component' => [
                        'name'  => 'GoogleLayer',
                        'type'  => 'roadmap',
                        'tiled' => true
                    ]
                ],
                [
                    'type'      => 'base',
                    'title'     => 'Mapbox',
                    'component' => [
                        'name'        => 'TileLayer',
                        'map'         => 'mapbox.streets',
                        'url'         => 'https://api.tiles.mapbox.com/v4/{map}/{z}/{x}/{y}.png?access_token={accessToken}',
                        'accessToken' => 'pk.eyJ1IjoidHR1bmdibXQiLCJhIjoiY2EzNDFhZjU4ZThkNzY5NTU3M2U1YWFiNmY4OTE3OWQifQ.Bo1ss5J4UjPPOjmq9S3VQw',
                        'attribution' => 'Map data &copy; <a href=\'http://mapbox.com\'>Mapbox</a>',
                    ]
                ],
                [
                    'type'      => 'base',
                    'title'     => 'Ảnh hàng không',
                    'component' => [
                        'name' => 'TileLayer',
                        'url'  => 'http://trueortho.hcmgis.vn/basemap/cache_lidar/{z}/{x}/{y}.jpg',
                    ]
                ],
                [
                    'type'      => 'base',
                    'title'     => 'Ảnh vệ tinh',
                    'component' => [
                        'name'  => 'GoogleLayer',
                        'type'  => 'satellite',
                        'tiled' => true,
                    ]
                ],
                [
                    "title"     => "Quận huyện",
                    "checked"  => role('quan'),
                    "component" => [
                        "url"        => "/geoserver/ows?",
                        "layers"     => "dichte:hc_quan",
                        'format' => 'image/png',
                        'transparent' => true,
                        "cql_filter" => $fn_cql('', 'quan')
                    ],
                ],
                [
                    "title"     => "Phường xã",
                    "checked"  => role('phuong'),
                    "component" => [
                        "url"        => "/geoserver/ows?",
                        "layers"     => "dichte:hc_phuong",
                        'format' => 'image/png',
                        'transparent' => true,
                        "cql_filter" => $fn_cql('', 'phuong')
                    ],
                ],
                [
                    "title"     => "Ranh tổ",
                    "component" => [
                        "url"        => "/geoserver/ows?",
                        "layers"     => "hcm_map:pg_ranhto",
                        'format' => 'image/png',
                        'transparent' => true,
                        "cql_filter" => $fn_cql()
                    ],
                ],
            ]
        ];
    }

}
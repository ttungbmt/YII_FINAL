<?php
namespace pcd\controllers\api;

use Carbon\Carbon;
use common\controllers\MyApiController;
use pcd\models\Cabenh;
use pcd\models\Danso;
use pcd\supports\RoleHc;
use yii\db\Expression;
use yii\db\Query;

class MapController extends MyApiController
{
    public $kptp;

    public function actionConfig()
    {
        $userId = user()->id;
        $key = "dataMap.{$userId}";
//        if(!empty(session($key))){
//            return session($key);
//        }

        $hc = RoleHc::init()->getHc();
        $this->setAuthData();
        $this->setAppData();

        $this->dataMap['layer_tree'] = $this->getLayerTree();

        $this->dataMap['categories'] = [
            'dm_xacminh_cb' => api('dm_xacminh_cb'),
            'dm_loaidieutra' => api('dm_loaidieutra'),
            'dm_chuandoan' => api('dm_chuandoan'),
            'dm_chuandoan_bd' => api('dm/chuandoan-bd'),
        ];

        $this->dataMap['extent'] = data_get($hc, 'giapranh.extent');
        $this->dataMap['boundary'] = data_get($hc, 'giapranh.boundary');

        session([$key => $this->dataMap]);

        return $this->dataMap;
    }

    public function getLayerTree(){
        $role = RoleHc::init();

        $_3mAgo = 'ngaymacbenh_nv >= '.(Carbon::now())->subMonths(3)->format('Y-m-d');

        $fn_cql = function ($cql = '', $hc = null) use($role){
            return $role->getGapranhCQL($cql, $hc);
        };
        $isQuan = role('quan');
        $maquan = userInfo()->ma_quan;
        $maphuong = userInfo()->ma_phuong;
        $isPhuong = role('phuong');

        return [
            [
                "title"     => "Quận huyện",
                "key"       => "pg_ranhquan",
                "onControl" => true,
                "selected" => $isQuan,
                "component" => [
                    "url"        => "/geoserver/ows?",
                    "layers"     => "dichte:hc_quan",
                    "cql_filter" => $fn_cql('', 'quan'),
                    "zIndex" => 1
                ],
            ],
            [
                "title"     => "Phường xã",
                "key"       => "dm_phuong_vn",
                "onControl" => true,
                "selected" => role('phuong'),
                "component" => [
                    "url"        => "/geoserver/ows?",
                    "layers"     => "dichte:hc_phuong",
                    "cql_filter" => $fn_cql('', 'phuong'),
                    "zIndex" => 2
                ],
            ],
            [
                "title"     => "Ranh tổ",
                "key"       => "pg_ranhto",
                "onControl" => true,
                "component" => [
                    "url"        => "/geoserver/ows?",
                    "layers"     => "dichte:ranh_to",
                    "cql_filter" => $fn_cql(),
                    "zIndex" => 3
                ],
            ],
            [
                "title"     => "Ranh tổ (vẽ)",
                "key"       => "pg_ranhto",
                "onControl" => true,
                "component" => [
                    "url"        => "/geoserver1/ows?",
                    "layers"     => "pcd:ranhto_draft",
                    "cql_filter" => $fn_cql()
                ],
            ],
            [
                "title"     => "Ca bệnh",
                "key"       => "cabenh_sxh",
                "onControl" => true,
                'selected'  => true,
                "component" => [
                    "cql_filter" => $fn_cql($_3mAgo),
                    "url"        => "/geoserver/ows?",
                    "layers"     => "dichte:v_phieu_dt",
                    "zIndex" => 10
                ],
            ],
            [
                "title"     => "Ca bệnh nghi ngờ",
                "key"       => "cabenh_sxh_nn",
                "onControl" => true,
                'selected'  => false,
                "component" => [
                    "url"        => "/geoserver/ows?",
                    "layers"     => "dichte:v_cabenh_sxh_nn",
                ],
            ],
            [
                "title"     => "Điểm nguy cơ",
                "key"       => "pt_nguyco",
                "onControl" => true,
                'selected'  => false,
                "component" => [
                    "url"        => "/geoserver/ows?",
                    "layers"     => "dichte:pt_nguyco",
                    "cql_filter" => $fn_cql(),
                    "zIndex" => 11
                ],
            ],
        ];
    }


    protected function getUser()
    {
        $user = user()->identity;
        $info = $user->info;

        return collect($user)->only(['username'])->merge($info);
    }

    protected function getGiapRanh()
    {
        if (role('phuong')) {
            list($table, $field, $val) = ['pg_ranhphuong', 'maphuong', roleCond()->getMaHc()];
        } elseif (role('quan')) {
            list($table, $field, $val) = ['pg_ranhquan', 'maquan', roleCond()->getMaHc()];
        } else {
            return [];
        }

        $val = roleCond()->getMaHc();

        $subQuery = (new Query())->select('geom')->from($table);
        $subQuery->where([$field => $val]);

        $query = (new Query())->select([
            'giapranh' => "string_agg(r1.{$field}, ',')",
            'geometry' => 'ST_AsGeoJSON(Box2D(ST_Extent(r1.geom))::geometry)'
        ])->from(['r1' => $table, 'r2' => $subQuery])->where('ST_Intersects(r1.geom, r2.geom)');
        $resp = $query->one();

        $geometry = data_get(json_decode(data_get($resp, 'geometry')), 'coordinates.0');

        $latlng = function ($coords, $num) {
            return array_reverse(array_slice(data_get($coords, $num), 0, 2));
        };

        return [
            'giapranh' => explode(',', $resp['giapranh']),
            'bounds'   => $geometry ? [
                $latlng($geometry, 2),
                $latlng($geometry, 0),
            ] : []
        ];
    }

    public function actionChoropleth(){
        $type = request('type', 'other');

        $k = 'maquan';
        $t = 'tenquan';
        $tb = 'hc_quan';
        $date_from = request('date_from', '01-01-2016');
        $date_to = request('date_to', '01-01-2018');
        $ys = range($date_from, $date_to);

        $ngaybc = new Expression('EXTRACT(YEAR FROM ngaybaocao)');

        $dm_hc = (new Query())->select(['ma_hc' => $k, 'ten_hc' => $t, 'geometry' => new Expression('ST_AsGeoJSON(geom)')])->from($tb)->orderBy('order')->all();
        $q1 = Danso::find();
        $q2 = Cabenh::find();

        if($type == 'year'){
            $group_fn = ['ma_hc', function ($i) {return $i['nam'];}];

            $q1->andFilterWhere(['in', 'nam', $ys]);
            $q2->select(['ma_hc' => 'ma_quan', 'nam' => $ngaybc, 'count(*)'])
                ->andFilterWhere(['in', $ngaybc, $ys])
                ->groupBy(new Expression('1,2'));

        } else {
            $group_fn = ['ma_hc'];
            $q1->select(['ma_hc', 'danso' => new Expression('SUM(danso)')])->groupBy('ma_hc');

            if($date_from){$q1->andFilterWhere(['>=', 'nam', new Expression("EXTRACT(YEAR FROM '{$date_from}'::date)")]);}
            if ($date_to){$q1->andFilterWhere(['<=', 'nam', new Expression("EXTRACT(YEAR FROM '{$date_to}'::date)")]);}

            $q2->select(['ma_hc' => 'ma_quan', 'count(*)'])
                ->andFilterDate(['ngaybaocao' => [$date_from, $date_to]])
                ->groupBy(new Expression('1'));
        }


        $danso = collect($q1->asArray()->all())->groupBy($group_fn);
        $sc = collect($q2->asArray()->all())->groupBy($group_fn);

        $data = [];
        foreach ($dm_hc as $hc){
            $k = $hc['ma_hc'];
            $data[$k] = [
                'type' => 'Feature',
                'properties' => [
                    'ma_hc' => $hc['ma_hc'],
                    'ten_hc' => $hc['ten_hc'],
                    'label' => $hc['ten_hc'],
                ],
                'geometry' => json_decode($hc['geometry'])
            ];

            if($type == 'year'){
                foreach ($ys as $y){
                    $count = data_get($sc, "{$k}.{$y}.0.count"); $pop = data_get($danso, "{$k}.{$y}.0.danso"); $cp = $pop ? ($count ? round(($count/$pop)*100000) : '') : '';

                    $data[$k]['items'][$y] = [
                        'nam' => $y,
                        'count' => $count,
                        'pop' => $pop,
                        'cp' => $cp,
                    ];
                }
            } else {
                $count = data_get($sc, "{$k}.0.count"); $pop = data_get($danso, "{$k}.0.danso"); $cp = $pop ? ($count ? round(($count/$pop)*100000) : '') : '';
                $data[$k]['properties'] = array_merge($data[$k]['properties'], [
                    'count' => $count,
                    'pop' => $pop,
                    'cp' => $cp,
                ]);
            }
        }

//        dd(collect($data)->map(function ($i){
//            return array_merge($array1);
//        }));


        return [
            'items' => array_values($data),
            'html' => $this->renderPartial('choropleth', ['type' => $type, 'data' => $data, 'ys' => $ys])
        ];
    }
}
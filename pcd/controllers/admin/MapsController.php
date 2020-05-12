<?php
namespace pcd\controllers\admin;

use pcd\controllers\AppController;
use pcd\models\VCbsxh;
use pcd\modules\auth\services\UserService;
use pcd\modules\pcd\consts\RolePQConst;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class MapsController extends AppController
{
    public $layout = '@app/views/maps/master';

    public function actionConfig(){
        return $this->renderJson([
            'home' => 123
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

//    public function actionConfig()
//    {
//        app()->response->format = 'json';
//        $userSrv = new UserService();
//        $roles = collect($userSrv->getRolesByUser());
//        $user = $userSrv->current();
//
//        $db = [];
//
//        if ($roles->has(RolePQConst::PHUONG)) {
//            $db = ['table' => 'dm_phuong', 'field' => 'ma_phuong', 'key' => $user->ma_phuong];
//        } elseif ($roles->has(RolePQConst::QUAN)) {
//            $db = ['table' => 'dm_quan', 'field' => 'ma_quan', 'key' => $user->ma_quan];
//        }
//
//
//        $hc = $db ? json_decode(dbSelect($this->getHanhChinh($db['table'], $db['field'], $db['key']))->queryScalar()) : [];
//
//
//        return [
//            'user' => $user,
//            'hanhchinh' => $hc,
//            'thongke' => $this->tkSXH(),
//            'settings' => app()->view->params['settings'],
//
//            'layerUrl' => [
//                'gisnen' => 'http://pcd.hcmgis.vn/geoserver/ows?',
//                'ranhphuong' => ' http://pcd.hcmgis.vn/geoserver/ows?',
//                'ranhquan' => ' http://pcd.hcmgis.vn/geoserver/ows?',
//                'ranhto' => ' http://pcd.hcmgis.vn/geoserver/ows?',
//                'cabenh' => ' http://pcd.hcmgis.vn/geoserver/ows?',
//                'kvsxh' => ' http://pcd.hcmgis.vn/geoserver/ows?',
//                'test_kvsxh' => ' http://pcd.hcmgis.vn/geoserver/ows?',
//                'geo_odsxh' => 'http://pcd.hcmgis.vn/geoserver/ows?',
//            ],
//
//
//
//
//
//
//
//
//            'geom' => [
//
//            ]
//        ];
//    }

    protected function tkSXH()
    {
        $tk = ArrayHelper::map(VCbsxh::find()
            ->select(['xmcabenh', 'COUNT(*) AS count'])
            ->where("date_part('year', CURRENT_DATE) = date_part('year', ngaybaocao)")
            ->filterPQAccess()
            ->groupBy(['xmcabenh'])
            ->asArray()->all(), 'xmcabenh', 'count');

        return [
            'chuadt' => isset($tk['']) ? $tk[''] : 0,
            'dangdt' => isset($tk[1]) ? $tk[1] : null,
            'chuaxv' => isset($tk[2]) ? $tk[2] : null,
            'dadt' => isset($tk[3]) ? $tk[3] : null,
        ];
    }

    protected function getHanhChinh($table, $field, $key)
    {
        return
            "SELECT row_to_json (T) FROM ( SELECT {$field}, ST_Extent (geom) AS bound, ( array_to_string( ARRAY ( SELECT B.{$field} FROM {$table} AS A, {$table} AS B WHERE st_intersects (A.geom, B.geom) AND A.{$field} = {$key} ), ', ' ) ) AS giapranh FROM {$table} WHERE {$field} = {$key} GROUP BY {$field} ) T";
    }

    public function actionRanhto()
    {
        $request = app()->request;

        $wkt = request('wkt');
        $sqlRes = dbSelect("SELECT khupho, tento, tenphuong, tenquan, maphuong, maquan FROM ranh_to WHERE ST_Intersects ( geom, ST_GeomFromText('{$wkt}', 4326) )")->queryAll();
        $totiepgiap = $sqlRes;
//        dd($totiepgiap);
//        $totiepgiap = ArrayHelper::index($sqlRes, 'tenkhupho', [function ($el) {
//            return $el['tenquan'];
//        }, 'tenphuong']);


//        dd($this->renderContent('totiepgiap', compact('totiepgiap')));

//        $geojson = json_encode($request->post('geoJSON'));
//
//        foreach ($ranh as $k => $item){
//            $ranhtokp[$k] = "{$item['tento']} ({$item['khupho']})";
//        }
//        $ranhtokp = implode(', ', $ranhtokp);
//
//        $user = RolePQService::getCurrentUser();
//
//        if($user->cap_hanhchinh == RolePQConst::$CAP_PHUONG){
//            $dientich = Yii::$app->db->createCommand("SELECT st_area( st_transform( st_intersection(st_transform(geom, 4326), ST_SetSRID(ST_GeomFromGeoJSON('{$geojson}'), 4326)), 900913)) as area from ranhphuong where ma_phuong = {$user->ma_hanhchinh}")->queryOne()['area'];
//        } elseif($user->cap_hanhchinh == RolePQConst::$CAP_QUAN){
//            $dientich = Yii::$app->db->createCommand("SELECT st_area ( st_intersection ( geom, ST_SetSRID( ST_GeomFromGeoJSON ('{$geojson}'), 4326)):: geography) AS area FROM hc_quan where maquan = {$user->ma_hanhchinh}")->queryOne()['area'];
//        }
//
        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
//            'tokp' => $ranh,
            'totiepgiap' => $totiepgiap,
            'viewto' => $this->renderPartial('totiepgiap', compact('totiepgiap')),
//            'toxl' => implode(', ', array_unique(array_filter(ArrayHelper::getColumn($ranh, 'tento')))),
//            'kpxl' => implode(', ', array_unique(array_filter(ArrayHelper::getColumn($ranh, 'khupho')))),
        ];
    }

    public function actionGeoHcPhuong()
    {
        $tb = " SELECT quan.ten_phuong,
    quan.ma_phuong,
    COALESCE(sxh.total, (0)::bigint) AS total,
    st_transform(geom, 4326) geom
   FROM (ranhphuong quan
     LEFT JOIN ( SELECT v_cbsxh.ma_phuong,
            count(*) AS total
           FROM v_cbsxh
          WHERE ((v_cbsxh.cdc_cbn_sot > 0) OR (v_cbsxh.cdc_cbn_sxh > 0)) AND date_part('year', ngaymacbenh_nv) = date_part('year', now())
          GROUP BY v_cbsxh.ma_phuong) sxh ON ((quan.ma_phuong = sxh.ma_phuong)))";

        $res = app()->db->createCommand("SELECT row_to_json(fc)
 FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
 FROM (SELECT 'Feature' As type
    , ST_AsGeoJSON(lg.geom)::json As geometry
    , row_to_json(lg.*) As properties
   FROM ({$tb}) As lg   ) As f )  As fc;")->queryScalar();

        app()->response->format = Response::FORMAT_JSON;
        return json_decode($res);

    }


    public function actionChartPhuong()
    {
        $ma_phuong = request('ma_phuong');

        $res = excuteSQL("
            SELECT thang, sum(sxh) sxh_total, sum(sot) sxv_total FROM (
                SELECT thang, count(cdc_cbn_sxh) sxh, count(cdc_cbn_sot) sot FROM (
                    SELECT ngaymacbenh_nv, date_part('month',ngaymacbenh_nv) thang,  date_part('year',ngaymacbenh_nv) nam, NULLIF(cdc_cbn_sxh, 0) cdc_cbn_sxh, NULLIF(cdc_cbn_sot, 0) cdc_cbn_sot
                    FROM v_cbsxh
                    WHERE (cdc_cbn_sot > 0 OR cdc_cbn_sxh > 0) AND ma_phuong = {$ma_phuong}
                ) cbsxh
                WHERE nam = date_part('year', now())
                GROUP BY thang, cdc_cbn_sxh, cdc_cbn_sot
            ) tk
            GROUP BY thang
            ORDER BY thang ASC"
        );

        app()->response->format = Response::FORMAT_JSON;
        return $res;
    }


    public function actionFilterSxh()
    {
        $post = [
            'datefrom' => request('datefrom'),
            'dateto' => request('dateto') ?: date('d/m/Y'),
            'loaibenh' => request('loaibenh') ?: [],
        ];

        $sxh = !in_array('sxh', $post['loaibenh']) ? 0 : VCbsxh::find()->filterSXH($post)->andWhere(['>=', 'cdc_cbn_sxh', 1])->count();
        $sot = !in_array('sot', $post['loaibenh']) ? 0 : VCbsxh::find()->filterSXH($post)->andWhere(['>=', 'cdc_cbn_sot', 1])->count();
        $khac = !in_array('khac', $post['loaibenh']) ? 0 : VCbsxh::find()->filterSXH($post)->andWhere(['>=', 'cdc_cbn_benhkhac', 1])->count();

        app()->response->format = Response::FORMAT_JSON;
        return [
            'sxh' => $sxh,
            'sot' => $sot,
            'khac' => $khac
        ];

    }


}
<?php
namespace pcd\modules\sxh\controllers;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use pcd\modules\pt_nguyco\models\PtNguyco;
use pcd\controllers\AppController;
use pcd\models\CabenhSxh;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use pcd\modules\sxh\models\search\SxhSearch;
use pcd\search\OdichSxhSearch;
use pcd\search\PtNguycoSearch;
use pcd\supports\RoleHc;
use yii\helpers\Url;
use yii\httpclient\Client;

class MapsController extends AppController {
    public function actionIndex(){
        return $this->renderPartial('index');
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionConfigs(){
        $user = \Yii::$app->user;
        $data = [];

        $data['map'] = [
            'popup' => ['cabenh_sxh', 'dnc', 'odich'],
        ];

        if(!$user->isGuest){
            $identity = $user->identity;
            $info = $identity->info->toArray();
            $data['auth'] = [
                'user' => collect([
                    'id' => $identity->id,
                    'username' => $identity->username,
                ])->merge(collect($info)->only(['fullname', 'email', 'maphuong', 'maquan'])),
                'permissions' => Arr::pluck(auth()->getPermissionsByUser($identity->id), 'name'),
                'roles' => Arr::pluck(auth()->getRolesByUser($identity->id), 'name'),
            ];

            $data['dm']['dm_quan'] = HcQuan::find()->andFilterWhere(['maquan' => $info['maquan']])->orderBy('order')->pluck('tenquan', 'maquan')->all();
            if($info['maquan'] || $info['maphuong']) {
                $data['dm']['dm_phuong'] = HcPhuong::find()->andFilterWhere(['maquan' => $info['maquan'], 'maphuong' => $info['maphuong']])->orderBy('order')->pluck('tenphuong', 'maphuong')->all();
            }

            if(role('phuong') || role('quan')){
                $resp = data_get(role('quan') ? HcQuan::findOne(['maquan' => $info['maquan']]) : HcPhuong::findOne(['maphuong' => $info['maphuong']]), 'giapranh');
                $data['map']['extent'] = $resp['extent'];
                $data['map']['boundary'] = $resp['boundary'];
            }
        }

        $data['map']['layer_tree'] = $this->getLayerTree($data['map']);


        $data['app'] = [
            'app_name' => params('app_name'),
            'app_logo' => params('assets.logo'),
            'description' => params('app_name'),

        ];

        return $this->asJson($data);
    }

    public function getLayerTree($data){
        $role = RoleHc::init();

        $_3mAgo = 'ngaymacbenh_nv >= '.(Carbon::now())->subMonths(3)->format('Y-m-d');

        $fn_cql = function ($cql = '', $hc = null) use($role){
            return $role->getGapranhCQL($cql, $hc);
        };

        return [
            [
                "title"     => "Quận huyện",
                "active" => role('quan'),
                "type" => 'wms',
                "key" => "hc_quan",
                "options" => [
                    "url"        => "/geoserver/ows?",
                    "layers"     => "dichte:hc_quan",
                    "cql_filter" => $fn_cql('', 'quan'),
                    "zIndex" => 1
                ],
            ],
            [
                "title"     => "Phường xã",
                "type" => 'wms',
                "key" => "hc_phuong",
                "active" => role('phuong'),
                "options" => [
                    "url"        => "/geoserver/ows?",
                    "layers"     => "dichte:hc_phuong",
                    "cql_filter" => $fn_cql('', 'phuong'),
                    "zIndex" => 2
                ],
            ],
            [
                "title"     => "Ranh tổ",
                "type" => 'wms',
                "key" => "ranhto",
                "options" => [
                    "url"        => "/geoserver/ows?",
                    "layers"     => "dichte:ranh_to",
                    "cql_filter" => $fn_cql(),
                    "zIndex" => 3
                ],
            ],
            [
                "title"     => "Ranh tổ (vẽ)",
                "type" => 'wms',
                "options" => [
                    "url"        => "/geoserver1/ows?",
                    "layers"     => "pcd:ranhto_draft",
                    "cql_filter" => $fn_cql(),
                    "zIndex" => 4
                ],
            ],
            [
                "title"     => "Ca bệnh",
                "type" => 'wms',
                "key" => "cabenh_sxh",
                'active'  => true,
                "options" => [
                    "cql_filter" => $fn_cql($_3mAgo),
                    "url"        => "/geoserver/ows?",
                    "layers"     => "dichte:v_phieu_dt",
                    "zIndex" => 10
                ],
            ],
//            [
//                "title"     => "Ca bệnh test",
//                "type" => 'wms',
//                "key" => "cabenh_sxh",
//                'active'  => true,
//                "options" => [
//                    "cql_filter" => $fn_cql($_3mAgo),
//                    "url"        => "/geoserver/ows?",
//                    "layers"     => "dichte:v_phieu_dt",
//                    "zIndex" => 10,
//                    'styles' => 'point_custom'
//                ],
//            ],
            [
                "title"     => "Ca bệnh nghi ngờ",
                "type" => 'wms',
                "options" => [
                    "url"        => "/geoserver/ows?",
                    "layers"     => "dichte:v_cabenh_sxh_nn",
                ],
            ],
            [
                "title"     => "Điểm nguy cơ",
                "type" => 'wms',
                "key" => "dnc",
                "control" => true,
                "options" => [
                    "url"        => "/geoserver/ows?",
                    "layers"     => "dichte:pt_nguyco",
                    "cql_filter" => $role->getGapranhCQL(''),
                    "zIndex" => 9
                ],
            ],
        ];
    }

    public function renderInfo($name, $data){
        $resp = [];
        $data = opt($data);

        switch ($name){
            case 'cabenh_sxh':
                $model = CabenhSxh::getPopupInfo($data->gid);
                $resp['model'] = $model;
                break;
            case 'dnc':
                $model = PtNguyco::getPopupInfo($data->gid);
                $resp['model'] = $model;
//                $resp['content'] = $this->renderPartial('popup/tpl_dnc', ['model' => $model]);
                break;
        }

        return $resp;
    }
    
    public function actionGetWmsInfo(){
        $client = new Client();
        $postData = request()->all();
        $respData = [];

        foreach (data_get($postData, 'items', []) as $k => $i){
            $feature = opt($i);
            $url = data_get($feature, 'infoUrl');
            $req = $client->get(Url::to($url, true));

            try {
                $resp = $req->send()->getData();
                $info = data_get($resp, 'features.0');
                $date = data_get($info, 'properties.ngaymacbenh_nv');
                if($date){
                    $m3ago = Carbon::now()->subtract('month', 1);
                    $compare = (new Carbon($date))->lessThan($m3ago);
                    if($compare){
                        return $this->asJson([
                            'status' => 'FAILED',
                        ]);
                    }
                }

                if($info) {
                    $layerName = $feature->layers;
                    $data = array_merge(['gid' => last(explode('.', $info['id']))], data_get($resp, 'features.0.properties'));
                    return $this->asJson([
                        'status' => 'OK',
                        'data' => array_merge( [
                            'uuid' => $feature->uuid,
                            'layers' => $layerName,
                        ],  $this->renderInfo($feature->key, $data))
                    ]);
                }
            } catch (\Exception $e ){
                return $this->asJson([
                    'status' => 'FAILED',
                    'message' => $e->getMessage(),
                ]);
            }
        }

        return $this->asJson([
            'status' => 'OK',
            'data' => $respData
        ]);
    }

    public function actionCabenh($id){
        return $this->asJson(['data' => CabenhSxh::getPopupInfo($id)]);
    }

    public function actionDsSxh(){
        $searchModel = new SxhSearch();
        return $this->getDs($searchModel);
    }

    public function actionDsOdich(){
        $searchModel = new OdichSxhSearch();
        return $this->getDs($searchModel);
    }

    public function actionDsDnc(){
        $searchModel = new PtNguycoSearch();
        return $this->getDs($searchModel);
    }

    protected function getDs($searchModel){
        # https://github.com/jlorente/yii2-datatables/blob/master/src/models/SearchModel.php
        $params = request()->queryParams;
        if(request()->has('export_type')){
            $params = ['form' => json_decode(request('formData'), true)];
        }

        $dataProvider = $searchModel->search($params);

        if(request()->has('export_type')){
            return $searchModel->exportData($dataProvider);
        }

        if(request()->has('columns') && !request()->has('draw')){
            return $this->asJson($searchModel->getConfigs($dataProvider));
        }

        return $this->asJson($searchModel->getDraw($dataProvider));
    }
}
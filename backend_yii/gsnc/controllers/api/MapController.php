<?php
namespace gsnc\controllers\api;


use common\controllers\MyApiController;
use common\models\Query;
use common\models\User;
use gsnc\models\Maunc;
use yii\db\Expression;

class MapController extends MyApiController
{
//    public function actionPhp(){
//        $query = collect((new \yii\db\Query())->select([
//            'gid',
//            'value',
//            'geometry' => new Expression('ST_AsGeoJSON(geom)')
//
//        ])->from('v_php')->all())->map(function ($i){
//            return [
//                'type' => 'Feature',
//                'geometry' => json_decode($i['geometry']),
//                'properties' => [
//                    'id' => $i['gid'],
//                    'weight' => floatval($i['value']),
//                ]
//            ];
//        });
//        return $query;
//    }


    public function actionGetTbChitieu(){
        $this->layout = null;

        $data = request()->all();
        $chitieu = json_decode(data_get($data, 'json'), true);
        return $this->render('pop_chitieu', ['chitieu' => $chitieu]);
    }

    public function actionLayers(){
        return [
            [
                'title' => 'Basemap',
                'checkbox' => false,
                'radiogroup' => true,
                'expanded' => true,
                'children' => [
                    'google:selected=true',
                    'hcmgis',
                    'vietbando',
                    ['google-satellite', ['title' => 'Ảnh vệ tinh']],
                ]
            ],
            [
                'title' => 'Overlay',
                'checkbox' => false,
                'expanded' => true,
                'children' => api('layer_tree')
            ],
        ];
    }

    public function actionConfig()
    {
        $data = [];

        $userId = user()->id;
        $user = User::findOne($userId);
        if ($user) {
            $data['user'] = array_merge($user->info->toArray(), ['username' => $user->username]);
            $data['roles'] = array_keys(auth()->getRolesByUser($userId));
            $data['permissions'] = array_keys(auth()->getPermissionsByUser($userId));
        }

        $data['layer_tree'] = api('layer_tree');

        $data['nav_links'] = api('nav_links');
        $data['app'] = [
            'title' => params('app_name'),
            'logo_url' => params('assets.logo')
        ];


        $data['categories'] = [
        ];

        return $data;
    }

    public function actionHeatmap(){
        $q = collect((new Query())->select([
            'ct.entity_id', 
            'ct.giatri', 
            'geometry' => new Expression('ST_AsGeoJSON(mn.geom)')
        ])->from(['ct' => 'ql_chitieu'])
            ->leftJoin(['mn' => 'maunc'], 'mn.gid = ct.entity_id')
            ->andFilterWhere([
                'ct.entity_type' => Maunc::className(),
                'ct.chitieu_id' => request('chitieu_id'),
            ])
            ->andFilterDate(['mn.ngaylaymau' => [request('date_from'), request('date_to')]])
            ->andWhere('mn.geom IS NOT NULL')->all())
            ->map(function ($i) {
                $geometry = json_decode($i['geometry'], true);
                return [
                    data_get($geometry, 'coordinates.1'), data_get($geometry, 'coordinates.0'), $i['giatri']
                ];
            })
        ;

        return [
            'items' => $q
        ];
    }

}
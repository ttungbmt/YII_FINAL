<?php

namespace pcd\controllers\api;

use common\controllers\ApiController;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use pcd\models\Loaibenh;
use pcd\modules\dm\models\DmKhupho;
use pcd\modules\dm\models\DmToDp;
use pcd\supports\RoleHc;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;

class DmController extends ApiController
{
    public function beforeAction($action)
    {
        if(in_array($action->id, ['quan'])){
            $this->attachBehaviors([
                'authenticator' => [
                    'class' => CompositeAuth::className(),
                    'authMethods' => [
                        HttpBasicAuth::className(),
                        HttpBearerAuth::className(),
                        QueryParamAuth::className(),
                    ],
                ]
            ]);
        }

        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function actionPhuong()
    {
        $value = app('request')->post('value');
        $value = $value ? $value : request('depdrop_params.0');
        $maquan = data_get(app('request')->post('depdrop_parents'), '0');
        $query = HcPhuong::find()->where(['maquan' => $maquan]);
        if(role('phuong') && request('role') === 'true'){
            $value = is_numeric($value) ? $value : userInfo()->maphuong;
            $query->andFilterWhere(['maphuong' => $value]);
        }

        $list_phuong = $query->orderBy('tenphuong')->map(function ($item) {
            return ['id' => $item->maphuong, 'name' => $item->tenphuong];
        });
        return [
            'output' => $list_phuong, 'selected' => $value
        ];
    }

    public function actionKhupho()
    {
        $value = app('request')->post('value');
        $value = $value ? $value : request('depdrop_params.0');
        $maphuong = data_get(app('request')->post('depdrop_parents'), '0');
        $query = DmKhupho::find()->where(['maphuong' => $maphuong]);
        if(role('phuong') && request('role') === 'true'){
            $value = is_numeric($value) ? $value : userInfo()->maphuong;
            $query->andFilterWhere(['khupho' => $value]);
        }

        $list = collect($query->orderBy('khupho')->map(function ($item) {
            return ['id' => $item->khupho, 'name' => $item->khupho];
        }))->sortBy('name', SORT_NATURAL)->values()->all();

        return [
            'output' => $list, 'selected' => $value
        ];
    }

    public function actionTo_dp()
    {
        $data = request()->all();
        $value = data_get($data, 'value');
        $khupho = data_get($data, 'depdrop_parents.0');
        $maquan = data_get($data, 'depdrop_params.0');
        $maphuong = data_get($data, 'depdrop_params.1');

        $data = DmToDp::find()->where(['maquan' => $maquan, 'maphuong' => $maphuong, 'khupho' => $khupho])->all();

        $list = collect($data)->map(function ($item) {
            return ['id' => $item->to_dp, 'name' => $item->to_dp];
        })->sortBy('name', SORT_NATURAL)->values()->all();

        return [
            'output' => $list, 'selected' => $value
        ];
    }

    public function actionQuan()
    {
        $query = HcQuan::find()->orderBy('order');
        if(request('role') === 'true'){
            $query->andFilterWhere(['maquan' => (string)userInfo()->maquan]);
        }


        return $query->pluck('tenquan', 'maquan');
    }

    public function actionChuandoanBd(){
        return Loaibenh::pluck('tenbenh', 'mabenh');
    }



}
<?php
namespace pcd\controllers\api;

use common\controllers\MyApiController;
use Illuminate\Support\Arr;
use pcd\models\CabenhSxh;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use ttungbmt\db\Query;
use ttungbmt\leaflet\layers\GeoJson;
use yii\db\Expression;
use yii\helpers\Json;

class TableController extends MyApiController
{
    public function actionHello(){
        $field = (object)['table' => HcPhuong::tableName(), 'code' => 'maphuong', 'value' => '78527622', 'tolerance' => '1/1e5', 'distance' => 200];

        $codes = collect((new Query())->select($field->code)->from($field->table)->andWhere(new Expression("ST_Intersects(geom, (SELECT geom FROM {$field->table} WHERE {$field->code} = '{$field->value}'))"))->all())->pluck($field->code)->all();
        $extent = (new Query())->select(new Expression("ST_AsGeoJSON(ST_Envelope(ST_Union(geom))) extent"))->from($field->table)->andWhere([$field->code => $codes])->one();
        $boundary = (new Query())->select(new Expression("ST_AsGeoJSON (ST_Simplify(ST_Buffer(ST_Union(geom)::geography, {$field->distance} ) :: geometry, {$field->tolerance} )) boundary"))->from($field->table)->andWhere([$field->code => $codes])->one();

        $data = [
            'items' => $codes,
            'extent' => Arr::get($extent, 'extent'),
            'boundary' => Arr::get($boundary, 'boundary'),
        ];

        return $data;

    }

    public function actionCheckCc(){
        $cbs = collect(CabenhSxh::find()->with(['xacminhCbs', 'xacminhCbs.phuong', 'chuyenCas'])
            ->andWhere(['=', 'loaidieutra' , 1])
            ->andWhere('px <> maphuong')
            ->andWhere(['>=', 'ngaybaocao' , '2019-01-01'])
            ->andWhere(['<', 'ngaybaocao' , '2020-01-01'])
            ->all())->filter(function ($i){
            $xm = $i->xacminhCbs;
            return true
                ;
        });
//        dd($cbs->all());

        foreach ($cbs as $cb){
            $cb->maphuong = $cb->px;
            $cb->maquan = $cb->qh;

            $cb->save();
        }


       return [];
    }
}



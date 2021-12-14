<?php

namespace pcd\controllers\api;


use common\controllers\MyApiController;
use nanson\postgis\helpers\GeoJsonHelper;
use pcd\models\RanhtoDraft;

class RanhtoDraftController extends MyApiController
{
    public function actionIndex()
    {
        return [
            'status' => 'OK',
            'items'  => array_map(function ($m) {
                $data = $m->toArray([], ['gid', 'geometry', 'tenquan', 'tenphuong']);
                unset($data['geom']);
                return $data;
            }, RanhtoDraft::find()->with(['quan', 'phuong'])->all())
        ];
    }

    public function actionSave()
    {
        $model = new RanhtoDraft();
        $gid = request('gid');
        $geometry = request('geometry');
        $data = request()->except('gid');
        if ($gid) {
            $model = RanhtoDraft::findOne(['gid' => $gid]);
        }

        if ($geometry) {
            if ($geometry['type'] == 'Polygon') {
                $model->geom = [$geometry['coordinates']];
            } else if ($geometry['type'] == 'MultiPolygon') {
                $model->geom = $geometry['coordinates'];
            }
        }

        $model->load($data, '');
        if (role('phuong')) {
            $model->maquan = userInfo()->maquan;
            $model->maphuong = userInfo()->maphuong;
        }
        $model->status = 1;

        $status = $model->save();
        $data = RanhtoDraft::find()->where(['gid' => $model->gid])->with(['quan', 'phuong'])->one()->toArray([], ['gid', 'geometry', 'tenquan', 'tenphuong']);
        unset($data['geom']);

        return [
            'status' => $status,
            'model'  => $data,
        ];
    }

    public function parseGeometry($g)
    {
//        dd($g);
//
//        $g['coordinates'] = 1;
    }

    public function actionDelete($id)
    {
        $model = RanhtoDraft::findOne(['gid' => $id]);
        return [
            'status' => $model->delete()
        ];
    }
}
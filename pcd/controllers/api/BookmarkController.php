<?php

namespace pcd\controllers\api;

use common\controllers\MyApiController;
use common\models\Bookmark;

class BookmarkController extends MyApiController
{
    public function actionIndex()
    {
        $query = Bookmark::find();
        $userId = user()->id;
        if ($userId) {
            $query->andFilterWhere(['created_by' => user()->id]);
        } else {
            $query->andFilterWhere(['ip' => getUserIpAddr()]);
            $query->andWhere('created_by IS NULL');
        }

        $item = collect($query->all())->map(function ($item) {
            return $item->toArray([], ['gid', 'geometry']);
        });

        return [
            'items' => $item
        ];
    }

    public function actionSave()
    {
        $model = new Bookmark();
        $gid = request('gid');
        $geom = collect(explode(',', request('latlngStr')))->reverse()->map(function ($item) {
            return floatval(trim($item));
        })->values()->all();
        $data = request()->except('gid');
        if ($gid) {
            $model = Bookmark::findOne(['gid' => $gid]);
        }
        $model->setAttributes($data);
        if ($geom) {
            $model->geom = $geom;
        }
        $model->setAttributes($data);
        $model->ip = getUserIpAddr();
        $model->save();

        return [
            'status' => $model->save(),
            'model'  => $model->toArray([], ['gid', 'geometry'])
        ];
    }

    public function actionDelete($id)
    {
        $model = Bookmark::findOne(['gid' => $id]);
        return [
            'status' => $model->delete()
        ];
    }
}
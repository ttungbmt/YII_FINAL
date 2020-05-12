<?php

namespace pcd\controllers\admin;

use pcd\models\CabenhSxh;
use pcd\search\CabenhSxhNnSearch;
use pcd\controllers\AppController;
use yii\helpers\Html;

class CabenhSxhNnController extends AppController
{
    protected $modelClass = 'pcd\models\CabenhSxh';

    public function actionIndex()
    {    
        $searchModel = new CabenhSxhNnSearch();
        $dataProvider = $searchModel->search(request()->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->renderRest(['view', 'model' => $this->findModel($id)], [
            'title' => 'Chi tiết Ca bệnh nghi ngờ #'.$id,
        ]);
    }

    public function actionCreate()
    {
        $model = new CabenhSxh();
        return $this->renderRest(['create', 'model' => $model], [
            'title' => 'Thêm mới ca bệnh nghi ngờ'
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $this->renderRest(['update', 'model' => $model], [
            'title' => 'Thêm mới ca bệnh nghi ngờ #'.$model->id,
        ]);
    }

    public function restSave(&$model)
    {
        if($model->lat && $model->lng){
            $model->geom = [$model->lng, $model->lat];
        }
        $model->ngaymacbenh = $model->ngaymacbenh_nv;
        $model->save();
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->renderRest();
    }
}

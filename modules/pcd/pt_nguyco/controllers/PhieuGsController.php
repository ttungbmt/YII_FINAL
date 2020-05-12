<?php
namespace modules\pcd\pt_nguyco\controllers;

use modules\pcd\pt_nguyco\models\PhieuGs;
use modules\pcd\pt_nguyco\models\search\PhieuGsSearch;
use pcd\controllers\AppController;

class PhieuGsController extends AppController
{
    protected $modelClass = 'modules\pcd\pt_nguyco\models\PhieuGs';

    public function actionIndex()
    {    
        $searchModel = new PhieuGsSearch();
        $dataProvider = $searchModel->search(request()->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->renderRest(['view', 'model' => $this->findModel($id)], [
            'title' => lang('Details ').'Phiếu giám sát #'.$id,
        ]);
    }

    public function actionCreate()
    {
        $model = new PhieuGs();

        return $this->renderRest(['create', 'model' => $model], [
            'title' => lang('Create ').'Phiếu giám sát',
            'size' => 'large'
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $this->renderRest(['update', 'model' => $model], [
            'title' => lang('Update ').'Phiếu giám sát #'.$model->id,
            'size' => 'large'
        ]);
    }

    public function restSave(&$model)
    {
        $model->save();
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->renderRest();
    }
}

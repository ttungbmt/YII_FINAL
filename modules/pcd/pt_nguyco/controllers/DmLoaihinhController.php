<?php
namespace modules\pcd\pt_nguyco\controllers;

use modules\pcd\pt_nguyco\models\DmLoaihinh;
use modules\pcd\pt_nguyco\models\search\DmLoaihinhSearch;
use pcd\controllers\AppController;

class DmLoaihinhController extends AppController
{
    protected $modelClass = 'modules\pcd\pt_nguyco\models\DmLoaihinh';

    public function actionIndex()
    {    
        $searchModel = new DmLoaihinhSearch();
        $dataProvider = $searchModel->search(request()->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->renderRest(['view', 'model' => $this->findModel($id)], [
            'title' => lang('Details ').'Loại hình #'.$id,
        ]);
    }

    public function actionCreate()
    {
        $model = new DmLoaihinh();
        return $this->renderRest(['create', 'model' => $model], [
            'title' => lang('Create ').'Loại hình',
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $this->renderRest(['update', 'model' => $model], [
            'title' => lang('Update ').'Loại hình #'.$model->id,
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

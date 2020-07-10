<?php

namespace pcd\modules\sxh\controllers;

use pcd\controllers\AppController;
use pcd\models\CabenhSxh;
use pcd\models\OdichSxh;
use pcd\modules\sxh\forms\SxhForm;


class DefaultController extends AppController {
    public function actions() {
        $actions = parent::actions();

        $actions['export-dieutra'] = [
            'class'    => 'common\actions\ExportWordAction',
            'fileName' => 'PhieuDt_SXH',
            'getData'  => [$this, 'getDataDieutra'],
        ];

        $actions['export-xuphat'] = [
            'class'    => 'common\actions\ExportWordAction',
            'fileName' => 'BienBanXuLyOdich',
            'view' => 'template-word-xuphat',
            'getData'  => [$this, 'getDataXuphat'],
        ];

        return $actions;
    }

    public function getDataXuphat(){
        $id = request('id');
        $model = new OdichSxh();
        return ['m' => $model];
    }


    public function actionIndex() {
        return $this->render('index');
    }

    public function actionUpdate($id = null) {
        $model = new SxhForm();
        $model->loadForm($id);
        return $this->render('update', compact('model'));
    }

    public function actionSave($id) {
        $model = new SxhForm();
        $data = collect(['errors' => [], 'warnings' => []]);
        $model->validateForm($id, $data);

        $is_chuyenca = request('status.is_chuyenca');
        $is_save = $model->saveForm($id, $data);

        return $this->asJson([
            'is_save'  => $is_save,
            'redirect_url' => ((!$id || $is_chuyenca) && $is_save) ? url(['update', 'id' => $model->id]) : null,
            'model'    => $model->toArray(),
            'errors'   => $data->get('errors'),
            'warnings' => $data->get('warnings'),
            'messages' => $data->get('messages'),
        ]);
    }

    public function getDataDieutra() {
        $id = request('id');
        $model = new SxhForm();
        $model->loadForm($id);
        return ['m' => $model];
    }


}

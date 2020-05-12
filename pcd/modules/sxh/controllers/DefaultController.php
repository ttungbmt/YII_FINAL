<?php

namespace pcd\modules\sxh\controllers;

use pcd\controllers\AppController;
use pcd\modules\sxh\forms\SxhForm;


class DefaultController extends AppController {
    public function actions() {
        $actions = parent::actions();

        $actions['export-dieutra'] = [
            'class'    => 'common\actions\ExportWordAction',
            'fileName' => 'PhieuDt_SXH',
            'getData'  => [$this, 'getDataDieutra'],
        ];

        return $actions;
    }



    public function actionIndex() {
        return $this->render('index');
    }

    public function actionUpdate($id = null) {
        $model = new SxhForm();
        $model->loadForm($id);

//        if($_SERVER['SERVER_NAME'] !== 'pcd.hcmgis.vn'){
//            dd($model->toArray());
//        }


        return $this->render('update', compact('model'));
    }

    public function actionSave($id) {
        $model = new SxhForm();
        $data = collect(['errors' => [], 'warnings' => []]);
        $model->validateForm($id, $data);

        $is_save = $model->saveForm($id, $data);

        return $this->asJson([
            'is_save'  => $is_save,
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

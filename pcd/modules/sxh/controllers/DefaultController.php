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
//        $cbs = collect(CabenhSxh::find()->with('xacminhCbs')->where("ngaybaocao >= '2020-01-01' AND sonha IS NULL AND duong IS NULL AND diachi_cc_id IS NULL AND loaidieutra = 3")->orderBy('gid DESC')->all());
//
//        $cbs = $cbs->filter(function ($i){
//            return count($i->xacminhCbs) == 2;
//        });
//        dd($cbs->first());
//        dd($cbs->count());

//        $transaction = \Yii::$app->db->beginTransaction();
//        try {
//            foreach ($cbs as $cb){
//                $cb->sonha = $cb->xacminhCbs[1]['sonha'];
//                $cb->duong = $cb->xacminhCbs[1]['duong'];
//                $cb->diachi_cc_id = $cb->xacminhCbs[0]['id'];
//                $cb->save();
//            }
//            $transaction->commit();
//        } catch (\Exception $e) {
//            $transaction->rollBack();
//            throw $e;
//        } catch (\Throwable $e) {
//            $transaction->rollBack();
//            throw $e;
//        }


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

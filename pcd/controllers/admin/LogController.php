<?php
/**
 * Created by PhpStorm.
 * User: THANHTUNG
 * Date: 06-Dec-17
 * Time: 3:49 PM
 */

namespace pcd\controllers\admin;

use pcd\controllers\AppController;
use pcd\models\LogDieutraSxhSearch;

class LogController extends AppController
{
    public function actionSxh(){
        $searchModel = new LogDieutraSxhSearch();
        $dataProvider = $searchModel->search(app('request.queryParams'));

        return $this->render('sxh', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
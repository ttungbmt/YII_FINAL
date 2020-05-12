<?php
namespace modules\pcd\thongke\controllers;

use common\controllers\BackendController;

class DncController extends BackendController {
    public function actionIndex(){
        return $this->render('index');
    }
}
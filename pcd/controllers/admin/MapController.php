<?php
namespace pcd\controllers\admin;

use pcd\controllers\AppController;

class MapController extends AppController
{
    public $layout = '@common/themes/admin/layouts/map';

    public function actionIndex(){
        return $this->redirect('map/v2');
    }

    public function actionV2(){
        return $this->renderPartial('v2');
    }
}
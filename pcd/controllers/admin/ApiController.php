<?php
/**
 * Created by PhpStorm.
 * User: THANHTUNG
 * Date: 10-Dec-17
 * Time: 9:13 AM
 */

namespace pcd\controllers\admin;

use common\controllers\MyApiController;

class ApiController extends MyApiController
{
    public function actionTest(){
        return ['test' => 123];
    }
}
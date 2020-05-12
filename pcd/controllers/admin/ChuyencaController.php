<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/8/2018
 * Time: 10:10 AM
 */

namespace pcd\controllers\admin;

use Carbon\Carbon;
use pcd\controllers\AppController;
use pcd\models\Chuyenca;
use pheme\grid\actions\ToggleAction;
use Yii;
use yii\db\Query;
use pcd\search\ChuyencaSearch;

class ChuyencaController extends AppController
{
    protected $modelClass = 'pcd\models\Chuyenca';

    public function actionIndex(){

        if(role('phuong')) {
            $searchModel = new ChuyencaSearch();
            $dataProvider = $searchModel->search(request()->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }
}
<?php

namespace pcd\controllers\admin;

use pcd\controllers\AppController;
use pcd\search\ExpOdichSearch;

class XulyOdsxhController extends AppController
{
    protected $modelClass = 'pcd\models\XulyOdsxh';

    public function actionIndex()
    {    
        $searchModel = new ExpOdichSearch();
        $dataProvider = $searchModel->search(request()->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

<?php

namespace pcd\controllers\admin;

use pcd\models\Bookmark;
use pcd\search\BookmarkSearch;
use pcd\controllers\AppController;
use yii\helpers\Html;

class BookmarkController extends AppController
{
    protected $modelClass = 'pcd\models\Bookmark';

    public function actionIndex()
    {    
        $searchModel = new BookmarkSearch();
        $dataProvider = $searchModel->search(request()->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->renderRest(['view', 'model' => $this->findModel($id)], [
            'title' => lang('Details ').'Bookmark #'.$id,
        ]);
    }

    public function actionCreate()
    {
        $model = new Bookmark();
        return $this->renderRest(['create', 'model' => $model], [
            'title' => lang('Create ').'Bookmark',
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $this->renderRest(['update', 'model' => $model], [
            'title' => lang('Update ').'Bookmark #'.$model->id,
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

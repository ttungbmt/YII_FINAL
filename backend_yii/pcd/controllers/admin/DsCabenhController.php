<?php



namespace pcd\controllers\admin;

use pcd\models\DsCabenh;
use pcd\search\DsCabenhSearch;
use pcd\controllers\AppController;
use Yii;
use yii\base\Exception;
use yii\helpers\Url;

class DsCabenhController extends AppController
{
    protected $modelClass = 'pcd\models\DsCabenh';

    public function actionIndex()
    {
        $searchModel = new DsCabenhSearch();
        $dataProvider = $searchModel->search(request()->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->renderRest(['view', 'model' => $this->findModel($id)], [
            'title' => lang('Details ').'Ca bệnh #'.$id,
        ]);
    }

    public function actionCreate()
    {
        $model = new DsCabenh();
        return $this->renderRest(['create', 'model' => $model], [
            'title' => lang('Create ').'Ca bệnh',
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $this->renderRest(['update', 'model' => $model], [
            'title' => lang('Update ').'Ca bệnh #'.$model->id,
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

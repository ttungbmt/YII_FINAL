<?php
namespace ttungbmt\leaflet\modules\mapbuilder\controllers;

use backend\controllers\BackendController;
use ttungbmt\leaflet\modules\mapbuilder\models\MapBuilder;
use ttungbmt\leaflet\modules\mapbuilder\models\search\MapBuilderSearch;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `mapbuilder` module
 */
class DefaultController extends BackendController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new MapBuilderSearch();
        $dataProvider = $model->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate(){
        $model = new MapBuilder();

        if($_POST && $model->load(Yii::$app->request->post())){
            $data = json_decode($model->value, true);
            $json = json_encode($data, JSON_UNESCAPED_UNICODE);
            if(empty($data)){
                $model->value = null;
            } else {
                $model->value = $json;
            }
            $model->group = 'mapbuilder';
            $model->key = uniqid();
            $model->key = uniqid();
            $model->save();

            return redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id){
        $model = MapBuilder::findOne($id);

        if($_POST && $model->load(Yii::$app->request->post())){
            $data = json_decode($model->value, true);
            $json = json_encode($data, JSON_UNESCAPED_UNICODE);

            if(empty($data)){
                $model->value = null;
            } else {
                $model->value = $json;
            }
            $model->save();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id){

    }
}

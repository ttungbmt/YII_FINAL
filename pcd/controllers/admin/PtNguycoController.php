<?php

namespace pcd\controllers\admin;

use DateTime;
use pcd\controllers\AppController;
use pcd\models\PhieuGs;
use pcd\models\PtNguyco;
use pcd\search\GiamsatSearch;
use pcd\search\PtNguycoSearch;
use yii\data\Pagination;
use yii\widgets\ActiveForm;

class PtNguycoController extends AppController
{
    protected $modelClass = 'pcd\models\PtNguyco';

    public function actionIndex()
    {
        $searchModel = new PtNguycoSearch();
        $dataProvider = $searchModel->search(request()->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->renderRest(['view', 'model' => $this->findModel($id)], [
            'title' => lang('Details ') . 'Điểm nguy cơ #' . $id,
        ]);
    }

    public function actionCreate()
    {
        $model = new PtNguyco();
        $giamsats = [];
        $giamsats = $model->giamsats;
        if ($_POST && $model->loadDNC(request()->all(), $giamsats)) {
            $this->saveData($model, $giamsats);
            return $this->redirect(['index']);
        }
        return $this->render('create', ['model' => $model, 'giamsats' => $giamsats]);
    }

    public function actionUpdate($id)
    {
        $model = PtNguyco::find()->where(['gid' => $id])->with('giamsats')->one();
        $giamsats = $model->giamsats;
        if ($_POST && $model->loadDNC(request()->all(), $giamsats)) {

            $this->saveData($model, $giamsats);
            return $this->redirect(['index']);
        }

        return $this->render('update', ['model' => $model, 'giamsats' => $giamsats]);
    }

    public function saveData(&$model, &$giamsats)
    {
        $model->save();

        $ms = collect(request('PhieuGs'))->map(function ($i){$m = DateTime::createFromFormat("d/m/Y", data_get($i, 'ngay_gs'))->format('m');return intval($m);});
        $ngay_cn = request('PtNguyco.ngaycapnhat');
        $year = $ngay_cn ? (DateTime::createFromFormat("d/m/Y", $ngay_cn))->format('Y') : date('Y');
        $k = collect(request('KehoachGs'))->where('dukien', 1)->mapWithKeys(function ($i) use ($year, $ms) {
            if (!$i['id']) {
                unset($i['id']);
            }
            $m = data_get($i, 'month');
            return [$m => array_merge($i, [
                'year' => $year,
            ])];
        });
        $d = $ms->unique()
            ->mapWithKeys(function ($i) use($year){return [$i => ['year' => $year, 'month' => $i, 'thucte' => 1]];})
            ;
        $end = collect();
        foreach (range(1,12) as $m){
            $tt = $d->firstWhere('month', $m);
            $dk = $k->firstWhere('month', $m);
            if($dk){
                $e = array_merge($dk, $tt ? $tt : []);
                $end->push($e);
            }
        }
        $end = $end->all();
        $model->syncOne('kehoachs', $end);

        $data = collect($giamsats)->map(function ($i) {
            return $i->toArray();
        })->all();
        $model->syncOne('giamsats', $data);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleteRecursive(['giamsats']);
        return $this->renderRest();
    }

    public function actionKetquaGs()
    {
        $searchModel = new GiamsatSearch();
        $dataProvider = $searchModel->search(request()->queryParams);

        return $this->render('ketqua_gs', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionKehoachGs($index = 1, $year = null)
    {
        $searchModel = new GiamsatSearch();
        $dataProvider = $searchModel->search(request()->queryParams);

        return $this->render('kehoach_gs', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'index' => $index,
            'year' => $year,
        ]);
    }

    public function actionViewGs($i)
    {
        $model = new PhieuGs();
        $form = ActiveForm::begin();
        return $this->renderAjax('_sub_gs', ['form' => $form, 'model' => $model, 'i' => $i]);
    }
}

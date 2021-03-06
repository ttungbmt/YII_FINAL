<?php
namespace pcd\modules\pt_nguyco\controllers;

use Carbon\Carbon;
use common\components\Access;
use common\controllers\BackendController;
use common\events\AccessEvent;
use common\supports\ModelNotFoundException;
use DateTime;
use kartik\widgets\ActiveForm;
use pcd\modules\pt_nguyco\models\PhieuGs;
use pcd\modules\pt_nguyco\models\PtNguyco;
use pcd\modules\pt_nguyco\models\search\PtNguycoSearch;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `pt_nguyco` module
 */
class DefaultController extends BackendController
{
//    protected function access(){
//        return [
//            'pt_nguyco' => ['index', 'create', 'update', 'delete']
//        ];
//    }

    protected $modelClass = 'pcd\modules\pt_nguyco\models\PtNguyco';

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
            $this->accessHook->beforeUpdate($this);
            $this->saveData($model, $giamsats);
            return $this->redirect(['index']);
        }
        return $this->render('create', ['model' => $model, 'giamsats' => $giamsats]);
    }

    public function actionUpdate($id)
    {
        $model = PtNguyco::find()->where(['gid' => $id])->with('giamsats')->one();
        if(!$model){
            throw new ModelNotFoundException('Model not found');
        }

        $giamsats = $model->getGiamsats()->orderBy('id')->all();
        if ($_POST && $model->loadDNC(request()->all(), $giamsats)) {
            $this->accessHook->beforeUpdate($this);
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

        $data = collect($giamsats)->map(function ($i) {
            return array_merge($i->toArray(), [
                'xuphat' => $i->xuphat === '' ? null : $i->xuphat,
                'vc_lq_dxl' => $i->vc_lq_dxl === '' ? null : $i->vc_lq_dxl,
                'ngay_gs' =>  $i->ngay_gs ? Carbon::createFromFormat('d/m/Y', $i->ngay_gs)->format('Y-m-d') : null,
                'ngayxuphat' =>  $i->ngayxuphat ? Carbon::createFromFormat('d/m/Y', $i->ngayxuphat)->format('Y-m-d') : null,
            ]);
        })->all();

        $model->syncOne('giamsats', $data);
    }

    public function actionDelete($id)
    {
        $this->accessHook->beforeDelete($this);

        $model = $this->findModel($id);
        $model->deleteRecursive(['giamsats']);
        return $this->renderRest();
    }


    public function actionViewGs($i)
    {
        $model = new PhieuGs();
        $form = ActiveForm::begin();
        return $this->renderAjax('_sub_gs', ['form' => $form, 'model' => $model, 'i' => $i]);
    }
}

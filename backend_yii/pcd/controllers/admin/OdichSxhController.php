<?php
namespace pcd\controllers\admin;
use pcd\controllers\AppController;
use pcd\models\Cabenh;
use pcd\models\CabenhSxh;
use pcd\models\OdichSxh;
use pcd\models\OdichSxhPoly;
use pcd\modules\pt_nguyco\models\PtNguyco;
use pcd\models\KehoachXulyOdsxh;
use pcd\models\XulyOdsxh;
use pcd\search\OdichSxhSearch;
use Yii;
use yii\db\Expression;
use yii\helpers\Html;
use yii\web\Response;

class OdichSxhController extends AppController
{
    public $modelClass = 'pcd\models\OdichSxh';

    public function actions() {
        $actions = parent::actions();

        $actions['export-khxl'] = [
            'class' => 'common\actions\ExportWordAction',
            'fileName' => 'Form_KHXLOD',
            'getData' => [$this, 'getDataKehoachXl'],
        ];

        return $actions;
    }

    public function getDataKehoachXl(){
        $id =request('id');
        $od = OdichSxh::findOne($id);
        $cbs = collect($od->cabenhs);
        $ids = $cbs->pluck('gid');
        $cb = $cbs->take(2)->last();
        $kh = $od->kehoachXulyOdsxh;
        $dnc = $this->getDnc($ids);

        return ['m' => [
                'diachi' => $od->diachiTxt,
                'soca' => $cbs->count(),
                'benh_ngaynhan' => Html::a(data_get($cb, 'ngaynhanthongbao'), url(['admin/cabenh-sxh/update', 'id' => data_get($cb, 'gid')]), ['target' => '_blank']),
            ], 'kh' => $kh,
            'dnc' => $dnc
        ];
    }

    public function actionIndex(){
        $searchModel = new OdichSxhSearch();
        $dataProvider = $searchModel->search(request()->all());
        if(request('partial') == true){
            $this->layout = '@app/views/layouts/partial';
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionXuly($id){
        $data = $this->findModel($id)->xulyOdsxhs;
        return $this->asJson([
            'title' => 'Xử lý ổ dịch',
            'content' => $this->renderPartial('xuly', ['data' => $data]),
        ]);
    }

    public function actionView($id)
    {
        $request = Yii::$app->request;
        $params = $request->queryParams;
        $model = $this->findModel($id);


        if (isset($params['onmap']) && $params['onmap']) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $dsCabenh = $model->v_cabenhs;
            return array_merge(['sxhs' => $dsCabenh], $model->attributes);
        }

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'   => "Cập nhật ổ dịch #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer'  => Html::button('Đóng', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Cập nhật', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }
//
//    /**
//     * Creates a new OdichSxh model.
//     * For ajax request will return json object
//     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
//     *
//     * @return mixed
//     */

    public function actionCreate()
    {
        return $this->redirect(['/sxh/odich/create', 'cabenh_ids' => request('cabenh_ids')]);
//        $request = Yii::$app->request;
//        $model = new OdichSxh();
//
//        if ($model->load($request->post()) && $model->validate()) {
//            if ($model->saveOdich($request)) {
//                return $this->redirect('index');
//            }
//        } else {
//
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
    }

    protected function getDnc($ids){
        $distance = 200;
        $sql = CabenhSxh::find()->select(new Expression("ST_Union(ST_Buffer(geom::geography, {$distance})::geometry) geom"))->andWhere(['gid' => $ids])->createCommand()->getRawSql();
        $models = PtNguyco::find()->andWhere(new Expression("ST_Intersects(geom, ({$sql}))"))->asArray()->all();
        return $models;
    }

    /**
     * Updates an existing OdichSxh model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;

        $model = OdichSxh::find()->where(['id' => $id])->with(
            [
                'xulyOdsxhs' => function ($q) {
                    $q->orderBy('lanxl ASC');
                },
                'cabenhs'
            ]
        )->one();

        $geomArr = [];
        $cabenh = $model->cabenhs;
        foreach($cabenh as $val) {
            array_push($geomArr, $val['gid']);
        }

        $geomodich = Yii::$app->db->CreateCommand("
            SELECT st_asgeojson(st_union(st_buffer(cb.geom::geography , 200)::geometry)) as geom
            FROM cabenh_sxh cb
            WHERE gid IN (" . implode(', ', $geomArr) . ")")->queryColumn();

        $khXulyOdsxh = KehoachXulyOdsxh::findOne(['odich_id' => $model->id]);
        $khXulyOdsxh = $khXulyOdsxh ? $khXulyOdsxh : new KehoachXulyOdsxh();
        if ($model->load($request->post()) && $model->validate()) {
            // dd($request->post());
            if ($model->saveOdich($request)) {
                return $this->redirect('index');
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'geomodich' => $geomodich,
                'khXulyOdsxh' => $khXulyOdsxh
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleteRecursive(['xulyOdsxhs', 'odichSxhPoly', 'kehoachXulyOdsxh']);

        return $this->asJson([
            'forceClose' => true,
            'forceReload' => '#pjax-container',
        ]);
    }
}

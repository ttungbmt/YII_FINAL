<?php

namespace pcd\controllers\admin;

use pcd\controllers\AppController;
use pcd\entities\mCabenh;
use pcd\entities\mDieutraSxh;
use pcd\entities\vPhieuSxh;
use pcd\models\Cabenh;
use pcd\models\DieutraSxh1;
use pcd\modules\auth\services\UserService;
use pcd\search\SXHSearch;
use pcd\services\DichteCommand;
use pcd\services\ExcelService;
use Yii;
use pcd\models\DieutraSxh;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * SxhController implements the CRUD actions for DieutraSxh model.
 */
class SxhController extends AppController
{
    protected $cabenh;
    protected $dtSxh;
    protected $vPhieuSxh;
    public $data;
    protected $method;

    public function __construct($id,
                                $module,
                                mCabenh $cabenh,
                                mDieutraSxh $dtSxh,
                                vPhieuSxh $vPhieuSxh,
                                $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->cabenh = $cabenh;
        $this->dtSxh = $dtSxh;
        $this->vPhieuSxh = $vPhieuSxh;
    }


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $params = app('request.queryParams');

        $searchModel = new SXHSearch(); //new Cabenh1Search();
        $dataProvider = $searchModel->search($params);
        $partial = collect($params)->get('partial', false);

        if ($partial) {
            return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate($macabenh = null)
    {
        $this->method = 'create';
        app()->view->params['button'] = 'Lưu phiếu điều tra';

        if ($macabenh) {
            // Kiểm tra tồn tại phiếu SXh
            $phieu = $this->vPhieuSxh->find()->where(['macabenh' => $macabenh])->one();
            if ($phieu) return $this->redirect(['update', 'ma_dt_sxh' => $phieu->ma_dt_sxh]);

            // Thành phố gửi về
            $this->cabenh = $this->cabenh->getCabenh($macabenh);
        }

        $this->beforeCreatePhieu();
        return $this->formXL();

    }

    public function actionUpdate($ma_dt_sxh)
    {

        $this->method = 'update';
        app()->view->params['button'] = 'Kiểm tra & Cập nhật phiếu';

        $this->vPhieuSxh = $this->vPhieuSxh->firstOrFail(['ma_dt_sxh' => $ma_dt_sxh]);
        $user = new UserService();


        return $this->formXL();
    }

    protected function formXL()
    {
        $phieu = $this->vPhieuSxh;
        $postData = Yii::$app->request->post();

        if ($_POST && isset($postData['vPhieuSxh']) & $phieu->validatePhieu($postData['vPhieuSxh'], $this->method)) {
            $dtSxh = $phieu->dieutraSxh;
            if (!$dtSxh) $dtSxh = $this->dtSxh;

            $dtSxh->attributes = $phieu->attributes;

            // Lưu ca bệnh
            if ($dtSxh->macabenh) {
                $cabenh = Cabenh::find()->where(['macabenh' => $dtSxh->macabenh])->one();
            } else {
                $cabenh = new Cabenh();
            }

            // Lưu ca bệnh
            $cabenh->attributes = $phieu->attributes;
            $cabenh->save();

            $dtSxh->macabenh = $cabenh->macabenh;
            $dtSxh->save();

            DichteCommand::updateCabenhWithCurrentTime($dtSxh->cabenh);
            Yii::$app->session->addFlash('messages', ['success' => 'Lưu thành công Phiếu điều tra SXH']);
            if ($this->method == 'create') {
                return $this->redirect(['update', 'ma_dt_sxh' => $dtSxh->ma_dt_sxh]);
            }
            $phieunew = $this->vPhieuSxh->find()->where(['ma_dt_sxh' => $phieu->ma_dt_sxh])->one() ?: $phieu;
            $phieu->attributes = $phieunew->attributes;
        }

        $this->vPhieuSxh = $phieu;
        return $this->render('_form', ['psxh' => $phieu]);
    }

    protected function beforeCreatePhieu()
    {
        $this->vPhieuSxh->attributes = $this->cabenh->attributes;

        if ($this->cabenh->benhvien) {
            $this->vPhieuSxh->tpbv = 1;
//            $bv = Benhvien::find()->where(['tenvt' => $this->cabenh->benhvien])->one();
            $this->vPhieuSxh->tpbv_bv = $this->cabenh->benhvien;
        }
    }

    /**
     * @param $ma_dt_sxh
     * @return string
     */
    public function actionWord($ma_dt_sxh = null)
    {
        $sxh = $ma_dt_sxh ? $this->vPhieuSxh->firstOrFail(['ma_dt_sxh' => $ma_dt_sxh]) : $this->vPhieuSxh;
        $headers = Yii::$app->response->headers;
        $headers
            ->add('Content-Type', 'application/vnd.ms-word')
            ->add('Content-Disposition', 'attachment;Filename=PhieuDieutraSXH.doc');
        return $this->renderPartial('word', ['sxh' => (object)$sxh->toArray()]);
    }


    # http://localhost:1111/dieutra/sxh/excel
    public function actionExcel()
    {

        $model = $this->vPhieuSxh;
        // Thiết lập định dạng xuất
        $model->typeExport = 'excel';

        // Build dữ liệu
        $dataExcel = $model->buildExcel();

        // Download excel
        ExcelService::download($dataExcel, [
            'file_name' => 'DieutraSXH',
            'sheet_name' => 'SXH',
        ]);

    }


    /**
     * Deletes an existing DieutraSxh model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $cabenh = Cabenh::find()->where(['macabenh' => $id])->one();
        $sxh = DieutraSxh1::find()->where(['macabenh' => $cabenh->macabenh])->one();

        $cabenh->delete();
        !$sxh || $sxh->delete();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#kv-pjax-container'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }

    /**
     * Finds the DieutraSxh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DieutraSxh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DieutraSxh1::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}

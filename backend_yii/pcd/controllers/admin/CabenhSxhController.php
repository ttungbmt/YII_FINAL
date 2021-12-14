<?php

namespace pcd\controllers\admin;

use common\actions\ExportWordAction;
use common\models\Query;
use pcd\controllers\AppController;
use pcd\forms\CabenhSxhForm;
use pcd\models\CabenhSxh;
use pcd\models\Chuyenca;
use pcd\models\Cungnha;
use pcd\models\DieutraSxh;
use pcd\models\XacminhCb;
use pcd\search\CabenhSxhSearch;
use Yii;
use yii\db\Expression;
use pcd\models\VPhieuDt;

class CabenhSxhController extends AppController {
    protected $modelClass = 'pcd\models\CabenhSxh';


    public function actionIndex() {
        $searchModel = new CabenhSxhSearch();
        $dataProvider = $searchModel->search(request()->queryParams);

        if (request('partial') == true) {
            $this->layout = '@app/views/layouts/partial';
            return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->renderRest(['view', 'model' => $this->findModel($id)], [
            'title' => 'Chi tiết Ca bệnh nghi ngờ #' . $id,
        ]);
    }

    public function actionCreate($id = null) {
        $model = $id ? CabenhSxhForm::findOne($id) : new CabenhSxhForm();
        if ($model->isNewRecord) {
            $model->setDefaultValues();
        }
        $xacminhCbs = [new XacminhCb(), new XacminhCb()];

        if (request()->isPost && $model->saveModel($xacminhCbs)) {
            Yii::$app->session->setFlash('success', 'Đã thêm mới ca bệnh');
            return $this->redirect(['index']);
//            return $this->redirect(['update', 'id' => $model->getId()]);
        }

//        dd($xacminhCbs);
        return $this->render('create', ['model' => $model, 'xacminhCbs' => $xacminhCbs]);
    }

    public function actionUpdate($id) {
        $model = CabenhSxhForm::findOne($id);
        $xacminhCbs = XacminhCb::find()->where(['cabenh_id' => $id])->orderBy('id')->with('phuong')->indexBy('id')->all();

        if (empty($xacminhCbs)) {
            return $this->redirect(['create', 'id' => $id]);
        }

        if (request()->isPost) {
            if ($model->saveModel($xacminhCbs)) {
                Yii::$app->session->setFlash('success', 'Đã cập nhật ca bệnh');
                return $this->refresh();
            }
        }

        if (request()->isGet && count($xacminhCbs) > 0) {
            if (!(count($xacminhCbs) % 2)) {
                array_push($xacminhCbs, new XacminhCb());
                array_push($xacminhCbs, new XacminhCb());
            } else {
                array_push($xacminhCbs, new XacminhCb());
            }
        }

        return $this->render('update', ['model' => $model, 'xacminhCbs' => $xacminhCbs]);
    }

    public function restSave(&$model) {
        $model->save();
    }

    public function actionDelete($id) {
        $cabenh = $this->findModel($id);
        if ($cabenh) {
            $cabenh->delete();
            DieutraSxh::deleteAll(['cabenh_id' => $id]);
            XacminhCb::deleteAll(['cabenh_id' => $id]);
            Chuyenca::deleteAll(['cabenh_id' => $id]);
        }

        return $this->renderRest();
    }

    public function actionWord($id) {
//        $sxh = $ma_dt_sxh ? $this->vPhieuSxh->firstOrFail(['ma_dt_sxh' => $ma_dt_sxh]) :  $this->vPhieuSxh;
        $sxh = (new Query())->select('dt.*, p1.tenphuong, p1.tenquan, p2.tenphuong as px_xm,
         p2.tenquan as qh_xm, p3.tenquan as ten_dclamviecqh, p3.tenphuong as ten_dclamviecpx')
            ->from('v_phieu_dt dt')
            ->leftJoin('hc_phuong p1', 'dt.maphuong = p1.maphuong')
            ->leftJoin('hc_phuong p2', 'dt.px = p2.maphuong')
            ->leftJoin('hc_phuong p3', 'dt.dclamviecpx = p3.maphuong::int4')
            ->where(['dt.gid' => $id])
            ->one();
//        $headers = Yii::$app->response->headers;
//        $headers
//            ->add('Content-Type', 'application/vnd.ms-word')
//            ->add('Content-Disposition', 'attachment;Filename=PhieuDieutraSXH.doc');
        return $this->renderPartial('_word', ['sxh' => (object)$sxh]);
//        return $this->renderPartial('word');
//
//        return $this->render('@pcd/themes/admin/admin/site/default', ['message' => 'Tính năng xuất file word đang được nâng cấp. Vui lòng quay lại sau.']);
    }

    public function actionCungnha() {
        if (request('gid')) {
            $geometry = new Expression("ST_GeomFromGeoJSON('" . json_encode(request('geometry')) . "')");
            $distance = new Expression("ST_Distance({$geometry}::geography, geom::geography)");
            $q = CabenhSxh::find()->addSelect(['distance' => $distance])
                ->where("ST_DWithin({$geometry}::geography, geom::geography, 100)")
                ->orderBy([$distance, 'ngaymacbenh' => SORT_ASC]);

            $ncb = collect();
            $gid = request('gid');
            if ($gid) {
                $ncb = collect(Cungnha::find()->where(['cabenh_id' => $gid])->with('nCabenh')->all());
                $q->andFilterWhere(['<>', 'gid', $gid]);
            }

            $models = collect($q->indexBy('gid')->all())->map(function ($i, $k) use ($ncb) {
                if ($_cb = $ncb->firstWhere('n_cabenh_id', $k)) {
                    $i->is_cungnha = 1;
                    $i->cungnha_id = $_cb->id;
                }

                return $i;
            });

            return $this->renderPartial('_cungnha', ['models' => $models]);
        }
    }


    public function actionAcceptCc($id) {
        $chca = Chuyenca::findOne($id);
        if ($chca) {
            $chca->is_chuyentiep = 1;
            $chca->save();

            return $this->asJson([
                'status' => 'OK'
            ]);
        }

        return $this->asJson([
            'status' => 'FAIL'
        ]);
    }
}
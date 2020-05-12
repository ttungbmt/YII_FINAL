<?php
namespace modules\pcd\import\controllers;

use common\actions\ImportAction;
use common\controllers\BackendController;
use common\controllers\ImportTrait;
use pcd\models\Benhvien;
use pcd\models\CabenhSxh;
use pcd\models\DmPhuong;
use pcd\models\DmQuan;
use pcd\models\Loaibenh;
use pcd\supports\RoleHc;
use yii\base\Model;

class SxhController extends BackendController {
//    public function actions() {
//        return [
//            'index' => [
//                'class' => ImportAction::className(),
//            ]
//        ];
//    }

    use ImportTrait;
    public $enableCsrfValidation = false;
    protected $modelImportClass = 'modules\pcd\import\forms\SxhImportForm';
    protected $modelClass = 'pcd\models\CabenhSxh';

    protected function options()
    {
        return [
            'header' => ['bv', 'icd', 't_benh', 'shs', 'ho_ten', 'phai', 'tuoi', 'dia_chi', 'nghe_nghiep', 'me', 'dt', 'qh', 'px', 'ng_nv', 'ng_bc', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc', 'hinh_thuc_dieu_tri', 'lat', 'lng'],
            'sample' => '/pcd/storage/samples/MAU_SXH.xlsx',
            'startDataRow' => 1
        ];
    }

    protected function prepareData()
    {
        $roles = RoleHc::init();

        $restrict_benh = 'SXH';
        $this->data['dm_loaibenh'] = Loaibenh::find()->select(['mabenh', 'tenbenh'])->andWhere(['mabenh' => $restrict_benh])->asArray()->indexBy('tenbenh')->all();
        $this->data['dm_bv'] = Benhvien::find()->select(['ma_bv' => 'mabenhvien', 'code' => 'tenvt'])->asArray()->indexBy('ma_bv')->all();

        $qh =  DmQuan::find()->select(['tenquan' => 'ten_qh', 'maquan' => 'ma_quan']);
        $px = DmPhuong::find()->select([
            'maquan' => 'ma_quan',
            'tenquan' => 'ten_qh',
            'maphuong' => 'ma_phuong',
            'tenphuong' => 'ten_px'
        ]);
        if(role('quan')){
            $roles->filterMahc($qh, 'maquan');
            $px->andWhere(['maquan' => (string)$roles->maquan]);
        } elseif (role('phuong')){
            $qh->andWhere(['maquan' => (string)$roles->maquan]);
            $roles->filterMahc($px, 'maphuong');
        }

        $this->data['dm_quan'] = $qh->asArray()->indexBy('maquan')->all();
        $this->data['dm_phuong'] = $px->select([
            'maquan' => 'ma_quan',
            'tenquan' => 'ten_qh',
            'maphuong' => 'ma_phuong',
            'tenphuong' => 'ten_px'
        ])->asArray()->indexBy('maphuong')->all();
    }

    protected function rules(&$model)
    {

        $model->dm_loaibenh = $this->data_get('dm_loaibenh');
        $model->dm_bv = $this->data_get('dm_bv');
        $model->dm_quan = $this->data_get('dm_quan');
        $model->dm_phuong = $this->data_get('dm_phuong');
    }

    protected function validateModels($excelModels)
    {
        $data = [];
        $models = [];

        foreach ($excelModels as $k => $i) {
            $data[$k] = $i->toArray();
            $data[$k]['maquan'] = $data[$k]['qh'];
            $data[$k]['maphuong'] = $data[$k]['px'];

            $models[$k] = new CabenhSxh();
        }

        // Validate model and relation 2rd
        if (
            Model::loadMultiple($models, $data, '') &&
            Model::validateMultiple($models)
        ) {

            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            try {
                $this->saveModels($models, $data, $connection);
                $transaction->commit();
                return true;
            } catch (\Exception $e) {
                $transaction->rollback();
                dd($e);
            }
            return true;
        }

        $this->data['models'] = $models;
        return false;
    }

    protected function saveModels($models, $data, $connection)
    {
        foreach ($models as $m) {
            $m->save();
        }
    }
}
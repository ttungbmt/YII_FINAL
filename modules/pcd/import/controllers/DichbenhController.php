<?php
namespace modules\pcd\import\controllers;

use common\controllers\BackendController;
use common\controllers\ImportTrait;

use pcd\modules\benh_tn\models\BenhTn;
use pcd\models\DmPhuong;
use pcd\models\DmQuan;
use yii\base\Model;

class DichbenhController extends BackendController {
    use ImportTrait;
    public $enableCsrfValidation = false;
    protected $modelImportClass = 'modules\pcd\import\forms\DichbenhImportForm';
    protected $modelClass = 'pcd\modules\benh_tn\models\BenhTn';

    protected function options()
    {
        return [
            'header' => ['bv', 'icd', 't_benh', 'shs', 'ho_ten', 'phai', 'tuoi', 'dia_chi', 'nghe_nghiep', 'me', 'dt', 'qh', 'px', 'ng_nv', 'ng_bc', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc', 'hinh_thuc_dieu_tri', 'lat', 'lng'],
            'sample' => '/gsnc/storage/samples/vt-khaosat-import.xlsx',
            'startDataRow' => 1
        ];
    }


    protected function prepareData()
    {
        $this->data['dm_quan'] = DmQuan::find()->select(['tenquan' => 'ten_qh', 'maquan' => 'ma_quan'])->asArray()->indexBy('maquan')->all();
        $this->data['dm_phuong'] = DmPhuong::find()->select([
            'maquan' => 'ma_quan',
            'tenquan' => 'ten_qh',
            'maphuong' => 'ma_phuong',
            'tenphuong' => 'ten_px'
        ])->asArray()->indexBy('maphuong')->all();
    }

    protected function rules(&$model)
    {
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

            $models[$k] = new BenhTn();
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
//
//        $connection->createCommand()->batchInsert('ql_chitieu', ['chitieu_id', 'giatri', 'entity_type', 'entity_id'], $chitieus)->execute();
    }
}
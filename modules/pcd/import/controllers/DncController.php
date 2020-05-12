<?php
namespace modules\pcd\import\controllers;

use common\controllers\BackendController;
use common\controllers\ImportTrait;

use pcd\modules\benh_tn\models\BenhTn;
use pcd\models\DmPhuong;
use pcd\models\DmQuan;
use yii\base\Model;

class DncController extends BackendController {
    use ImportTrait;
    public $enableCsrfValidation = false;
    protected $modelImportClass = 'modules\pcd\import\forms\DncImportForm';
    protected $modelClass = 'modules\pcd\pt_nguyco\models\PtNguyco';

    protected function options()
    {
        return [
            'header' => ['maquan', 'maphuong', 'khupho', 'to', 'diachi', 'sonha', 'tenduong', 'ten_cs', 'dienthoai', 'loaihinh', 'nhom', 'ngaycapnhat', 'ngayxoa', 'lat', 'lng',],
            'sample' => '/pcd/storage/samples/MAU_DNC.xlsx',
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
            $models[$k] = new $this->modelClass();
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
            if($m->lat && $m->lng){
                $m->geom = [floatval($m->lng), floatval($m->lat)];
            }

            $m->save();
        }
    }
}
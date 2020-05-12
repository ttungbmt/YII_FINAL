<?php
namespace modules\pcd\import\controllers;

use common\controllers\BackendController;
use common\controllers\ImportTrait;
use pcd\models\DmQuan;
use yii\base\Model;

class XnHuyetthanhController extends BackendController {
    use ImportTrait;
    public $enableCsrfValidation = false;
    protected $modelImportClass = 'modules\pcd\import\forms\XnHuyetthanhImportForm';
    protected $modelClass = 'pcd\models\XnHuyetthanh';

    protected function options()
    {
        return [
            'header' => ['maso', 'hoten', 'ngaynhanmau', 'ngaykhoibenh', 'ngaylay_bp', 'ngaynhan_bp', 'phai', 'namsinh', 'maquan', 'maphuong', 'diachi', 'donvi_gui', 'duan', 'yeucau_xn', 'ketqua', 'phantip_virut', 'ketluan'],
            'sample' => '/pcd/storage/samples/MAU_HUYETTHANH.xlsx',
            'startDataRow' => 1
        ];
    }

    protected function prepareData()
    {
        $this->data['dm_quan'] = DmQuan::find()->select(['tenquan' => 'ten_qh', 'maquan' => 'ma_quan'])->asArray()->indexBy('maquan')->all();
    }

    protected function rules(&$model)
    {
        $model->dm_quan = $this->data_get('dm_quan');
    }

    protected function validateModels($excelModels)
    {
        $data = [];
        $models = [];

        foreach ($excelModels as $k => $i) {
            $data[$k] = $i->toArray();
            $models[$k] = new $this->modelClass;
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
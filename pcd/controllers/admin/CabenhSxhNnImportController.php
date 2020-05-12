<?php

namespace pcd\controllers\admin;

use pcd\controllers\AppController;
use common\forms\UploadForm;
use common\libs\excel\Excel;
use kartik\helpers\Html;
use pcd\models\CabenhSxh;
use yii\base\Model;
use yii\data\ArrayDataProvider;


class CabenhSxhNnImportController extends AppController
{
    public $enableCsrfValidation = false;

    protected $modelClass = 'pcd\forms\CabenhSxhNnImportForm';

    protected $sampleFile = 'storage/samples/ca-nghi-ngo.xlsx';

    public function actionIndex()
    {
        $fileEx = new $this->modelClass;
        $model = new UploadForm();
        $excel = new Excel();

        if ($model->load(request()->post())) {
            if ($model->validateForm()) {

                list($fileName, $type) = [$model->file->tempName, request('type')];

                /**
                 * Check format column of file Excel input
                 **/
                $header = $excel->readSheetHeader($fileName);
                $diff_1 = array_diff(array_values($header), array_keys($fileEx->attributeLabels()));
                $diff_2 = array_diff(array_keys($fileEx->attributeLabels()), array_values($header));
                if (!empty($diff_1) || !empty($diff_2)) {
                    $this->data['models'] = "Excel không đúng định dạng, file phải chứa các cột trong file mẫu: <br>" . implode(', ', array_values($fileEx->attributeLabels())) . "<br>";

                    return $this->renderJson([
                        'html' => $this->renderAjax('_errors', $this->data)
                    ]);
                }

                $data = collect($excel->import($fileName))->map(function ($item) {
                    return (new $this->modelClass($item));
                })->all();
                $models = $data;

                $this->data['page'] = request()->post('page', 0);
                $this->data['dataProvider'] = new ArrayDataProvider([
                    'allModels'  => $models,
                    'pagination' => [
                        'pageSize' => 20,
                        'page'     => $this->data['page']
                    ]
                ]);
                $passes = Model::validateMultiple($models);

                $this->data['models'] = $models;

                switch ($type) {
                    case 'preview':
                        $pages = collect(explode(',', request()->post('pages', null)))->filter(function ($item) {
                            return $item !== '';
                        })->all();

                        if (in_array($this->data['page'], $pages)) {
                            $this->data['message'] = 'Dữ liệu đã được nhập';
                            $this->data['hideBtnImport'] = true;
                        }
                        break;
                    case 'save':
                        $models = $this->data['dataProvider']->getModels();
                        $name = class_basename(new $this->modelClass);
                        if (Model::loadMultiple($models, request()->all(), $name) && Model::validateMultiple($models)) {
                            $this->saveModels($models);
                        }

                        break;

                    case 'save-all':
                        if ($passes) {
                            $this->saveModels($models);
                        }
                        break;
                }
                return $this->renderJson([
                    'html' => $this->renderAjax('_preview', $this->data)
                ]);

            } else {

                $this->data['models'] = [$model];

                return $this->renderJson([
                    'html' => $this->renderAjax('_errors', $this->data)
                ]);
            }
        }


        return $this->render('index', [
            'model'      => $model,
            'sampleFile' => asset($this->sampleFile)
        ]);
    }

    /**
     * @param $data
     * @param $name
     *
     * @return bool
     */
    protected function validateModels(&$data, $name)
    {
        $data = collect($data)->map(function ($item) {
            return $item->toArray();
        })->values()->all();

        $models = array_fill(0, count($data), $name);

        if (Model::loadMultiple($models, $data, '') && Model::validateMultiple($models)) {
            foreach ($data as $d) {

                $m = new CabenhSxh();
                $m->setAttributes($d);
                $m->ngaymacbenh = $d['ngaymacbenh_nv'];
                $m->is_nghingo = 1;

                /**
                 * Kiểm tra lat lng
                 */
                if ($d['lat'] && $d['lng']) {
                    $m->geom = [$d['lng'], $d['lat']];
                }
                $m->save();
            }

            return true;
        }

        $this->data['errors'] = $models;

        return false;
    }

    protected function saveModels($models)
    {
        if ($this->validateModels($models, new CabenhSxh())) {

            $count = count($models);
            $this->data['message'] = 'Đã lưu thành công ' . Html::a($count . ' đối tượng', '#', ['class' => 'alert-link']);
            $this->data['page'] = request('page');
        }
    }

}
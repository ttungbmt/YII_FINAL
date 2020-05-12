<?php
namespace pcd\controllers\admin;

use common\forms\UploadForm;
use common\libs\excel\Excel;
use kartik\helpers\Html;
use pcd\controllers\AppController;
use pcd\forms\CabenhDudoanForm;
use pcd\models\DsCabenh;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use Yii;

class ImportController extends AppController
{
    public $enableCsrfValidation = false;

    protected $modelClass = 'pcd\forms\CabenhDudoanForm';

    protected $sampleFile = 'storage/samples/ds1.xlsx';

    public function actionIndex()
    {
        $fileEx = new CabenhDudoanForm();
        $model = new UploadForm();
        $excel = new Excel();

//        $session = Yii::$app->session;

        if ($model->load(request()->post())) {
            if ($model->validateForm()) {

//                if(!isset($session['previousFile']) || $model->file->name != $session['previousFile']) {
//                    $session['saved'] = [];
//                    $session['previousFile'] = $model->file->name;
//                }

                list($fileName, $type) = [$model->file->tempName, request('type')];

                $data = collect($excel->import($fileName))->map(function ($item) {
                    return (new $this->modelClass($item));
                })->all();
                $models = $data;

                $this->data['page'] = request()->post('page', 0);
                $this->data['dataProvider'] = new ArrayDataProvider([
                    'allModels'  => $models,
                    //'pagination' => false,
                    'pagination' => [
                        'pageSize' => 20,
                        'page'     => $this->data['page']
                    ]
                ]);
                $passes = Model::validateMultiple($models);

                $this->data['models'] = $models;

                switch ($type) {
                    case 'preview':
                        $header = $excel->readSheetHeader($fileName);
                        $diff_1 = array_diff(array_values($header), array_keys($fileEx->attributeLabels()));
                        $diff_2 = array_diff(array_keys($fileEx->attributeLabels()), array_values($header));
                        if (!empty($diff_1) || !empty($diff_2)) {
                            $this->data['models'] = "Excel k đúng định dạng. Phải tồn tại các cột: <b>" . implode(', ', array_keys ($fileEx->attributeLabels())) . "</b>";

                            return $this->renderJson([
                                'html' => $this->renderAjax('_errors', $this->data)
                            ]);
                        }

                        $pages = explode(',', request()->post('pages', null));
                        $pages = collect(explode(',', request()->post('pages', null)))->filter(function($item){
                            return $item !== '';
                        })->all();

                        if(in_array($this->data['page'], $pages)){
                            $this->data['message'] = 'Dữ liệu đã được nhập';
                            $this->data['hideBtnImport'] = true;
                        }
                        break;
                    case 'save':
                        $models = $this->data['dataProvider']->getModels();
                        $name = class_basename(new $this->modelClass);
                        if (Model::loadMultiple($models, request()->all(), $name) && Model::validateMultiple($models)) {
                            $this->saveModels($models);
//                            $session['saved'] = array_merge($session['saved'], [$this->data['page'] => true]);
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

    protected function validateModels(&$data, $name)
    {
        $data = collect($data)->map(function ($item){ return $item->toArray();})->values()->all();

        $models = array_fill(0, count($data), $name);

        if (Model::loadMultiple($models, $data, '') && Model::validateMultiple($models)) {
            return true;
        }

        $this->data['errors'] = $models;

        return false;
    }

    protected function saveModels($models)
    {
        if ($this->validateModels($models, new DsCabenh)) {
            foreach ($models as $m) {
//                $m->save();
            }

            $count = count($models);
            $this->data['message'] = 'Đã lưu thành công ' . Html::a($count . ' đối tượng', '#', ['class' => 'alert-link']);
            $this->data['page'] = request('page');
        }
    }
}
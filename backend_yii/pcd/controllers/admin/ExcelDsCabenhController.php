<?php

namespace pcd\controllers\admin;

use pcd\controllers\AppController;
use pcd\models\DsCabenh;
use pcd\traits\ExcelTrait;
use pcd\services\ExcelService;
use pcd\forms\ExcelDsCabenh;
use Yii;
use pcd\models\UploadForm;
use yii\web\UploadedFile;
use yii\base\Model;

class ExcelDsCabenhController extends AppController
{
    use ExcelTrait;

    public $data = [];

//    public function actionImportdata()
//    {
//        $modelData = new DsCabenh();
//        $request = Yii::$app->request;
//
//        if ($request->isPost) {
//            dd($_POST);
//
//            $sheet = $_POST['ExcelDsCabenh'];
//
//        }
////        dd($modelData);
//        ExcelService::import('uploads/cabenh/ds_cabenh.xlsx')->insertData($modelData, $sheet);
//        return $this->render('importdata');
//    }

    public function actionNhapcabenh()
    {
        $ex = new ExcelDsCabenh();

        $session = Yii::$app->session;
        $model = new UploadForm();

        $request = Yii::$app->request;
        $filePath = $session->getFlash('filePath');


        if ($request->isPost) {

            if (isset($_POST['formCB']))
                dump('abc');

            $model->load($_POST);
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file) {
//                $model->file = UploadedFile::getInstance($model, 'file');

                if (!$model->validate())
                    return $this->render('import', $this->data);

                $filePath = 'uploads/cabenh/ds_cabenh' . '.' . $model->file->extension;
                $model->file->saveAs($filePath);
                $session->setFlash('filePath', $filePath);

            }

            if ($session->get('url_validate')) {
                if ($filePath !== $session->get('url_validate') && $filePath != '') {
                } else {
                    $filePath = $session->get('url_validate');
                }
            }

            $sheetExcel = ExcelService::import($filePath)->readSheet();

            // Validate định dạng cột excel

            $diff = array_diff(array_values($sheetExcel->oheading), $ex->attributes());

            if (!empty($diff)) {
                $session->setFlash('errors', ['Excel k đúng định dạng. Phải tồn tại các cột: <b>' . implode(", ", array_values($ex->attributes())) . '</b>']);
                return $this->refresh();
            }

            // Validate Excel
            if (empty($sheetExcel->data)) {
                $session->setFlash('errors', ['File Excel nhập k có dữ liệu']);
                return $this->refresh();
            }

            foreach ($sheetExcel->data as $row) {
                $bin = new ExcelDsCabenh();
                $bin->attributes = $row;
                $bin->formatDate('d/m/Y', 'm-d-y');
                $bin->formatDate('d/m/Y', $model->formatExcel);

                $ds_cabenh[] = $bin;
            }
            $this->data['ds_cabenh'] = $ds_cabenh;

            if (isset($_POST['importData']) && Model::validateMultiple($ds_cabenh)) {
                $count = 0;
                foreach ($ds_cabenh as $item) {
                    $cabenh = new DsCabenh();


                    $cabenh->attributes = $item->toArray();

                    if (!$cabenh->validate()) {
                        Yii::$app->session->setFlash('errors', $cabenh->getFirstErrors());

                        return $this->render('import', ['model' => $model, '$ds_cabenh' => $ds_cabenh]);
                    }

                    if ($cabenh->save()) {
                        $count++;
                    }
                }

                $session->setFlash('success', "Đã thêm mới {$count} ca bệnh");
                $session->remove('url_validate');
                $session->remove('filePath');
                return $this->refresh();
            }


            $errors = [];
            foreach ($ds_cabenh as $item) {
                if (!empty($item->getFirstErrors())) {
                    $errors[] = $item->getFirstErrors();
                }
            }
            $session->setFlash('errors', $errors);
            $session->set('url_validate', $filePath);
        }


        $this->data['model'] = $model;
        return $this->render('import', $this->data);
    }
}
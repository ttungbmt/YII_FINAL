<?php

namespace pcd\controllers\admin;

use pcd\controllers\AppController;
use pcd\entities\excelCabenh;
use pcd\entities\frmXuatSxh;
use pcd\entities\mCabenh;
use pcd\forms\UploadForm;
use pcd\models\Loaibenh;
use pcd\models\DmPhuong;
use pcd\services\ExcelService;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * DmtinhController implements the CRUD actions for DmTinh model.
 */
class ExcelController extends AppController {

    public $enableCsrfValidation = false;

    public $data = [];

    public function actionImportExcelCabenh(){
        $sheetExcel = ExcelService::import('uploads/cabenh/q12.xlsx')->readSheet();
        return $this->render('importExcelCabenh', ['excel' => collect($sheetExcel)]);
    }

    public function actionXuatphieusxh(){
        $model = new frmXuatSxh();
        $request = Yii::$app->request;
        if ($_POST && $model->load($_POST) && $model->checkRole()){
            $data = $model->dataExcel();
            // Chuyển đổi 0 => '0'
            foreach ($data as $k => $v){
                foreach ($v as $key => $val){
                    $data[$k][$key] = is_numeric($data[$k][$key]) ? (string)$data[$k][$key] : $data[$k][$key];
                }
            }
            //Download excel
            ExcelService::download($data, [
                'file_name' => 'DieutraSXH',
                'sheet_name' => 'SXH',
            ]);
        }
        return $this->render('xuatphieusxh', ['model' =>$model]);
    }

    public function actionNhapcabenh(){
        $ex = new excelCabenh();

        $session = Yii::$app->session;
        $model = new UploadForm();

        $request = Yii::$app->request;
        $filePath = $session->getFlash('filePath');


        if ($request->isPost) {
            $model->load($_POST);
            $model->file = UploadedFile::getInstance($model, 'file');
            if($model->file){
//                $model->file = UploadedFile::getInstance($model, 'file');

                if (!$model->validate())
                    return $this->render('importExcel', $this->data);

                $filePath = 'uploads/cabenh/dsCabenh'.'.'.$model->file->extension;
                $model->file->saveAs($filePath);
                $session->setFlash('filePath', $filePath);

            }

            if($session->get('url_validate')){
                if($filePath !== $session->get('url_validate') && $filePath != ''){
                } else {
                    $filePath = $session->get('url_validate');
                }
            }

            $sheetExcel = ExcelService::import($filePath)->readSheet();
//            dd($sheetExcel);

            // Validate định dạng cột excel

            $diff =array_diff(array_values($sheetExcel->heading), $ex->attributes());

            if(!empty($diff)){
                $session->setFlash('errors', ['Excel k đúng định dạng. Phải tồn tại các cột: <b>'.implode(", ", array_values($ex->attributes())) .'</b>']);
                return $this->refresh();
            }

            // Validate Excel
            if(empty($sheetExcel->data)){
                $session->setFlash('errors', ['File Excel nhập k có dữ liệu']);
                return $this->refresh();
            }

            foreach ($sheetExcel->data as $row){
                $bin = new excelCabenh();
                $bin->attributes = $row;
                $bin->formatDate('d/m/Y', 'm-d-y');
                $bin->formatDate('d/m/Y', $model->formatExcel);

                $dsCabenh[] = $bin;
            }
            $this->data['dsCabenh'] = $dsCabenh;

            if (Model::loadMultiple($dsCabenh, $request->post()) && Model::validateMultiple($dsCabenh)) {
                $count = 0;
                foreach ($dsCabenh as $item) {
                    $cabenh = new mCabenh();

                    $cabenh->attributes = $item->toArray();

                    if(!$cabenh->validate()){
                        Yii::$app->session->setFlash('errors', $cabenh->getFirstErrors());

                        return $this->render('importExcel', ['model' => $model, 'dsCabenh' => $dsCabenh]);
                    }

                    $loaibenh = Loaibenh::findOne(['tenbenh' => $cabenh->tbenh]);
                    if($loaibenh){
                        $cabenh->tbenh = $loaibenh->mabenh;
                        $cabenh->chuandoanbd = $loaibenh->mabenh;
                    }

                    $cabenh->chuyenca_filter = 0;

                    $phuongquan = DmPhuong::find()->where(['ten_px' => $item->px, 'ten_qh' => $item->qh])->one();
                    if ( isset($phuongquan) ) {
                        $cabenh->ma_phuong = $phuongquan->ma_phuong;
                        $cabenh->ma_quan = $phuongquan->ma_quan;
                        $cabenh->qh1 = $phuongquan->ma_quan;
                        $cabenh->px1 = $phuongquan->ma_phuong;
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
            foreach ($dsCabenh as $item){
                if(!empty( $item->getFirstErrors())){
                    $errors[] = $item->getFirstErrors();
                }
            }
            $session->setFlash('errors', $errors);
            $session->set('url_validate', $filePath);
        }

        $this->data['model'] = $model;
        return $this->render('importExcel', $this->data);
    }






}

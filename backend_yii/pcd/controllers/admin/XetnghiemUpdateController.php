<?php

namespace pcd\controllers\admin;

use pcd\controllers\AppController;
use common\forms\UploadForm;
use common\libs\excel\Excel;
use kartik\helpers\Html;
use pcd\forms\CabenhImportForm;
use pcd\models\Cabenh;
use pcd\models\CabenhSxh;
use pcd\models\CabenhSxh1;
use pcd\models\Diachi;
use pcd\models\HcPhuong;
use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use pcd\models\Loaibenh;


class XetnghiemUpdateController extends AppController
{
    public $enableCsrfValidation = false;

    protected $modelClass = 'pcd\forms\XetnghiemUpdateForm';

    protected $sampleFile = 'storage/samples/xetnghiem-update.xlsx';

    public function actionIndex()
    {
        $fileEx = new $this->modelClass;
        $model = new UploadForm();
        $excel = new Excel();

        $fields_compare = [
            'ma_icd' => 'Mã ICD (MA ICD)',
            'phai' => 'Phái (PHAI)',
            'benhvien' => 'Bệnh viện (BENHVIEN)',
            'ngaybaocao' => 'Ngày báo cáo (NGAYBAOCAO)',
            'ngaynhanthongbao' => 'Ngày nhận thông báo (NGAYNHANTHONGBAO)',
            'ngaymacbenh' => 'Ngày mắc bệnh (NGAYMACBENH)',
            'ngaynhapvien' => 'Ngày nhập viện (NGAYNHAPVIEN)',
            'ngayxuatvien' => 'Ngày xuất viện (NGAYXUATVIEN)',
            'nghenghiep' => 'Nghề nghiệp (NGHENGHIEP)',
            'shs' => 'Số hồ sơ (SHS)',
            'vitri' => 'Vị trí (VITRI)',
            'me' => 'Mẹ (ME)',
            'dienthoai' => 'Điện thoại (DIENTHOAI)',
            'nam_nv' => 'Năm nhập viện (NAM_NV)',
            'thang_nv' => 'Tháng nhập viện (THANG_NV)',
            'tuan_nv' => 'Tuần nhập viện (TUAN_NV)',
            'nam_bc' => 'Năm báo cáo (NAM_BC)',
            'thang_bc' => 'Tháng báo cáo (THANG_BC)',
            'tuan_bc' => 'Tuần báo cáo (TUAN_BC)',
            'sonha' => 'Số nhà (SONHA)',
            'duong' => 'Đường (DUONG)',
            'to_dp' => 'Tổ dân phố (TO_DP)',
            'khupho' => 'Khu phố (KHUPHO)',
            'chuandoan_bd' => 'Chuẩn đoán ban đầu (CHUANDOAN_BD)',
            'ngaysinh' => 'Ngày sinh (NGAYSINH)',
            'lat' => 'Lat (LAT)',
            'lng' => 'Lng (LNG)'
        ];

        if ($model->load(request()->post())) {
            if ($model->validateForm()) {
                list($fileName, $type) = [$model->file->tempName, request('type')];

                $addCompare = request()->post('compare') ? request()->post('compare') : [];


                /**
                 * Check format column of file Excel input
                 **/
                $header = $excel->readSheetHeader($fileName);
                $formLabel = $fileEx->attributeLabels();
                $formHeader = collect(array_keys($formLabel))->concat($addCompare)->all();
                $diff = array_diff($formHeader, array_values($header));

                if (!empty($diff)) {
                    $diffLabel = [];
                    foreach($diff as $d){
                        $diffLabel[$d] = isset($formLabel[$d]) ? $formLabel[$d] : $fields_compare[$d];
                    }
                    $this->data['models'] = "Excel không đúng định dạng,  vui lòng bổ sung các cột sau: <br>" . implode(', ', array_values($diffLabel)) . "<br>";

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
                            $this->saveModels($models, $addCompare);
                        }

                        break;

                    case 'save-all':
                        if ($passes) {
                            $this->saveModels($models, $addCompare);
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
            'sampleFile' => asset($this->sampleFile),
            'fields_compare' => $fields_compare
        ]);
    }

    /**
     * @param $data
     * @param $name
     *
     * @return bool
     */
    protected function validateModels(&$data, $name, $addCompare)
    {
        $data = collect($data)->map(function ($item) {
            return $item->toArray();
        })->values()->all();

        $loai_xn = [1 => 'PCR', 2 => 'MAC-ELISA', 3 => 'TEST NHANH'];
        $ketqua_xn = [1 => 'Dương tính', 2 => 'Âm tính'];

        $loai_xn = collect($loai_xn)->map(function($item){
           return str_slug($item);
        })->all();

        $ketqua_xn = collect($ketqua_xn)->map(function($item){
            return str_slug($item);
        })->all();

        foreach($data as $k => $row) {
            $lxn = str_slug($row['loai_xn']);
            $kqxn = str_slug($row['ketqua_xn']);

            if($row['xetnghiem'] == 1 && !in_array($lxn, $loai_xn)){
                $this->data['errors'] = "Vui lòng kiểm tra lại thông tin Loại xét nghiệm của bệnh nhân " . $row['hoten'];
                return false;
            } elseif ($row['xetnghiem'] == 1 && in_array($lxn, $loai_xn)){
                $row['loai_xn'] = array_search($lxn, $loai_xn);
            }

            if($row['xetnghiem'] == 1 && !in_array($kqxn, $ketqua_xn)){
                $this->data['errors'] = "Vui lòng kiểm tra lại thông tin Kết quả xét nghiệm của bệnh nhân " . $row['hoten'];
                return false;
            } elseif ($row['xetnghiem'] == 1 && in_array($kqxn, $ketqua_xn)){
                $row['ketqua_xn'] = array_search($kqxn, $ketqua_xn);
            }

            $phuong = HcPhuong::find()->where(['tenphuong_en' => $row['maphuong']])->andWhere(['tenquan_en' => $row['maquan']])->one();
            if($phuong) {
                $row['maphuong'] = $phuong->maphuong;
                $row['maquan'] = $phuong->maquan;
            }

            $data[$k] = $row;
        }

        $models = array_fill(0, count($data), $name);

        if (Model::loadMultiple($models, $data, '') && Model::validateMultiple($models)) {

            $success = 0; //Số row dữ liệu cập nhật thành công
            $err = []; //Danh sách các ca không cập nhật thành công
            $transaction = app('db')->beginTransaction();
            try{
                foreach($data as $d){
                    $update = collect($addCompare)->map(function ($i) use($d){
                        return [$i => $d[$i]];
                    })->collapse()->all();

                    $command = app('db')->createCommand()
                        ->update('cabenh_sxh', [
                                'xetnghiem' => $d['xetnghiem'],
                                'ngaylaymau' => $d['ngaylaymau'],
                                'loai_xn' => $d['loai_xn'],
                                'ketqua_xn' => $d['ketqua_xn'],
                            ], array_merge($update, [
                                'hoten' => $d['hoten'],
                                'maphuong' => $d['maphuong'],
                                'maquan' => $d['maquan'],
                                'tuoi' => $d['tuoi'],
                        ]));
                    if($command->execute()) {
                        $success++;
                    } else {
                        array_push($err, $d['hoten']);
                    }
                }
                $transaction->commit();
            }catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }

            if(!$success){
                $this->data['errors'] = "Vui lòng kiểm tra lại thông tin ca bệnh hoặc định dạng chuẩn của file excel!";
                return false;
            } else {
                if($err){
                    $this->data['errors'] = "Vui lòng kiểm tra lại thông tin ca bệnh hoặc định dạng dữ liệu của các ca bệnh sau: " .
                        implode(', ', $err);
                }
            }

            return $success;
        }

        $this->data['errors'] = $models;

        return false;
    }

    protected function saveModels($models, $addCompare)
    {
        $success = $this->validateModels($models, new CabenhSxh(), $addCompare);
        if ($success) {
            $count = count($models);
            $this->data['message'] = 'Đã lưu thành công ' . Html::a($success . '/' . $count . ' đối tượng ', '#', ['class' => 'alert-link']);
            $this->data['page'] = request('page');
        } else {
            return $this->renderJson([
                'html' => $this->renderAjax('_errors', $this->data)
            ]);
        }
    }

}
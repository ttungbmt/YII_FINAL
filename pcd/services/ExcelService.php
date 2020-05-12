<?php
namespace pcd\services;

use pcd\models\VDmPhuong;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Fill;
use yii\base\DynamicModel;

class ExcelService
{
    public $config = [
        'sheet_name' => 'active', // all, active

        'to_array' => false,
        'row_heading' => 1,
        'row_start' => null,

        'format_heading' => true,
        'keep_case' => false,
        'date_column' => [],

    ];

    public static $objPHPExcel;

    public $oheading;
    public $heading;
    public $data;


    public static function import($fileName, $sheet = null){
        /**  Identify the type of $inputFileName  **/
        $inputFileType = PHPExcel_IOFactory::identify($fileName);
        /**  Create a new Reader of the type that has been identified  **/
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        /** Set read type to read cell data only **/
        $objReader->setReadDataOnly(true);
        $objPHPExcel = PHPExcel_IOFactory::load($fileName);
        if(is_string($sheet)){
            $objPHPExcel->setActiveSheetIndexByName($sheet);
        } elseif(is_numeric($sheet)){
            $objPHPExcel->setActiveSheetIndex($sheet);
        } elseif(is_array($sheet)){

        }

        self::$objPHPExcel = $objPHPExcel->getActiveSheet();
        return new self;
    }

    public function setConfig($config){
        $this->config = array_merge($this->config, $config);
        return $this;
    }

    public function toArray(){
        return self::$objPHPExcel->toArray();
    }

    public function readSheet($column = null){
        $objWorksheet = self::$objPHPExcel;

        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $headingsArray = $objWorksheet->rangeToArray('A'.$this->config['row_heading'].':'.$highestColumn.$this->config['row_heading'],null, true, true, true);

        // Xử lý header
        $this->heading = $headingsArray[$this->config['row_heading']];
        $this->oheading = $this->heading;
        if($this->config['format_heading']){
            $this->formatHeading();
        }

        $r = -1;
        $namedDataArray = array();
        $row_start = !$this->config['row_start'] ? $this->config['row_heading']+1 : $this->config['row_start'];
        for ($row = $row_start; $row <= $highestRow;++$row) {
            $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
            if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')){
                ++$r;
                foreach($this->heading as $columnKey => $columnHeading) {
                    if(is_array($column) && !empty($column)){
                        $columnHeading = array_key_exists($columnHeading, $column) ? $column[$columnHeading]: $columnHeading;
                    }

                    $namedDataArray[$row][$columnHeading] = $dataRow[$row][$columnKey];
                }

            }
        }

        // Data Row
        $this->data = $namedDataArray;
        return $this;
    }

    public function exceptColumn($column){
        foreach($this->data as $k => $item){
            foreach($column as $except){
                unset($this->data[$k][$except]);
            }
        }
        return $this;
    }



    public function validate($rules){
        $i = 0;
        $message = [];
        foreach($this->data as $k => $item){
            $model = DynamicModel::validateData($item, $rules);
            if ($model->hasErrors()) {
                $message[$k]['key'] =  $i;
                $message[$k]['row'] =  $k;
                $message[$k]['error'] =  $model->getErrors();
            }
            ++$i;
        }
        return $message;


    }

    protected function formatHeading(){
        foreach($this->heading as $k => $item){
            $arr[$k] = str_slug($item, '_', true);
        }
        $this->heading = $arr;
    }

    public function download($data, $config){
        // Khởi tạo config
        $config = array_merge([
            'sheet_name' => 'Demo',
            'file_name' => 'Demo',

        ],$config);

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->fromArray($data, null, 'A1');

        // Đổi tên
        $objPHPExcel->getActiveSheet()->setTitle($config['sheet_name']);
        // Đổi style
        $objPHPExcel->getActiveSheet()->getStyle('A1:CU1')
            ->applyFromArray(
                [
                    'font' => [
                        'name'  => 'Arial',
                        'bold'  => true,
                        'color' => [
                            'rgb' => 'ffffff'
                        ]
                    ],
                    'fill' => [
                        'type'	   => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                        'startcolor' => [
                            'rgb' => 'F39C11'
                        ],
                        'endcolor'   => [
                            'argb' => 'F39C11'
                        ]
                    ],
                ]
            );

        // Freeze cột
        $objPHPExcel->getActiveSheet()->freezePane( "A1" );

        // Thiết lập autosize column
        foreach(range('A','CU') as $columnID)
        {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Lưu file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        // Tải file
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="'.$config['file_name'].'.xlsx"');
        $objWriter->save('php://output');
    }

    public static function getMaPhuong($tenquan, $tenphuong) {
        $tenquan = strtoupper(UtilsService::convertViToEn(trim($tenquan), true));
        $tenphuong = strtoupper(UtilsService::convertViToEn(trim($tenphuong), true));
        $model = VDmPhuong::findOne(['ten_px' => $tenphuong, 'ten_qh' => $tenquan]);

        if (isset($model) && !empty($model)) {
            return $model->ma_phuong;
        }

        return null;
    }

    public static function checkMaPhuong($model) {
        if (!isset($model->ten_phuong) || !isset($model->ten_quan)) {
            $model->addError('ten_phuong', 'Tên phường, quận là bắt buộc');
        }

        $ma_phuong = self::getMaPhuong($model->ten_quan, $model->ten_phuong);
        if (!isset($ma_phuong)) {
            $model->addError('ten_phuong', 'Tên phường, quận không chính xác');
        }

        return $model;
    }

//    public static function filterColumn($filterCol, $danhsach){
//        $filterVal = [];
//        //Bộ lọc giá trị theo filter
//        foreach($danhsach as $k => $val){
//            foreach($val as $i => $item){
//                if(in_array($i, $filterCol)){
//                    $filterVal[$k][$i] = self::setVal($i, $item);
//                }
//            }
//        }
//        return $filterVal;
//    }

//    // Bộ lọc gán giá trị
//    public static function setVal($k, $val){
//        switch ($k) {
//            case 'gioitinh':
//                if($val === null)
//                    return $val;
//                return ($val === false) ? 'Nữ' : 'Nam';
//                break;
//            default:
//                return $val;
//        }
//    }

//    public static function getArray($filePath, $headerRow = 1, $header=true, $headerCase=true, $rules){
//        //Create excel reader after determining the file type
//        $inputFileName = $filePath;
//        /**  Identify the type of $inputFileName  **/
//        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
//        /**  Create a new Reader of the type that has been identified  **/
//        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
//        /** Set read type to read cell data onl **/
//        $objReader->setReadDataOnly(true);
//        /**  Load $inputFileName to a PHPExcel Object  **/
//        $objPHPExcel = $objReader->load($inputFileName);
//        //Get worksheet and built array with first row as header
//        $objWorksheet = $objPHPExcel->getActiveSheet();
//        //excel with first row header, use header as key
//        if($header){
//            $highestRow = $objWorksheet->getHighestRow();
//            $highestColumn = $objWorksheet->getHighestColumn();
////            dd('A1:'.$highestColumn.'1');
//            $headingsArray = $objWorksheet->rangeToArray('A'.$headerRow.':'.$highestColumn.$headerRow,null, true, true, true);
//            $headingsArray = $headingsArray[$headerRow];
//
//            $errors['header'] = $headingsArray;
//            $errors['status'] = 'success';
//            $errors['data'] = [];
//
//            $r = -1;
//            $namedDataArray = array();
//            for ($row = $headerRow + 1; $row <= $highestRow; ++$row) {
//                $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
//
//                if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
//
//                    ++$r;
//                    foreach($headingsArray as $columnKey => $columnHeading) {
//                        // Nếu header[1] true thì snake case
//                        if($headerCase){ $columnHeading = snake_case($columnHeading); }
//                        $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
//                    }
//
//                    // Kiểm tra hợp lệ
//                    if(is_array($rules)){
//
////                        dd($namedDataArray[$r]);
//                        $model = DynamicModel::validateData($namedDataArray[$r], $rules);
//                        $model = self::checkMaPhuong($model);
//                        if ($model->hasErrors()) {
//                            $error['messages'] = $model->getErrors();
//                            $error['row'] = $row;
//                            $error['stt'] = $namedDataArray[$r]['stt'];
//
//
//                            $errors['status'] = 'failed';
//                            $errors['data'][$error['stt']] = $error;
//                        }
//
//                    }
//                }
//            }
//
//        }
//        else{
//            //excel sheet with no header
//            $namedDataArray = $objWorksheet->toArray(null,true,true,true);
//            $namedDataArray[] = 'ma_phuong';
//        }
//
//        $errors['excel'] = $namedDataArray;
//        return $errors;
//    }
}
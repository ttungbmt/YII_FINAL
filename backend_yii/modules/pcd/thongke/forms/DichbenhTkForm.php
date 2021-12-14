<?php
namespace modules\pcd\thongke\forms;

use yii\base\DynamicModel;

class DichbenhTkForm extends DynamicModel {
    public $dulieu;
    public $by_date;
    public $loaibenh;
    public $thangs;
    public $nam;
    public $nams;

    public function formName()
    {
        return '';
    }

    public function rules() {
        return [
            [['dulieu', 'loaibenh', 'nam', 'nams', 'thangs'], 'string']
        ];
    }

    public function attributeLabels() {
        return [
            'dulieu' => 'Dữ liệu',
            'loaibenh' => 'Loại bệnh',
            'nams' => 'Năm',
            'nam' => 'Năm',
            'thangs' => 'Tháng',
            'by_date' => 'Thống kê theo',
        ];
    }
}
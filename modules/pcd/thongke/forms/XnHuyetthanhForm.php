<?php
namespace modules\pcd\thongke\forms;


use yii\base\DynamicModel;

class XnHuyetthanhForm extends DynamicModel {
    public $dulieu;
    public $loai_tk ;
    public $loai_xn;
    public $date;
    public $months;
    public $year;

    public function formName()
    {
        return '';
    }


    public function rules() {
        return [
            [['loai_tk', 'loai_xn', 'month', 'dulieu'], 'string'],
            [['year'], 'date', 'format' => 'php:Y'],
//            [['month'], 'date', 'format' => 'php:m/Y'],
        ];
    }

    public function attributeLabels() {
        return [
            'dulieu ' => 'Dữ liệu',
            'loai_tk ' => 'Thống kê theo',
            'loai_xn' => 'Loại xét nghiệm',
            'date' => 'Thời gian',
            'months' => 'Tháng',
            'year' => 'Năm',
        ];
    }
}
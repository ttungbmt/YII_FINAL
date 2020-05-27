<?php
namespace pcd\modules\pt_nguyco\forms;

use yii\base\DynamicModel;

class ThongkeForm extends DynamicModel {
    public $loai_tk = 'loaihinh';
    public $year;
    public $month;
    public $maquan;
    public $maphuong;

    public function init() {
        parent::init();
        $this->month = date('m/Y');
    }


    public function formName() {
        return '';
    }

    public function rules() {
        return [
            [['loai_tk', 'year', 'maquan', 'maphuong'], 'safe'],
            [['month'], 'date', 'format' => 'php:d/m/Y'],
        ];
    }

    public function attributeLabels() {
        return [
            'loai_tk' => 'Thống kê',
            'year' => 'Năm',
            'month' => 'Tháng',
            'maquan' => 'Quận',
            'maphuong' => 'Phường',
        ];
    }
}
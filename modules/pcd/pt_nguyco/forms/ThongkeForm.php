<?php
namespace modules\pcd\pt_nguyco\forms;

use yii\base\DynamicModel;

class ThongkeForm extends DynamicModel {
    public $loai_tk = 'loaihinh';
    public $year;

    public function init() {
        parent::init();
    }


    public function formName() {
        return '';
    }

    public function rules() {
        return [
            [['loai_tk', 'year'], 'safe']
        ];
    }

    public function attributeLabels() {
        return [
            'loai_tk' => 'Thống kê',
            'year' => 'Năm',
        ];
    }
}
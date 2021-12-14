<?php
namespace modules\pcd\thongke\forms;

use yii\base\DynamicModel;
use yii\db\ActiveRecord;

class OdichTkForm extends DynamicModel {
    public $postUrl = '/thongke/odich/phantich';

    public $year;

    public function init() {
        parent::init();

        if(!$this->year) $this->year = date('Y');
    }

    public function formName()
    {
        return '';
    }


    public function rules() {
        return [
            [['year'], 'date', 'format' => 'php:Y'],
        ];
    }

    public function attributeLabels() {
        return [
            'year' => 'Năm',
        ];
    }
}
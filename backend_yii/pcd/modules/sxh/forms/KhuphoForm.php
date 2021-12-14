<?php
namespace pcd\modules\sxh\forms;

use yii\base\DynamicModel;

class KhuphoForm extends DynamicModel
{
    public $maquan;
    public $maphuong;

    public function rules()
    {
        return [
            [['maquan', 'maphuong'], 'safe']
        ];
    }


    public function formName()
    {
        return '';
    }


    public function attributeLabels()
    {
        return [
            'maquan' => 'Quận huyện',
            'maphuong' => 'Phường xã',
        ];
    }

    public function fields()
    {
        return ['maquan', 'maphuong'];
    }


}
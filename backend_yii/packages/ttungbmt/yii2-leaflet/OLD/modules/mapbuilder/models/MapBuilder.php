<?php
namespace ttungbmt\leaflet\modules\mapbuilder\models;

use yeesoft\models\Setting;
use yii\db\ActiveRecord;

class MapBuilder extends Setting
{
    public $data;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['description'], 'string'],
        ]);
    }

    public function attributeLabels()
    {
        return [
            'value' => 'JSON config'
        ];
    }


}
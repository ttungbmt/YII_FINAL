<?php

namespace pcd\modules\dm\models;

use pcd\models\App;

/**
 * This is the model class for table "dm_hoachat".
 *
 * @property int $id
 * @property string|null $ten_hc
 */
class DmHoachat extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dm_hoachat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_hc'], 'required'],
            [['ten_hc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'ten_hc' => 'Tên hóa chất',
        ];
    }
}

<?php

namespace pcd\modules\dm\models;

use pcd\models\App;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use Yii;

/**
 * This is the model class for table "dm_to_dp".
 *
 * @property int $gid
 * @property string|null $maquan
 * @property string|null $maphuong
 * @property string|null $khupho
 * @property string|null $to_dp
 */
class DmToDp extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dm_to_dp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['maquan', 'maphuong', 'khupho', 'to_dp'], 'string', 'max' => 255],
            [['maquan', 'maphuong', 'khupho', 'to_dp'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gid' => 'Gid',
            'maquan' => 'Quận huyện',
            'maphuong' => 'Phường xã',
            'khupho' => 'Khu phố',
            'to_dp' => 'Tổ dân phố',
        ];
    }

    public function getQuan(){
        return $this->hasOne(HcQuan::className(), ['maquan' => 'maquan']);
    }

    public function getPhuong(){
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'maphuong']);
    }
}

<?php

namespace pcd\modules\dm\models;

use Illuminate\Support\Str;
use pcd\models\App;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use Yii;

/**
 * This is the model class for table "dm_khupho".
 *
 * @property int $gid
 * @property string|null $maquan
 * @property string|null $maphuong
 * @property string|null $khupho
 */
class DmKhupho extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dm_khupho';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['maquan', 'maphuong', 'khupho'], 'string', 'max' => 255],
            [['maquan', 'maphuong', 'khupho'], 'required'],
            [['khupho'], 'unique', 'targetAttribute' => ['maquan', 'maphuong', 'khupho'], 'message' => 'Khu phố/ấp đã tồn tại'],
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
        ];
    }

    public function beforeSave($insert)
    {
        $this->khupho = trim($this->khupho);
        return parent::beforeSave($insert);
    }


    public function getQuan()
    {
        return $this->hasOne(HcQuan::className(), ['maquan' => 'maquan']);
    }

    public function getPhuong()
    {
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'maphuong']);
    }
}

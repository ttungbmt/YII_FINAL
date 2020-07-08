<?php

namespace pcd\modules\dm\models;

use nanson\postgis\behaviors\GeometryBehavior;
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
    public $geometryType = GeometryBehavior::GEOMETRY_POLYGON;
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
            [['geom'], 'safe'],
            [['maquan', 'maphuong', 'khupho', 'to_dp'], 'string', 'max' => 255],
            [['maquan', 'maphuong', 'khupho', 'to_dp'], 'required'],
            [['to_dp'], 'unique', 'targetAttribute' => ['to_dp', 'khupho', 'maquan', 'maphuong'], 'message' => 'Tổ dân phố đã tồn tại'],
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


    public function beforeSave($insert)
    {
        $this->khupho = trim($this->khupho);
        $this->to_dp = trim($this->to_dp);

        return parent::beforeSave($insert);
    }

    public function getQuan(){
        return $this->hasOne(HcQuan::className(), ['maquan' => 'maquan']);
    }

    public function getPhuong(){
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'maphuong']);
    }
}

<?php

namespace gsnc\models;

use Yii;

/**
 * This is the model class for table "dv_capnuoc".
 *
 * @property int $gid
 * @property string|null $ten_dv
 * @property string|null $lat
 * @property string|null $lng
 * @property string|null $geom
 * @property string|null $diachi
 * @property string|null $maquan
 * @property string|null $maphuong
 * @property string|null $dienthoai
 * @property string|null $website
 * @property string|null $diaban_ql
 * @property string|null $fax
 * @property int|null $loaimau_id
 * @property string|null $tenquan
 * @property string|null $tenphuong
 * @property string|null $tanxuat_kt
 * @property string|null $ma_dv_ql
 */
class DvCapnuoc extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dv_capnuoc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['geom', 'diachi'], 'string'],
            [['loaimau_id'], 'default', 'value' => null],
            [['loaimau_id'], 'integer'],
            [['ten_dv', 'lat', 'lng', 'maquan', 'maphuong', 'dienthoai', 'website', 'diaban_ql', 'fax', 'tenquan', 'tenphuong', 'tanxuat_kt', 'ma_dv_ql'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gid' => 'Gid',
            'ten_dv' => 'Ten Dv',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'geom' => 'Geom',
            'diachi' => 'Diachi',
            'maquan' => 'Maquan',
            'maphuong' => 'Maphuong',
            'dienthoai' => 'Dienthoai',
            'website' => 'Website',
            'diaban_ql' => 'Diaban Ql',
            'fax' => 'Fax',
            'loaimau_id' => 'Loaimau ID',
            'tenquan' => 'Tenquan',
            'tenphuong' => 'Tenphuong',
            'tanxuat_kt' => 'Tanxuat Kt',
            'ma_dv_ql' => 'Ma Dv Ql',
        ];
    }
}

<?php
namespace pcd\models;

use nanson\postgis\behaviors\GeometryBehavior;
use Yii;

/**
 * This is the model class for table "hc_phuong".
 *
 * @property int $gid
 * @property string $objectid
 * @property string $madvhc
 * @property string $caphc
 * @property string $maphuong
 * @property string $maquan
 * @property string $tenphuong
 * @property string $tenquan
 * @property string $soho
 * @property string $st_area_sh
 * @property string $st_length_
 * @property string $geom
 */
class HcPhuong extends App
{
    public $geometryType = GeometryBehavior::GEOMETRY_MULTIPOLYGON;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hc_phuong';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['objectid', 'soho', 'st_area_sh', 'st_length_'], 'number'],
            [['geom'], 'string'],
            [['madvhc', 'maphuong', 'maquan', 'tenphuong'], 'string', 'max' => 50],
            [['caphc', 'tenquan'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gid' => 'Gid',
            'objectid' => 'Objectid',
            'madvhc' => 'Madvhc',
            'caphc' => 'Caphc',
            'maphuong' => 'Maphuong',
            'maquan' => 'Maquan',
            'tenphuong' => 'Phường xã',
            'tenquan' => 'Quận huyện',
            'soho' => 'Soho',
            'st_area_sh' => 'St Area Sh',
            'st_length_' => 'St Length',
            'geom' => 'Geom',
        ];
    }
}

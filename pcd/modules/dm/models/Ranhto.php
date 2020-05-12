<?php
namespace pcd\modules\dm\models;
use common\models\MyModel;
use nanson\postgis\behaviors\GeometryBehavior;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;

/**
 * This is the model class for table "ranh_to".
 *
 * @property int $gid
 * @property string $objectid
 * @property string $tenphuong
 * @property string $tenquan
 * @property string $tento
 * @property string $khupho
 * @property string $shape_leng
 * @property string $maquan
 * @property string $maphuong
 * @property string $shape_le_1
 * @property string $shape_area
 * @property string $geom
 */
class Ranhto extends MyModel
{
    public $geometryType = GeometryBehavior::GEOMETRY_MULTIPOLYGON;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ranh_to';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['objectid', 'shape_leng', 'shape_le_1', 'shape_area'], 'number'],
            [['geom'], 'string'],
            [['tenphuong', 'tenquan', 'tento', 'khupho', 'maphuong'], 'string', 'max' => 50],
            [['maquan'], 'string', 'max' => 53],
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
            'tenphuong' => 'Phường xã',
            'tenquan' => 'Quận huyện',
            'tento' => 'Tổ DP',
            'khupho' => 'Khu phố',
            'maquan' => 'Maquan',
            'maphuong' => 'Maphuong',
            'geom' => 'Geom',
        ];
    }

    public function getHcPhuong()
    {
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'maphuong']);
    }

    public function getHcQuan()
    {
        return $this->hasOne(HcQuan::className(), ['maquan' => 'maquan']);
    }
}

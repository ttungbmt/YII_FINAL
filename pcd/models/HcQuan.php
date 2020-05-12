<?php
namespace pcd\models;

use nanson\postgis\behaviors\GeometryBehavior;
use Yii;

/**
 * This is the model class for table "hc_quan".
 *
 * @property int $gid
 * @property string $tenquan
 * @property string $caphc
 * @property int $maquan
 * @property string $geom
 */
class HcQuan extends App
{
    public $geometryType = GeometryBehavior::GEOMETRY_MULTIPOLYGON;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hc_quan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['maquan'], 'default', 'value' => null],
            [['maquan'], 'integer'],
            [['geom'], 'string'],
            [['tenquan', 'caphc'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gid' => 'Gid',
            'tenquan' => 'Quận huyện',
            'caphc' => 'Caphc',
            'maquan' => 'Maquan',
            'geom' => 'Geom',
        ];
    }




}

<?php

namespace pcd\models;

use common\models\MyModel;
use nanson\postgis\behaviors\GeometryBehavior;
use Yii;

/**
 * This is the model class for table "ranhto_draft".
 *
 * @property int    $gid
 * @property string $maquan
 * @property string $maphuong
 * @property string $geom
 * @property string $khupho
 * @property string $to_dp
 * @property string $created_at
 * @property string $updated_at
 * @property int    $created_by
 * @property int    $updated_by
 * @property int    $status
 * @property string $ghichu
 */
class RanhtoDraft extends MyModel
{
    protected $timestamps = true;
    protected $blameables = true;
    public $geometryType = GeometryBehavior::GEOMETRY_MULTIPOLYGON;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ranhto_draft';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ghichu'], 'string'],
            [['created_at', 'updated_at', 'geom'], 'safe'],
            [['created_by', 'updated_by', 'status'], 'default', 'value' => null],
            [['created_by', 'updated_by', 'status'], 'integer'],
            [['maquan', 'maphuong', 'khupho', 'to_dp'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gid'        => 'Gid',
            'maquan'     => 'Maquan',
            'maphuong'   => 'Maphuong',
            'geom'       => 'Geom',
            'khupho'     => 'Khupho',
            'to_dp'      => 'To Dp',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'status'     => 'Status',
            'ghichu'     => 'Ghichu',
        ];
    }

    public function getQuan(){
        return $this->hasOne(HcQuan::className(), ['maquan' => 'maquan' ]);
    }

    public function getPhuong(){
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'maphuong' ]);
    }

    public function extraFields()
    {
        return array_merge(parent::extraFields(), [
            'tenquan' => function($model){
                return $model->quan->tenquan;
            },
            'tenphuong' => function($model){
                return $model->phuong->tenphuong;
            },
        ]);
    }
}

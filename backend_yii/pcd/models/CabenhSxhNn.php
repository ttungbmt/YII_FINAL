<?php
namespace pcd\models;

use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "dm_dichte".
 *
 * @property int    $gid Gid
 * @property string $bv
 * @property string $t_benh
 * @property string $hoten
 * @property int    $tuoi
 * @property string $ng_nv
 * @property string $lat
 * @property string $lng
 * @property string $geom
 */
class CabenhSxhNn extends MyModel
{
    protected $timestamps = true;

    protected $dates = ['ngaymacbenh_nv'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cabenh_sxh_nn';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tuoi'], 'integer'],
            [['ngaymacbenh_nv', 'lat', 'lng', 'geom'], 'safe'],
            [['benhvien', 'chuandoan_bd', 'hoten'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gid'    => Yii::t('app', 'Gid'),
            'benhvien'     => Yii::t('app', 'Bệnh viện'),
            'chuandoan_bd' => Yii::t('app', 'Chuẩn đoán ban đầu'),
            'hoten'  => Yii::t('app', 'Họ tên'),
            'tuoi'   => Yii::t('app', 'Tuổi'),
            'ngaymacbenh_nv'  => Yii::t('app', 'Ngày nhập viện'),
            'lat'    => Yii::t('app', 'Lat'),
            'lng'    => Yii::t('app', 'Lng'),
            'geom'   => Yii::t('app', 'Geom'),
        ];
    }
}
<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "v_cabenh_sxh_nn".
 *
 * @property int $macabenh
 * @property string $benhvien
 * @property string $chuandoan_bd
 * @property string $hoten
 * @property string $tuoi
 * @property string $ngaymacbenh_nv
 * @property int $songaybenh
 * @property string $geom
 */
class VCabenhSxhNn extends \common\models\MyModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_cabenh_sxh_nn';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['macabenh', 'songaybenh'], 'default', 'value' => null],
            [['macabenh', 'songaybenh'], 'integer'],
            [['ngaymacbenh_nv'], 'safe'],
            [['geom'], 'string'],
            [['benhvien', 'chuandoan_bd', 'hoten', 'tuoi'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'macabenh' => Yii::t('app', 'Macabenh'),
            'benhvien' => Yii::t('app', 'Benhvien'),
            'chuandoan_bd' => Yii::t('app', 'Chuandoan Bd'),
            'hoten' => Yii::t('app', 'Hoten'),
            'tuoi' => Yii::t('app', 'Tuoi'),
            'ngaymacbenh_nv' => Yii::t('app', 'Ngaymacbenh Nv'),
            'songaybenh' => Yii::t('app', 'Songaybenh'),
            'geom' => Yii::t('app', 'Geom'),
        ];
    }
}

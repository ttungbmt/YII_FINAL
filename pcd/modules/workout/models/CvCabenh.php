<?php

namespace pcd\modules\workout\models;

use Yii;

/**
 * This is the model class for table "cv_cabenh".
 *
 * @property int $id
 * @property string $hoten
 * @property int $tuoi
 * @property int $namsinh
 * @property string $ngaymacbenh
 * @property string $ngayphathien
 * @property string $geom
 */
class CvCabenh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cv_cabenh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tuoi', 'namsinh'], 'default', 'value' => null],
            [['tuoi', 'namsinh'], 'integer'],
            [['ngaymacbenh', 'ngayphathien'], 'safe'],
            [['geom'], 'string'],
            [['hoten'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hoten' => 'Hoten',
            'tuoi' => 'Tuoi',
            'namsinh' => 'Namsinh',
            'ngaymacbenh' => 'Ngaymacbenh',
            'ngayphathien' => 'Ngayphathien',
            'geom' => 'Geom',
        ];
    }
}

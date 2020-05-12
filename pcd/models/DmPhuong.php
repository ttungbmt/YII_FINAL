<?php

namespace pcd\models;

use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "dm_phuong".
 *
 * @property integer $ma_phuong
 * @property string $ten_phuong
 * @property string $ten_quan
 * @property string $geom
 * @property integer $soho
 * @property string $cap_hanhchinh
 * @property integer $ma_quan
 */
class DmPhuong extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dm_phuong';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ma_phuong'], 'required'],
            [['ma_phuong', 'soho', 'ma_quan'], 'integer'],
            [['geom'], 'string'],
            [['ten_phuong'], 'string', 'max' => 50],
            [['ten_quan'], 'string', 'max' => 20],
            [['cap_hanhchinh'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ma_phuong' => Yii::t('app', 'Ma Phuong'),
            'ten_phuong' => Yii::t('app', 'Ten Phuong'),
            'ten_quan' => Yii::t('app', 'Ten Quan'),
            'geom' => Yii::t('app', 'Geom'),
            'soho' => Yii::t('app', 'Soho'),
            'cap_hanhchinh' => Yii::t('app', 'Cap Hanhchinh'),
            'ma_quan' => Yii::t('app', 'Ma Quan'),
        ];
    }
}

<?php

namespace pcd\models;

use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "v_dm_phuong1".
 *
 * @property integer $ma_phuong
 * @property string $ten_phuong
 * @property string $ten_quan
 * @property string $geom
 * @property integer $soho
 * @property string $cap_hanhchinh
 * @property integer $ma_quan
 * @property integer $code
 * @property string $ten_phuong_en
 * @property integer $ma_px
 * @property string $ten_px
 * @property string $ten_qh
 * @property string $giap_ranh
 */
class VDmPhuong1 extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_dm_phuong1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ma_phuong', 'soho', 'ma_quan', 'code', 'ma_px'], 'integer'],
            [['geom', 'ten_phuong_en', 'ten_px', 'ten_qh', 'giap_ranh'], 'string'],
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
            'code' => Yii::t('app', 'Code'),
            'ten_phuong_en' => Yii::t('app', 'Ten Phuong En'),
            'ma_px' => Yii::t('app', 'Ma Px'),
            'ten_px' => Yii::t('app', 'Ten Px'),
            'ten_qh' => Yii::t('app', 'Ten Qh'),
            'giap_ranh' => Yii::t('app', 'Giap Ranh'),
        ];
    }
}

<?php

namespace pcd\models;

use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "v_dm_quan1".
 *
 * @property string $ten_quan
 * @property integer $ma_quan
 * @property string $cap_hanhchinh
 * @property string $soho
 * @property string $geom
 * @property string $ten_quan_en
 * @property integer $ma_qh
 * @property string $ten_qh
 * @property string $giap_ranh
 * @property string $qhuyen
 */
class VDmQuan1 extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_dm_quan1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ma_quan', 'ma_qh'], 'integer'],
            [['soho'], 'number'],
            [['geom', 'ten_quan_en', 'ten_qh', 'giap_ranh', 'qhuyen'], 'string'],
            [['ten_quan'], 'string', 'max' => 20],
            [['cap_hanhchinh'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ten_quan' => Yii::t('app', 'Ten Quan'),
            'ma_quan' => Yii::t('app', 'Ma Quan'),
            'cap_hanhchinh' => Yii::t('app', 'Cap Hanhchinh'),
            'soho' => Yii::t('app', 'Soho'),
            'geom' => Yii::t('app', 'Geom'),
            'ten_quan_en' => Yii::t('app', 'Ten Quan En'),
            'ma_qh' => Yii::t('app', 'Ma Qh'),
            'ten_qh' => Yii::t('app', 'Ten Qh'),
            'giap_ranh' => Yii::t('app', 'Giap Ranh'),
            'qhuyen' => Yii::t('app', 'Qhuyen'),
        ];
    }
}

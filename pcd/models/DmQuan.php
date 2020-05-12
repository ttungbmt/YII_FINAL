<?php

namespace pcd\models;

use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "dm_quan".
 *
 * @property string $ten_quan
 * @property integer $ma_quan
 * @property string $cap_hanhchinh
 * @property string $soho
 * @property string $geom
 */
class DmQuan extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dm_quan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ma_quan'], 'required'],
            [['ma_quan'], 'integer'],
            [['soho'], 'number'],
            [['geom'], 'string'],
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
        ];
    }
}

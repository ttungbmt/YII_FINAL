<?php

namespace pcd\models;

use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "v_dm_phuong".
 *
 * @property integer $ma_phuong
 * @property string $ten_phuong
 * @property integer $ma_quan
 * @property string $ten_quan
 */
class VDmPhuong extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_dm_phuong';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ma_phuong', 'ma_quan'], 'integer'],
            [['ten_phuong'], 'string', 'max' => 50],
            [['ten_quan'], 'string', 'max' => 20]
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
            'ma_quan' => Yii::t('app', 'Ma Quan'),
            'ten_quan' => Yii::t('app', 'Ten Quan'),
        ];
    }
}

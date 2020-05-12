<?php

namespace pcd\models;

use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "loaibenh".
 *
 * @property integer $id
 * @property string $mabenh
 * @property string $tenbenh
 */
class Loaibenh extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loaibenh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mabenh', 'tenbenh'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mabenh' => Yii::t('app', 'Mã bệnh'),
            'tenbenh' => Yii::t('app', 'Tên bệnh'),
        ];
    }
}

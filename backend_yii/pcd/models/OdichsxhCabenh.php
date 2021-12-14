<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "odichsxh_cabenh".
 *
 * @property string $odich_id
 * @property string $cabenh_id
 */
class OdichsxhCabenh extends App
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'odichsxh_cabenh';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['odich_id', 'cabenh_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'odich_id'  => Yii::t('app', 'Odich ID'),
            'cabenh_id' => Yii::t('app', 'Cabenh ID'),
        ];
    }
}

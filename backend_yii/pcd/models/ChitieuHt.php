<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "chitieu_ht".
 *
 * @property int $id
 * @property string $benhvien
 * @property int $chitieu
 * @property string $nam
 */
class ChitieuHt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chitieu_ht';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chitieu'], 'default', 'value' => null],
            [['chitieu'], 'integer'],
            [['benhvien', 'nam'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'benhvien' => 'Bệnh viện',
            'chitieu' => 'Chỉ tiêu',
            'nam' => 'Năm',
        ];
    }
}

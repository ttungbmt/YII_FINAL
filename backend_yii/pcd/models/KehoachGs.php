<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "kehoach_gs".
 *
 * @property int $id
 * @property int $pt_nguyco_id
 * @property int $year
 * @property int $month
 * @property int $dukien
 * @property int $thucte
 */
class KehoachGs extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kehoach_gs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pt_nguyco_id', 'year', 'month', 'dukien', 'thucte'], 'default', 'value' => null],
            [['pt_nguyco_id', 'year', 'month', 'dukien', 'thucte'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pt_nguyco_id' => 'Pt Nguyco ID',
            'year' => 'Year',
            'month' => 'Month',
            'dukien' => 'Dukien',
            'thucte' => 'Thucte',
        ];
    }
}

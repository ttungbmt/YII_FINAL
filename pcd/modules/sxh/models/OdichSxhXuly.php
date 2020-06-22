<?php

namespace pcd\modules\sxh\models;

use pcd\models\App;
use Yii;

/**
 * This is the model class for table "odich_sxh_xuly".
 *
 * @property int $id
 * @property int $odich_id
 * @property string|null $khaosat_cts
 * @property string|null $diet_lqs
 * @property string|null $phun_hcs
 * @property string|null $dncs
 * @property string|null $phamvi
 */
class OdichSxhXuly extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'odich_sxh_xuly';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['khaosat_cts', 'diet_lqs', 'phun_hcs', 'dncs', 'odich_id', 'phamvi'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'khaosat_cts' => 'Khaosat Cts',
            'diet_lqs' => 'Diet Lqs',
            'phun_hcs' => 'Phun Hcs',
            'dncs' => 'Dncs',
            'odich_id' => 'Odich_id',
        ];
    }
}

<?php
namespace pcd\modules\pt_nguyco\models\view;

use pcd\models\App;
/**
 * This is the model class for table "v_giamsat".
 *
 * @property int $pt_nguyco_id
 * @property double $year
 * @property double $month
 * @property int $count_gs
 * @property int $count_lq
 */
class VGiamsat extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_giamsat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pt_nguyco_id', 'count_gs', 'count_lq'], 'default', 'value' => null],
            [['pt_nguyco_id', 'count_gs', 'count_lq'], 'integer'],
            [['year', 'month'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pt_nguyco_id' => 'Pt Nguyco ID',
            'year' => 'Year',
            'month' => 'Month',
            'count_gs' => 'Count Gs',
            'count_lq' => 'Count Lq',
        ];
    }
}

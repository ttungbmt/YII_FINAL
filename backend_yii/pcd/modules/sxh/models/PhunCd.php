<?php

namespace pcd\modules\sxh\models;
use pcd\models\App;


/**
 * This is the model class for table "phun_cd".
 *
 * @property int $id
 * @property int|null $lydo
 * @property string|null $phamvi_xl
 */
class PhunCd extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phun_cd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lydo'], 'default', 'value' => null],
            [['lydo'], 'integer'],
            [['phamvi_xl'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lydo' => 'Lý do phun chủ động',
            'phamvi_xl' => 'Phạm vi xử lý',
        ];
    }


}

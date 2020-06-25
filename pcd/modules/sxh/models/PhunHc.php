<?php

namespace pcd\modules\sxh\models;

use pcd\models\App;

/**
 * This is the model class for table "odich_sxh_phun_hc".
 *
 * @property int $id
 * @property int|null $odich_id
 * @property string|null $ngayxuly
 * @property int|null $tt
 * @property string|null $maquan
 * @property string|null $maphuong
 * @property string|null $khupho
 * @property string|null $to_dp
 * @property int|null $sonocgia_tt
 * @property int|null $sonocgia_xl
 * @property int|null $somaylon
 * @property int|null $somaynho
 * @property string|null $loai_hc
 * @property float|null $solit_hc
 * @property int|null $songuoi_tg
 */
class PhunHc extends App
{
    protected $dates = ['ngayxuly'];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'odich_sxh_phun_hc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['odich_id', 'tt', 'sonocgia_tt', 'sonocgia_xl', 'somaylon', 'somaynho', 'songuoi_tg'], 'default', 'value' => null],
            [['odich_id', 'tt', 'sonocgia_tt', 'sonocgia_xl', 'somaylon', 'somaynho', 'songuoi_tg'], 'integer'],
            [['solit_hc'], 'number'],
            [['maquan'], 'string', 'max' => 3],
            [['maphuong'], 'string', 'max' => 8],
            [['khupho', 'to_dp', 'loai_hc', 'ngayxuly'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'odich_id' => 'Odich ID',
            'tt' => 'Tt',
            'maquan' => 'Maquan',
            'maphuong' => 'Maphuong',
            'khupho' => 'Khupho',
            'to_dp' => 'To Dp',
            'sonocgia_tt' => 'Sonocgia Tt',
            'sonocgia_xl' => 'Sonocgia Xl',
            'somaylon' => 'Somaylon',
            'somaynho' => 'Somaynho',
            'loai_hc' => 'Loai Hc',
            'solit_hc' => 'Solit Hc',
            'songuoi_tg' => 'Songuoi Tg',
        ];
    }
}

<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "diachi".
 *
 * @property int $id
 * @property int $cabenh_id
 * @property string $dienthoai
 * @property string $vitri
 * @property string $sonha
 * @property string $duong
 * @property string $to
 * @property string $khupho
 * @property string $tinh
 * @property string $diachikhac
 * @property string $px
 * @property string $qh
 */
class Diachi extends \common\models\MyModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diachi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cabenh_id'], 'integer'],
            [['vitri', 'diachikhac'], 'string'],
            [['dienthoai', 'sonha', 'duong', 'to', 'khupho', 'tinh', 'px', 'qh'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cabenh_id' => 'Cabenh ID',
            'dienthoai' => 'Dienthoai',
            'vitri' => 'Vitri',
            'sonha' => 'Sonha',
            'duong' => 'Duong',
            'to' => 'To',
            'khupho' => 'Khupho',
            'tinh' => 'Tinh',
            'diachikhac' => 'Diachikhac',
            'px' => 'Px',
            'qh' => 'Qh',
        ];
    }
}

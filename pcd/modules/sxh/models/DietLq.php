<?php
namespace pcd\modules\sxh\models;

use pcd\models\App;

/**
 * This is the model class for table "odich_sxh_diet_lq".
 *
 * @property int $id
 * @property int|null $odich_id
 * @property string|null $ngayxuly
 * @property string|null $khupho
 * @property string|null $to_dp
 * @property string|null $sonha
 * @property string|null $songuoi
 */
class DietLq extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'odich_sxh_diet_lq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['odich_id'], 'default', 'value' => null],
            [['odich_id'], 'integer'],
            [['ngayxuly', 'khupho', 'to_dp', 'sonha', 'songuoi'], 'string', 'max' => 255],
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
            'ngayxuly' => 'Ngayxuly',
            'khupho' => 'Khupho',
            'to_dp' => 'To Dp',
            'sonha' => 'Sonha',
            'songuoi' => 'Songuoi',
        ];
    }
}

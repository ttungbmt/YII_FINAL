<?php
namespace modules\pcd\pt_nguyco\models;
use pcd\models\App;

/**
 * This is the model class for table "dm_loaihinh".
 *
 * @property int $id Id
 * @property string $nhom Nhóm
 * @property string $ten_lh Loại hình
 * @property string $tanxuat Tần xuất
 * @property string $thaydoi Thay đổi
 */
class DmLoaihinh extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dm_loaihinh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nhom', 'ten_lh', 'tanxuat', 'thaydoi'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'nhom' => 'Nhóm',
            'ten_lh' => 'Loại hình',
            'tanxuat' => 'Tần xuất',
            'thaydoi' => 'Thay đổi',
        ];
    }
}

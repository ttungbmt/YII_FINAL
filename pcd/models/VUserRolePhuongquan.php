<?php

namespace pcd\models;

use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "v_user_role_phuongquan".
 *
 * @property string $cap_hanhchinh
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property integer $ma_quan
 * @property integer $ma_phuong
 * @property integer $ma_hanhchinh
 * @property string $ten_quan
 * @property string $ten_phuong
 * @property string $ghi_chu
 */
class VUserRolePhuongquan extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_user_role_phuongquan';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cap_hanhchinh', 'username', 'ghi_chu'], 'string'],
            [['id', 'user_id', 'ma_quan', 'ma_qh', 'ma_phuong', 'ma_px', 'ma_hanhchinh'], 'integer'],
            [['ten_quan'], 'string', 'max' => 20],
            [['ten_phuong'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cap_hanhchinh' => Yii::t('app', 'Cap Hanhchinh'),
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'username' => Yii::t('app', 'Username'),
            'ma_quan' => Yii::t('app', 'Ma Quan'),
            'ma_phuong' => Yii::t('app', 'Ma Phuong'),
            'ma_hanhchinh' => Yii::t('app', 'Ma Hanhchinh'),
            'ten_quan' => Yii::t('app', 'Ten Quan'),
            'ten_phuong' => Yii::t('app', 'Ten Phuong'),
            'ghi_chu' => Yii::t('app', 'Ghi Chu'),
        ];
    }
}

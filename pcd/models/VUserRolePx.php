<?php

namespace pcd\models;

use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "v_user_role_px".
 *
 * @property integer $id
 * @property string $username
 * @property integer $state
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property integer $ma_px
 * @property integer $ma_qh
 * @property string $cap_hanhchinh
 * @property string $ghi_chu
 * @property integer $ma_hanhchinh
 * @property string $ten_quan
 * @property string $ten_qh
 * @property string $ten_phuong
 * @property string $ten_px
 * @property integer $ma_phuong
 * @property integer $ma_quan
 */
class VUserRolePx extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_user_role_px';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'state', 'ma_px', 'ma_qh', 'ma_hanhchinh', 'ma_phuong', 'ma_quan'], 'integer'],
            [['username', 'password', 'auth_key', 'access_token', 'cap_hanhchinh', 'ghi_chu', 'ten_qh', 'ten_px'], 'string'],
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
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'state' => Yii::t('app', 'State'),
            'password' => Yii::t('app', 'Password'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'access_token' => Yii::t('app', 'Access Token'),
            'ma_px' => Yii::t('app', 'Ma Px'),
            'ma_qh' => Yii::t('app', 'Ma Qh'),
            'cap_hanhchinh' => Yii::t('app', 'Cap Hanhchinh'),
            'ghi_chu' => Yii::t('app', 'Ghi Chu'),
            'ma_hanhchinh' => Yii::t('app', 'Ma Hanhchinh'),
            'ten_quan' => Yii::t('app', 'Ten Quan'),
            'ten_qh' => Yii::t('app', 'Ten Qh'),
            'ten_phuong' => Yii::t('app', 'Ten Phuong'),
            'ten_px' => Yii::t('app', 'Ten Px'),
            'ma_phuong' => Yii::t('app', 'Ma Phuong'),
            'ma_quan' => Yii::t('app', 'Ma Quan'),
        ];
    }
}

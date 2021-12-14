<?php

namespace pcd\models;

use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "v_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $role
 * @property integer $ma_phuong
 * @property integer $ma_quan
 * @property integer $status
 * @property string $fullname
 * @property string $phone
 * @property string $email
 */
class VUser extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ma_phuong', 'ma_quan', 'status'], 'integer'],
            [['username'], 'string'],
            [['role'], 'string', 'max' => 64],
            [['fullname', 'phone', 'email'], 'string', 'max' => 255],
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
            'role' => Yii::t('app', 'Role'),
            'ma_phuong' => Yii::t('app', 'Ma Phuong'),
            'ma_quan' => Yii::t('app', 'Ma Quan'),
            'status' => Yii::t('app', 'Status'),
            'fullname' => Yii::t('app', 'Fullname'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
        ];
    }
}

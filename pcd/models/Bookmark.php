<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "bookmark".
 *
 * @property int $gid
 * @property string $name
 * @property string $description
 * @property string $geom
 * @property string $ip
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Bookmark extends \common\models\MyModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bookmark';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['created_by', 'updated_by'], 'default', 'value' => null],
            [['created_at', 'updated_at', 'geom'], 'safe'],
            [['name', 'ip'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gid' => Yii::t('app', 'Gid'),
            'name' => Yii::t('app', 'Tên'),
            'description' => Yii::t('app', 'Mô tả'),
            'geom' => Yii::t('app', 'Geom'),
            'ip' => Yii::t('app', 'Ip'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}

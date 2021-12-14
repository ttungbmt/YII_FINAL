<?php

namespace pcd\modules\workout\models;

use Yii;

/**
 * This is the model class for table "wk_musle".
 *
 * @property int $id
 * @property string $name
 * @property string $thumbnail
 */
class Muscle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wk_muscle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['thumbnail'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'thumbnail' => 'Thumbnail',
        ];
    }
}

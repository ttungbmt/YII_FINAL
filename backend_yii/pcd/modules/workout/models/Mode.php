<?php

namespace pcd\modules\workout\models;

use Yii;

/**
 * This is the model class for table "wk_mode".
 *
 * @property int $id
 * @property string $mode
 * @property int $exercise_id
 */
class Mode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wk_mode';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['exercise_id'], 'default', 'value' => null],
            [['exercise_id'], 'integer'],
            [['mode'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mode' => 'Mode',
            'exercise_id' => 'Exercise ID',
        ];
    }
}

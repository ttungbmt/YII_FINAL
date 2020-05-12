<?php
namespace pcd\modules\workout\models;

/**
 * This is the model class for table "wk_workout".
 *
 * @property int $id
 * @property string $title
 */
class Workout extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wk_workout';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['day'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }


    public function getExercises(){
        return $this->hasMany(Exercise::className(), ['id' => 'exercise_id'])
            ->viaTable('wk_workout_poly', ['workout_id' => 'id']);
    }

    public function getExIds(){
        return $this->getExercises()->select('id');
    }
}

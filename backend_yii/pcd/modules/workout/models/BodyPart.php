<?php

namespace pcd\modules\workout\models;

use Yii;

/**
 * This is the model class for table "wk_body_part".
 *
 * @property int $id
 * @property string $title
 * @property string $img
 */
class BodyPart extends \yii\db\ActiveRecord
{
    private $_ordersCount;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wk_body_part';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['img'], 'string'],
            [['title'], 'string', 'max' => 255],
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
            'img' => 'Img',
        ];
    }

    public function getExercises(){
        return $this->hasMany(Exercise::className(), ['id' => 'exercise_id'])
            ->viaTable('wk_body_part_poly', ['body_part_id' => 'id']);
    }

    public function setOrdersCount($count)
    {
        $this->_ordersCount = (int) $count;
    }

//    public function getOrdersCount()
//    {
//        if ($this->isNewRecord) {
//            return null; // this avoid calling a query searching for null primary keys
//        }
//
//        return empty($this->ordersAggregation) ? 0 : $this->ordersAggregation[0]['counted'];
//    }

    public function getExercisesCount()
    {
        return $this->hasMany(Exercise::className(), ['id' => 'exercise_id'])
            ->viaTable('wk_body_part_poly', ['body_part_id' => 'id']);
    }
}

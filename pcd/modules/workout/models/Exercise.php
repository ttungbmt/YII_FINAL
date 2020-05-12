<?php

namespace pcd\modules\workout\models;

use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "wk_exercise".
 *
 * @property int $id
 * @property string $title
 * @property string $link
 * @property string $musl_img
 * @property int $equip_id
 */
class Exercise extends MyModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wk_exercise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link', 'musl_img'], 'string'],
            [['equip_id'], 'default', 'value' => null],
            [['equip_id'], 'integer'],
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
            'link' => 'Link',
            'musl_img' => 'Musl Img',
            'equip_id' => 'Equip ID',
        ];
    }

    public function getEquip(){
        return $this->hasOne(Equip::className(), ['id' => 'equip_id']);
    }

    public function getBodyPart(){
        return $this->hasMany(BodyPart::className(), ['id' => 'body_part_id'])
            ->viaTable('wk_body_part_poly', ['exercise_id' => 'id']);
    }

    public function getPrimaryMusl(){
        return $this->hasMany(Muscle::className(), ['id' => 'poly_id'])
            ->viaTable('wk_muscle_poly', ['exercise_id' => 'id'], function($query){
                $query->andWhere(['poly_type' => 'primary']);
            });
    }

    public function getSecondaryMusl(){
        return $this->hasMany(BodyPart::className(), ['id' => 'poly_id'])
            ->viaTable('wk_muscle_poly', ['exercise_id' => 'id'], function($query){
                $query->andWhere(['poly_type' => 'secondary']);
            });
    }

    public function getMode(){
        return $this->hasMany(Mode::className(), ['exercise_id' => 'id']);
    }
}

<?php
namespace pcd\models;
use Yii;
/**
 * This is the model class for table "cungnha".
 *
 * @property int $id
 * @property int $cabenh_id
 * @property int $n_cabenh_id
 */
class Cungnha extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cungnha';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cabenh_id', 'n_cabenh_id'], 'default', 'value' => null],
            [['cabenh_id', 'n_cabenh_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cabenh_id' => 'Cabenh ID',
            'n_cabenh_id' => 'N Cabenh ID',
        ];
    }

    public function getNCabenh(){
        return $this->hasOne(CabenhSxh::className(), ['gid' => 'n_cabenh_id']);
    }
}

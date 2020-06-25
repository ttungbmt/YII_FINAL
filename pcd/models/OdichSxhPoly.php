<?php
namespace pcd\models;

use Yii;

/**
 * This is the model class for table "odich_sxh_poly".
 *
 * @property int $id
 * @property int $odich_id
 * @property int $cabenh_id
 * @property string $resource_type
 * @property int $resource_id
 * @property array $data
 */
class OdichSxhPoly extends App
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'odich_sxh_poly';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['odich_id', 'order', 'resource_id'], 'default', 'value' => null],
            [['odich_id', 'order', 'resource_id'], 'integer'],
            [['data'], 'safe'],
            [['resource_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'odich_id' => Yii::t('app', 'Odich ID'),
            'order' => 'Order',
            'resource_type' => 'Resource Type',
            'resource_id' => 'Resource ID',
            'data' => 'Data',
        ];
    }

    public function getOdich(){
        return $this->hasOne(OdichSxh::className(), ['id' => 'odich_id']);
    }

    public function getCabenhs(){
        return $this->hasOne(Cabenh::className(), ['macabenh' => 'cabenh_id']);
    }
}

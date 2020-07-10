<?php
namespace pcd\models;

use Yii;

/**
 * This is the model class for table "danso".
 *
 * @property int $id
 * @property string $ma_hc
 * @property int $nam
 * @property int $danso
 * @property string $cap_hc
 */
class Danso extends App
{
    protected $timestamps = true;

    public $qh;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'danso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nam', 'danso'], 'default', 'value' => null],
            [['nam', 'danso', 'uoctinh'], 'integer'],
            [['ma_hc'], 'string', 'max' => 255],
            [['danso', 'nam'], 'integer'],
            [['ma_hc', 'type', 'nam', 'danso', 'uoctinh'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '#',
            'ma_hc' => 'Hành chính',
            'nam' => 'Năm',
            'danso' => 'Dân số',
            'uoctinh' => 'Ước tính',
            'type' => 'Dân số',
        ];
    }
    
    public function getQuan(){
        return $this->hasOne(HcQuan::className(), ['maquan' => 'ma_hc']);
    }

    public function getPhuong(){
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'ma_hc']);
    }

    public function loadAndSave($data){
        if($this->type == 2) $this->qh = opt(HcPhuong::find()->andWhere(['maphuong' => $this->ma_hc])->one())->maquan;

        if(!$this->load($data)) return false;

        return $this->save();
    }
}

<?php
namespace pcd\models;

use pcd\supports\RoleHc;
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
    public $px;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'danso';
    }

    public function init()
    {
        parent::init();

        $role = RoleHc::init();
        $role->initFormHc($this, ['qh', 'px']);
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
            [['qh', 'ma_hc', 'type', 'nam', 'danso', 'uoctinh'], 'required'],
            [['px'], 'required', 'when' => function(){
                return role('phuong');
            }],
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
            'qh' => 'Quận huyện',
            'px' => 'Phường xã',
        ];
    }
    
    public function getQuan(){
        return $this->hasOne(HcQuan::className(), ['maquan' => 'ma_hc']);
    }

    public function getPhuong(){
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'ma_hc']);
    }

    public function loadAndSave($data){
        if($this->type == 1){
            $this->qh = $this->ma_hc;
        } elseif ($this->type == 2) {
            $this->qh = data_get(HcPhuong::find()->andWhere(['maphuong' => $this->ma_hc])->one(), 'maquan');
            $this->px = $this->ma_hc;
        }

        if(!$this->load($data)) return false;

        $this->type = $this->px ? 2 : 1;
        $this->ma_hc = $this->px ? $this->px : $this->qh;

        return $this->save();
    }
}

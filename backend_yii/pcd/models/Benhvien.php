<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "benhvien".
 *
 * @property integer $mabenhvien
 * @property string  $tenbenhvien
 * @property string  $maso
 * @property string  $tenvt
 * @property string  $diachi
 */
class Benhvien extends App
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'benhvien';
    }

    public static function primaryKey()
    {
        return ['mabenhvien'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mabenhvien'], 'number'],
            [['tenbenhvien'], 'string', 'max' => 150],
            [['maso', 'tenvt', 'diachi'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mabenhvien'  => Yii::t('app', 'Mabenhvien'),
            'tenbenhvien' => Yii::t('app', 'Tên bệnh viện'),
            'maso'        => Yii::t('app', 'Mã số'),
            'tenvt'       => Yii::t('app', 'Tên viết tắt'),
            'diachi'      => Yii::t('app', 'Địa chỉ'),
        ];
    }

    public function saveModel(){
        $old_bv = $this->tenvt;

        if(!$this->load(request()->post())) return false;
        $bool = $this->save();

        if($bool) DieutraSxh::updateAll(['tpbv_bv' => $this->tenvt], ['tpbv_bv' => $old_bv]);

        return $bool;
    }
}

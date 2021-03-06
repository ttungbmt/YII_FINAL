<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "phieu_gs".
 *
 * @property int $id Id
 * @property int $pt_nguyco_id Id ĐNC
 * @property string $vc_nc Vật chứa nước
 * @property string $vc_lq Vật chứa LQ
 * @property string $ngay_gs Ngày giám sát
 * @property string $nguoi_gs Người 
 * @property string $mucdich_gs Mục đích giám sát
 */
class PhieuGs extends App
{
    public $dates = ['ngay_gs'];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phieu_gs';
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pt_nguyco_id'], 'default', 'value' => null],
            [['pt_nguyco_id', 'vc_nc', 'vc_lq', 'dexuat_xp', 'xuphat'], 'integer'],
            [[ 'ngay_gs', 'nguoi_gs', 'mucdich_gs'], 'string', 'max' => 255],
            [['ngay_gs', 'nguoi_gs', 'vc_nc', 'vc_lq', 'mucdich_gs'], 'required'],
            [['vc_nc', 'vc_lq'], 'default', 'value' => null],
            [['vc_nc', 'vc_lq'], 'validateVatchua'],
            [['ngayxuphat', 'ngay_gs'], 'date', 'format' => 'php:d/m/Y'],
        ];
    }

    public function validateYear($attribute, $params){
        return ;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'pt_nguyco_id' => 'Id ĐNC',
            'vc_nc' => 'Số vật dụng/ vật chứa/ nơi chứa có nước',
            'vc_lq' => 'Số có LQ',
            'ngay_gs' => 'Ngày giám sát',
            'nguoi_gs' => 'Người giám sát',
            'mucdich_gs' => 'Mục đích giám sát',
            'dexuat_xp' => 'Đề xuất xử phạt',
            'xuphat' => 'Xử phạt',
            'ngayxuphat' => 'Ngày xử phạt',
        ];
    }

    public function getDnc()
    {
        return $this->hasOne(PtNguyco::className(), ['gid' => 'pt_nguyco_id']);
    }

    public function validateVatchua($attribute, $params){
        if(!$this->vc_nc && $this->vc_lq){
            $this->addError('vc_nc', 'Không hợp lệ');
        }
    }
}

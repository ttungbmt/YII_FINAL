<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "xacminh_cb".
 *
 * @property int $id
 * @property int $cabenh_id
 * @property int $is_diachi
 * @property int $is_benhnhan
 * @property string $dienthoai
 * @property string $sonha
 * @property string $duong
 * @property string $to_dp
 * @property string $khupho
 * @property string $tinh
 * @property string $tinh_dc_khac
 * @property string $px
 * @property string $qh
 * @property int $type
 */
class XacminhCb extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xacminh_cb';
    }

    public function init() {
        parent::init();

        if ($this->isNewRecord) {
            $this->is_diachi = null;
            $this->is_benhnhan = null;
            $this->dienthoai = null;
            $this->sonha = null;
            $this->duong = null;
            $this->to_dp = null;
            $this->khupho = null;
            $this->tinh = 'HCM';
            $this->tinh_dc_khac = null;
            $this->qh = null;
            $this->px = null;
        }
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['px', 'qh'], 'safe'],
            [['cabenh_id', 'is_diachi', 'is_benhnhan'], 'default', 'value' => null],
            [['cabenh_id', 'is_diachi', 'is_benhnhan', 'type'], 'integer'],
            [['tinh_dc_khac'], 'string'],
            [['dienthoai', 'sonha', 'duong', 'to_dp', 'khupho', 'tinh'], 'string', 'max' => 255],
            [['is_diachi'], 'required'],
//            ['is_benhnhan', 'required', 'when' => function($model) {
//                return $model->type === 0;
//            }],

            [['qh', 'px'], 'required', 'when' => function($model) {
                return $model->tinh == 'HCM';
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
            'cabenh_id' => 'Cabenh ID',
            'is_diachi' => 'Địa chỉ',
            'is_benhnhan' => 'Bệnh nhân',
            'dienthoai' => 'Điện thoại',
            'sonha' => 'Số nhà',
            'duong' => 'Đường',
            'to_dp' => 'Tổ',
            'khupho' => 'Khu phố',
            'tinh' => 'Tỉnh',
            'tinh_dc_khac' => 'Địa chỉ tỉnh khác',
            'px' => 'Phường xã',
            'qh' => 'Quận huyện',
        ];
    }

    public function getPhuong(){
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'px']);
    }


}

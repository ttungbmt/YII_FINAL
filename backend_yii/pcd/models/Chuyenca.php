<?php

namespace pcd\models;

use Carbon\Carbon;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "chuyenca".
 *
 * @property int $id
 * @property int $cabenh_id
 * @property int $type 1: Chuyển ca, 2: Trả ca
 * @property string $nguoichuyen
 * @property string $qh_chuyen
 * @property string $px_chuyen
 * @property string $nguoinhan
 * @property string $qh_nhan
 * @property string $px_nhan
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_locked
 * @property string $ten_qh_nhan
 * @property string $ten_px_nhan
 * @property string $ten_qh_chuyen
 * @property string $ten_px_chuyen
 * @property string $readed_at
 * @property int $is_chuyentiep
 * @property string $sdt_chuyen
 * @property string $sdt_nhan
 * @property string $hoten_nhan
 * @property string $hoten_chuyen
 * @property string $date_chuyen
 * @property string $date_nhan
 */
class Chuyenca extends App
{
    protected $timestamps = true;
    protected $blameables = true;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chuyenca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cabenh_id', 'type', 'created_by', 'updated_by', 'is_locked', 'is_chuyentiep'], 'default', 'value' => null],
            [['cabenh_id', 'type', 'created_by', 'updated_by', 'is_locked', 'is_chuyentiep'], 'integer'],
            [['created_at', 'updated_at', 'readed_at'], 'safe'],
            [['nguoichuyen', 'qh_chuyen', 'px_chuyen', 'nguoinhan', 'qh_nhan', 'px_nhan', 'ten_qh_nhan', 'ten_px_nhan', 'ten_qh_chuyen', 'ten_px_chuyen', 'sdt_chuyen', 'sdt_nhan', 'hoten_nhan', 'hoten_chuyen'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cabenh_id' => 'Ca bệnh ID',
            'type' => 'Type',
            'nguoichuyen' => 'Người chuyển',
            'qh_chuyen' => 'Quận/huyện chuyển',
            'px_chuyen' => 'Phường/xã chuyển',
            'nguoinhan' => 'Người nhận',
            'qh_nhan' => 'Quận/huyện nhận',
            'px_nhan' => 'Phường/xã nhận',
            'created_by' => 'Created by',
            'updated_by' => 'Updated By',
            'created_at' => 'Ngày chuyển',
            'updated_at' => 'Updated At',
            'readed_at' => 'Đọc lúc',
            'hoten' => 'Bệnh nhân',
            'sdt_nhan' => 'SĐT người nhận',
            'sdt_chuyen' => 'SĐT người chuyển',
            'date_chuyen' => 'Thời gian chuyển',
            'date_nhan' => 'Thời gian nhận',
        ];
    }


    public function getChuyen(){
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'px_chuyen']);
    }

    public function getNhan(){
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'px_nhan']);
    }

    public function getCabenhSxh(){
        return $this->hasOne(CabenhSxh::className(), ['gid' => 'cabenh_id']);
    }

    public function getDatetime(){

        if(!$this->created_at) return '';
        $d1 = Carbon::parse($this->created_at);
        $d1_str = $d1->format('d/m/Y - H:i:s');
        $d2 = Carbon::now()->diffForHumans($d1);
        return "{$d1_str} <br/>({$d2})";
    }

    public function toJs(){
        return ArrayHelper::toArray($posts, [
            self::className() => [
                'nguoichuyen',
            ],
        ]);
    }
}

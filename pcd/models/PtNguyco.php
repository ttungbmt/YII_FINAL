<?php

namespace pcd\models;

use kartik\helpers\Html;
use Yii;
use yii\base\Model;

/**
 * This is the model class for table "pt_nguyco".
 *
 * @property int    $gid         ID
 * @property string $geom        Geom
 * @property string $maso        Mã ĐNC
 * @property string $ten_cs      Tên chủ đơn vị/ Người chịu trách nhiệm
 * @property string $sonha       Số nhà
 * @property string $tenduong    Đường
 * @property string $khupho      Khu phố/ ấp
 * @property string $to_dp       Tổ
 * @property string $maphuong    Phường xã
 * @property string $maquan      Quận huyện
 * @property string $nhom        Nhóm
 * @property string $loaihinh    Loại hình
 * @property string $tochuc_gs   Cá nhân, tổ chức phụ trách giám sát
 * @property string $ngaycapnhat Ngày cập nhật
 * @property string $ngayxoa     Ngày xóa
 * @property string $ghichu      Ghi chú
 * @property string $dienthoai   Điện thoại
 * @property string $phancap_ql  Phân cấp QL
 * @property string $thuchien    Thục hiện
 * @property string $created_at  Ngày tạo
 * @property string $updated_at  Ngày cập nhật
 * @property string $created_by  Người tạo
 * @property string $updated_by  Người cập nhật
 */
class PtNguyco extends App
{
    public $timestamps = true;
    public $blameables = true;
    public $dates = [
        'ngaycapnhat',
        'ngayxoa',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pt_nguyco';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loaihinh_id', 'ky_ck'], 'integer'],
            [['ngaycapnhat', 'ngayxoa', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['maso', 'ten_cs', 'sonha', 'tenduong', 'khupho', 'to_dp', 'maphuong', 'maquan', 'nhom', 'loaihinh', 'tochuc_gs', 'ghichu', 'phancap_ql', 'thuchien', 'dienthoai'], 'string', 'max' => 255],
            [['ngaycapnhat', 'ngayky_ck'], 'date', 'format' => 'php:d/m/Y'],
            [['ngaycapnhat'], 'required'],
            ['giamsats', 'validateGiamsats'],
        ];
    }

    public function validateGiamsats()
    {
        foreach ($this->giamsats as $gs) {
            if (!$gs->validate()) {
                return;
            }
        }
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gid'         => 'ID',
            'geom'        => 'Geom',
            'maso'        => 'Mã ĐNC',
            'ten_cs'      => 'Tên chủ đơn vị/ Người chịu trách nhiệm',
            'sonha'       => 'Số nhà',
            'tenduong'    => 'Đường',
            'khupho'      => 'Khu phố/ ấp',
            'to_dp'       => 'Tổ',
            'maphuong'    => 'Phường xã',
            'maquan'      => 'Quận huyện',
            'nhom'        => 'Nhóm điểm nguy cơ',
            'loaihinh'    => 'Tên loại hình',
            'tochuc_gs'   => 'Cá nhân, tổ chức phụ trách giám sát',
            'ngaycapnhat' => 'Ngày cập nhật',
            'ngayxoa'     => 'Ngày xóa',
            'ghichu'      => 'Ghi chú',
            'phancap_ql'  => 'Phân cấp QL',
            'thuchien'    => 'Thục hiện',
            'created_at'  => 'Ngày tạo',
            'updated_at'  => 'Ngày cập nhật',
            'created_by'  => 'Người tạo',
            'updated_by'  => 'Người cập nhật',
            'dienthoai'   => 'Số điện thoại',
            'loaihinh_id' => 'Loại hình',
            'ky_ck'       => 'Ký cam kết',
            'ngayky_ck'   => 'Ngày ký cam kết',

            'diachiText'   => 'Địa chỉ',
        ];
    }

    public function getGiamsats()
    {
        return $this->hasMany(PhieuGs::className(), ['pt_nguyco_id' => 'gid'])->orderBy('ngay_gs');
    }

    public function getKehoachs()
    {
        return $this->hasMany(KehoachGs::className(), ['pt_nguyco_id' => 'gid'])->orderBy('year, month');
    }

    public function getKhYear($y)
    {
        return $this->hasOne(KehoachGs::className(), ['pt_nguyco_id' => 'gid'])->andFilterWhere(['year' => $y]);
    }

    public function getGsYear($y)
    {
        return $this->hasOne(VGiamsat::className(), ['pt_nguyco_id' => 'gid'])->andFilterWhere(['year' => $y]);
    }


    public function getQuan()
    {
        return $this->hasOne(HcQuan::className(), ['maquan' => 'maquan']);
    }

    public function getPhuong()
    {
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'maphuong']);
    }

    public function getDiachiText()
    {
        $addrs = collect([$this->sonha, $this->tenduong])->filter()->implode(' ');
        return trim($addrs);
    }

    public function getLh()
    {
        return $this->hasOne(DmLoaihinh::className(), ['loaihinh_id' => 'gid']);
    }

    public function getDncText()
    {
        return Html::a($this->ten_cs, ['/admin/pt-nguyco/update', 'id' => $this->getId()], ['target' => '_blank']);
    }

    public function loadDNC($data, &$giamsats)
    {
        $l1 = $this->load($data);
        $n = collect(data_get($data, 'PhieuGs'))->map(function ($i) use ($giamsats) {
            $id = data_get($i, 'id');
            $d = collect($giamsats)->firstWhere('id', $id);
            return $d ? $d : new PhieuGs();
        })->all();
        $giamsats = $n;
        Model::loadMultiple($giamsats, $data);


        if (
            $l1 &&
            $this->validate() &&
            Model::validateMultiple($giamsats)
        ) {
            return true;
        }
        return false;
    }
}

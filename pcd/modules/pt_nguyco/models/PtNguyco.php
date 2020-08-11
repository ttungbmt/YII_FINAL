<?php

namespace pcd\modules\pt_nguyco\models;

use Carbon\Carbon;
use kartik\helpers\Html;
use pcd\models\App;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use pcd\modules\pt_nguyco\models\view\VGiamsat;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pt_nguyco".
 *
 * @property int $gid         ID
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
        'ngayky_ck'
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
            [['lat', 'lng'], 'safe'],
            [['lat', 'lng'], 'filter', 'filter' => 'trim'],
            [['loaihinh_id', 'ky_ck'], 'integer'],
            [['khupho', 'to_dp', 'ngaycapnhat', 'ngayxoa', 'created_at', 'updated_at', 'created_by', 'updated_by', 'diachi'], 'safe'],
            [['maphuong', 'maquan', 'khupho', 'to_dp', 'dienthoai', 'sonha', 'tenduong', 'nhom',], 'safe'],
            [['maso', 'ten_cs', 'loaihinh', 'tochuc_gs', 'ghichu', 'phancap_ql', 'thuchien',], 'string', 'max' => 255],
            [['ngaycapnhat', 'ngayky_ck', 'ngayxoa'], 'date', 'format' => 'php:d/m/Y'],
            [['geom'], 'geom'],
            [['maphuong', 'maquan'], 'required'],
            [['ngayxoa', 'ngaycapnhat', 'ngayky_ck'], 'dateCompare', 'compareValue' => date('d/m/Y'), 'format' => 'd/m/Y', 'operator' => '<='],
            ['ngayxoa', 'dateCompare', 'compareAttribute' => 'ngaycapnhat', 'format' => 'd/m/Y', 'operator' => '>='],
            ['ngayxoa', 'validateNgayxoa'],
            [['ky_ck'], 'required', 'when' => function ($model) {
                return $model->dm_loaihinh && $model->dm_loaihinh->nhom == '1';
            }],
            [['ngayky_ck'], 'required', 'when' => function ($model) {
                return $model->ky_ck == '1';
            }],
            ['giamsats', 'validateGiamsats'],
        ];
    }

    public function validateNgayxoa($attribute){
        foreach ($this->giamsats as $gs){

            if($gs->ngay_gs && $this->ngayxoa){
                $gs = Carbon::createFromFormat('d/m/Y', $gs->ngay_gs);
                $nx = Carbon::createFromFormat('d/m/Y', $this->ngayxoa);
                if($nx < $gs){
                    $this->addError($attribute, "Ngày xóa phải lớn hơn ngày giám sát của các đợt giám sát");
                }

            }
        }
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
            'gid' => 'ID',
            'geom' => 'Geom',
            'maso' => 'Mã ĐNC',
            'ten_cs' => 'Tên chủ đơn vị/ Người chịu trách nhiệm',
            'sonha' => 'Số nhà',
            'tenduong' => 'Đường',
            'khupho' => 'Khu phố/ ấp',
            'to_dp' => 'Tổ',
            'maphuong' => 'Phường xã',
            'maquan' => 'Quận huyện',
            'nhom' => 'Nhóm điểm nguy cơ',
            'loaihinh' => 'Tên loại hình',
            'tochuc_gs' => 'Cá nhân, tổ chức phụ trách giám sát',
            'ngaycapnhat' => 'Ngày cập nhật',
            'ngayxoa' => 'Ngày xóa',
            'ghichu' => 'Ghi chú',
            'phancap_ql' => 'Phân cấp QL',
            'thuchien' => 'Thục hiện',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
            'created_by' => 'Người tạo',
            'updated_by' => 'Người cập nhật',
            'dienthoai' => 'Số điện thoại',
            'loaihinh_id' => 'Loại hình',
            'ky_ck' => 'Ký cam kết',
            'ngayky_ck' => 'Ngày ký cam kết',

            'diachiText' => 'Địa chỉ',
        ];
    }


    public static function rawFields(){
        return [
            'id',
            'ten_cs',
            'nhom',
            'loaihinh' => function($model){
                if($lh = $model->dm_loaihinh){
                    if(in_array($lh->id, [20, 21, 22]) && $model->loaihinh) return "Khác ({$model->loaihinh})";
                    return $model->dm_loaihinh->ten_lh;
                }
                return '';
            },
            'khupho',
            'to_dp',
            'tenphuong' => function($model){
                return data_get($model, 'phuong.tenphuong', '');
            },
            'tenquan' => function($model){
                return data_get($model, 'quan.tenquan', '');
            },
            'diachi'=> function($model){
                return collect([$model->sonha, $model->tenduong])->implode(' ');
            },
            'maquan',
            'maphuong',
        ];
    }

    public function getGiamsats()
    {
        return $this->hasMany(PhieuGs::className(), ['pt_nguyco_id' => 'gid'])->orderBy('ngay_gs');
    }

    public function getGiamsatOrderIds()
    {
        return $this->hasMany(PhieuGs::className(), ['pt_nguyco_id' => 'gid'])->orderBy('id');
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

    public function getDm_loaihinh()
    {
        return $this->hasOne(DmLoaihinh::className(), ['id' => 'loaihinh_id']);
    }

    public function getLoaihinh()
    {
        return $this->hasOne(DmLoaihinh::className(), ['id' => 'loaihinh_id']);
    }

    public function getDiachiText()
    {
        $addrs = collect([$this->sonha, $this->tenduong])->filter()->implode(' ');
        return trim($addrs);
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
            if($d) {
                $d->load($i, '');
                return $d;
            }
            $model = new PhieuGs();
            $model->load($i, '');
            return $model;
        })->all();
        $giamsats = $n;

        if ($this->lat && $this->lng) {
            $this->geom = [$this->lng, $this->lat];
        }

        if ($this->loaihinh_id) {
            $this->nhom = data_get(DmLoaihinh::findOne($this->loaihinh_id), 'nhom');
        }

        if (
            $l1 &&
            $this->validate() &&
            Model::validateMultiple($giamsats)
        ) {
            return true;
        }

        return false;
    }

    public function getPopupFields()
    {
        return [
            'gid',
            'ten_cs',
            'diachi' => function ($model) {
                if ($model->sonha || $model->tenduong) return collect([$model->sonha, $model->tenduong])->filter()->implode(' ');
                return Html::tag('span', $model->diachi, ['class' => 'text-danger']);
            },
            'tenphuong' => function ($model) {
                return data_get($model, 'phuong.tenphuong');
            },
            'tenquan' => function ($model) {
                return data_get($model, 'quan.tenquan');
            },
            'khupho_to' => function ($model) {
                return collect([$model->khupho, $model->to_dp])->filter()->implode(' - ');
            },
            'maphuong',
            'maquan',
            'khupho',
            'to_dp',
            'nhom',
            'loaihinh' => function ($model) {
                return data_get($model->dm_loaihinh, 'ten_lh');
            },
            'ngaycapnhat',
            'geometry' => function ($model) {
                return $model->toGeometry();
            },
        ];
    }

    public static function getPopupInfo($id)
    {
        $model = self::find()->andWhere(['gid' => $id])->one();
        return ArrayHelper::toArray($model, [
            self::className() => (new self())->getPopupFields()
        ]);
    }
}

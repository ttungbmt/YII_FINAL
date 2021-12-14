<?php

namespace pcd\models;

use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "v_cabenh".
 *
 * @property integer $macabenh
 * @property integer $code
 * @property integer $ma_dtcm
 * @property string $ma_icd
 * @property integer $ma_dsxh
 * @property integer $mabenhvien
 * @property string $tencabenh
 * @property string $sohoso
 * @property string $hoten
 * @property integer $gioitinh
 * @property integer $tuoi
 * @property string $hotennguoithan
 * @property string $dienthoai
 * @property string $ngaybaocao
 * @property string $ngaynhanthongbao
 * @property string $ngaymacbenh
 * @property string $ngaynhapvien
 * @property string $ngayxuatvien
 * @property string $ketquaxetnghiem
 * @property integer $dihoc
 * @property string $tentruong
 * @property string $cdravien
 * @property string $chuandoan
 * @property string $sonha
 * @property string $tenduong
 * @property string $tenphuong
 * @property string $tenquan
 * @property string $todanpho
 * @property integer $tinh
 * @property string $khupho
 * @property integer $thuongtru
 * @property integer $cobenhnhan
 * @property integer $codiachi
 * @property string $diachinoikhac
 * @property integer $tiemdu
 * @property integer $tiemchung
 * @property integer $tinhtrangxuatvien
 * @property string $ngaynhaplieu
 * @property string $ghichu
 * @property string $geom
 * @property string $loai_dich
 * @property double $geo_x
 * @property double $geo_y
 * @property string $geom_txt
 * @property integer $ma_phuong
 * @property integer $ma_quan
 * @property string $ten_phuong
 * @property string $ten_quan
 * @property boolean $dadieutra
 * @property string $ngaycapnhat
 * @property integer $songaybenh
 * @property integer $ma_dt_sxh
 * @property integer $ma_dt_tcm
 * @property string $shs
 * @property string $tbenh
 * @property string $vitri1
 * @property string $me
 * @property string $dt
 * @property integer $nam_nv
 * @property integer $thang_nv
 * @property integer $tuan_nv
 * @property integer $nam_bc
 * @property integer $thang_bc
 * @property integer $tuan_bc
 * @property string $phai
 */
class VCabenh extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_cabenh';
    }

    public static function primaryKey()
    {
        return [
            'macabenh',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['macabenh', 'code', 'ma_dtcm', 'ma_dsxh', 'mabenhvien', 'gioitinh', 'tuoi', 'dihoc', 'tinh', 'thuongtru', 'cobenhnhan', 'codiachi', 'tiemdu', 'tiemchung', 'tinhtrangxuatvien', 'ma_phuong', 'ma_quan', 'songaybenh', 'ma_dt_sxh', 'ma_dt_tcm', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc'], 'integer'],
            [['ngaybaocao', 'ngaynhanthongbao', 'ngaymacbenh', 'ngaynhapvien', 'ngayxuatvien', 'ngaynhaplieu'], 'safe'],
            [['diachinoikhac', 'ghichu', 'geom', 'loai_dich', 'geom_txt', 'dt'], 'string'],
            [['geo_x', 'geo_y', 'ngaycapnhat'], 'number'],
            [['dadieutra'], 'boolean'],
            [['ma_icd', 'dienthoai'], 'string', 'max' => 15],
            [['tencabenh', 'hoten', 'hotennguoithan', 'ketquaxetnghiem', 'tenduong', 'tenphuong', 'tenquan'], 'string', 'max' => 150],
            [['sohoso', 'ten_quan'], 'string', 'max' => 20],
            [['tentruong'], 'string', 'max' => 200],
            [['cdravien', 'chuandoan', 'sonha', 'khupho', 'ten_phuong'], 'string', 'max' => 50],
            [['todanpho'], 'string', 'max' => 10],
            [['shs', 'tbenh', 'vitri1', 'me', 'phai'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'macabenh' => Yii::t('app', 'Macabenh'),
            'code' => Yii::t('app', 'Code'),
            'ma_dtcm' => Yii::t('app', 'Ma Dtcm'),
            'ma_icd' => Yii::t('app', 'Ma Icd'),
            'ma_dsxh' => Yii::t('app', 'Ma Dsxh'),
            'mabenhvien' => Yii::t('app', 'Mabenhvien'),
            'tencabenh' => Yii::t('app', 'Tencabenh'),
            'sohoso' => Yii::t('app', 'Sohoso'),
            'hoten' => Yii::t('app', 'Hoten'),
            'gioitinh' => Yii::t('app', 'Gioitinh'),
            'tuoi' => Yii::t('app', 'Tuoi'),
            'hotennguoithan' => Yii::t('app', 'Hotennguoithan'),
            'dienthoai' => Yii::t('app', 'Dienthoai'),
            'ngaybaocao' => Yii::t('app', 'Ngày báo cáo'),
            'ngaynhanthongbao' => Yii::t('app', 'Ngaynhanthongbao'),
            'ngaymacbenh' => Yii::t('app', 'Ngaymacbenh'),
            'ngaynhapvien' => Yii::t('app', 'Ngaynhapvien'),
            'ngayxuatvien' => Yii::t('app', 'Ngayxuatvien'),
            'ketquaxetnghiem' => Yii::t('app', 'Ketquaxetnghiem'),
            'dihoc' => Yii::t('app', 'Dihoc'),
            'tentruong' => Yii::t('app', 'Tentruong'),
            'cdravien' => Yii::t('app', 'Cdravien'),
            'chuandoan' => Yii::t('app', 'Chuandoan'),
            'sonha' => Yii::t('app', 'Sonha'),
            'tenduong' => Yii::t('app', 'Tenduong'),
            'tenphuong' => Yii::t('app', 'Tenphuong'),
            'tenquan' => Yii::t('app', 'Tenquan'),
            'todanpho' => Yii::t('app', 'Todanpho'),
            'tinh' => Yii::t('app', 'Tinh'),
            'khupho' => Yii::t('app', 'Khupho'),
            'thuongtru' => Yii::t('app', 'Thuongtru'),
            'cobenhnhan' => Yii::t('app', 'Cobenhnhan'),
            'codiachi' => Yii::t('app', 'Codiachi'),
            'diachinoikhac' => Yii::t('app', 'Diachinoikhac'),
            'tiemdu' => Yii::t('app', 'Tiemdu'),
            'tiemchung' => Yii::t('app', 'Tiemchung'),
            'tinhtrangxuatvien' => Yii::t('app', 'Tinhtrangxuatvien'),
            'ngaynhaplieu' => Yii::t('app', 'Ngaynhaplieu'),
            'ghichu' => Yii::t('app', 'Ghichu'),
            'geom' => Yii::t('app', 'Geom'),
            'loai_dich' => Yii::t('app', 'Loai Dich'),
            'geo_x' => Yii::t('app', 'Geo X'),
            'geo_y' => Yii::t('app', 'Geo Y'),
            'geom_txt' => Yii::t('app', 'Geom Txt'),
            'ma_phuong' => Yii::t('app', 'Ma Phuong'),
            'ma_quan' => Yii::t('app', 'Ma Quan'),
            'ten_phuong' => Yii::t('app', 'Ten Phuong'),
            'ten_quan' => Yii::t('app', 'Ten Quan'),
            'dadieutra' => Yii::t('app', 'Dadieutra'),
            'ngaycapnhat' => Yii::t('app', 'Ngaycapnhat'),
            'songaybenh' => Yii::t('app', 'Songaybenh'),
            'ma_dt_sxh' => Yii::t('app', 'Ma Dt Sxh'),
            'ma_dt_tcm' => Yii::t('app', 'Ma Dt Tcm'),
            'shs' => Yii::t('app', 'Shs'),
            'tbenh' => Yii::t('app', 'Tbenh'),
            'vitri1' => Yii::t('app', 'Vitri1'),
            'me' => Yii::t('app', 'Me'),
            'dt' => Yii::t('app', 'Dt'),
            'nam_nv' => Yii::t('app', 'Nam Nv'),
            'thang_nv' => Yii::t('app', 'Thang Nv'),
            'tuan_nv' => Yii::t('app', 'Tuan Nv'),
            'nam_bc' => Yii::t('app', 'Nam Bc'),
            'thang_bc' => Yii::t('app', 'Thang Bc'),
            'tuan_bc' => Yii::t('app', 'Tuan Bc'),
            'phai' => Yii::t('app', 'Phai'),
        ];
    }
}

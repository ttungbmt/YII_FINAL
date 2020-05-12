<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "cabenh_sxh".
 *
 * @property int $gid
 * @property int $loaidieutra
 * @property int $loaicabenh
 * @property int $chuyenca
 * @property int $loaibaocao
 * @property string $chuandoan_bd Danh mục bệnh
 * @property string $chuandoan_bd_khac
 * @property string $ma_icd
 * @property string $maphuong
 * @property string $maquan
 * @property string $hoten
 * @property string $tuoi
 * @property string $phai
 * @property string $ngaysinh
 * @property string $benhvien
 * @property string $ngaybaocao
 * @property string $ngaynhanthongbao
 * @property string $ngaymacbenh
 * @property string $ngaynhapvien
 * @property string $ngayxuatvien
 * @property string $ngaymacbenh_nv
 * @property string $nghenghiep
 * @property string $shs
 * @property string $vitri
 * @property string $me
 * @property string $dienthoai
 * @property string $geom
 * @property string $nam_nv
 * @property string $thang_nv
 * @property string $tuan_nv
 * @property string $nam_bc
 * @property string $thang_bc
 * @property string $tuan_bc
 * @property string $sonha
 * @property string $duong
 * @property string $to_dp
 * @property string $khupho
 * @property string $px
 * @property string $qh
 * @property string $ht_dieutri
 * @property string $xacminh_cb
 * @property string $chuandoan Bệnh SXH, Sốt/Nhiễm siêu vi/Nghi ngờ sốt xuất huyết, Bệnh khác
 * @property string $chuandoan_khac
 * @property int $xetnghiem
 * @property string $ngaylaymau
 * @property int $loai_xn
 * @property int $ketqua_xn
 */
class CabenhSxh1 extends \common\models\MyModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cabenh_sxh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loaidieutra', 'loaicabenh', 'chuyenca', 'loaibaocao', 'xetnghiem', 'loai_xn', 'ketqua_xn'], 'default', 'value' => null],
            [['loaidieutra', 'loaicabenh', 'chuyenca', 'loaibaocao', 'xetnghiem', 'loai_xn', 'ketqua_xn'], 'integer'],
            [['ngaysinh', 'ngaybaocao', 'ngaynhanthongbao', 'ngaymacbenh', 'ngaynhapvien', 'ngayxuatvien', 'ngaymacbenh_nv', 'ngaylaymau', 'geom', 'shs', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc', 'tuoi'], 'safe'],
            [['chuandoan_bd', 'chuandoan_bd_khac', 'ma_icd', 'hoten', 'maquan', 'maphuong', 'phai', 'benhvien', 'nghenghiep', 'vitri', 'me', 'dienthoai', 'sonha', 'duong', 'to_dp', 'khupho', 'px', 'qh', 'ht_dieutri', 'xacminh_cb', 'chuandoan', 'chuandoan_khac'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gid' => Yii::t('app', 'Gid'),
            'loaidieutra' => Yii::t('app', 'Loaidieutra'),
            'loaicabenh' => Yii::t('app', 'Loaicabenh'),
            'chuyenca' => Yii::t('app', 'Chuyenca'),
            'loaibaocao' => Yii::t('app', 'Loaibaocao'),
            'chuandoan_bd' => Yii::t('app', 'Danh mục bệnh'),
            'chuandoan_bd_khac' => Yii::t('app', 'Chuandoan Bd Khac'),
            'ma_icd' => Yii::t('app', 'Ma Icd'),
            'maphuong' => Yii::t('app', 'Maphuong'),
            'maquan' => Yii::t('app', 'Maquan'),
            'hoten' => Yii::t('app', 'Hoten'),
            'tuoi' => Yii::t('app', 'Tuoi'),
            'phai' => Yii::t('app', 'Phai'),
            'ngaysinh' => Yii::t('app', 'Ngaysinh'),
            'benhvien' => Yii::t('app', 'Benhvien'),
            'ngaybaocao' => Yii::t('app', 'Ngaybaocao'),
            'ngaynhanthongbao' => Yii::t('app', 'Ngaynhanthongbao'),
            'ngaymacbenh' => Yii::t('app', 'Ngaymacbenh'),
            'ngaynhapvien' => Yii::t('app', 'Ngaynhapvien'),
            'ngayxuatvien' => Yii::t('app', 'Ngayxuatvien'),
            'ngaymacbenh_nv' => Yii::t('app', 'Ngaymacbenh Nv'),
            'nghenghiep' => Yii::t('app', 'Nghenghiep'),
            'shs' => Yii::t('app', 'Shs'),
            'vitri' => Yii::t('app', 'Vitri'),
            'me' => Yii::t('app', 'Me'),
            'dienthoai' => Yii::t('app', 'Dienthoai'),
            'geom' => Yii::t('app', 'Geom'),
            'nam_nv' => Yii::t('app', 'Nam Nv'),
            'thang_nv' => Yii::t('app', 'Thang Nv'),
            'tuan_nv' => Yii::t('app', 'Tuan Nv'),
            'nam_bc' => Yii::t('app', 'Nam Bc'),
            'thang_bc' => Yii::t('app', 'Thang Bc'),
            'tuan_bc' => Yii::t('app', 'Tuan Bc'),
            'sonha' => Yii::t('app', 'Sonha'),
            'duong' => Yii::t('app', 'Duong'),
            'to_dp' => Yii::t('app', 'To Dp'),
            'khupho' => Yii::t('app', 'Khupho'),
            'px' => Yii::t('app', 'Px'),
            'qh' => Yii::t('app', 'Qh'),
            'ht_dieutri' => Yii::t('app', 'Ht Dieutri'),
            'xacminh_cb' => Yii::t('app', 'Xacminh Cb'),
            'chuandoan' => Yii::t('app', 'Bệnh SXH, Sốt/Nhiễm siêu vi/Nghi ngờ sốt xuất huyết, Bệnh khác'),
            'chuandoan_khac' => Yii::t('app', 'Chuandoan Khac'),
            'xetnghiem' => Yii::t('app', 'Xetnghiem'),
            'ngaylaymau' => Yii::t('app', 'Ngaylaymau'),
            'loai_xn' => Yii::t('app', 'Loai Xn'),
            'ketqua_xn' => Yii::t('app', 'Ketqua Xn'),
        ];
    }
}

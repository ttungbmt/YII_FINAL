<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "v_cabenh1".
 *
 * @property integer $macabenh
 * @property integer $mabenhvien
 * @property string $hoten
 * @property integer $tuoi
 * @property string $dienthoai
 * @property string $ngaybaocao
 * @property string $ngaynhanthongbao
 * @property string $ngaynhapvien
 * @property integer $diachi1
 * @property string $ngaysinh
 * @property integer $benhnhan1
 * @property string $dienthoai1
 * @property string $sonha1
 * @property string $duong1
 * @property string $to1
 * @property string $khupho1
 * @property integer $qh1
 * @property integer $px1
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
 * @property string $ngaydieutra
 * @property integer $diachi2
 * @property string $maso
 * @property integer $ma_dt_sxh
 * @property string $sonha2
 * @property string $duong2
 * @property string $to2
 * @property string $khupho2
 * @property string $tinh2
 * @property integer $qh2
 * @property string $px2
 * @property integer $diachi3
 * @property integer $benhnhan2
 * @property integer $benhnhan3
 * @property string $dienthoai3
 * @property string $sonha3
 * @property string $duong3
 * @property string $to3
 * @property string $khupho3
 * @property string $tinh3
 * @property integer $qh3
 * @property integer $benhnoikhac
 * @property integer $px3
 * @property integer $sonhakhac
 * @property string $duongkhac
 * @property string $tokhac
 * @property string $khuphokhac
 * @property string $tinhkhac
 * @property string $qhkhac
 * @property string $songuoicutru
 * @property string $cutruduoi15
 * @property integer $tpbv
 * @property string $tpbv_bv
 * @property integer $phcd
 * @property integer $nhapvien
 * @property string $nhapvien_bv
 * @property string $nghenghiep
 * @property string $ngaymacbenh
 * @property string $dclamviec
 * @property integer $dclamviecqh
 * @property integer $dclamviecpx
 * @property integer $noilamviec_sxh
 * @property integer $nhaconguoibenh
 * @property string $dienthoai2
 * @property integer $nhacobnsxh
 * @property integer $bvpk
 * @property integer $nhatho
 * @property integer $dinh
 * @property integer $chua
 * @property integer $congvien
 * @property integer $noihoihop
 * @property integer $noixd
 * @property integer $cafe
 * @property integer $noichannuoi
 * @property integer $noibancay
 * @property integer $vuaphelieu
 * @property integer $noikhac
 * @property string $noikhac_ghichu
 * @property integer $diemden_px
 * @property integer $diemden_pxkhac
 * @property integer $diemden_qhkhac
 * @property integer $gdcosxh
 * @property string $gdsonguoisxh
 * @property integer $gdso15t
 * @property integer $gdthuocsxh
 * @property string $gdthuocsxhsonguoi
 * @property integer $gdthuocsxh15t
 * @property integer $bi
 * @property integer $ci
 * @property integer $cachidiem
 * @property integer $dietlangquang
 * @property integer $giamsattheodoi
 * @property integer $xulyonho
 * @property integer $cathuphat
 * @property integer $odichmoi
 * @property integer $odichcu
 * @property integer $odichcu_xuly
 * @property integer $xuly
 * @property integer $xuly_ngay
 * @property integer $xuatvien
 * @property integer $xacdinh
 * @property string $tenbenhkhac
 * @property string $nguoidieutra
 * @property string $ngayxuatvien
 * @property integer $pxkhac
 * @property integer $xmcabenh
 * @property integer $kdc_pxk
 * @property integer $kdc_qhk
 * @property integer $kdc_tk
 * @property integer $cdc_kbn_pxk
 * @property integer $cdc_kbn_qhk
 * @property integer $cdc_kbn_tk
 * @property integer $cdc_cbn_sxh
 * @property integer $cdc_cbn_ksxh
 * @property string $tk_namsxh
 * @property string $tk_thangsxh
 * @property string $geom
 * @property string $loai_dich
 * @property double $geo_x
 * @property double $geo_y
 * @property string $geom_txt
 * @property integer $ma_phuong
 */
class VCabenh1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_cabenh1';
    }

    public function getOdich()
    {
        return $this->hasOne(OdichSxh::className(), ['id' => 'odichsxh_id']);
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
            [['macabenh', 'mabenhvien', 'tuoi', 'diachi1', 'benhnhan1', 'qh1', 'px1', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc', 'diachi2', 'ma_dt_sxh', 'qh2', 'diachi3', 'benhnhan2', 'benhnhan3', 'qh3', 'benhnoikhac', 'px3', 'sonhakhac', 'tpbv', 'phcd', 'nhapvien', 'dclamviecqh', 'dclamviecpx', 'noilamviec_sxh', 'nhaconguoibenh', 'nhacobnsxh', 'bvpk', 'nhatho', 'dinh', 'chua', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu', 'noikhac', 'diemden_px', 'diemden_pxkhac', 'diemden_qhkhac', 'gdcosxh', 'gdso15t', 'gdthuocsxh', 'gdthuocsxh15t', 'bi', 'ci', 'cachidiem', 'dietlangquang', 'giamsattheodoi', 'xulyonho', 'cathuphat', 'odichmoi', 'odichcu', 'odichcu_xuly', 'xuly', 'xuly_ngay', 'xuatvien', 'xacdinh', 'pxkhac', 'xmcabenh', 'kdc_pxk', 'kdc_qhk', 'kdc_tk', 'cdc_kbn_pxk', 'cdc_kbn_qhk', 'cdc_kbn_tk', 'cdc_cbn_sxh', 'cdc_cbn_ksxh', 'ma_phuong'], 'integer'],
            [['ngaybaocao', 'ngaynhanthongbao', 'ngaynhapvien', 'ngaysinh', 'dt', 'ngaydieutra', 'ngaymacbenh', 'ngayxuatvien', 'tk_namsxh', 'tk_thangsxh', 'geom', 'loai_dich', 'geom_txt'], 'string'],
            [['geo_x', 'geo_y'], 'number'],
            [['hoten'], 'string', 'max' => 150],
            [['dienthoai'], 'string', 'max' => 15],
            [['dienthoai1', 'sonha1', 'duong1', 'to1', 'khupho1', 'shs', 'tbenh', 'vitri1', 'me', 'phai', 'maso', 'sonha2', 'duong2', 'to2', 'khupho2', 'tinh2', 'px2', 'dienthoai3', 'sonha3', 'duong3', 'to3', 'khupho3', 'tinh3', 'duongkhac', 'tokhac', 'khuphokhac', 'tinhkhac', 'qhkhac', 'songuoicutru', 'cutruduoi15', 'tpbv_bv', 'nhapvien_bv', 'nghenghiep', 'dclamviec', 'dienthoai2', 'noikhac_ghichu', 'gdsonguoisxh', 'gdthuocsxhsonguoi', 'tenbenhkhac', 'nguoidieutra'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'macabenh' => Yii::t('app', 'Macabenh'),
            'mabenhvien' => Yii::t('app', 'Mabenhvien'),
            'hoten' => Yii::t('app', 'Hoten'),
            'tuoi' => Yii::t('app', 'Tuoi'),
            'dienthoai' => Yii::t('app', 'Dienthoai'),
            'ngaybaocao' => Yii::t('app', 'Ngày báo cáo'),
            'ngaynhanthongbao' => Yii::t('app', 'Ngaynhanthongbao'),
            'ngaynhapvien' => Yii::t('app', 'Ngaynhapvien'),
            'diachi1' => Yii::t('app', 'Diachi1'),
            'ngaysinh' => Yii::t('app', 'Ngaysinh'),
            'benhnhan1' => Yii::t('app', 'Benhnhan1'),
            'dienthoai1' => Yii::t('app', 'Dienthoai1'),
            'sonha1' => Yii::t('app', 'Sonha1'),
            'duong1' => Yii::t('app', 'Duong1'),
            'to1' => Yii::t('app', 'To1'),
            'khupho1' => Yii::t('app', 'Khupho1'),
            'qh1' => Yii::t('app', 'Qh1'),
            'px1' => Yii::t('app', 'Px1'),
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
            'ngaydieutra' => Yii::t('app', 'Ngaydieutra'),
            'diachi2' => Yii::t('app', 'Diachi2'),
            'maso' => Yii::t('app', 'Maso'),
            'ma_dt_sxh' => Yii::t('app', 'Ma Dt Sxh'),
            'sonha2' => Yii::t('app', 'Sonha2'),
            'duong2' => Yii::t('app', 'Duong2'),
            'to2' => Yii::t('app', 'To2'),
            'khupho2' => Yii::t('app', 'Khupho2'),
            'tinh2' => Yii::t('app', 'Tinh2'),
            'qh2' => Yii::t('app', 'Qh2'),
            'px2' => Yii::t('app', 'Px2'),
            'diachi3' => Yii::t('app', 'Diachi3'),
            'benhnhan2' => Yii::t('app', 'Benhnhan2'),
            'benhnhan3' => Yii::t('app', 'Benhnhan3'),
            'dienthoai3' => Yii::t('app', 'Dienthoai3'),
            'sonha3' => Yii::t('app', 'Sonha3'),
            'duong3' => Yii::t('app', 'Duong3'),
            'to3' => Yii::t('app', 'To3'),
            'khupho3' => Yii::t('app', 'Khupho3'),
            'tinh3' => Yii::t('app', 'Tinh3'),
            'qh3' => Yii::t('app', 'Qh3'),
            'benhnoikhac' => Yii::t('app', 'Benhnoikhac'),
            'px3' => Yii::t('app', 'Px3'),
            'sonhakhac' => Yii::t('app', 'Sonhakhac'),
            'duongkhac' => Yii::t('app', 'Duongkhac'),
            'tokhac' => Yii::t('app', 'Tokhac'),
            'khuphokhac' => Yii::t('app', 'Khuphokhac'),
            'tinhkhac' => Yii::t('app', 'Tinhkhac'),
            'qhkhac' => Yii::t('app', 'Qhkhac'),
            'songuoicutru' => Yii::t('app', 'Songuoicutru'),
            'cutruduoi15' => Yii::t('app', 'Cutruduoi15'),
            'tpbv' => Yii::t('app', 'Tpbv'),
            'tpbv_bv' => Yii::t('app', 'Tpbv Bv'),
            'phcd' => Yii::t('app', 'Phcd'),
            'nhapvien' => Yii::t('app', 'Nhapvien'),
            'nhapvien_bv' => Yii::t('app', 'Nhapvien Bv'),
            'nghenghiep' => Yii::t('app', 'Nghenghiep'),
            'ngaymacbenh' => Yii::t('app', 'Ngaymacbenh'),
            'dclamviec' => Yii::t('app', 'Dclamviec'),
            'dclamviecqh' => Yii::t('app', 'Dclamviecqh'),
            'dclamviecpx' => Yii::t('app', 'Dclamviecpx'),
            'noilamviec_sxh' => Yii::t('app', 'Noilamviec Sxh'),
            'nhaconguoibenh' => Yii::t('app', 'Nhaconguoibenh'),
            'dienthoai2' => Yii::t('app', 'Dienthoai2'),
            'nhacobnsxh' => Yii::t('app', 'Nhacobnsxh'),
            'bvpk' => Yii::t('app', 'Bvpk'),
            'nhatho' => Yii::t('app', 'Nhatho'),
            'dinh' => Yii::t('app', 'Dinh'),
            'chua' => Yii::t('app', 'Chua'),
            'congvien' => Yii::t('app', 'Congvien'),
            'noihoihop' => Yii::t('app', 'Noihoihop'),
            'noixd' => Yii::t('app', 'Noixd'),
            'cafe' => Yii::t('app', 'Cafe'),
            'noichannuoi' => Yii::t('app', 'Noichannuoi'),
            'noibancay' => Yii::t('app', 'Noibancay'),
            'vuaphelieu' => Yii::t('app', 'Vuaphelieu'),
            'noikhac' => Yii::t('app', 'Noikhac'),
            'noikhac_ghichu' => Yii::t('app', 'Noikhac Ghichu'),
            'diemden_px' => Yii::t('app', 'Diemden Px'),
            'diemden_pxkhac' => Yii::t('app', 'Diemden Pxkhac'),
            'diemden_qhkhac' => Yii::t('app', 'Diemden Qhkhac'),
            'gdcosxh' => Yii::t('app', 'Gdcosxh'),
            'gdsonguoisxh' => Yii::t('app', 'Gdsonguoisxh'),
            'gdso15t' => Yii::t('app', 'Gdso15t'),
            'gdthuocsxh' => Yii::t('app', 'Gdthuocsxh'),
            'gdthuocsxhsonguoi' => Yii::t('app', 'Gdthuocsxhsonguoi'),
            'gdthuocsxh15t' => Yii::t('app', 'Gdthuocsxh15t'),
            'bi' => Yii::t('app', 'Bi'),
            'ci' => Yii::t('app', 'Ci'),
            'cachidiem' => Yii::t('app', 'Cachidiem'),
            'dietlangquang' => Yii::t('app', 'Dietlangquang'),
            'giamsattheodoi' => Yii::t('app', 'Giamsattheodoi'),
            'xulyonho' => Yii::t('app', 'Xulyonho'),
            'cathuphat' => Yii::t('app', 'Cathuphat'),
            'odichmoi' => Yii::t('app', 'Odichmoi'),
            'odichcu' => Yii::t('app', 'Odichcu'),
            'odichcu_xuly' => Yii::t('app', 'Odichcu Xuly'),
            'xuly' => Yii::t('app', 'Xuly'),
            'xuly_ngay' => Yii::t('app', 'Xuly Ngay'),
            'xuatvien' => Yii::t('app', 'Xuatvien'),
            'xacdinh' => Yii::t('app', 'Xacdinh'),
            'tenbenhkhac' => Yii::t('app', 'Tenbenhkhac'),
            'nguoidieutra' => Yii::t('app', 'Nguoidieutra'),
            'ngayxuatvien' => Yii::t('app', 'Ngayxuatvien'),
            'pxkhac' => Yii::t('app', 'Pxkhac'),
            'xmcabenh' => Yii::t('app', 'Xmcabenh'),
            'kdc_pxk' => Yii::t('app', 'Kdc Pxk'),
            'kdc_qhk' => Yii::t('app', 'Kdc Qhk'),
            'kdc_tk' => Yii::t('app', 'Kdc Tk'),
            'cdc_kbn_pxk' => Yii::t('app', 'Cdc Kbn Pxk'),
            'cdc_kbn_qhk' => Yii::t('app', 'Cdc Kbn Qhk'),
            'cdc_kbn_tk' => Yii::t('app', 'Cdc Kbn Tk'),
            'cdc_cbn_sxh' => Yii::t('app', 'Cdc Cbn Sxh'),
            'cdc_cbn_ksxh' => Yii::t('app', 'Cdc Cbn Ksxh'),
            'tk_namsxh' => Yii::t('app', 'Tk Namsxh'),
            'tk_thangsxh' => Yii::t('app', 'Tk Thangsxh'),
            'geom' => Yii::t('app', 'Geom'),
            'loai_dich' => Yii::t('app', 'Loai Dich'),
            'geo_x' => Yii::t('app', 'Geo X'),
            'geo_y' => Yii::t('app', 'Geo Y'),
            'geom_txt' => Yii::t('app', 'Geom Txt'),
            'ma_phuong' => Yii::t('app', 'Ma Phuong'),
        ];
    }
}

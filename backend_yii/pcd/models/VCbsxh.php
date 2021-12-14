<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "v_cbsxh".
 *
 * @property integer $macabenh
 * @property integer $ma_dt_sxh
 * @property string $hoten
 * @property string $phai
 * @property string $ngaysinh
 * @property integer $tuoi
 * @property string $me
 * @property string $maso
 * @property string $ma_icd
 * @property string $shs
 * @property string $chuandoanbd
 * @property string $ngaybaocao
 * @property string $ngaynhanthongbao
 * @property string $ngaymacbenh
 * @property string $ngaynhapvien
 * @property string $ngayxuatvien
 * @property string $ngaymacbenh_nv
 * @property integer $songaybenh
 * @property integer $ma_quan
 * @property integer $ma_phuong
 * @property string $ten_quan
 * @property string $ten_phuong
 * @property integer $qh1
 * @property integer $px1
 * @property string $sonha1
 * @property string $duong1
 * @property string $to1
 * @property string $khupho1
 * @property integer $tpbv
 * @property string $tpbv_bv
 * @property integer $phcd
 * @property integer $nhapvien
 * @property string $nhapvien_bv
 * @property integer $cdc_cbn_sot
 * @property integer $cdc_cbn_benhkhac
 * @property integer $cdc_cbn_sxh
 * @property integer $cdc_kbn_tk
 * @property integer $cdc_kbn_qhk
 * @property integer $cdc_kbn_pxk
 * @property double $lat
 * @property double $lng
 * @property string $geom
 * @property integer $cathuphat
 * @property integer $xmcabenh
 */
class VCbsxh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_cbsxh';
    }

    public static function primaryKey()
    {
        return ['macabenh'];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['macabenh', 'ma_dt_sxh', 'tuoi', 'songaybenh', 'ma_quan', 'ma_phuong', 'qh1', 'px1', 'tpbv', 'phcd', 'nhapvien', 'cdc_cbn_sot', 'cdc_cbn_benhkhac', 'cdc_cbn_sxh', 'cdc_kbn_tk', 'cdc_kbn_qhk', 'cdc_kbn_pxk', 'cathuphat', 'xmcabenh'], 'integer'],
            [['ngaysinh', 'ngaybaocao', 'ngaynhanthongbao', 'ngaymacbenh', 'ngaynhapvien', 'ngayxuatvien', 'ngaymacbenh_nv'], 'safe'],
            [['lat', 'lng'], 'number'],
            [['geom'], 'string'],
            [['hoten'], 'string', 'max' => 150],
            [['phai', 'me', 'maso', 'shs', 'chuandoanbd', 'sonha1', 'duong1', 'to1', 'khupho1', 'tpbv_bv', 'nhapvien_bv'], 'string', 'max' => 255],
            [['ma_icd'], 'string', 'max' => 15],
            [['ten_quan'], 'string', 'max' => 20],
            [['ten_phuong'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'macabenh' => Yii::t('app', 'Macabenh'),
            'ma_dt_sxh' => Yii::t('app', 'Ma Dt Sxh'),
            'hoten' => Yii::t('app', 'Hoten'),
            'phai' => Yii::t('app', 'Phai'),
            'ngaysinh' => Yii::t('app', 'Ngaysinh'),
            'tuoi' => Yii::t('app', 'Tuoi'),
            'me' => Yii::t('app', 'Me'),
            'maso' => Yii::t('app', 'Maso'),
            'ma_icd' => Yii::t('app', 'Ma Icd'),
            'shs' => Yii::t('app', 'Shs'),
            'chuandoanbd' => Yii::t('app', 'Chuandoanbd'),
            'ngaybaocao' => Yii::t('app', 'Ngày báo cáo'),
            'ngaynhanthongbao' => Yii::t('app', 'Ngaynhanthongbao'),
            'ngaymacbenh' => Yii::t('app', 'Ngaymacbenh'),
            'ngaynhapvien' => Yii::t('app', 'Ngaynhapvien'),
            'ngayxuatvien' => Yii::t('app', 'Ngayxuatvien'),
            'ngaymacbenh_nv' => Yii::t('app', 'Ngaymacbenh Nv'),
            'songaybenh' => Yii::t('app', 'Songaybenh'),
            'ma_quan' => Yii::t('app', 'Ma Quan'),
            'ma_phuong' => Yii::t('app', 'Ma Phuong'),
            'ten_quan' => Yii::t('app', 'Ten Quan'),
            'ten_phuong' => Yii::t('app', 'Ten Phuong'),
            'qh1' => Yii::t('app', 'Qh1'),
            'px1' => Yii::t('app', 'Px1'),
            'sonha1' => Yii::t('app', 'Sonha1'),
            'duong1' => Yii::t('app', 'Duong1'),
            'to1' => Yii::t('app', 'To1'),
            'khupho1' => Yii::t('app', 'Khupho1'),
            'tpbv' => Yii::t('app', 'Tpbv'),
            'tpbv_bv' => Yii::t('app', 'Tpbv Bv'),
            'phcd' => Yii::t('app', 'Phcd'),
            'nhapvien' => Yii::t('app', 'Nhapvien'),
            'nhapvien_bv' => Yii::t('app', 'Nhapvien Bv'),
            'cdc_cbn_sot' => Yii::t('app', 'Cdc Cbn Sot'),
            'cdc_cbn_benhkhac' => Yii::t('app', 'Cdc Cbn Benhkhac'),
            'cdc_cbn_sxh' => Yii::t('app', 'Cdc Cbn Sxh'),
            'cdc_kbn_tk' => Yii::t('app', 'Cdc Kbn Tk'),
            'cdc_kbn_qhk' => Yii::t('app', 'Cdc Kbn Qhk'),
            'cdc_kbn_pxk' => Yii::t('app', 'Cdc Kbn Pxk'),
            'lat' => Yii::t('app', 'Lat'),
            'lng' => Yii::t('app', 'Lng'),
            'geom' => Yii::t('app', 'Geom'),
            'cathuphat' => Yii::t('app', 'Cathuphat'),
            'xmcabenh' => Yii::t('app', 'Xmcabenh'),
        ];
    }

    /**
     * @inheritdoc
     * @return VCbsxhQuery the active query used by this AR class.
     */
//    public static function find()
//    {
//        return new SXHQuery(get_called_class());
//    }
}

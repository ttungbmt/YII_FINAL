<?php

namespace pcd\models;

use pcd\models\App;
use Yii;

/**
 * This is the model class for table "dieutra_sxh".
 *
 * @property int $id
 * @property int $cabenh_id
 * @property string $maso
 * @property string $ngaydieutra
 * @property int $benhnoikhac
 * @property int $sonhakhac
 * @property string $duongkhac
 * @property string $tokhac
 * @property string $khuphokhac
 * @property string $tinhkhac
 * @property string $tinhnoikhac
 * @property string $qhkhac
 * @property int $pxkhac
 * @property string $songuoicutru
 * @property string $cutruduoi15
 * @property int $tpbv
 * @property string $tpbv_bv
 * @property int $phcd
 * @property int $nhapvien
 * @property string $nhapvien_bv
 * @property int $xetnghiem
 * @property string $ngaylaymau
 * @property int $loai_xn
 * @property int $ketqua_xn
 * @property string $dclamviec
 * @property string $dclamviec_tinh
 * @property string $dclamviec_tinh_mota
 * @property int $dclamviecqh
 * @property int $dclamviecpx
 * @property int $noilamviec_sxh
 * @property int $nhacobnsxh
 * @property int $nhaconguoibenh
 * @property int $bvpk
 * @property int $nhatho
 * @property int $dinh
 * @property int $chua
 * @property int $congvien
 * @property int $noihoihop
 * @property int $noixd
 * @property int $cafe
 * @property int $noichannuoi
 * @property int $noibancay
 * @property int $vuaphelieu
 * @property int $noikhac
 * @property string $noikhac_ghichu
 * @property int $diemden_px
 * @property int $diemden_pxkhac
 * @property int $diemden_qhkhac
 * @property int $gdcosxh
 * @property string $gdsonguoisxh
 * @property int $gdso15t
 * @property int $gdthuocsxh
 * @property string $gdthuocsxhsonguoi
 * @property int $gdthuocsxh15t
 * @property int $bi
 * @property int $ci
 * @property int $cachidiem
 * @property int $dietlangquang
 * @property int $giamsattheodoi
 * @property int $xulyonho
 * @property int $cathuphat
 * @property int $odichmoi
 * @property int $odichcu
 * @property int $odichcu_xuly
 * @property int $xuly
 * @property int $xuly_ngay
 * @property int $xuatvien
 * @property int $xmcabenh
 * @property string $nguoidieutra
 * @property string $nguoidieutra_sdt
 */
class DieutraSxh extends App
{
    public $dates = [
        'ngaydieutra',
        'ngaylaymau',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dieutra_sxh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cabenh_id', 'benhnoikhac', 'sonhakhac', 'pxkhac', 'tpbv', 'phcd', 'nhapvien', 'xetnghiem', 'loai_xn', 'ketqua_xn', 'dclamviecqh', 'dclamviecpx', 'noilamviec_sxh', 'nhacobnsxh', 'nhaconguoibenh', 'bvpk', 'nhatho', 'dinh', 'chua', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu', 'noikhac', 'diemden_px', 'diemden_pxkhac', 'diemden_qhkhac', 'gdcosxh', 'gdso15t', 'gdthuocsxh', 'gdthuocsxh15t', 'bi', 'ci', 'cachidiem', 'dietlangquang', 'giamsattheodoi', 'xulyonho', 'xulyorong', 'cathuphat', 'odichmoi', 'odichcu', 'odichcu_xuly', 'xuly', 'xuly_ngay', 'xuatvien', 'xmcabenh'], 'default', 'value' => null],
            [['cabenh_id', 'benhnoikhac', 'sonhakhac', 'pxkhac', 'tpbv', 'phcd', 'nhapvien', 'xetnghiem', 'loai_xn', 'ketqua_xn', 'dclamviecqh', 'dclamviecpx', 'noilamviec_sxh', 'nhacobnsxh', 'nhaconguoibenh', 'bvpk', 'nhatho', 'dinh', 'chua', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu', 'noikhac', 'diemden_px', 'diemden_pxkhac', 'diemden_qhkhac', 'gdcosxh', 'gdso15t', 'gdthuocsxh', 'gdthuocsxh15t', 'bi', 'ci', 'cachidiem', 'dietlangquang', 'giamsattheodoi', 'xulyonho', 'xulyorong', 'cathuphat', 'odichmoi', 'odichcu', 'odichcu_xuly', 'xuly', 'xuly_ngay', 'xuatvien', 'xmcabenh'], 'integer'],
            [['ngaydieutra', 'ngaylaymau', 'nguoidieutra_sdt'], 'safe'],
            [['tinhnoikhac', 'dclamviec_tinh_mota'], 'string'],
            [['maso', 'duongkhac', 'tokhac', 'khuphokhac', 'tinhkhac', 'qhkhac', 'songuoicutru', 'cutruduoi15', 'tpbv_bv', 'nhapvien_bv', 'dclamviec', 'dclamviec_tinh', 'noikhac_ghichu', 'gdsonguoisxh', 'gdthuocsxhsonguoi', 'nguoidieutra'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cabenh_id' => 'Cabenh ID',
            'maso' => 'Maso',
            'ngaydieutra' => 'Ngaydieutra',
            'benhnoikhac' => 'Benhnoikhac',
            'sonhakhac' => 'Sonhakhac',
            'duongkhac' => 'Duongkhac',
            'tokhac' => 'Tokhac',
            'khuphokhac' => 'Khuphokhac',
            'tinhkhac' => 'Tinhkhac',
            'tinhnoikhac' => 'Tinhnoikhac',
            'qhkhac' => 'Qhkhac',
            'pxkhac' => 'Pxkhac',
            'songuoicutru' => 'Songuoicutru',
            'cutruduoi15' => 'Cutruduoi15',
            'tpbv' => 'Tpbv',
            'tpbv_bv' => 'Tpbv Bv',
            'phcd' => 'Phcd',
            'nhapvien' => 'Nhapvien',
            'nhapvien_bv' => 'Nhapvien Bv',
            'xetnghiem' => 'Xetnghiem',
            'ngaylaymau' => 'Ngaylaymau',
            'loai_xn' => 'Loai Xn',
            'ketqua_xn' => 'Ketqua Xn',
            'dclamviec' => 'Dclamviec',
            'dclamviec_tinh' => 'Dclamviec Tinh',
            'dclamviec_tinh_mota' => 'Dclamviec Tinh Mota',
            'dclamviecqh' => 'Dclamviecqh',
            'dclamviecpx' => 'Dclamviecpx',
            'noilamviec_sxh' => 'Noilamviec Sxh',
            'nhacobnsxh' => 'Nhacobnsxh',
            'nhaconguoibenh' => 'Nhaconguoibenh',
            'bvpk' => 'Bvpk',
            'nhatho' => 'Nhatho',
            'dinh' => 'Dinh',
            'chua' => 'Chua',
            'congvien' => 'Congvien',
            'noihoihop' => 'Noihoihop',
            'noixd' => 'Noixd',
            'cafe' => 'Cafe',
            'noichannuoi' => 'Noichannuoi',
            'noibancay' => 'Noibancay',
            'vuaphelieu' => 'Vuaphelieu',
            'noikhac' => 'Noikhac',
            'noikhac_ghichu' => 'Noikhac Ghichu',
            'diemden_px' => 'Diemden Px',
            'diemden_pxkhac' => 'Diemden Pxkhac',
            'diemden_qhkhac' => 'Diemden Qhkhac',
            'gdcosxh' => 'Gdcosxh',
            'gdsonguoisxh' => 'Gdsonguoisxh',
            'gdso15t' => 'Gdso15t',
            'gdthuocsxh' => 'Gdthuocsxh',
            'gdthuocsxhsonguoi' => 'Gdthuocsxhsonguoi',
            'gdthuocsxh15t' => 'Gdthuocsxh15t',
            'bi' => 'Bi',
            'ci' => 'Ci',
            'cachidiem' => 'Cachidiem',
            'dietlangquang' => 'Dietlangquang',
            'giamsattheodoi' => 'Giamsattheodoi',
            'xulyonho' => 'Xulyonho',
            'cathuphat' => 'Cathuphat',
            'odichmoi' => 'Odichmoi',
            'odichcu' => 'Odichcu',
            'odichcu_xuly' => 'Odichcu Xuly',
            'xuly' => 'Xuly',
            'xuly_ngay' => 'Xuly Ngay',
            'xuatvien' => 'Xuatvien',
            'xmcabenh' => 'Xmcabenh',
            'nguoidieutra' => 'Nguoidieutra',
            'nguoidieutra_sdt' => 'Số điện thoại',
        ];
    }

    public function getCabenhSxh(){
        return $this->hasOne(CabenhSxh::className(), ['gid' =>  'cabenh_id']);
    }
}

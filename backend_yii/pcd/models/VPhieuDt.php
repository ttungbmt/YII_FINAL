<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "v_phieu_dt".
 *
 * @property int $gid
 * @property int $loaidieutra
 * @property int $loaicabenh
 * @property int $chuyenca
 * @property int $loaibaocao
 * @property string $chuandoan_bd
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
 * @property string $tinh
 * @property string $tinh_dc_khac
 * @property string $ht_dieutri
 * @property string $loaixacminh_cb
 * @property string $chuandoan
 * @property string $chuandoan_khac
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
 * @property int $songaybenh
 * @property int $loai_xm_cb
 */
class VPhieuDt extends CabenhSxh
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_phieu_dt';
    }

    public static function primaryKey()
    {
        return ['gid'];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gid', 'loaidieutra', 'loaicabenh', 'chuyenca', 'loaibaocao', 'cabenh_id', 'benhnoikhac', 'sonhakhac', 'pxkhac', 'tpbv', 'phcd', 'nhapvien', 'xetnghiem', 'loai_xn', 'ketqua_xn', 'dclamviecqh', 'dclamviecpx', 'noilamviec_sxh', 'nhacobnsxh', 'nhaconguoibenh', 'bvpk', 'nhatho', 'dinh', 'chua', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu', 'noikhac', 'diemden_px', 'diemden_pxkhac', 'diemden_qhkhac', 'gdcosxh', 'gdso15t', 'gdthuocsxh', 'gdthuocsxh15t', 'bi', 'ci', 'cachidiem', 'dietlangquang', 'giamsattheodoi', 'xulyonho', 'cathuphat', 'odichmoi', 'odichcu', 'odichcu_xuly', 'xuly', 'xuly_ngay', 'xuatvien', 'xmcabenh', 'songaybenh'], 'default', 'value' => null],
            [['loai_xm_cb', 'gid', 'loaidieutra', 'loaicabenh', 'chuyenca', 'loaibaocao', 'cabenh_id', 'benhnoikhac', 'sonhakhac', 'pxkhac', 'tpbv', 'phcd', 'nhapvien', 'xetnghiem', 'loai_xn', 'ketqua_xn', 'dclamviecqh', 'dclamviecpx', 'noilamviec_sxh', 'nhacobnsxh', 'nhaconguoibenh', 'bvpk', 'nhatho', 'dinh', 'chua', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu', 'noikhac', 'diemden_px', 'diemden_pxkhac', 'diemden_qhkhac', 'gdcosxh', 'gdso15t', 'gdthuocsxh', 'gdthuocsxh15t', 'bi', 'ci', 'cachidiem', 'dietlangquang', 'giamsattheodoi', 'xulyonho', 'cathuphat', 'odichmoi', 'odichcu', 'odichcu_xuly', 'xuly', 'xuly_ngay', 'xuatvien', 'xmcabenh', 'songaybenh'], 'integer'],
            [['ngaysinh', 'ngaybaocao', 'ngaynhanthongbao', 'ngaymacbenh', 'ngaynhapvien', 'ngayxuatvien', 'ngaymacbenh_nv', 'ngaydieutra', 'ngaylaymau'], 'safe'],
            [['tinhnoikhac', 'dclamviec_tinh_mota'], 'string'],
            [['chuandoan_bd', 'chuandoan_bd_khac', 'ma_icd', 'maphuong', 'maquan', 'hoten', 'tuoi', 'phai', 'benhvien', 'nghenghiep', 'shs', 'vitri', 'me', 'dienthoai', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc', 'sonha', 'duong', 'to_dp', 'khupho', 'px', 'qh', 'tinh', 'tinh_dc_khac', 'ht_dieutri', 'chuandoan_khac', 'maso', 'duongkhac', 'tokhac', 'khuphokhac', 'tinhkhac', 'qhkhac', 'songuoicutru', 'cutruduoi15', 'tpbv_bv', 'nhapvien_bv', 'dclamviec', 'dclamviec_tinh', 'noikhac_ghichu', 'gdsonguoisxh', 'gdthuocsxhsonguoi', 'nguoidieutra'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gid' => 'Gid',
            'loaidieutra' => 'Loaidieutra',
            'loaicabenh' => 'Loaicabenh',
            'chuyenca' => 'Chuyenca',
            'loaibaocao' => 'Loaibaocao',
            'chuandoan_bd' => 'Chuandoan Bd',
            'chuandoan_bd_khac' => 'Chuandoan Bd Khac',
            'ma_icd' => 'Ma Icd',
            'maphuong' => 'Maphuong',
            'maquan' => 'Maquan',
            'hoten' => 'Hoten',
            'tuoi' => 'Tuoi',
            'phai' => 'Phai',
            'ngaysinh' => 'Ngaysinh',
            'benhvien' => 'Benhvien',
            'ngaybaocao' => 'Ngaybaocao',
            'ngaynhanthongbao' => 'Ngaynhanthongbao',
            'ngaymacbenh' => 'Ngaymacbenh',
            'ngaynhapvien' => 'Ngaynhapvien',
            'ngayxuatvien' => 'Ngayxuatvien',
            'ngaymacbenh_nv' => 'Ngaymacbenh Nv',
            'nghenghiep' => 'Nghenghiep',
            'shs' => 'Shs',
            'vitri' => 'Vitri',
            'me' => 'Me',
            'dienthoai' => 'Dienthoai',
            'geom' => 'Geom',
            'nam_nv' => 'Nam Nv',
            'thang_nv' => 'Thang Nv',
            'tuan_nv' => 'Tuan Nv',
            'nam_bc' => 'Nam Bc',
            'thang_bc' => 'Thang Bc',
            'tuan_bc' => 'Tuan Bc',
            'sonha' => 'Sonha',
            'duong' => 'Duong',
            'to_dp' => 'To Dp',
            'khupho' => 'Khupho',
            'px' => 'Px',
            'qh' => 'Qh',
            'ht_dieutri' => 'Ht Dieutri',
            'chuandoan' => 'Chuandoan',
            'chuandoan_khac' => 'Chuandoan Khac',
            'xetnghiem' => 'Xetnghiem',
            'ngaylaymau' => 'Ngaylaymau',
            'loai_xn' => 'Loai Xn',
            'ketqua_xn' => 'Ketqua Xn',
            'cabenh_id' => 'Cabenh ID',
            'maso' => 'Maso',
            'ngaydieutra' => 'Ngaydieutra',
            'diachi1' => 'Diachi1',
            'benhnhan1' => 'Benhnhan1',
            'dienthoai1' => 'Dienthoai1',
            'sonha1' => 'Sonha1',
            'duong1' => 'Duong1',
            'to1' => 'To1',
            'khupho1' => 'Khupho1',
            'qh1' => 'Qh1',
            'px1' => 'Px1',
            'diachi2' => 'Diachi2',
            'benhnhan2' => 'Benhnhan2',
            'dienthoai2' => 'Dienthoai2',
            'sonha2' => 'Sonha2',
            'duong2' => 'Duong2',
            'to2' => 'To2',
            'khupho2' => 'Khupho2',
            'tinh2' => 'Tinh2',
            'tinhkhac2' => 'Tinhkhac2',
            'qh2' => 'Qh2',
            'px2' => 'Px2',
            'diachi3' => 'Diachi3',
            'benhnhan3' => 'Benhnhan3',
            'dienthoai3' => 'Dienthoai3',
            'sonha3' => 'Sonha3',
            'duong3' => 'Duong3',
            'to3' => 'To3',
            'khupho3' => 'Khupho3',
            'tinh3' => 'Tinh3',
            'tinhkhac3' => 'Tinhkhac3',
            'qh3' => 'Qh3',
            'px3' => 'Px3',
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
            'songaybenh' => 'Songaybenh',
        ];
    }
}

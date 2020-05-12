<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "cabenh".
 *
 * @property int    $macabenh
 * @property int    $ma_dtcm
 * @property string $ma_icd
 * @property int    $ma_dsxh
 * @property int    $mabenhvien
 * @property string $tencabenh
 * @property string $sohoso
 * @property string $hoten       Họ tên
 * @property int    $gioitinh
 * @property int    $tuoi
 * @property string $hotennguoithan
 * @property string $dienthoai
 * @property string $ngaybaocao
 * @property string $ngaynhanthongbao
 * @property string $ngaymacbenh
 * @property string $ngaynhapvien
 * @property string $ngayxuatvien
 * @property string $ketquaxetnghiem
 * @property int    $dihoc
 * @property string $tentruong
 * @property string $cdravien
 * @property string $chuandoan
 * @property string $sonha
 * @property string $tenduong
 * @property string $tenphuong
 * @property string $tenquan
 * @property string $todanpho
 * @property int    $tinh        tỉnh
 * @property string $khupho
 * @property int    $thuongtru
 * @property int    $cobenhnhan
 * @property int    $codiachi
 * @property string $diachinoikhac
 * @property int    $tiemdu      tiêm đủ
 * @property int    $tiemchung   tiêm chủng
 * @property int    $tinhtrangxuatvien
 * @property string $ngaynhaplieu
 * @property string $ghichu
 * @property string $geom
 * @property int    $ma_phuong
 * @property string $loai_dich
 * @property string $benhvien
 * @property int    $xacminhdiachi
 * @property string $motadiachi
 * @property int    $id_vungdich
 * @property string $ngaycapnhat
 * @property string $diachi
 * @property string $nghenghiep
 * @property int    $ma_quan
 * @property string $ngaysinh
 * @property int    $diachi1
 * @property int    $benhnhan1
 * @property string $dienthoai1
 * @property string $sonha1
 * @property string $duong1
 * @property string $to1
 * @property string $khupho1
 * @property int    $qh1
 * @property int    $px1
 * @property string $shs
 * @property string $tbenh
 * @property string $vitri1
 * @property string $me
 * @property string $dt
 * @property int    $nam_nv
 * @property int    $thang_nv
 * @property int    $tuan_nv
 * @property int    $nam_bc
 * @property int    $thang_bc
 * @property int    $tuan_bc
 * @property string $phai
 * @property string $tinh1
 * @property int    $chuyenca1
 * @property int    $chuyenca2
 * @property int    $chuyenca_filter
 * @property string $chuandoanbd Chuẩn đoán ban đầu
 * @property int    $odichsxh_id
 * @property int    $loaibc
 * @property string $dclamviec_khac
 * @property int    $cb_sxh
 * @property string $created_at
 * @property string $updated_at
 * @property int    $created_by
 * @property int    $updated_by
 */
class Cabenh extends App
{
    public $dates = ['ngaynhapvien', 'ngaymacbenh'];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cabenh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_dtcm', 'ma_dsxh', 'mabenhvien', 'gioitinh', 'tuoi', 'dihoc', 'tinh', 'thuongtru', 'cobenhnhan', 'codiachi', 'tiemdu', 'tiemchung', 'tinhtrangxuatvien', 'ma_phuong', 'xacminhdiachi', 'id_vungdich', 'ma_quan', 'diachi1', 'benhnhan1', 'qh1', 'px1', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc', 'chuyenca1', 'chuyenca2', 'chuyenca_filter', 'odichsxh_id', 'loaibc', 'cb_sxh', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['ma_dtcm', 'ma_dsxh', 'mabenhvien', 'gioitinh', 'tuoi', 'dihoc', 'tinh', 'thuongtru', 'cobenhnhan', 'codiachi', 'tiemdu', 'tiemchung', 'tinhtrangxuatvien', 'ma_phuong', 'xacminhdiachi', 'id_vungdich', 'ma_quan', 'diachi1', 'benhnhan1', 'qh1', 'px1', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc', 'chuyenca1', 'chuyenca2', 'chuyenca_filter', 'odichsxh_id', 'loaibc', 'cb_sxh', 'created_by', 'updated_by'], 'integer'],
            [['ngaybaocao', 'ngaynhanthongbao', 'ngaymacbenh', 'ngaynhapvien', 'ngayxuatvien', 'ngaynhaplieu', 'ngaysinh', 'created_at', 'updated_at'], 'safe'],
            [['diachinoikhac', 'ghichu', 'geom', 'loai_dich', 'benhvien', 'motadiachi', 'diachi', 'dt', 'dclamviec_khac'], 'string'],
            [['ngaycapnhat'], 'number'],
            [['ma_icd', 'dienthoai'], 'string', 'max' => 15],
            [['tencabenh', 'hoten', 'hotennguoithan', 'ketquaxetnghiem', 'tenduong', 'tenphuong', 'tenquan'], 'string', 'max' => 150],
            [['sohoso'], 'string', 'max' => 20],
            [['tentruong'], 'string', 'max' => 200],
            [['cdravien', 'chuandoan', 'sonha', 'khupho'], 'string', 'max' => 50],
            [['todanpho'], 'string', 'max' => 10],
            [['nghenghiep', 'dienthoai1', 'sonha1', 'duong1', 'to1', 'khupho1', 'shs', 'tbenh', 'vitri1', 'me', 'phai', 'tinh1', 'chuandoanbd'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'macabenh'          => 'Macabenh',
            'ma_dtcm'           => 'Ma Dtcm',
            'ma_icd'            => 'Ma Icd',
            'ma_dsxh'           => 'Ma Dsxh',
            'mabenhvien'        => 'Mabenhvien',
            'tencabenh'         => 'Tencabenh',
            'sohoso'            => 'Sohoso',
            'hoten'             => 'Họ tên',
            'gioitinh'          => 'Gioitinh',
            'tuoi'              => 'Tuoi',
            'hotennguoithan'    => 'Hotennguoithan',
            'dienthoai'         => 'Dienthoai',
            'ngaybaocao'        => 'Ngaybaocao',
            'ngaynhanthongbao'  => 'Ngaynhanthongbao',
            'ngaymacbenh'       => 'Ngaymacbenh',
            'ngaynhapvien'      => 'Ngaynhapvien',
            'ngayxuatvien'      => 'Ngayxuatvien',
            'ketquaxetnghiem'   => 'Ketquaxetnghiem',
            'dihoc'             => 'Dihoc',
            'tentruong'         => 'Tentruong',
            'cdravien'          => 'Cdravien',
            'chuandoan'         => 'Chuandoan',
            'sonha'             => 'Sonha',
            'tenduong'          => 'Tenduong',
            'tenphuong'         => 'Tenphuong',
            'tenquan'           => 'Tenquan',
            'todanpho'          => 'Todanpho',
            'tinh'              => 'tỉnh',
            'khupho'            => 'Khupho',
            'thuongtru'         => 'Thuongtru',
            'cobenhnhan'        => 'Cobenhnhan',
            'codiachi'          => 'Codiachi',
            'diachinoikhac'     => 'Diachinoikhac',
            'tiemdu'            => 'tiêm đủ',
            'tiemchung'         => 'tiêm chủng',
            'tinhtrangxuatvien' => 'Tinhtrangxuatvien',
            'ngaynhaplieu'      => 'Ngaynhaplieu',
            'ghichu'            => 'Ghichu',
            'geom'              => 'Geom',
            'ma_phuong'         => 'Ma Phuong',
            'loai_dich'         => 'Loai Dich',
            'benhvien'          => 'Benhvien',
            'xacminhdiachi'     => 'Xacminhdiachi',
            'motadiachi'        => 'Motadiachi',
            'id_vungdich'       => 'Id Vungdich',
            'ngaycapnhat'       => 'Ngaycapnhat',
            'diachi'            => 'Diachi',
            'nghenghiep'        => 'Nghenghiep',
            'ma_quan'           => 'Ma Quan',
            'ngaysinh'          => 'Ngaysinh',
            'diachi1'           => 'Diachi1',
            'benhnhan1'         => 'Benhnhan1',
            'dienthoai1'        => 'Dienthoai1',
            'sonha1'            => 'Sonha1',
            'duong1'            => 'Duong1',
            'to1'               => 'To1',
            'khupho1'           => 'Khupho1',
            'qh1'               => 'Qh1',
            'px1'               => 'Px1',
            'shs'               => 'Shs',
            'tbenh'             => 'Tbenh',
            'vitri1'            => 'Vitri1',
            'me'                => 'Me',
            'dt'                => 'Dt',
            'nam_nv'            => 'Nam Nv',
            'thang_nv'          => 'Thang Nv',
            'tuan_nv'           => 'Tuan Nv',
            'nam_bc'            => 'Nam Bc',
            'thang_bc'          => 'Thang Bc',
            'tuan_bc'           => 'Tuan Bc',
            'phai'              => 'Phai',
            'tinh1'             => 'Tinh1',
            'chuyenca1'         => 'Chuyenca1',
            'chuyenca2'         => 'Chuyenca2',
            'chuyenca_filter'   => 'Chuyenca Filter',
            'chuandoanbd'       => 'Chuẩn đoán ban đầu',
            'odichsxh_id'       => 'Odichsxh ID',
            'loaibc'            => 'Loaibc',
            'dclamviec_khac'    => 'Dclamviec Khac',
            'cb_sxh'            => 'Cb Sxh',
            'created_at'        => 'Created At',
            'updated_at'        => 'Updated At',
            'created_by'        => 'Created By',
            'updated_by'        => 'Updated By',
        ];
    }

    public function getHcPhuong()
    {
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'ma_phuong']);
    }

    public function getHcQuan()
    {
        return $this->hasOne(HcQuan::className(), ['maquan' => 'ma_quan']);
    }
}

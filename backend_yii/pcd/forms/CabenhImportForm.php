<?php
namespace pcd\forms;

use common\forms\Form;
use common\modules\auth\models\UserInfo;
use pcd\models\Benhvien;
use pcd\models\HcPhuong;
use pcd\supports\RoleHc;

class CabenhImportForm extends Form
{
    public $stt;
    public $bv;
    public $icd;
    public $t_benh;
    public $shs;
    public $ho_ten;
    public $phai;
    public $tuoi;
    public $dia_chi;
    public $nghe_nghiep;
    public $me;
    public $dt;
    public $qh;
    public $px;
    public $ng_nv;
    public $ng_bc;
    public $nam_nv;
    public $thang_nv;
    public $tuan_nv;
    public $nam_bc;
    public $thang_bc;
    public $tuan_bc;
    public $lat;
    public $lng;

    public function requiredColumns()
    {
        return ['bv', 'icd', 't_benh', 'shs', 'ho_ten', 'phai', 'tuoi', 'dia_chi', 'nghe_nghiep', 'me', 'dt', 'qh', 'px', 'ng_nv', 'ng_bc', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc'];
    }

    public function fields()
    {
        return [
            'stt'          => 'stt',
            'benhvien'     => 'bv',
            'ma_icd'       => 'icd',
            'tenbenh'      => 't_benh',
            'shs'          => 'shs',
            'hoten'        => 'ho_ten',
            'phai'         => 'phai',
            'tuoi'         => 'tuoi',
            'vitri'        => 'dia_chi',
            'nghenghiep'   => 'nghe_nghiep',
            'me'           => 'me',
            'dienthoai'    => 'dt',
            'quanhuyen'    => 'qh',
            'phuongxa'     => 'px',
            'ngaynhapvien' => 'ng_nv',
            'ngaybaocao'   => 'ng_bc',
            'nam_nv'       => 'nam_nv',
            'thang_nv'     => 'thang_nv',
            'tuan_nv'      => 'tuan_nv',
            'nam_bc'       => 'nam_bc',
            'thang_bc'     => 'thang_bc',
            'tuan_bc'      => 'tuan_bc',
            'lat'          => 'lat',
            'lng'          => 'lng',
        ];
    }

    public function rules()
    {
        $dmQp = RoleHc::init()->getDmQp();
        $dmBv = Benhvien::pluck('tenvt')->all();
        return [
            [['stt', 'ho_ten', 'phai', 'dt', 't_benh', 'nghe_nghiep', 'dia_chi', 'icd', 'qh', 'px', 'me', 'bv', 'ng_bc', 'ng_nv', 'tuoi', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc', 'lat', 'lng'], 'safe'],
            [['shs'], 'string'],
            ['qh', 'in', 'range' => $dmQp['quan']],
            ['px', 'in', 'range' => $dmQp['phuong']],
            ['bv', 'in', 'range' => $dmBv],
            [['qh', 'px'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'stt'         => 'STT',
            'bv'          => 'BV',
            'icd'         => 'ICD',
            't_benh'      => 'T_BENH',
            'shs'         => 'SHS',
            'ho_ten'      => 'HO TEN',
            'phai'        => 'PHAI',
            'tuoi'        => 'TUOI',
            'dia_chi'     => 'DIA CHI',
            'nghe_nghiep' => 'NGHE NGHIEP',
            'me'          => 'ME',
            'dt'          => 'DT',
            'qh'          => 'QH',
            'px'          => 'PX',
            'ng_nv'       => 'NG_NV',
            'ng_bc'       => 'NG_BC',
            'nam_nv'      => 'Nam NV',
            'thang_nv'    => 'Thang NV',
            'tuan_nv'     => 'Tuan NV',
            'nam_bc'      => 'Nam BC',
            'thang_bc'    => 'Thang BC',
            'tuan_bc'     => 'Tuan BC',
            'lat'         => 'Lat',
            'lng'         => 'Lng'
        ];
    }

    public function formAttrs()
    {
        return [
            'bv'          => ['label' => 'bv'],
            'icd'         => ['label' => 'icd'],
            't_benh'      => ['label' => 't_benh'],
            'shs'         => ['label' => 'shs'],
            'ho_ten'      => ['label' => 'ho_ten'],
            'phai'        => ['label' => 'phai'],
            'tuoi'        => ['label' => 'tuoi'],
            'dia_chi'     => ['label' => 'dia_chi'],
            'nghe_nghiep' => ['label' => 'nghe_nghiep'],
            'me'          => ['label' => 'me'],
            'dt'          => ['label' => 'dt'],
            'qh'          => ['label' => 'qh'],
            'px'          => ['label' => 'px'],
            'ng_nv'       => ['label' => 'ng_nv'],
            'ng_bc'       => ['label' => 'ng_bc'],
            'nam_nv'      => ['label' => 'nam_nv'],
            'thang_nv'    => ['label' => 'thang_nv'],
            'tuan_nv'     => ['label' => 'tuan_nv'],
            'nam_bc'      => ['label' => 'nam_bc'],
            'thang_bc'    => ['label' => 'thang_bc'],
            'tuan_bc'     => ['label' => 'tuan_bc'],
            'lat'         => ['label' => 'lat'],
            'lng'         => ['label' => 'lng'],
        ];
    }
}
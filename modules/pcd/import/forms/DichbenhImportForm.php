<?php
namespace modules\pcd\import\forms;

use common\models\DynamicImportForm;
use Illuminate\Support\Arr;

class DichbenhImportForm extends DynamicImportForm {
    public $dm_quan;
    public $dm_phuong;

    public function attributeLabels(){
        return [
            'gid' => 'Gid',
            'benhvien' => 'Benhvien',
            'chuandoan_bd' => 'Chuandoan Bd',
            'shs' => 'Shs',
            'hoten' => 'Hoten',
            'phai' => 'Phai',
            'tuoi' => 'Tuoi',
            'diachi' => 'Diachi',
            'nghenghiep' => 'Nghenghiep',
            'me' => 'Me',
            'dienthoai' => 'Dienthoai',
            'maquan' => 'Maquan',
            'maphuong' => 'Maphuong',
            'ngaynhapvien' => 'Ngaynhapvien',
            'ngaybaocao' => 'Ngaybaocao',
            'nam_nv' => 'Nam Nv',
            'thang_nv' => 'Thang Nv',
            'tuan_nv' => 'Tuan Nv',
            'nam_bc' => 'Nam Bc',
            'thang_bc' => 'Thang Bc',
            'tuan_bc' => 'Tuan Bc',
            'hinhthuc_dt' => 'Hinhthuc Dt',
        ];
    }

    public function rules()
    {
        $rules = [
            [['bv', 'icd', 't_benh', 'shs', 'ho_ten', 'phai', 'tuoi', 'dia_chi', 'nghe_nghiep', 'me', 'dt', 'ng_nv', 'ng_bc', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc', 'hinh_thuc_dieu_tri'], 'safe'],
            [['tuoi'], 'integer'],
            [['ng_nv', 'ng_bc'], 'date', 'format' => 'DD/MM/YYYY'],
            [['qh'], 'in', 'range' => Arr::pluck($this->dm_quan, 'tenquan')],
            [['px'], 'in', 'range' => Arr::pluck($this->dm_phuong, 'tenphuong')],
        ];

        return $rules;
    }

    public function fields(){
        $data = collect();

        $f0 = collect([
            'qh' => $this->dm_quan,
            'px' => $this->dm_phuong,
        ])->map(function ($dm, $k){
            return function($model, $field) use($dm, $k){
                $val = $this->arr_where($dm, $field);
                return in_array($k, ['qh', 'px']) ? (string)$val : $val;
            };
        })->all();

        $data->push($f0);

        $data->push([
            'benhvien' => 'bv',
            'icd',
            'chuandoan_bd' => 't_benh',
            'shs',
            'hoten' => 'ho_ten',
            'phai',
            'tuoi',
            'diachi' => 'dia_chi',
            'nghenghiep' => 'nghe_nghiep',
            'me',
            'dienthoai' => 'dt',
            'ngaynhapvien' => 'ng_nv',
            'ngaybaocao' => 'ng_bc',
            'nam_nv',
            'thang_nv',
            'tuan_nv',
            'nam_bc',
            'thang_bc',
            'tuan_bc',
            'hinhthuc_dt' => 'hinh_thuc_dieu_tri',
        ]);

        return $data->collapse()->all();
    }
}
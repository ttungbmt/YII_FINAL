<?php

namespace pcd\modules\import\forms;

use common\models\DynamicImportForm;
use Illuminate\Support\Arr;

class SxhImportForm extends DynamicImportForm {
    public $dm_loaibenh;
    public $dm_quan;
    public $dm_phuong;
    public $dm_bv;

    public function attributeLabels() {
        return [
            'bv'          => 'bv',
            'icd'         => 'icd',
            't_benh'      => 't_benh',
            'shs'         => 'shs',
            'ho_ten'      => 'ho_ten',
            'phai'        => 'phai',
            'tuoi'        => 'tuoi',
            'dia_chi'     => 'dia_chi',
            'nghe_nghiep' => 'nghe_nghiep',
            'me'          => 'me',
            'dt'          => 'dt',
            'qh'          => 'qh',
            'px'          => 'px',
            'ng_nv'       => 'ng_nv',
            'ng_bc'       => 'ng_bc',
            'nam_nv'      => 'nam_nv',
            'thang_nv'    => 'thang_nv',
            'tuan_nv'     => 'tuan_nv',
            'nam_bc'      => 'nam_bc',
            'thang_bc'    => 'thang_bc',
            'tuan_bc'     => 'tuan_bc',
        ];
    }

    public function rules() {
        $rules = [
            [['icd', 'shs', 'ho_ten', 'dia_chi', 'nghe_nghiep', 'me', 'dt', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc', 'hinh_thuc_dieu_tri'], 'safe'],
            [['tuoi'], 'integer'],
            [['phai'], 'in', 'range' => ['T', 'G']],
            [['ng_nv', 'ng_bc'], 'date', 'format' => 'DD/MM/YYYY'],
            [['t_benh'], 'in', 'range' => Arr::pluck($this->dm_loaibenh, 'tenbenh')],
            [['bv'], 'in', 'range' => Arr::pluck($this->dm_bv, 'code')],

            [['px', 'qh'], 'required'],
            [['qh'], 'qhInRange'],
            [['px'], 'pxInRange'],
        ];

        return $rules;
    }


    public function qhInRange($attribute,$params){
        $item = collect($this->dm_quan)->firstWhere('tenquan', $this->qh);
        if(empty($item)){
            $this->addError($attribute, "Mã quận/ huyện ({$this->px}) không tồn tại trong danh mục quận/ huyện");
        }
    }

    public function pxInRange($attribute,$params){
        $item = collect($this->dm_phuong)->where('tenquan', $this->qh)->firstWhere('tenphuong', $this->px);
        if(empty($item)){
            $this->addError($attribute, "Mã phường/ xã ({$this->px}) không tồn tại trong danh mục phường/ xã của quận/ huyện ({$this->qh})");
        }

    }

    public function fields() {
        $data = collect();

        $f0 = collect([
            'qh' => $this->dm_quan,
            'px' => $this->dm_phuong,
        ])->map(function ($dm, $k) {
            return function ($model, $field) use ($dm, $k) {
                $val = $this->arr_where($dm, $field);
                return in_array($k, ['qh', 'px']) ? (string)$val : $val;
            };
        })->all();

        $data->push($f0);

        $data->push([
            'benhvien'     => 'bv',
            'ma_icd'       => 'icd',
            'chuandoan_bd' => function ($model) {
                $i = collect($this->dm_loaibenh)->firstWhere('tenbenh', $model->t_benh);
                return data_get($i, 'mabenh');
            },
            'shs',
            'hoten'        => 'ho_ten',
            'phai',
            'tuoi',
            'vitri'        => 'dia_chi',
            'nghenghiep'   => 'nghe_nghiep',
            'me',
            'dienthoai'    => 'dt',
            'ngaynhapvien' => 'ng_nv',
            'ngaybaocao'   => 'ng_bc',
            'nam_nv',
            'thang_nv',
            'tuan_nv',
            'nam_bc',
            'thang_bc',
            'tuan_bc',
            'loaidieutra'  => function () {
                return 0;
            },
            'loaicabenh' => function(){
                return 0;
            },
            'loaibaocao' => function(){
                return 1;
            },
            'chuyenca' => function(){
                return 0;
            },
            'ht_dieutri' => function($model){
                return $model->hinh_thuc_dieu_tri == 'Điều trị ngoại trú' ? 1 : 0;
            },
            'tp_guive'  => function () {
                return 1;
            },
        ]);

        return $data->collapse()->all();
    }
}
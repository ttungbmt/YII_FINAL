<?php
namespace modules\pcd\import\forms;

use common\models\DynamicImportForm;
use Illuminate\Support\Arr;

class XnHuyetthanhImportForm extends DynamicImportForm {
    public $dm_quan;
    public $dm_phuong;

    public function attributeLabels(){
        return [
            'maso' => 'Maso',
            'hoten' => 'Hoten',
            'ngaynhanmau' => 'Ngaynhanmau',
            'phai' => 'Phai',
            'namsinh' => 'Namsinh',
            'diachi' => 'Diachi',
            'donvi_gui' => 'Donvi Gui',
            'duan' => 'Duan',
            'yeucau_xn' => 'Yeucau Xn',
            'ketqua' => 'Ketqua',
            'ketluan' => 'Ketluan',
        ];
    }

    public function rules()
    {
        $rules = [
            [['ngaynhanmau', 'ngaykhoibenh', 'ngaylay_bp', 'ngaynhan_bp'], 'safe'],
            [['maso', 'namsinh', 'maphuong'], 'safe'],
            [[ 'hoten', 'phai',  'diachi', 'donvi_gui', 'duan', 'yeucau_xn', 'ketqua', 'ketluan', 'phantip_virut'], 'string', 'max' => 255],
            [['maquan'], 'in', 'range' => Arr::pluck($this->dm_quan, 'tenquan')],
        ];

        return $rules;
    }

    public function fields(){
        $data = collect();

        $f0 = collect([
            'maquan' => $this->dm_quan,
        ])->map(function ($dm, $k){
            return function($model, $field) use($dm, $k){
                $val = $this->arr_where($dm, $field);
                return in_array($k, ['maquan']) ? (string)$val : $val;
            };
        })->all();

        $data->push($f0);

        $data->push([
            'maso', 'hoten', 'ngaynhanmau', 'ngaykhoibenh', 'ngaylay_bp', 'ngaynhan_bp', 'phai', 'namsinh', 'diachi', 'donvi_gui', 'duan', 'yeucau_xn', 'ketqua', 'phantip_virut', 'ketluan'
        ]);

        return $data->collapse()->all();
    }
}
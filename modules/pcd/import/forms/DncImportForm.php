<?php
namespace modules\pcd\import\forms;

use common\models\DynamicImportForm;

class DncImportForm extends DynamicImportForm {
    public $postUrl = '/import/dnc';
    public $dm_quan;
    public $dm_phuong;

    public function attributeLabels(){
        return [
            'maquan' => 'Mã quận',
            'maphuong' => 'Mã phường',
            'khupho' => 'Khu phố',
            'to' => 'Tổ dân phố',
            'diachi' => 'Địa chỉ',
            'sonha' => 'Số nhà',
            'tenduong' => 'Tên đường',
            'ten_cs' => 'Tên cơ sở',
            'dienthoai' => 'Điện thoại',
            'loaihinh' => 'Loại hình',
            'nhom' => 'Nhóm',
            'ngaycapnhat' => 'Ngày cập nhật',
            'ngayxoa' => 'Ngày xóa',
            'lat' => 'lat',
            'lng' => 'lng',
        ];
    }

    public function rules()
    {
        $rules = [
            [['lat', 'lng', 'ngaycapnhat'], 'filter', 'filter' => 'trim'],
//            [['khupho', 'to', 'khupho', 'to', 'diachi', 'sonha', 'tenduong', 'ten_cs', 'dienthoai', 'loaihinh'], 'filter', 'filter' => 'trim', 'skipOnArray' => true],
            [['maquan', 'maphuong', 'khupho', 'to', 'diachi', 'sonha', 'tenduong', 'ten_cs', 'dienthoai', 'loaihinh', 'nhom', 'lat', 'lng'], 'safe'],
            [['nhom'], 'integer'],
            [['lat', 'lng'], 'safe'],
            [['ngaycapnhat', 'ngayxoa'], 'date', 'format' => 'php:d/m/Y'],
//            [['maphuong'], 'in', 'range' => Arr::pluck($this->dm_quan, 'tenquan')],
//            [['maquan'], 'in', 'range' => Arr::pluck($this->dm_phuong, 'tenphuong')],

        ];

        return $rules;
    }

    public function fields(){
        $data = collect();

//        $f0 = collect([
//            'qh' => $this->dm_quan,
//            'px' => $this->dm_phuong,
//        ])->map(function ($dm, $k){
//            return function($model, $field) use($dm, $k){
//                $val = $this->arr_where($dm, $field);
//                return in_array($k, ['qh', 'px']) ? (string)$val : $val;
//            };
//        })->all();
//
//        $data->push($f0);

        $data->push([
            'maphuong',
            'maquan',
            'khupho', 'to', 'diachi', 'sonha', 'tenduong', 'ten_cs', 'dienthoai', 'loaihinh', 'nhom', 'ngaycapnhat', 'ngayxoa', 'lat', 'lng',
        ]);

        return $data->collapse()->all();
    }
}
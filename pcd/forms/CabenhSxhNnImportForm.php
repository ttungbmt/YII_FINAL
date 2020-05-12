<?php

namespace pcd\forms;

use common\models\MyModel;

class CabenhSxhNnImportForm extends MyModel
{
    public $bv;
    public $t_benh;
    public $hoten;
    public $tuoi;
    public $ng_nv;
    public $lat;
    public $lng;

    public function fields()
    {
        return [
            'benhvien' => 'bv',
            'chuandoan_bd' => 't_benh',
            'hoten' => 'hoten',
            'tuoi' => 'tuoi',
            'ngaymacbenh_nv' => 'ng_nv',
            'lat' => 'lat',
            'lng' => 'lng'
        ];
    }

    public function rules()
    {
        return [
            [['bv', 't_benh', 'hoten'], 'string', 'max' => 255],
            [['lat', 'lng', 'ng_nv'], 'safe'],
            [['tuoi'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'bv' => 'Bệnh viện',
            't_benh' => 'Tên bệnh',
            'hoten' => 'Họ tên',
            'tuoi' => 'Tuổi',
            'ng_nv' => 'Ngày nhập viện',
            'lat' => 'Lat',
            'lng' => 'Lng'
        ];
    }

    public function formAttrs()
    {
        return [
            'bv' => ['label' => 'bv'],
            't_benh' => ['label' => 't_benh'],
            'hoten' => ['label' => 'hoten'],
            'tuoi' => ['label' => 'tuoi'],
            'ng_nv' => ['label' => 'ng_nv'],
            'lat' => ['label' => 'lat'],
            'lng' => ['label' => 'lng']
        ];
    }
}
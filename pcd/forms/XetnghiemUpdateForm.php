<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/25/2018
 * Time: 10:20 AM
 */

namespace pcd\forms;

use common\models\MyModel;
use pcd\models\HcPhuong;
use yii\base\DynamicModel;

class XetnghiemUpdateForm extends DynamicModel
{
//    public $ho_ten;
//    public $quan_huyen;
//    public $phuong_xa;
//    public $tuoi;
//    public $xn;
//    public $ng_xn;
//    public $loai_xn;
//    public $ketqua_xn;

    private $_attributes = [];
    protected $_dynamicFormAttrs = [];

    public function __construct(array $attributes = [], $config = [])
    {
        foreach ($attributes as $name => $value) {
            $this->_attributes[$name] = $value;
        }
        parent::__construct($config);
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->_attributes)) {
            return $this->_attributes[$name];
        }

        return parent::__get($name);
    }

    public function attributes()
    {
        return $this->_attributes;
    }

    public function fields()
    {
        $_fields = collect($this->_attributes)->map(function($v, $k){
            return [$k => $k];
        })->collapse()->forget(['ho_ten', 'xn', 'ng_xn', 'loai_xn', 'ketqua_xn', 'quan_huyen', 'phuong_xa', 'tuoi']);

        return $_fields->merge([
            'hoten' => 'ho_ten',
            'xetnghiem' => 'xn',
            'ngaylaymau' => 'ng_xn',
            'loai_xn' => 'loai_xn',
            'ketqua_xn' => 'ketqua_xn',
            'maquan' => 'quan_huyen',
            'maphuong' => 'phuong_xa',
            'tuoi' => 'tuoi'
        ])->all();
    }

//    public function rules()
//    {
//        return [
//            [['ho_ten', 'ketqua_xn', 'loai_xn', 'quan_huyen', 'phuong_xa'], 'string', 'max' => 255],
//            ['loai_xn', 'in', 'range' => api('dm_loai_xn')],
//            ['ketqua_xn', 'in', 'range' => api('dm_kq_xn')],
//            [['ng_xn'], 'safe'],
//            [['xn', 'tuoi'], 'integer']
//        ];
//    }

    public function attributeLabels()
    {
        return [
            'ho_ten' => 'HO TEN',
            'quan_huyen' => 'QUAN HUYEN',
            'phuong_xa' => 'PHUONG XA',
            'tuoi' => 'TUOI',
            'xn' => 'XN',
            'ng_xn' => 'NG_XN',
            'loai_xn' => 'LOAI_XN',
            'ketqua_xn' => 'KETQUA_XN'
        ];
    }

    public function formAttrs()
    {
        foreach($this->_attributes as $k => $value) {
            $this->_dynamicFormAttrs +=  [$k => ['label' => $k]];
        }
        return $this->_dynamicFormAttrs;
    }
}
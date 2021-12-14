<?php
/**
 * Created by PhpStorm.
 * User: ttungbmt
 * Date: 06/03/2016
 * Time: 11:14
 */

namespace pcd\entities;

use pcd\models\Cabenh;

class mCabenh extends Cabenh
{
    use ModelTrait;

    protected $dates = [
        'ngaybaocao',
        'ngaynhanthongbao',
        'ngaymacbenh',
        'ngaynhapvien',
        'ngayxuatvien',
        'ngaysinh',
    ];

    public static function findByRole(){
        return parent::find();
    }

    public function getCabenh($macabenh){
        return $this->findByRole()->where(['macabenh' => $macabenh])->one()->formatDate();
    }




}
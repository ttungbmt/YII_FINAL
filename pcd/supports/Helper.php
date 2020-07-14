<?php
namespace pcd\supports;

class Helper
{
    public static function addPrompt($bool, $label, $arr = []){
        return $bool ? array_merge($arr, ['prompt' => $label]) : $arr;
    }

    public static function statusClassCc($value, $path = 'CabenhSxhSearch.loaica'){
        $loaica = data_get(request()->all(), $path, 0);
        return $loaica == $value ? 'primary' : 'default';
    }
}
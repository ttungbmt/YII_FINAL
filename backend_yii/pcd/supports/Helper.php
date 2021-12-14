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

    public static function toDiachi($data){
        $sonha = data_get($data, 'sonha');
        $tenduong = data_get($data, 'tenduong');
        $tenquan = data_get($data, 'tenquan');
        $tenphuong = data_get($data, 'tenphuong');

        $fnStr = function ($str){return trim($str);};

        $g1 = collect([$sonha, $tenduong])->map($fnStr)->filter()->implode(' ');
        $g2 = collect([$tenphuong, $tenquan])->map($fnStr)->filter()->implode(' - ');

        return collect([$g1, $g2])->map($fnStr)->filter()->implode(' - ');
    }
}
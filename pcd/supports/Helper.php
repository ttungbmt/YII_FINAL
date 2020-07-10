<?php
namespace pcd\supports;

class Helper
{
    public static function addPrompt($bool, $label, $arr = []){
        return $bool ? array_merge($arr, ['prompt' => $label]) : $arr;
    }
}
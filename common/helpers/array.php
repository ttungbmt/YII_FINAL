<?php

use Illuminate\Support\Arr;

if (! function_exists('isAssoc')) {
    function isAssoc(array $array)
    {
        $keys = array_keys($array);

        return array_keys($keys) !== $keys;
    }
}

if (! function_exists('array_filter_blank')) {
    function array_filter_blank(array $array)
    {
        return array_filter($array, function ($item){
            return trim($item) !== '';
        });
    }
}


if (! function_exists('array_first')) {
    function array_first($array, callable $callback = null, $default = null)
    {
        return Arr::first($array, $callback, $default);
    }
}

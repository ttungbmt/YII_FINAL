<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 7/6/2016
 * Time: 9:17 PM
 */
namespace pcd\services;

use yii\helpers\VarDumper;

class DebugService {

    /**
     * Debug function
     * d($var);
     */
    public static function dump($var, $caller = null) {
        if (!isset($caller)) {
            $caller = array_shift(debug_backtrace(1));
        }
        echo '<code>File: ' . $caller['file'] . ' / Line: ' . $caller['line'] . '</code>';
        echo '<pre>';
        VarDumper::dump($var, 10, true);
        echo '</pre>';
    }

    /**
     * Debug function with die() after
     * dd($var);
     */
    public static function dumpdie($var) {
        $debug_backtrace = debug_backtrace(1);
        $caller = array_shift($debug_backtrace);
        self::dump($var, $caller);
        die();
    }

}
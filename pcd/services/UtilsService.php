<?php

namespace pcd\services;

use DateTime;
use Yii;

/**
 * All utils function for website
 * @author TriLVH
 */
class UtilsService {

//    public static $_M_WARINING = 'alert-warning';
//    public static $_M_SUCCESS = 'alert-success';
//    public static $_M_ERROR = 'alert-danger';
//    public static $_M_INFO = 'alert-info';

    public static $_M_WARINING = 'warning';
    public static $_M_SUCCESS = 'success';
    public static $_M_ERROR = 'danger';
    public static $_M_INFO = 'info';

    public static function addMoreToArray(&$array, $key, $value) {
        foreach ($array as $index => $obj) {
            $array[$index][$key] = $value;
        }
        return $array;
    }

    public static function pushMessage($type, $message) {
//        Yii::$app->getSession()->setFlash('consol_v_error', $message);
//        Yii::$app->getSession()->setFlash('error_type', $type);
        Yii::$app->getSession()->setFlash($type, $message);
    }

    // Get value from array with key, return empty if not exist
    public static function getArrayValue($array, $key, $default = '', $ignore = null) {
        $default = isset($default) ? $default : '';
        $result = isset($array[$key]) ? $array[$key] : $default;
        return $result == $ignore ? $default : $result;
    }

    public static function getSubArrayFromHash($hash, $idname) {
        $ids = [];
        foreach ($hash as $index => $model) {
            array_push($ids, $model[$idname]);
        }
        return $ids;
    }

    public static function getVar($prefix, $var, $default) {
        $default = isset($default) || empty($default) ? $default : '';
        $prefix = isset($prefix) ? $prefix : '';
        return isset($var) && !empty($var) ? $prefix . $var : $default;
    }

    // Check valid array prop
    public static function checkValidProp($array, $prop) {
        return isset($array[$prop]);
    }

    // Check valid array
    public static function checkValidArray($array) {
        return isset($array) && !empty($array);
    }

    // Check if valid data
    public static function checkValidData($data) {
        return isset($data) && (trim($data) != '');
    }

    // Get first value of array return if array invalid
    public static function getFirst($array) {
        return self::checkValidArray($array) ? $array[0] : null;
    }

    // Create sheet excel object
    public static function createExcelSheetReaderObject($file) {
        $phpExcel = new \PHPExcel();
        // create reader for excel file, and set for reading only
        $reader = \PHPExcel_IOFactory::createReaderForFile($file);
        //$reader->setReadDataOnly(true);
        // create obj for excel, get sheet object to read: first sheet only
        $objReader = $reader->load($file);

        return $objReader;
    }

    // Check valid input file reader
    public static function checkValidExcelFile($file_path) {
        $phpExcel = new \PHPExcel();
        $valid = false;
        $types = array('Excel2007', 'Excel5');
        foreach ($types as $type) {
            $reader = \PHPExcel_IOFactory::createReader($type);
            if ($reader->canRead($file_path)) {
                $valid = true;
                break;
            }
        }

        return $valid;
    }

    // Convert vi to en
    public static function convertViToEn($str, $tolower = false) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
//$str = str_replace(" ", "-", str_replace("&*#39;","",$str));

        if ($tolower) {
            return trim(strtolower($str));
        }

        return trim(str_replace($str));
    }

    /**
     * Cloning value from root array
     * @param type $clone
     * @param type $root
     * @param type $keys
     * @return type
     */
    public static function cloneItems(&$clone, $root, $keys) {
        foreach ($keys as $index => $key) {
            $clone[$key] = $root[$key];
        }
        return $clone;
    }

    /**
     * Convert hashmap to new key
     * @param type $hash
     * @param type $idname
     * @return type
     */
    public static function convertHash(&$hash, $idname) {
        $result = [];
        if (UtilsService::checkValidArray($hash)) {
            foreach ($hash as $key => $value) {
                if (isset($value[$idname])) {
                    $result[$value[$idname]] = $value;
                }
            }
        }
        return $result;
    }

    public static function convertHashToKeyValue($hash, $idkey, $idvalue) {
        $result = [];
        foreach ($hash as $key => $value) {
            if (isset($value[$idkey])) {
                $result[$value[$idkey]] = $value[$idvalue];
            }
        }
        return $result;
    }

    public static function validateDate($date, $format = 'd/m/Y') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public static function convertDate($date) {
        $d = DateTime::createFromFormat('d/m/Y', $date);
        return $d->format('Y-m-d');
    }

    public static function getDateFromString($strDate, $strAdd, $formatin = 'd/m/Y', $formatout = 'd/m/Y') {
        $date = DateTime::createFromFormat($formatin, $strDate);

        $date->setTimeStamp(strtotime($strAdd, $date->getTimeStamp()));

        return $date->format($formatout);
    }

    public static function getDateFromFormat($strDate, $formatin, $formatout) {
        return DateTime::createFromFormat($formatin, $strDate)->format($formatout);
    }

    public static function getDaysTwoDates($startDate, $endDate, $format = 'd/m/Y') {
        if (!isset($startDate) || !isset($endDate)) {
            return 0;
        }

        $startStamp = DateTime::createFromFormat($format, $startDate)->getTimestamp();
        $endStamp = DateTime::createFromFormat($format, $endDate)->getTimestamp();

        return ($endStamp - $startStamp) / (60 * 60 * 24);
    }

    public static function reverseDateTime($date) {
        if (self::validateDate($date, 'Y-m-d H:i:s')) {
            $d = DateTime::createFromFormat('Y-m-d H:i:s', $date);
            return $d->format('d/m/Y');
        }
        return $date;
    }

    public static function getDateString($date) {
        return DateTime::createFromFormat('Y-m-d H:i:s.u', $date)->format('d/m/Y');
    }

    public static function reverseDate($date) {
        if (self::validateDate($date, 'Y-m-d')) {
            $d = DateTime::createFromFormat('Y-m-d', $date);
            return $d->format('d/m/Y');
        }
        return $date;
    }

    public static function generateCode($prefix) {
        $random_hash = sha1(md5(uniqid(rand(), true)));
        return $random_hash . $prefix;
    }

    public static function getHomeUrl() {
        return Yii::$app->homeUrl;
    }

    public static function convertErrorHash($errors) {
        $result = '';
        foreach ($errors as $index => $error) {
            foreach ($error as $id => $ms) {
                $result .= '*' . $ms . '<br/>';
            }
        }
        return $result;
    }

    public static function hashString($str) {
        return sha1(md5($str));
    }

    public static function getCpMonthSql($prop) {
        return "DATEADD(DAY, -DAY($prop)+ 1 , $prop)";
    }

    public static function getCp2MonthSql($first, $operator, $second) {
        return ' ' . self::getCpMonthSql($first) . " $operator " . self::getCpMonthSql($second) . ' ';
    }

    /**
     * Search into array check for matching data, array of objects
     * @param type $array
     * @param type $keyvalues ['propname' => 'value', ...]
     * @return array of matching objects
     */
    public static function searchInArray($array, $keyvalues = null) {
        if (!isset($array)) {
            return [];
        }
        $result = [];
        foreach ($array as $index => $data) {
            $valid = true;
            foreach ($keyvalues as $key => $value) {
                if (!isset($data[$key]) || $data[$key] != $value) {
                    $valid = false;
                }
            }
            if ($valid) {
                $result[] = $data;
            }
        }
        return $result;
    }

    /**
     * This function return sub array by keys
     * @param type $array
     * @param type $keys
     * @return type
     */
    public static function getValuesByKeys($array, $keys) {
        $result = [];
        foreach ($keys as $key) {
            if (isset($array[$key])) {
                $result[] = $array[$key];
            }
        }
        return $result;
    }

    public static function convertArraytoSqlArray($array) {
        return '(' . implode(',', $array) . ')';
    }

    public static function getCurrentTimeStamp() {
        return (new DateTime())->getTimestamp();
    }

    public static function getArrLatLngFromLineString($linestring) {
        $linestring = str_replace('(', '["', $linestring);
        $linestring = str_replace(')', '"]', $linestring);
        $linestring = str_replace('LINESTRING', '', $linestring);

        //Debugservice::dumpdie($linestring);
        $linestring = json_decode($linestring);
        $line = $linestring[0];
        //Debugservice::dumpdie($linestring);
        $latlngs = explode(',', $line);
        $result = [];
        foreach ($latlngs as $latlng) {
            $arrlatlng = explode(' ', $latlng);
            if (sizeof($arrlatlng) > 1) {
                $result[] = ['lat' => $arrlatlng[1], 'lng' => $arrlatlng[0]];
            }
        }
        return $result;
    }

    public static function getArrLatLngFromMultilineString($linestring) {
        $linestring = str_replace('((', '["', $linestring);
        $linestring = str_replace('))', '"]', $linestring);
        $linestring = str_replace('),(', '","', $linestring);
        $linestring = str_replace('MULTILINESTRING', '', $linestring);

        $result = [];
        //Debugservice::dumpdie($linestring);
        $linestring = json_decode($linestring);
        //Debugservice::dumpdie($linestring);
        foreach ($linestring as $index => $line) {
            $latlngs = explode(',', $line);
            $result[$index] = [];
            foreach ($latlngs as $index1 => $latlng) {
                $arrlatlng = explode(' ', $latlng);
                $result[$index][] = ['lat' => $arrlatlng[1], 'lng' => $arrlatlng[0]];
            }
        }

        return $result;
    }

    public static function convertPointToLatlng($point) {
        $point = str_replace('POINT', '', $point);
        $point = str_replace('(', '[', $point);
        $point = str_replace(')', ']', $point);
        $point = str_replace(' ', ',', $point);
        $point = json_decode($point);

        return [
            'lat' => $point[1],
            'lng' => $point[0]
        ];
    }
}

<?php
/**
 * Crated by PhpStorm.
 * User: levoh
 * Date: 24/12/2015
 * Time: 8:19 AM
 */

namespace pcd\services;


use pcd\models\VCabenh;
use pcd\services\UtilsService;
use pcd\services\PQService;
use yii\base\Exception;
use pcd\services\DbService;
use yii\helpers\ArrayHelper;

class DichteService {
    public static $GIOI_TINH = ['T' => 'Trai', 'G' => 'Gái'];
    public static $LOAI_SXH = 'SXH';
    public static $LOAI_TCM = 'TCM';
    public static $LOAIS = ['SXH' => 'Sốt xuất huyết', 'TCM' => 'Tay chân miệng', '' => 'Chưa xác định'];

    public static function getVungdich($endDate, $loai) {
        if (!UtilsService::validateDate($endDate)) {
            throw new Exception("$endDate is invalid date format d/m/Y");
        }

        $deltaDays = 14;
        $deltaDaysByGroup = 2;
        $deltaStep = $deltaDays / ($deltaDaysByGroup + 1) / 2 + 1;
        $step = 1;
        $deltaColor = 255 / $deltaStep * 2;
        $green = 255;
        $red = 0;
        $colors[] = ['red' => $red, 'green' => $green];
        while ($step < $deltaStep * 2) {

            if ($red + $deltaColor < 255) {
                $red = ($red + $deltaColor);
            } else if ($red !== 255) {
                $red = 255;
            } else {
                if ($green - $deltaColor > 0)
                    $green = $green - $deltaColor;
                else
                    $green = 0;
            }
            $colors[] = ['red' => intval($red), 'green' => intval($green)];
            $step++;
        }
        //DebugService::dumpdie($colors);
        $startDate = UtilsService::getDateFromString($endDate, "-$deltaDays days");

        $query = VCabenh::find();
        $query->where("macabenh in (select id_cabenh from vungdich_cabenh a where a.id_vungdich in (select id from v_vungdich))");
        PQService::initQueryRolePQOfCurrentUser($query);
        $cabenhs = ArrayHelper::toArray($query->orderBy('ngaymacbenh')->all());

        $groupDate = $tmpDate = UtilsService::getDateFromFormat($startDate, 'd/m/Y', 'Y-m-d');
        $indexGroup = 0;
        $groups[$indexGroup]['startDate'] = $startDate;
        $groups[$indexGroup]['children'] = [];
        $groups[$indexGroup]['color'] = $colors[0];
        foreach ($cabenhs as $index => $cabenh) {
            while (UtilsService::getDaysTwoDates($tmpDate, $cabenh['ngaymacbenh'], 'Y-m-d') != 0) {
                $tmpDate = UtilsService::getDateFromString($tmpDate, '+1 days', 'Y-m-d', 'Y-m-d');
                if ($groupDate == null || UtilsService::getDaysTwoDates($groupDate, $tmpDate, 'Y-m-d') > $deltaDaysByGroup) {
                    $groups[$indexGroup]['endDate'] = UtilsService::getDateFromString($tmpDate, '-1 days', 'Y-m-d', 'd/m/Y');
                    $indexGroup++;
                    $groupDate = $tmpDate;
                    $groups[$indexGroup]['startDate'] = UtilsService::getDateFromFormat($tmpDate, 'Y-m-d', 'd/m/Y');
                    $groups[$indexGroup]['endDate'] = '';
                    $groups[$indexGroup]['children'] = [];
                    $groups[$indexGroup]['color'] = $colors[$indexGroup % ($deltaStep * 2)];
                }
            }
            $groups[$indexGroup]['children'][] = $cabenh;
        }

        //DebugService::dumpdie($groups);
        return $groups;
    }

    public static function updateVungdich() {
        self::insertCabenhToVungdich();
        self::mergeTwoVungdich();
        self::createNewVungdich();
    }

    public static function createNewVungdich() {
        DbService::execute("insert into vung_dich (id_cabenh, ngay_bat_dau, ngay_ket_thuc, loai_dich) select macabenh, ngaymacbenh, ngaymacbenh + 14, loai_dich from cabenh where macabenh not in (select id_cabenh from vungdich_cabenh)");
        DbService::execute("insert into vungdich_cabenh(id_cabenh, id_vungdich) select id_cabenh, id from vung_dich where id not in (select id_vungdich from vungdich_cabenh)");
    }

    public static function insertCabenhToVungdich() {
        $sql = " insert into vungdich_cabenh (id_vungdich, id_cabenh) "
            . " select c.id, a.macabenh from (select * from cabenh where (macabenh not in (select id_cabenh from vungdich_cabenh))) a "
            . " inner join vung_dich c "
            . " on a.loai_dich = c.loai_dich "
            . " and a.ngaymacbenh <= c.ngay_ket_thuc and a.ngaymacbenh >= c.ngay_bat_dau "
            . " and (select st_contains(st_buffer(st_collect(geom),200/111000.18),a.geom)  from cabenh b where b.macabenh in (select id_cabenh from vungdich_cabenh d where c.id = d.id_vungdich)) = true";
        DbService::execute($sql);
    }

    public static function mergeTwoVungdich() {
        while (true) {
            $cabenhsDupInVungdich = DbService::getModels("select * from vungdich_cabenh where id_cabenh "
                ." in (select a.id_cabenh from vungdich_cabenh a where "
                ." 1 < (select count(b.id_cabenh) from vungdich_cabenh b "
                ." where a.id_cabenh = b.id_cabenh group by id_cabenh) order by id_cabenh limit 1)");
            if (!empty($cabenhsDupInVungdich)) {
                $currentIdVungdich = $cabenhsDupInVungdich[0]['id_vungdich'];
                $currentIdCabenh = $cabenhsDupInVungdich[0]['id_cabenh'];
                foreach ($cabenhsDupInVungdich as $index => $cabenh) {
                    $id_cabenh = $cabenh['id_cabenh'];
                    $id_vungdich = $cabenh['id_vungdich'];
                    if ($id_cabenh != $currentIdCabenh) {
                        $currentIdCabenh = $id_cabenh;
                        $currentIdVungdich = $id_vungdich;
                    } else {
                        DbService::execute("delete from vungdich_cabenh where id_cabenh = $id_cabenh and id_vungdich = $id_vungdich");
                        DbService::execute("delete from vung_dich where id = $id_vungdich");
                        DbService::execute("update vungdich_cabenh set id_vungdich = $currentIdVungdich where id_vungdich = $id_vungdich");
                        DbService::execute("update vung_dich a set ngay_ket_thuc = (select ngaymacbenh from cabenh where macabenh in (select id_cabenh from vungdich_cabenh where id_vungdich = a.id) order by ngaymacbenh desc limit 1) + 14 where id = $currentIdVungdich");
                        break;
                    }
                }
            } else {
                break;
            }
        }
    }

    public static function getSummaryCabenhOnYear($year = 2014, $loai = 'sxh') {
        $vungquans = DbService::getModels('select * from v_vungquan');
        $vungquans_geom = ArrayHelper::map($vungquans, 'ten_qh', 'geom_txt');
        $vungquans_tenquan = ArrayHelper::map($vungquans, 'ten_qh', 'ten_quan');
        $vungquans_maqh = ArrayHelper::map($vungquans, 'ten_qh', 'ma_qh');
        $vungquans_centroid = ArrayHelper::map($vungquans, 'ten_qh', 'geom_centroid');
        $vungquans_count = [
            '01' => 51.42,
            '02' => 37.07,
            '03' => 61.44,
            '04' => 71.06,
            '05' => 91.51,
            '06' => 140.76,
            '07' => 62.42,
            '08' => 140.04,
            '09' => 40.00,
            '10' => 73.30,
            '11' => 97.79,
            '12' => 49.44,
            'BINH CHANH' => 118.21,
            'BINH TAN' => 80.17,
            'BINH THANH' => 29.85,
            'CAN GIO' => 48.40,
            'CU CHI' => 46.07,
            'GO VAP' => 32.09,
            'HOC MON' => 55.21,
            'NHA BE' => 88.61,
            'PHU NHUAN' => 29.54,
            'TAN BINH' => 51.00,
            'TAN PHU' => 62.38,
            'THU DUC' => 30.71,
            'KHONG RO' => 0
        ];

        $result = [];
        foreach($vungquans_geom as $index => $item) {
            $result[$index]['ma_qh'] = $vungquans_maqh[$index];
            $result[$index]['count'] = $vungquans_count[$index];
            $result[$index]['ten_quan'] = $vungquans_tenquan[$index];
            $result[$index]['centroid'] = UtilsService::convertPointToLatlng($vungquans_centroid[$index]);
            $result[$index]['geom_txt'] = UtilsService::getArrLatLngFromLineString($vungquans_geom[$index]);
        }

        return $result;
    }

    public static function getSummaryOfAddressByPhuong() {
        $add = DbService::getModels('select * from v_cabenh_add');
        $nonAdd = DbService::getModels('select * from v_cabenh_nonadd');

        $countOfNonAdd = ArrayHelper::map($nonAdd, 'ma_phuong', 'count');
        $countOfAdd = ArrayHelper::map($add, 'ma_phuong', 'count');
        $tenquanadd = ArrayHelper::map($add, 'ma_phuong', 'ten_quan');
        $tenqhadd = ArrayHelper::map($add, 'ma_phuong', 'ten_phuong');
        $tenquannadd = ArrayHelper::map($nonAdd, 'ma_phuong', 'ten_quan');
        $tenqhnadd = ArrayHelper::map($nonAdd, 'ma_phuong', 'ten_phuong');

        $result = [];
        foreach ($countOfNonAdd as $index => $item) {
            $result[$index] = [];
            $result[$index]['ten_phuong'] = $tenqhnadd[$index];
            $result[$index]['count_nonadd'] = $countOfNonAdd[$index];
            $result[$index]['count_add'] = isset($countOfAdd[$index]) ? $countOfAdd[$index] : 0;
            $result[$index]['ten_quan'] = $tenquannadd[$index];
        }

        foreach ($countOfAdd as $index => $item) {
            $result[$index] = [];
            $result[$index]['ten_phuong'] = $tenqhadd[$index];
            $result[$index]['count_add'] = $countOfAdd[$index];
            $result[$index]['count_nonadd'] = isset($countOfNonAdd[$index]) ? $countOfNonAdd[$index] : 0;
            $result[$index]['ten_quan'] = $tenquanadd[$index];
        }

        return $result;
    }
}
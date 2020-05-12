<?php

namespace pcd\services;

use pcd\models\DmPhuong;
use pcd\models\DmQuan;
use pcd\models\VUserRolePhuongquan;
use yii\helpers\ArrayHelper;

class PQService {
    public static function getTreePQ() {
        $dmphuongs = ArrayHelper::toArray(DmPhuong::find()->select(['ten_phuong', 'ma_phuong', 'ma_quan'])->all());
        $dmquans = ArrayHelper::map(DmQuan::find()->select(['ma_quan', 'ten_quan'])->all(), 'ma_quan', 'ten_quan');

        foreach ($dmquans as $index => $ten_quan) {
            $dmquans[$index] = ['ten_quan' => $ten_quan, 'dmphuongs' => []];
        }

        foreach ($dmphuongs as $index => $dmphuong) {

            $maquan = $dmphuong['ma_quan'];
            if (isset($dmquans[$maquan])) {
                $dmquans[$maquan]['dmphuongs'][] = $dmphuong;
            }
        }

        return $dmquans;
    }

    public static function getRolePQOfCurrentUser() {
        if (!\Yii::$app->user->isGuest) {
            $userid = \Yii::$app->user->id;
            return VUserRolePhuongquan::findOne(['user_id' => $userid]);
        }
        return null;
    }

    public static function canAccessPhuong($maphuong, $maquan) {
        $user = self::getRolePQOfCurrentUser();

        if (isset($user)) {
            if ($user->cap_hanhchinh !== RolePQConst::$CAP_SO) {
                if ($user->cap_hanhchinh === RolePQConst::$CAP_QUAN) {
                    return $maquan == $user->ma_hanhchinh;
                } else {
                    return $maphuong == $user->ma_hanhchinh;
                }
            } else {
                return true;
            }
        }
        return false;
    }

    public static function initQueryRolePQOfCurrentUser(&$query, $is_query_interface = true) {
        $vUserRolePQ = self::getRolePQOfCurrentUser();

        if (isset($vUserRolePQ)) {
            switch ($vUserRolePQ->cap_hanhchinh) {
                case RolePQConst::$CAP_SO:
                    if (!$is_query_interface)
                        $query .= ' 1=1 ';
                    break;
                case RolePQConst::$CAP_QUAN:
                    if ($is_query_interface)
                        $query->andFilterWhere(['ma_quan' => $vUserRolePQ->ma_hanhchinh]);
                    else
                        $query .= " ma_quan = {$vUserRolePQ->ma_hanhchinh} ";
                    break;
                case RolePQConst::$CAP_PHUONG:
                    if ($is_query_interface){
                        $query->andFilterWhere(['ma_phuong' => $vUserRolePQ->ma_hanhchinh]);
                    }
                    else {
                        $query .= " ma_phuong = {$vUserRolePQ->ma_hanhchinh} ";
                    }
                    break;
            }
        } else {
            if (!is_string($query)) {
                $query->andWhere('1=0');
            } else {
                $query .= ' 1=0 ';
            }
        }

        return $query;
    }
}
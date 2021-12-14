<?php
/**
 * Created by PhpStorm.
 * User: ttungbmt
 * Date: 2016-03-14
 * Time: 10:12
 */

namespace pcd\services;


use pcd\models\VUserRolePx;

class RolePQService
{
    public static function getCurrentUser() {
        if (!\Yii::$app->user->isGuest) {
            $userid = \Yii::$app->user->id;
            return VUserRolePx::findOne(['user_id' => $userid]);
        }
        return null;
    }
}
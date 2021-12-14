<?php
namespace pcd\services;


use pcd\modules\auth\services\UserService;
use pcd\services\RolePQConst;
use pcd\models\DmQuan;
use yii\helpers\ArrayHelper;

class RolePQSrv
{
    public static function filterPQAccess(&$query){
        $userSrv = new UserService();
        $roles = collect($userSrv->getRolesByUser());
        $user = $userSrv->current();

        if($roles->has(RolePQConst::PHUONG)){
            $query->andFilterWhere(['ma_phuong' => $user->ma_phuong]);
        } elseif ($roles->has(RolePQConst::QUAN)){
            $query->andFilterWhere(['ma_quan' => $user->ma_quan]);
        }
    }


    public static function listQh(){
        $query = DmQuan::find();
        !authUser()->ma_quan || $query->andFilterWhere(['ma_quan' => authUser()->ma_quan]);
        return ArrayHelper::map($query->orderBy('ten_qh')->all(), 'ma_quan', 'ten_quan');
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/26/2018
 * Time: 10:18 AM
 */

namespace pcd\controllers\admin;


use pcd\controllers\AppController;
use common\models\Query;
use pcd\models\CabenhSxh;
use pcd\models\Thongke;
use pcd\supports\RoleHc;

class KiemtraCabenhController extends AppController
{
    public function actionIndex(){

        $role = RoleHc::init();

        $tbThongke = Thongke::tableName();

        $totalData = (new Query())
            ->select('*')
            ->from($tbThongke)
        ;

        $role->filterCabenh($totalData, 1);

        $errorDieutra = $errorChuyenca = $errorDiachi = [];
        foreach($totalData->all() as $cb) {
            if(($cb['chua_dt'] + $cb['dang_dt'] + $cb['chua_xv'] + $cb['da_dt']) > 1){
                $c = CabenhSxh::find()->where(['gid' => $cb['cabenh_id']])->asArray()->one();
                array_push($errorDieutra, $c);
            }

            if(($cb['ca_tp'] + $cb['canhan'] + $cb['cachuyen'] + $cb['ca_phcd']) > 1){
                $c = CabenhSxh::find()->where(['gid' => $cb['cabenh_id']])->asArray()->one();
                array_push($errorChuyenca, $c);
            }

            if(($cb['cdc_cbn_sxh'] + $cb['cdc_cbn_ksxh'] + $cb['cdc_kbn_pxk'] + $cb['cdc_kbn_qhk'] + $cb['cdc_kbn_tk'] + $cb['kdc_pxk'] + $cb['kdc_qhk'] + $cb['kdc_tk']) > 1){
                $c = CabenhSxh::find()->where(['gid' => $cb['cabenh_id']])->asArray()->one();
                array_push($errorDiachi, $c);
            }
        }

        if(role('admin')){
            $errorDieutra = array_group_by($errorDieutra, 'maquan');
            $errorChuyenca = array_group_by($errorChuyenca, 'maquan');
            $errorDiachi = array_group_by($errorDiachi, 'maquan');
        } elseif(role('quan')){
            $errorDieutra = array_group_by($errorDieutra, 'maphuong');
            $errorChuyenca = array_group_by($errorChuyenca, 'maphuong');
            $errorDiachi = array_group_by($errorDiachi, 'maphuong');
        } elseif(role('phuong')){
            $errorDieutra = array_group_by($errorDieutra, 'khupho');
            $errorChuyenca = array_group_by($errorChuyenca, 'khupho');
            $errorDiachi = array_group_by($errorDiachi, 'khupho');
        }

        return $this->render('index', [
            'errorDieutra' => $errorDieutra,
            'errorChuyenca' => $errorChuyenca,
            'errorDiachi' => $errorDiachi
        ]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: THANHTUNG
 * Date: 13-Dec-17
 * Time: 1:12 PM
 */

namespace gsnc\controllers\api;

use common\controllers\ApiController;
use gsnc\models\Benhvien;
use gsnc\models\DmChitieu;
use gsnc\models\DmMaunc;
use gsnc\models\DmPhuong;
use gsnc\models\DmQcvn;
use gsnc\models\DmOnhiem;
use gsnc\models\DmLoaibv;
use gsnc\models\DmQuan;
use gsnc\models\DvCapnuoc;
use gsnc\models\PoiBenhvien;
use Illuminate\Support\Arr;

class DmController extends ApiController
{
    public function actionDonviBc(){
        $data = DmQuan::find()->andFilterWhere(['NOT IN', 'gid', [27,28]])->orderBy('order')->all();
        return collect($data)->map(function ($i){
            return [
                'label' => $i['maquan'] === 'THANH PHO' ? 'Trung tâm kiểm soát bệnh tật TP.HCM' : $i['tenquan'],
                'value' => (string)$i['maquan'],
                'extra' => Arr::only($i->toArray(), ['caphc'])
            ];
        });
    }

    public function actionDonviCn($donvi_bc_id = null){
        $data = DvCapnuoc::find()->andFilterWhere(['ma_dv_ql' => $donvi_bc_id])->orderBy('ten_dv')->all();
        return collect($data)->map(function ($i){
            return [
                'label' => $i['ten_dv'],
                'value' => (string)$i['gid'],
                'extra' => Arr::only($i->toArray(), ['loaimau_id'])
            ];
        });
    }

    public function actionPhuong(){
        $value = app('request')->post('value');
        $maquan = data_get(app('request')->post('depdrop_parents'), '0');
        $list_phuong = DmPhuong::find()->where(['maquan' => $maquan])->map(function ($item){
            return ['id' => $item->maphuong, 'name' => $item->tenphuong];
        });

        return [
            'output' => $list_phuong, 'selected'=> $value
        ];
    }

    public function actionQuan(){
        $query = DmQuan::find();
//        if(role('quan')){
//            $query->where(['maquan' => userInfo()->ma_quan]);
//        }

        return $query->pluck('tenquan', 'maquan');
    }

    public function actionQcvn(){
        return DmQcvn::find()->orderBy('tenqc')->pluck('tenqc', 'id');
    }

    public function actionChitieuByQcvn(){
        $v = request('value');
        $qcvn_id = request('depdrop_all_params.qcvn_id');
        $ct = collect(DmChitieu::find()->where(['qcvn_id' => $qcvn_id])->pluck('tenchitieu', 'id'))->map(function($v, $k){
            return ['id' => $k, 'name' => $v];
        })->values()->all();
        return [
            'output' => $ct,
            'selected' => $v,
        ];
    }

    public function actionQcvnmc(){
        return DmQcvn::find()->where(['type' => 'maunc'])->pluck('tenqc', 'id');
    }

    public function actionQcvnbv(){
        return DmQcvn::find()->where(['type' => 'benhvien'])->pluck('tenqc', 'id');
    }

    public function actionLoaibv(){
        return DmLoaibv::find()->orderBy('ten')->pluck('ten', 'id');
    }

    public function actionBenhvien(){
        return PoiBenhvien::find()->orderBy('ten')->pluck('ten', 'gid');
    }

    public function actionMaunc(){
        return DmMaunc::find()->orderBy('mamau')->pluck('mamau', 'id');
    }

    public function actionOnhiem(){
        return DmOnhiem::find()->pluck('ten', 'id');
    }
    public function actionChitieu(){
        return DmChitieu::find()->pluck('tenchitieu', 'id');
    }
    public function actionGroupYkien(){

        return [
            1 => 'Ý KIẾN CỦA NGƯỜI DÂN VỀ NGUỒN NƯỚC ĐANG SỬ DỤNG',
            2 => 'PHẦN KHẢO SÁT CỦA NGƯỜI KHẢO SÁT',
            3 => 'Các biện pháp hướng dẫn người dân sử dụng nước sạch',
        ];
    }

    public function actionPhuongEn(){

        return DmPhuong::find()->pluck('tenphuong_en', 'maphuong')->all();
    }

    public function actionQuanEn(){
        return DmQuan::find()->pluck('tenquan_en', 'maquan')->all();
    }
}

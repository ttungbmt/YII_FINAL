<?php

namespace pcd\modules\pt_nguyco\controllers;

use Carbon\Carbon;
use common\controllers\BackendController;
use Illuminate\Support\Arr;
use Mpdf\Tag\Q;
use pcd\models\HcPhuong;
use pcd\modules\pt_nguyco\forms\ThongkeForm;
use pcd\modules\pt_nguyco\models\DmLoaihinh;
use pcd\modules\pt_nguyco\models\PtNguyco;
use pcd\supports\Helper;
use yii\db\Expression;
use yii\db\Query;

class ThongkeController extends BackendController
{
    public function actionIndex()
    {
        $model = new ThongkeForm();
        return $this->render('index', compact('model'));
    }

    public function actionLoaihinh()
    {
        $model = new ThongkeForm();
        if (request()->isPost && $model->load(request()->all())) {
            $month = $model->month;
            $date = Carbon::createFromFormat('m/Y', $month)->setDay(1)->format('Y-m-d');

            $field = [];
            if($model->loai_tk == 'hanhchinh'){
                if($model->maquan){
                    if($model->maphuong){
                        $field = ['table' => 'dm_khupho', 'name' => 'khupho', 'code' => 'khupho', 'key' => 'khupho', 'order' => 'khupho'];

                    } else {
                        $field = ['table' => 'hc_phuong', 'name' => 'tenphuong', 'code' => 'maphuong', 'key' => 'maphuong', 'order' => 'order'];
                    }
                } else {
                    $field = ['table' => 'hc_quan', 'name' => 'tenquan', 'code' => 'maquan', 'key' => 'maquan', 'order' => 'order'];
                }
            } else {
                $field = ['table' => 'dm_loaihinh', 'name' => 'ten_lh', 'code' => 'loaihinh_id', 'key' => 'id', 'order' => 'order'];
            }

            $q0 = (new Query())->select([
                'pt.gid',
                'code' => "pt.{$field['code']}",
                'ngayxoa',
                'ngaycapnhat',
                'gs' => new Expression("MAX(CASE WHEN TO_CHAR(ngay_gs, 'MM/YYYY') = '{$month}' THEN 1 END)"),
                'luot_gs' => new Expression("COUNT(CASE WHEN TO_CHAR(ngay_gs, 'MM/YYYY') = '{$month}' THEN 1 END)"),
                'lq' => new Expression("MAX(CASE WHEN (TO_CHAR(ngay_gs, 'MM/YYYY') = '{$month}' AND vc_lq > 0) THEN 1 END)"),
                'dx_xp' => new Expression("MAX(CASE WHEN (TO_CHAR(ngay_gs, 'MM/YYYY') = '{$month}' AND dexuat_xp = 1) THEN 1 END)"),
                'xp' => new Expression("MAX(CASE WHEN (TO_CHAR(ngay_gs, 'MM/YYYY') = '{$month}' AND xuphat = 1) THEN 1 END)"),
            ])
                ->from(['pt' => 'pt_nguyco'])
                ->leftJoin(['pgs' => 'phieu_gs'], 'pgs.pt_nguyco_id = pt.gid')
                ->groupBy(new Expression('1,2,3,4'))
                ->orderBy(new Expression('1'));

            if ($model->maphuong)  $q0->andFilterWhere(['maphuong' => $model->maphuong]);
            if ($model->maquan) $q0->andFilterWhere(['maquan' => $model->maquan]);

            $e_current = "COUNT(CASE WHEN ngaycapnhat < '{$date}' THEN 1 END)";
            $e_moi = "COUNT(CASE WHEN TO_CHAR(ngaycapnhat, 'MM/YYYY') = '{$month}' THEN 1 END)";

            $q1 = (new Query())->select([
                'code',
                'dauthang' => new Expression("({$e_current} - COUNT(CASE WHEN ngayxoa < '{$date}' THEN 1 END))"),
                'daxoa' => new Expression("COUNT(CASE WHEN TO_CHAR(ngayxoa, 'MM/YYYY') = '{$month}' THEN 1 END)"),
                'moi' => new Expression($e_moi),
                'gs' => new Expression("SUM(gs)"),
                'luot_gs' => new Expression("SUM(luot_gs)"),
                'lq' => new Expression("SUM(lq)"),
                'dx_xp' => new Expression("SUM(dx_xp)"),
                'xp' => new Expression("SUM(xp)"),
            ])
                ->from(['pgs' => $q0])
                ->groupBy('code');


            $q2 = (new Query())->select([
                $field['key'],
                'name' => $field['name'],
                'dnc_gs.*',
            ])
                ->from(['tb' => $field['table']])
                ->leftJoin(['dnc_gs' => $q1], "dnc_gs.code = tb.{$field['key']}")
                ->orderBy($field['order'])
            ;

            if($model->loai_tk == 'hanhchinh'){
                if ($model->maquan)  $q2->andFilterWhere(['maquan' => $model->maquan]);
                if ($model->maphuong)  $q2->andFilterWhere(['maphuong' => $model->maphuong]);
            }

            $data0 = collect($q2->all())->map(function ($i) {
                return array_merge($i, [
                    'luot_gs' => is_string($i['luot_gs']) ? (float)$i['luot_gs'] : $i['luot_gs']
                ]);
            });

            $data_e = $data0;

            $nhoms = collect(DmLoaihinh::find()->select('id, nhom, ten_lh')->asArray()->all())->groupBy('nhom')->map(function ($i){
                return Arr::pluck($i, 'id');
            })->all();

            return $this->asJson([
                'data' => $data_e,
                'nhoms' => $nhoms
            ]);
        }

        return $this->asJson([
            'data' => [],
            'nhoms' => []
        ]);
    }

    public function actionXuphat()
    {
        $year = request('year');
        $year = $year ? $year : date('Y');

        $q1 = (new Query)
            ->select(['pt_nguyco_id', 'thang' => new Expression('date_part(\'month\', ngayxuphat)')])
            ->from('phieu_gs')
            ->andWhere('ngayxuphat IS NOT NULL')
            ->andWhere('date_part(\'year\', ngayxuphat) = \'' . $year . '\'')
        ;
        $q2 = (new Query)->select([
            'thang1' => 'SUM(CASE  WHEN thang = 1 THEN 1 END)::int',
            'thang2' => 'SUM(CASE  WHEN thang = 2 THEN 1 END)::int',
            'thang3' => 'SUM(CASE  WHEN thang = 3 THEN 1 END)::int',
            'thang4' => 'SUM(CASE  WHEN thang = 4 THEN 1 END)::int',
            'thang5' => 'SUM(CASE  WHEN thang = 5 THEN 1 END)::int',
            'thang6' => 'SUM(CASE  WHEN thang = 6 THEN 1 END)::int',
            'thang7' => 'SUM(CASE  WHEN thang = 7 THEN 1 END)::int',
            'thang8' => 'SUM(CASE  WHEN thang = 8 THEN 1 END)::int',
            'thang9' => 'SUM(CASE  WHEN thang = 9 THEN 1 END)::int',
            'thang10' => 'SUM(CASE  WHEN thang = 10 THEN 1 END)::int',
            'thang11' => 'SUM(CASE  WHEN thang = 11 THEN 1 END)::int',
            'thang12' => 'SUM(CASE  WHEN thang = 12 THEN 1 END)::int',
        ])
            ->from(['gs' => $q1])
            ->leftJoin(['dnc' => 'pt_nguyco'], 'gs.pt_nguyco_id = dnc.gid')
            ->groupBy('code');

        $q3 = (new Query);

        if ($maquan = request()->post('maquan')) {
            if ($maphuong = request()->post('maphuong')) {
                $field = [
                    'table' => (new Query())->select('maphuong, khupho')->from(PtNguyco::tableName())->groupBy(new Expression('1,2')),
                    'name' => 'khupho', 'code' => 'khupho', 'label' => 'Khu phố'
                ];
                $q2->andWhere(['maphuong' => $maphuong]);
                $q3
                    ->orderBy('hc.'.$field['code'])
                    ->andWhere(['maphuong' => $maphuong]);

            } else {
                $field = ['table' => 'hc_phuong', 'name' => 'tenphuong', 'code' => 'maphuong', 'label' => 'Phường xã'];
                $q2->andWhere(['maquan' => $maquan]);
                $q3
                    ->orderBy('hc.order')
                    ->andWhere(['maquan' => $maquan]);
            }

        } else {
            $field = ['table' => 'hc_quan', 'name' => 'tenquan', 'code' => 'maquan', 'label' => 'Quận huyện'];
            $q3 = $q3->orderBy('hc.order');
        }

        $q2->addSelect([ 'code' => "dnc.{$field['code']}"]);

        $q3
            ->select([
                'ten' => "hc.{$field['name']}",
                'code' => "hc.{$field['code']}",
            ])
            ->from(['hc' => $field['table']])
            ->leftJoin(['xp' => $q2], "xp.code = hc.{$field['code']}")
            ->addSelect('xp.thang1, xp.thang2, xp.thang3, xp.thang4, xp.thang5, xp.thang6, xp.thang7, xp.thang8, xp.thang9, xp.thang10, xp.thang11, xp.thang12');


        return $this->asJson([
            'data' => $q3->all(),
            'field' => $field
        ]);
    }

    public function actionTinhhinhGs(){
        $q1 = (new Query())->select(new Expression("pt_nguyco_id, date_part('month', ngay_gs) as month, date_part('year', ngay_gs) as year, count(pt_nguyco_id)"))->from('phieu_gs')->groupBy(new Expression('1,2,3'));
        $q2 = (new Query())->select(new Expression("pt_nguyco_id, json_agg(gs) as giamsats"))->from(['gs' => $q1])->groupBy(new Expression('1'));


        $tb = PtNguyco::tableName();
        $model = PtNguyco::find()->with('loaihinh')->select("{$tb}.gid, ten_cs, sonha, tenduong, px.maphuong, px.tenphuong, px.tenquan, px.maquan, nhom, loaihinh_id, ngaycapnhat, ngayxoa, gs.giamsats")
            ->leftJoin(['gs' => $q2], "gs.pt_nguyco_id = {$tb}.gid")
            ->leftJoin(['px' => HcPhuong::tableName()], "px.maphuong = {$tb}.maphuong")
            ->andFilterWhere([
                "{$tb}.maquan" => request('maquan'),
                "{$tb}.maphuong" => request('maphuong'),
            ])
            ->asArray()
            ->all()
        ;

        $data = collect($model)->map(function ($i) {
            $i = array_merge($i, [
                'loaihinh' => data_get($i, 'loaihinh.ten_lh'),
                'diachi' => Helper::toDiachi(Arr::only($i, ['sonha', 'tenduong'])),
                'giamsats' => $i['giamsats'] ? Arr::except(json_decode($i['giamsats'], true), ['month']) : [],
                'ngaycapnhat' => dbToDate($i['ngaycapnhat']),
            ]);

            return $i;
        });


        return $this->asJson([
            'data' => $data,
        ]);
    }


    public function actionGiamsat($id){
        $query = (new Query())->select([
            'month' => "DATE_PART('month', ngay_gs)",
            'count_gs' => "COUNT ( * )",
            'count_lq' => "SUM ( CASE WHEN vc_lq = 1 THEN 1 ELSE 0 END )",
        ])
            ->from('phieu_gs')
            ->andWhere(['pt_nguyco_id' => $id])
            ->groupBy(new Expression('1'))
            ->orderBy(new Expression('1'));


        return $this->asJson([
            'status' => 'OK',
            'data' => $query->all()
        ]);
    }
}
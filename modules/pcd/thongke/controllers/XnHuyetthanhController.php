<?php

namespace modules\pcd\thongke\controllers;

use common\controllers\BackendController;
use modules\pcd\thongke\forms\XnHuyetthanhForm;
use yii\db\Expression;
use yii\db\Query;

class XnHuyetthanhController extends BackendController {

    public function actionIndex() {
        $model = new XnHuyetthanhForm();
        return $this->render('index', compact('model'));
    }

    public function actionByKetquaXn() {
        $months = request('months');
        $year = request('year');
        $loai_xn = request('loai_xn');

        $q1 = (new Query())->select(['maquan', 'phai', 'ketqua', 'phantip_virut', 'tuoi' => new Expression('date_part(\'year\', CURRENT_DATE) - CAST(NULLIF(namsinh, \'\') as INTEGER)')])
            ->from('xn_huyetthanh')
            ->andFilterWhere(['yeucau_xn' => $loai_xn])
            ->andFilterWhere(['to_char(COALESCE(ngaynhanmau, ngaykhoibenh), \'MM\')' => $months])
            ->andFilterWhere(['to_char(COALESCE(ngaynhanmau, ngaykhoibenh), \'YYYY\')' => $year]);

        $q2 = (new Query())->select(
            [
                'maquan',
                'count'     => 'count(*)::int',
                'trai'      => 'sum(CASE WHEN phai = \'T\' THEN 1 END)::int',
                'gai'       => 'sum(CASE WHEN phai = \'G\' THEN 1 END)::int',
                'age_5'     => 'sum(CASE WHEN tuoi <= 5 THEN 1 END)::int',
                'age_6_10'  => 'sum(CASE WHEN tuoi >= 6 AND tuoi <=10 THEN 1 END)::int',
                'age_11_14' => 'sum(CASE WHEN tuoi >= 11 AND tuoi <=14 THEN 1 END)::int',
                'age_15_17' => 'sum(CASE WHEN tuoi >= 15 AND tuoi <=17 THEN 1 END)::int',
                'age_18'    => 'sum(CASE WHEN tuoi >=18 THEN 1 END)::int',
                'duongtinh' => 'sum(CASE WHEN ketqua =\'DUONG TINH\' THEN 1 END)::int',
                'amtinh'    => 'sum(CASE WHEN ketqua =\'AM TINH\' THEN 1 END)::int',
                'den1'      => 'sum(CASE WHEN phantip_virut =\'DEN-1\' THEN 1 END)::int',
                'den2'      => 'sum(CASE WHEN phantip_virut =\'DEN-2\' THEN 1 END)::int',
                'den3'      => 'sum(CASE WHEN phantip_virut =\'DEN-3\' THEN 1 END)::int',
                'den4'      => 'sum(CASE WHEN phantip_virut =\'DEN-4\' THEN 1 END)::int'
            ]
        )->from($q1)->groupBy('maquan');

        $q3 = (new Query())->select([
            'hc.maquan',
            'hc.tenquan',
            'xn.count', 'xn.trai', 'xn.gai', 'xn.age_5', 'xn.age_6_10', 'xn.age_11_14', 'xn.age_15_17', 'xn.age_18', 'xn.duongtinh', 'xn.amtinh', 'xn.den1', 'xn.den2', 'xn.den3', 'xn.den4',
        ])
            ->from(['hc' => 'hc_quan'])
            ->leftJoin(['xn' => $q2], 'xn.maquan = hc.maquan')
            ->orderBy('order');

        return $this->asJson([
            'data' => $q3->all()
        ]);
    }

    public function actionByBenhvien() {
        $months = request('months');
        $year = request('year', date('Y'));
        $loai_xn = request('loai_xn');

        $q1 = (new Query())->select(['donvi_gui', 'thang' => new Expression('date_part(\'month\', COALESCE(ngaynhanmau, ngaykhoibenh))')])
            ->from('xn_huyetthanh')
            ->andFilterWhere(['yeucau_xn' => $loai_xn])
            ->andFilterWhere(['to_char(COALESCE(ngaynhanmau, ngaykhoibenh), \'MM\')' => $months])
            ->andFilterWhere(['to_char(COALESCE(ngaynhanmau, ngaykhoibenh), \'YYYY\')' => $year]);

        $q2 = (new Query())->select('benhvien, chitieu')->from('chitieu_ht')->andWhere(['nam' => $year]);
        $q3 = (new Query())->select(
            [
                'donvi_gui',
                'chitieu' => 'CAST (bv.chitieu AS INTEGER)',
                'count'   => 'count(*)::int',
                'thang1'  => 'sum(CASE  WHEN thang = 1 THEN 1 END)::int',
                'thang2'  => 'sum(CASE  WHEN thang = 2 THEN 1 END)::int',
                'thang3'  => 'sum(CASE  WHEN thang = 3 THEN 1 END)::int',
                'thang4'  => 'sum(CASE  WHEN thang = 4 THEN 1 END)::int',
                'thang5'  => 'sum(CASE  WHEN thang = 5 THEN 1 END)::int',
                'thang6'  => 'sum(CASE  WHEN thang = 6 THEN 1 END)::int',
                'thang7'  => 'sum(CASE  WHEN thang = 7 THEN 1 END)::int',
                'thang8'  => 'sum(CASE  WHEN thang = 8 THEN 1 END)::int',
                'thang9'  => 'sum(CASE  WHEN thang = 9 THEN 1 END)::int',
                'thang10' => 'sum(CASE  WHEN thang = 10 THEN 1 END)::int',
                'thang11' => 'sum(CASE  WHEN thang = 11 THEN 1 END)::int',
                'thang12' => 'sum(CASE  WHEN thang = 12 THEN 1 END)::int',
            ]
        )->from(['tb' => $q1])
            ->groupBy(new Expression('1,2'))
            ->leftJoin(['bv' => $q2], 'bv.benhvien = tb.donvi_gui')
            ->orderBy('donvi_gui')
        ;

        return $this->asJson([
            'data' => $q3->all()
        ]);
    }
}
<?php
namespace modules\pcd\pt_nguyco\controllers;
use common\controllers\BackendController;
use modules\pcd\pt_nguyco\forms\ThongkeForm;
use yii\db\Expression;
use yii\db\Query;

class ThongkeController extends BackendController {
    public function actionIndex(){
        $model = new ThongkeForm();
        return $this->render('index', compact('model'));
    }

    public function actionLoaihinh(){
        $year = request('year', date('Y'));

        $q1 = (new Query)
            ->select([
                'loaihinh',
                'count(*)'
            ])
            ->from(['dnc' => 'pt_nguyco'])
            ->andWhere('loaihinh IS NOT NULL')
            ->groupBy(new Expression('1'))
        ;
        return $this->asJson([
            'data' => $q1->all()
        ]);
    }

    public function actionXuphat(){
        $year = request('year');
        $year = $year ? $year : date('Y');

        $q1 = (new Query)
            ->select(['pt_nguyco_id', 'thang' => new Expression('date_part(\'month\', ngayxuphat)')])
            ->from('phieu_gs')
            ->andWhere('ngayxuphat IS NOT NULL')
            ->andWhere('date_part(\'year\', ngayxuphat) = \''.$year.'\'')
        ;
        $q2 = (new Query)->select([
            'maquan' => 'dnc.maquan',
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
            ->groupBy('dnc.maquan')
        ;
        $q3 = (new Query)->select('tenquan, hc.maquan, xp.thang1, xp.thang2, xp.thang3, xp.thang4, xp.thang5, xp.thang6, xp.thang7, xp.thang8, xp.thang9, xp.thang10, xp.thang11, xp.thang12')->from(['hc' => 'hc_quan'])
            ->leftJoin(['xp' => $q2], 'xp.maquan = hc.maquan')
            ->orderBy('hc.order')
        ;

        return $this->asJson([
            'data' => $q3->all()
        ]);
    }
}
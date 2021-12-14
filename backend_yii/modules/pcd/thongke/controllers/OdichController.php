<?php
namespace modules\pcd\thongke\controllers;

use common\controllers\BackendController;
use modules\pcd\thongke\forms\OdichTkForm;
use yii\db\Expression;
use yii\db\Query;

class OdichController extends BackendController {
    public function actionIndex(){
        $model = new OdichTkForm();
        return  $this->render('index', compact('model'));
    }

    public function actionPhantich(){
        $year = request('year', date('Y'));
        $od = (new Query)->select([
            'od.id',
            'num_sxh' => "SUM(CASE WHEN resource_type = 'sxh' THEN 1 END)::int",
            'num_dnc' => "SUM(CASE WHEN resource_type = 'dnc' THEN 1 END)::int",
        ])
            ->from(['od' => 'odich_sxh'])
            ->leftJoin(['cb' => 'odich_sxh_poly'], 'od.id = cb.odich_id')
            ->andFilterWhere(["date_part('year', od.ngayphathien)" => $year])
            ->groupBy(new Expression('1'))
        ;
        $od = $od->all();

        return $this->asJson([
            'data' => $od
        ]);
    }
}
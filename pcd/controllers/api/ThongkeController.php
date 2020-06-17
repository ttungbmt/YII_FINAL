<?php
namespace pcd\controllers\api;

use common\controllers\MyApiController;
use common\modules\auth\models\UserInfo;
use pcd\models\Cabenh;
use pcd\models\CabenhSxh;
use pcd\models\Danso;
use pcd\models\Thongke;
use pcd\supports\RoleHc;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use common\models\Query;
use yii\db\Expression;

class ThongkeController extends MyApiController
{
    public function actionThongke($type){
        $tbThongke = CabenhSxh::tableName();

        $role = RoleHc::init();
        $dmPhuong = HcPhuong::find()->orderBy('order');
        $dmQuan = HcQuan::find()->orderBy('order');
        $role->filterCabenh($dmPhuong);

        $dmPhuong = $dmPhuong->asArray()->pluck('tenphuong', 'maphuong');
        $dmQuan = $dmQuan->asArray()->pluck('tenquan', 'maquan');

        if(hasRoles('admin')){
            $dm = $dmQuan;
            $fieldGroup = 'maquan';
        } elseif (role('quan')){
            $dm = $dmPhuong;
            $fieldGroup = 'maphuong';
        } elseif (role('phuong')){
            $listKP = (new Query())
                ->select('DISTINCT(khupho)')
                ->from($tbThongke)
                ->where(['maphuong' => (string)userInfo()->ma_phuong])
                ->orderBy('khupho')
            ;
            $dm = collect($listKP->all())->forget(null)->pluck('khupho', 'khupho');
            $fieldGroup = 'khupho';
        }

        $model = (new Query())
            ->select('count(*), loaidieutra')
            ->from($tbThongke)
            ->groupBy('loaidieutra');

        if($date_from = request()->get('date_from')){
            $model->andWhere(['>=', new Expression("ngaybaocao"), dateToDb($date_from)]);
        } else {
            $model->andWhere(['>=', new Expression("ngaybaocao"), '2019-01-01']);
        }

        if($date_to = request()->get('date_to')){
            $model->andWhere(['<=', new Expression("ngaybaocao"), dateToDb($date_to)]);
        }

        $model
            ->addSelect($fieldGroup)->addGroupBy($fieldGroup);

        $role->filterCabenh($model, 0);

        $model = collect($model->all());


        $data = $model->map(function($item) use ($fieldGroup){
            $name = trim($item[$fieldGroup]);
            $item[$fieldGroup] = $name;
            if($item[$fieldGroup] == ""){
                $item[$fieldGroup] = null;
            }
            return $item;
        })
            ->groupBy($fieldGroup)
            ->map(function ($item, $k) {
                return collect($item)
                    ->groupBy('loaidieutra')
                    ->map(function ($item, $k) {
                        return collect($item)->sum('count');
                    });
            });


        $tk_dieutra = $dm
            ->map(function ($item, $k) use ($data, $fieldGroup) {
                $val = $data->get($k);
                return [
                    'field' => $fieldGroup,
                    'ten' => $item,
                    'da_dt' => $dadt = data_get($val, 3, 0),
                    'dang_dt' => $dangdt = data_get($val, 1, 0),
                    'chua_xv' => $chuaxv = data_get($val, 2, 0),
                    'chua_dt' => $chuadt = data_get($val, 0, 0),
                    'total' => $dadt + $dangdt + $chuaxv + $chuadt,
                ];
            });

//        dd($tk_dieutra, $data, $dm);


        $model2 = (new Query())
            ->select('loaicabenh, count(*)')
            ->from($tbThongke)
            ->andWhere(['>=', new Expression("ngaybaocao"), '2019-01-01'])
            ->groupBy('loaicabenh');

        $model2->addSelect($fieldGroup)->addGroupBy($fieldGroup);

        $role->filterCabenh($model2, 0);

        $data2 = collect($model2->all())
            ->groupBy($fieldGroup)
            ->map(function ($item, $k) {
                return collect($item)
                    ->groupBy('loaicabenh')
                    ->map(function ($item, $k) {
                        return collect($item)->sum('count');
                    });
            });

        $tk_chuyenca = $dm
            ->map(function ($item, $k) use ($data2, $fieldGroup) {
                $val = $data2->get($k);
                return [
                    'field' => $fieldGroup,
                    'ten' => $item,
                    'ca_tp' => $ca_tp = data_get($val, 0, 0),
                    'ca_nhan' => $ca_nhan = data_get($val, 1, 0),
                    'ca_chuyen' => $ca_chuyen = data_get($val, 2, 0),
                    'ca_phcd' => $ca_phcd = data_get($val, 3, 0),
                    'total' => $ca_tp + $ca_nhan + $ca_chuyen + $ca_phcd,
                ];
            });

        $model3 = (new Query())
            ->select('count(*), loai_xm')
            ->from('v_xacminh_cb')
            ->andWhere(['>=', 'ngaybaocao', '2019-01-01'])
            ->groupBy('loai_xm');


        $model3->addSelect($fieldGroup)->addGroupBy($fieldGroup);
        $role->filterCabenh($model3, 0);


        $data3 = (new Query())->select([
            'cdc_cbn' => 'COUNT(CASE WHEN loai_xm_cb IN(7,8) THEN 1 END)',
            'cdc_kbn' => 'COUNT(CASE WHEN loai_xm_cb IN(4,5,6) THEN 1 END)',
            'kdc_kbn' => 'COUNT(CASE WHEN loai_xm_cb IN(1,2,3) THEN 1 END)',
        ])
            ->from('cabenh_sxh')
            ->andWhere(['>=', 'ngaybaocao', '2019-01-01'])
            ->addSelect($fieldGroup)->addGroupBy($fieldGroup)
        ;
        $role->filterCabenh($data3, 0);
        $data3 = collect($data3->all());

        $tk_xacminh = collect($dm)->map(function ($name, $k) use($data3, $fieldGroup){
            $val = $data3->firstWhere($fieldGroup, $k);
            return [
                'field' => $fieldGroup,
                'ten' => $name,
                'cdc_cbn' => $cdc_cbn = data_get($val, 'cdc_cbn', 0),
                'cdc_kbn' => $cdc_kbn = data_get($val, 'cdc_kbn', 0),
                'kdc_kbn' => $kdc_kbn = data_get($val, 'kdc_kbn', 0),
                'total' => $cdc_cbn + $cdc_kbn + $kdc_kbn,
            ];
        });

        if($type == 'dieutra') {
            return $this->renderPartial('_dieutra', [
                'tk_dieutra' => $tk_dieutra,
            ]);
        } elseif($type == 'xacminh') {
            return $this->renderPartial('_xacminh', [
                'tk_xacminh' => $tk_xacminh,
            ]);
        } elseif($type == 'chuyenca') {
            return $this->renderPartial('_chuyenca', [
                'tk_chuyenca' => $tk_chuyenca,
            ]);
        }

        return $this->renderPartial('thongke', [
            'tk_dieutra' => $tk_dieutra,
            'tk_xacminh' => $tk_xacminh,
            'tk_chuyenca' => $tk_chuyenca,
        ]);
    }



    public function actionSoca(){
        $type = request('type', 'other');

        $k = 'maquan';
        $t = 'tenquan';
        $tb = 'hc_quan';
        $date_from = request('date_from', '01-01-2016');
        $date_to = request('date_to', '01-01-2018');
        $ys = range($date_from, $date_to);

        $ngaybc = new Expression('EXTRACT(YEAR FROM ngaybaocao)');

        $dm_hc = (new Query())->select(['ma_hc' => $k, 'ten_hc' => $t, 'geometry' => new Expression('ST_AsGeoJSON(geom)')])->from($tb)->orderBy('order')->all();
        $q1 = Danso::find();
        $q2 = Cabenh::find();

        if($type == 'year'){
            $group_fn = ['ma_hc', function ($i) {return $i['nam'];}];

            $q1->andFilterWhere(['in', 'nam', $ys]);
            $q2->select(['ma_hc' => 'ma_quan', 'nam' => $ngaybc, 'count(*)'])
                ->andFilterWhere(['in', $ngaybc, $ys])
                ->groupBy(new Expression('1,2'));

        } else {
            $group_fn = ['ma_hc'];
            $q1->select(['ma_hc', 'danso' => new Expression('SUM(danso)')])->groupBy('ma_hc');

            if($date_from){$q1->andFilterWhere(['>=', 'nam', new Expression("EXTRACT(YEAR FROM '{$date_from}'::date)")]);}
            if ($date_to){$q1->andFilterWhere(['<=', 'nam', new Expression("EXTRACT(YEAR FROM '{$date_to}'::date)")]);}

            $q2->select(['ma_hc' => 'ma_quan', 'count(*)'])
                ->andFilterDate(['ngaybaocao' => [$date_from, $date_to]])
                ->groupBy(new Expression('1'));
        }


        $danso = collect($q1->asArray()->all())->groupBy($group_fn);
        $sc = collect($q2->asArray()->all())->groupBy($group_fn);

        $data = [];
        foreach ($dm_hc as $hc){
            $k = $hc['ma_hc'];
            $data[$k] = [
                'ma_hc' => $hc['ma_hc'],
                'ten_hc' => $hc['ten_hc'],
                'geometry' => json_decode($hc['geometry'])
            ];

            if($type == 'year'){
                foreach ($ys as $y){
                    $count = data_get($sc, "{$k}.{$y}.0.count"); $pop = data_get($danso, "{$k}.{$y}.0.danso"); $cp = $pop ? ($count ? round(($count/$pop)*100000) : '') : '';

                    $data[$k]['items'][$y] = [
                        'nam' => $y,
                        'count' => $count,
                        'pop' => $pop,
                        'cp' => $cp,
                    ];
                }
            } else {
                $count = data_get($sc, "{$k}.0.count"); $pop = data_get($danso, "{$k}.0.danso"); $cp = $pop ? ($count ? round(($count/$pop)*100000) : '') : '';
                $data[$k] = array_merge($data[$k], [
                    'count' => $count,
                    'pop' => $pop,
                    'cp' => $cp,
                ]);
            }
        }


        return [
            'type' => $type,
            'ys' => $ys,
            'data' => $data
        ];
    }
}
<?php
namespace pcd\controllers\api;

use Carbon\Carbon;
use common\controllers\MyApiController;
use common\modules\auth\models\UserInfo;
use pcd\models\Cabenh;
use pcd\models\CabenhSxh;
use pcd\models\Chuyenca;
use pcd\models\Danso;
use pcd\models\Thongke;
use pcd\modules\dm\models\DmKhupho;
use pcd\supports\RoleHc;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use common\models\Query;
use yii\db\Expression;

class ThongkeController extends MyApiController
{
    public function actionThongke($type){
        $role = RoleHc::init();
        $date_from = request()->get('date_from', Carbon::create(2020,1,1)->format('d/m/Y'));
        $date_to = request()->get('date_to', date('d/m/Y'));

        $field_px = ['label' => 'Phường xã', 'table' => HcPhuong::tableName(), 'code' => 'maphuong', 'name' => 'tenphuong', 'chuyen' => 'px_chuyen', 'nhan' => 'px_nhan', 'order' => 'order'];

        if(role('phuong')){
            $field = ['label' => 'Khu phố/ấp', 'table' => DmKhupho::tableName(), 'code' => 'khupho', 'name' => 'khupho', 'chuyen' => 'px_chuyen', 'nhan' => 'px_nhan', 'order' => 'khupho'];
        } elseif (role('quan')){
            $field = $field_px;
        } else {
            $field = ['label' => 'Quận huyện', 'table' => HcQuan::tableName(), 'code' => 'maquan', 'name' => 'tenquan', 'chuyen' => 'qh_chuyen', 'nhan' => 'qh_chuyen', 'order' => 'order'];
        }

        $q_fn = function ($query) use($role, $field, $date_from, $date_to){
            $query->andFilterDate(['ngaybaocao' => [$date_from, $date_to]]);
            $role->filterMaHc($query);


            $q = (new Query())->from(['hc' => $field['table']])
                ->select([
                    'code' => $field['code'],
                    'name' => $field['name'],
                    'tk.*'
                ])
                ->leftJoin(['tk' => $query], "hc.{$field['code']} = tk.code")
                ->orderBy('hc.'.$field['order']);

            $role->filterMaHc($q);

            $data = collect($q->all());

            if(role('phuong')){
                $kro = collect($query->all())->firstWhere('code', null);
                $data->push(array_merge($kro ? $kro : [],['name' => 'Không rõ', 'code' => 'KHONG RO']));
            }

            return $data;
        };

        $q_dt = (new Query())
            ->select([
                'code' => $field['code'],
                'da_dt' => 'SUM( CASE WHEN loaidieutra = 3 THEN 1 END )',
                'dang_dt' => 'SUM( CASE WHEN loaidieutra = 1 THEN 1 END )',
                'chua_xv' => 'SUM( CASE WHEN loaidieutra = 2 THEN 1 END )',
                'chua_dt' => 'SUM( CASE WHEN loaidieutra = 0 THEN 1 END )',
            ])
            ->from(CabenhSxh::tableName())
            ->groupBy(new Expression('1'))
        ;

        $q_xm = (new Query())->from(CabenhSxh::tableName())
            ->select([
                'code' => $field['code'],
                'cdc_cbn' => 'COUNT(CASE WHEN loai_xm_cb IN(7,8) THEN 1 END)',
                'cdc_kbn' => 'COUNT(CASE WHEN loai_xm_cb IN(4,5,6) THEN 1 END)',
                'kdc_kbn' => 'COUNT(CASE WHEN loai_xm_cb IN(1,2,3) THEN 1 END)',
            ])->groupBy(new Expression('1'))
        ;

        $q_chuyen = (new Query())->select(['code' => $field['chuyen'], 'total' => 'COUNT(DISTINCT cabenh_id)',])
            ->from(['cc' => Chuyenca::tableName()])->groupBy(new Expression('1'))
            ->leftJoin(['cb' => CabenhSxh::tableName()], "cb.gid = cc.cabenh_id")
            ->andFilterDate(['ngaybaocao' => [$date_from, $date_to]]);

        !role('phuong') && $role->filterMaHc($q_chuyen);

        $q_nhan = (new Query())->select(['code' => $field['nhan'], 'total' => 'COUNT(DISTINCT cabenh_id)',])
            ->from(['cc' => Chuyenca::tableName()])->groupBy(new Expression('1'))
            ->leftJoin(['cb' => CabenhSxh::tableName()], "cb.gid = cc.cabenh_id")
            ->andFilterDate(['ngaybaocao' => [$date_from, $date_to]]);
        !role('phuong') && $role->filterMaHc($q_nhan);

        $field_cc = role('phuong') ? $field_px : $field;
        $q_cc =  (new Query())->select([
            'code' => $field_cc['code'],
            'name' => $field_cc['name'],
            'chuyen' => 'c.total',
            'nhan' => 'n.total',
        ])
            ->from(['hc' => $field_cc['table']])
            ->leftJoin(['c' => $q_chuyen], "hc.{$field_cc['code']} = c.code")
            ->leftJoin(['n' => $q_nhan], "hc.{$field_cc['code']} = n.code")
            ->orderBy('hc.'.$field_cc['order']);
        $role->filterMaHc($q_cc);

//        dd($q_fn($q_dt)->createCommand()->getRawSql());

        $tk_dieutra = collect($q_fn($q_dt));
        $tk_xacminh = collect($q_fn($q_xm));
        $tk_chuyenca = collect($q_cc->all());

        return $this->renderPartial('thongke', [
            'field' => $field,
            'field_cc' => $field_cc,
            'tk_dieutra' => $tk_dieutra,
            'tk_xacminh' => $tk_xacminh,
            'tk_chuyenca' => $tk_chuyenca,
            'date_from' => $date_from,
            'date_to' => $date_to,
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
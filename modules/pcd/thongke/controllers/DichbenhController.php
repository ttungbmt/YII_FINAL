<?php
namespace modules\pcd\thongke\controllers;

use common\controllers\BackendController;
use modules\pcd\thongke\forms\DichbenhTkForm;
use pcd\models\Danso;
use pcd\models\HcQuan;
use yii\db\Expression;
use yii\db\Query;

class DichbenhController extends BackendController {
    public function actionIndex()
    {
        $model = new DichbenhTkForm();
        return $this->render('index', compact('model'));
    }

    protected function formatReq($p){
        $formatFn = function ($p1){ return array_filter(array_map('trim', $p1));};

        if(is_string($p)) return $formatFn(explode(',', $p));
        return $formatFn($p);
    }

    public function actionByYear(){
        $dulieu =  request('dulieu');
        $loaibenh = request('loaibenh');
        $nams = $this->formatReq(request('nams'));

        $qh = HcQuan::find()->orderBy('order')->pluck('tenquan', 'maquan')->all();
        $ds = Danso::find()->andFilterWhere(['nam' => $nams])->indexBy('ma_hc')->asArray()->all();
        $benh = (new Query)->select('maquan, hinhthuc_dt')
            ->andFilterWhere(['chuandoan_bd' => $loaibenh])
            ->andFilterWhere(['date_part(\'year\', ngaynhapvien)' => $nams])
            ->groupBy(new Expression('1, 2'));

        if($nams){
            $benh = $benh->addSelect(['nam' => new Expression('extract(year from ngaynhapvien)')])->addGroupBy(new Expression('3'));
        }
        $benh = $benh->addSelect('count(*)')->from('dichbenh');
        $benh = collect($benh->all())->groupBy('maquan');


        $data = collect($qh)->map(function ($v, $k) use($benh, $nams, $ds, $dulieu){
            $resp = [
                'maquan' => (string)$k,
                'tenquan' => $v,
            ];

            $stat = $benh->get($k);

            $fn = function ($value, $name, $nams = null) use ($stat, $ds, $dulieu) {
                if($value) {
                    $d = $value->where('hinhthuc_dt', $name);
                    if($nams) $d = $d->where('nam', $nams);
                    $v1 = $d->first();
                    $maquan = data_get($v1, 'maquan');
                    $ds_q = data_get($ds, "{$maquan}.danso");
                    $count = (int)data_get($v1, 'count', 0);
                    $value = ($dulieu == '1k_dan') ?  ($ds_q == 0 ? 0 : round(($count/$ds_q)*100000)) : $count;
                    return $value;
                }
                return 0;
            };

            if($nams){
                if(!$stat) {
                    $ns = array_map(function ($v){ return ['nam' => $v, 'dt_noi' => 0, 'dt_ngoai' => 0, 'ravien' => 0];}, $nams);
                    return array_merge($resp, ['nam' => $ns]);
                };

                $resp['nam'] = $stat->sortBy('nam')->groupBy('nam')->map(function ($v, $k) use($fn){
                    return [
                        'nam' => (string)$k,
                        'dt_noi' => $fn($v, 'Điều trị nội trú', $k),
                        'dt_ngoai' => $fn($v, 'Điều trị ngoại trú', $k),
                        'ravien' => $fn($v, 'Ra viện', $k)
                    ];
                })->values();
                return $resp;
            }
            $resp['dt_noi'] = $fn($stat, 'Điều trị nội trú');
            $resp['dt_ngoai'] = $fn($stat, 'Điều trị ngoại trú');
            $resp['ravien'] = $fn($stat, 'Ra viện');

            return $resp;
        })->values();

        return $this->asJson([
            'data' => $data,
            'nams' => $nams
        ]);
    }

    public function actionByMonth(){
        // required nam

        $loaibenh = request('loaibenh');
        $dulieu =  request('dulieu');
        $nam =  request('nam') ? request('nam') : null;
        $thangs =  $this->formatReq(request('thangs'));
        $qh = HcQuan::find()->orderBy('order')->pluck('tenquan', 'maquan')->all();
        $ds = Danso::find()->andWhere(['nam' => $nam])->indexBy('ma_hc')->asArray()->all();

        $resp = (new Query)->select('maquan, extract(month from ngaynhapvien) as thang, count(*)')
            ->groupBy(new Expression('1,2'))
            ->orderBy(new Expression('maquan, thang'))
            ->andFilterWhere(['chuandoan_bd' => $loaibenh])
            ->from('dichbenh');

        $resp->andFilterWhere([
            'extract(year from ngaynhapvien)' => $nam,
            'extract(month from ngaynhapvien)' => $thangs,
        ]);

        $resp = collect($resp->all());

        $data = collect($qh)->map(function ($v, $maquan) use($resp, $thangs, $ds, $dulieu){
            $maquan = (string)$maquan;
            $d = [
                'maquan' => $maquan,
                'tenquan' => $v,
            ];
            $ds_q = data_get($ds, "{$maquan}.danso");
            $d['ds_q'] = (int)$ds_q;

            $d['thangs'] = collect($thangs)->map(function ($v) use($resp, $maquan, $ds_q, $dulieu){
                $d = $resp->where('maquan', $maquan)->where('thang', $v)->first();
                $count = (int)data_get($d, 'count');
                $value = ($dulieu == 'cabenh') ?  $count : round(($count/$ds_q)*100000);
                return ['thang' => data_get($d, 'thang'), 'count' => $value, 'total' => $count, 'ds' => $ds_q];
            })->all();
            return $d;
        })->values();

        return $this->asJson([
            'data' => $data,
            'thangs' => $thangs,
            'nam' => $nam
        ]);
    }
}
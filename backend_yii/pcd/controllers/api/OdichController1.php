<?php
namespace pcd\controllers\api;

use common\controllers\MyApiController;
use pcd\models\CabenhSxh;
use pcd\models\CabenhSxhNn;
use yii\db\Query;
use Carbon\Carbon;
use pcd\supports\RoleHc;
use yii\db\Expression;

class OdichController extends MyApiController
{
    public function actionTimCabenh(){
        return [];
    }


    public function actionToAh(){
        $ids = request('cabenhIds');
        $distance = request('distance', 200);
        $q_cb = (new Query())->select(new Expression("ST_Union(ST_Buffer(geom::geography, {$distance})::geometry)"))->from('cabenh')->andFilterWhere(['macabenh' => $ids])->createCommand()->getRawSql();
        $to_ah = (new Query())->select('khupho, tento, tenphuong, tenquan, maphuong, maquan')->from(['ranh_to'])
            ->where("ST_Intersects(({$q_cb}), geom)")
            ->all()
        ;

        return [
            'html' => $this->renderPartial('to_ah', ['to_ah' => $to_ah])
        ];
    }

    public function actionTimOdich($table = 'cabenh_sxh')
    {
        $table = request('table') ? 'cabenh_sxh_nn_copy1' : $table;
        if(role('admin') && $table === 'cabenh_sxh'){
            return [];
        } elseif (!role('admin') && $table ==='cabenh_sxh_nn'){
            return [];
        }

        $request = request();
        $date_from = $request->post('ngmacbenh_from');
        $date_to = $request->post('ngmacbenh_to', date('d/m/Y'));
        $loaibenh = $request->post('loaibenh', []);
        $day1 = $request->post('day1', 14);
        $day2 = $request->post('day2', 30);
        $radius = $request->post('distance', 200);

        list($distanceAlias, $dayAlias) = ['distance', 'day'];
        list($numday, $distance) = ['abs(sxh1.ngaymacbenh_nv - sxh2.ngaymacbenh_nv)', 'ST_Distance([[sxh1.geom]]::geography, [[sxh2.geom]]::geography)'];
        $ids = collect();
        $dataMap = collect();
        $odich = collect();

        foreach (range(1, 100) as $val) {
            $query = (new Query())
                ->select(['sxh1.gid id1', 'sxh2.gid id2', $distanceAlias => $distance, $dayAlias => $numday, 'date1' => 'sxh1.ngaymacbenh_nv', 'date2' => 'sxh2.ngaymacbenh_nv']);

            if ($val == 1) {
                $query = $query->from(['sxh1' => $table, 'sxh2' => $table])
                    ->andWhere(['<=', $numday, $day1])
                    ->andWhere(['BETWEEN', 'sxh1.ngaymacbenh_nv', $date_from, $date_to])
                    ->andWhere(['BETWEEN', 'sxh2.ngaymacbenh_nv', $date_from, $date_to])
                    ->andWhere('sxh2.ngaymacbenh_nv > sxh1.ngaymacbenh_nv')
                ;

                if (role('phuong')) {
                    $query->andWhere(['sxh1.maphuong' => userInfo()->ma_phuong]);
                } else if (role('quan')) {
                    $query->andWhere(['sxh1.maquan' => userInfo()->ma_quan]);
                }

            } else {
                $subQuery = (new Query())->select('gid, ngaymacbenh_nv, geom')
                    ->from($table)->andWhere(['gid' => $ids]);
                $query = $query
                    ->from(['sxh1' => $subQuery, 'sxh2' => $table])
                    ->andWhere(['<=', $numday, $day2])
                    ->andWhere(['BETWEEN', 'sxh1.ngaymacbenh_nv', $date_from, $date_to])
                    ->andWhere(['BETWEEN', 'sxh2.ngaymacbenh_nv', $date_from, $date_to])
                    ->andWhere('sxh2.ngaymacbenh_nv > sxh1.ngaymacbenh_nv')
                ;
            }

//            if (in_array('sxh', $loaibenh)) {
//                $query->andWhere('sxh1.cdc_cbn_sxh = 1 AND sxh2.cdc_cbn_sxh = 1');
//            }

            $query->andWhere('sxh1.gid <> sxh2.gid')
                ->andWhere("ST_DWithin (sxh1.geom::geography, sxh2.geom::geography, {$radius})")
                ->orderBy(['sxh1.ngaymacbenh_nv' => SORT_ASC, 'sxh2.ngaymacbenh_nv' => SORT_ASC]);


            $q = collect($query->all());

            $data = $q->pluck('id1')->concat($q->pluck('id2'))->unique();
            $tmp = $ids->concat($data)->unique();

            if (
                $tmp->count() == $ids->count()
                && !empty($ids)
            ) {
                break;
            }

            $ids = $tmp;
            $dataMap = $dataMap->push($q);
        }

//        $dataMap = session()->set('od', $dataMap);
//        $ids = session()->set('ids', $ids);
//        $dataMap = session()->get('od');
//        $ids = session()->get('ids');

        $odich_1 = $dataMap->first();
//        $this->kptp = session()->get('kptp');
        $odich_n = $dataMap->last();

        $cabenhs = collect(($table == 'cabenh_sxh_nn' ? CabenhSxhNn::className() : CabenhSxh::className())::find()->where(['gid' => $ids])
            ->indexBy('gid')->all())->map(function ($i) {return $i->toArray(
            ['hoten', 'ngaymacbenh_nv', 'gid']
        );});

//        dd($this->buildFirstOd($odich_1, $odich_n, $cabenh));
//        dd($this->buildOdich($odich_1));

        return [
            'cabenhs' => $cabenhs,
//            'odichs'  => $this->buildOdich($odich_n),
            'odichs'  => $this->buildOdNew($dataMap, $cabenhs),
//            'odichs'  => $this->oDichBuild($odich_1, $dataMap, $cabenhs, $radius),
        ];
    }

    protected function uniqueMap($map, $name1 = 'id1', $name2 = 'id2'){
        return $map->pluck($name1)->merge($map->pluck($name2)->all())->unique();
    }

    protected function buildOdNew($dataMap, $cb){
        $dmap = collect($dataMap->first());
        $od = collect();
        $i = 0;

        $ids = $this->uniqueMap($dmap);

        foreach ($ids as $h => $v){
            if($od->isEmpty()){
                $idxs = $dmap->where('id1', $v);
                $idxs = $this->uniqueMap($idxs);
                $od->push($idxs->all());
            } else {
                $idxs = $dmap->where('id1', $v);
                $idxs = $this->uniqueMap($idxs);
                foreach ($od as $k => $s) {
                    if(collect($s)->intersect($idxs)){
                        $new = collect($od->get($k))->merge($idxs)->unique()->all();
                        $od->put($k, $new);
                    }
                }
            }
        }
        $od_new = [];
        foreach ($od as $o => $i){
            $od_new[] = $this->loopOd($i, $cb, $dataMap->last());
        }

        return $od_new;
    }

    public function loopOd($od, $cb, $lastMap){
        $od = collect($od);
        $lastMap->push(['id1' => 6, 'id2' => 7]);
        $cb_add = $this->uniqueMap($lastMap)->diff($od);
        foreach ($cb_add as $k => $i){
            $id1 = $lastMap->where('id1', $i)->pluck('id2');
            $id2 = $lastMap->where('id2', $i)->pluck('id1');
            $m = $id1->merge($id2)->unique()->filter(function ($item) use($i){return $i != $item;});
            if($m->intersect($od)){
                $od->push($i);
            }
        }
        return $od->all();
    }

    protected function parseOd2Cb($od, $cb){
        return collect($od)->map(function ($d, $k1) use ($cb) {
            return [
                'id'      => $k1,
                'cabenhs' => collect($d)->map(function ($s, $k2) use ($cb) {
                    return [
                        'id'     => $s,
                        'date'   => data_get($cb, "{$s}.ngaymacbenh_nv"),
                        'nearby' => [

                        ]
                    ];
                })
            ];
        });
    }

    protected function buildFirstOd($dataMap, $map_n, $cb)
    {
        foreach ($dataMap as $h => $v) {
            if (empty($od)) {
                // Chưa có ổ dịch, tạo ổ mới
                $od[$i][] = $v['id1'];
                $od[$i][] = $v['id2'];

            } else {
                foreach ($od as $k => $s) {
                    if (in_array($v['id1'], $s) && !in_array($v['id2'], $s)) {
                        $od[$k][] = $v['id2'];
                        $od[$k] = array_unique($od[$k]);
                    } elseif (!in_array($v['id1'], $s) && in_array($v['id2'], $s)) {
                        $od[$k][] = $v['id1'];
                        $od[$k] = array_unique($od[$k]);
                    }
                }

                $check = [];
                foreach ($od as $k => $s) {
                    if (!in_array($v['id1'], $s) && !in_array($v['id2'], $s)) {
                        $check[] = true;
                    }
                }

                if (count($check) === count($od)) {
                    $i++;
                    $od[$i][] = $v['id1'];
                    $od[$i][] = $v['id2'];
                    $od[$i] = array_unique($od[$i]);
                }

            }
        }


        foreach ($od as $k => $d1) {
            foreach ($map_n as $m) {
                if (in_array($m['id1'], $d1) && !in_array($m['id2'], $d1)) {
                    $od[$k][] = $m['id2'];
                    $od[$k] = array_unique($od[$k]);
                } elseif (!in_array($m['id1'], $d1) && in_array($m['id2'], $d1)) {
                    $od[$k][] = $m['id1'];
                    $od[$k] = array_unique($od[$k]);
                }
            }
        }

        $od = collect($od)->map(function ($d, $k1) use ($cb) {
            return [
                'id'      => $k1,
                'cabenhs' => collect($d)->map(function ($s, $k2) use ($cb) {
                    return [
                        'id'     => $s,
                        'date'   => data_get($cb, "{$s}.ngaymacbenh_nv"),
                        'nearby' => [

                        ]
                    ];
                })
            ];
        });

        return $od;
    }

    protected function getKhoiphat($data)
    {
        $kp = [];
        $tp = [];

        foreach ($data as $i) {
            $cb = $i['cabenhs']->sortBy('date')->slice(0, 2)->keys();
            array_push($kp, $cb->first());
            array_push($tp, $cb->last());
        }

        return [
            'khoiphat' => $kp,
            'thuphat'  => $tp,
        ];
    }

    protected function buildOdich($dataMap)
    {

        $odich = collect([]);
        $data = collect($dataMap)->recursive()->sortBy('day');

        $incre = 1;

        $data->map(function ($item, $k) use ($data, $odich, &$incre) {
            $od = $odich->pluck('cabenhs')->collapse()->pluck('id');

            list($id1, $id2) = [$item->get('id1'), $item->get('id2')];

            $data = collect([
                ['id'     => $id1, 'date' => from_db_date($item->get('date1')),
                 'nearby' => $this->getNearby($id1, $data)
                ],
                ['id'     => $id2, 'date' => from_db_date($item->get('date2')),
                 'nearby' => $this->getNearby($id2, $data)
                ],
            ]);
            $inter = $data->pluck('id')->intersect($od);

            if ($inter->isEmpty()) {
                // Tạo mới ỏ dịch

                $odich = $odich->put($incre, [
                    'id'      => $incre,
                    'cabenhs' => $data->indexBy('id')
                ]);

                $incre = $incre + 1;
            } else {
                // Tìm ổ dịch
                $fobj = $inter->first();
                $res = $odich->filter(function ($i) use ($fobj) {
                    return collect($i)->get('cabenhs')->pluck('id')->contains($fobj);
                });

                $fodich = collect($res->first());
                $id = $fodich->get('id');

                $odich = $odich->put(
                    $id,
                    ['id' => $id, 'cabenhs' => $fodich->get('cabenhs')->concat($data)->unique('id')->indexBy('id')]
                );
            }
        });

        return $odich;
    }


    protected function getNearby($id, $data)
    {
        $res = $data
            ->filter(function ($item) use ($id) {
                return $item->get('id1') == $id || $item->get('id2') == $id;
            })
            ->map(function ($item) use ($id) {
                return [
                    'id'       => $id == $item->get('id1') ? $item->get('id2') : $item->get('id1'),
                    'distance' => $item->get('distance'),
                    'day'      => $item->get('day')
                ];
            });
        return $res->unique('id')->indexBy('id')->all();
    }

    protected function getNearbySub($id, $data, $key)
    {
        $res = $data
            ->filter(function ($item) use ($id, $key) {
                if($key != $id) {
                    return $item['id1'] == $id || $item['id2'] == $id;
                } else {
                    return ($item['id1'] == $id || $item['id2'] == $id) && $item['day'] <= 14 ;
                }

            })
            ->map(function ($item) use ($id) {
                return [
                    'id'       => $id == $item['id1'] ? $item['id2'] : $item['id1'],
                    'distance' => $item['distance'],
                    'day'      => $item['day']
                ];
            });
        return $res->unique('id')->indexBy('id')->all();
    }

    protected function oDichBuild($odich_1, $dataMap, $cabenh, $radius)
    {

        $dataCollapse = collect($dataMap)->collapse()->sortBy('day');
        $arrId = [];
        $odichTest = [];
        if (empty($odich_1)) return [];

        foreach ($odich_1 as $key => $od) {
            if (in_array($od['id1'], $arrId) || in_array($od['id2'], $arrId)) {
            } else {
                array_push($arrId, $od['id1'], $od['id2']);
                array_push($odichTest, [
                    $od['id1'] => ['id' => $od['id1'], 'day' => $od['date1']],
                    $od['id2'] => ['id' => $od['id2'], 'day' => $od['date2']]
                ]);
            }
        }

        foreach ($dataMap as $k => $data) {
            if ($k != 0) {
                foreach ($data as $cb) {

                    //Xác định ca bệnh có thể liên quan tới những ổ dịch nào?
                    $timeMin = [];
                    foreach ($odichTest as $key => $od) {
                        if (((in_array($cb['id1'], array_keys($od)) && !in_array($cb['id2'], $od)) ||
                                (!in_array($cb['id1'], array_keys($od)) && in_array($cb['id2'], $od))) &&
                            $cb['date1'] >= array_values($od)[0]['day']) {
                            $timeMin[$key] = $cb['day'];
                        }
                    }

                    //Thêm ca bệnh vào ổ dịch có ngày gần nhất
                    if ($timeMin) {
                        $stt = array_keys($timeMin, min($timeMin));
                        if (in_array($cb['id1'], array_keys($odichTest[$stt[0]]))) {
                            $odichTest[$stt[0]][$cb['id2']] = [
                                'id' => $cb['id2'],
                                'day' => $cb['date2']
                            ];
                        } else {
                            $odichTest[$stt[0]][$cb['id1']] = [
                                'id' => $cb['id1'],
                                'day' => $cb['date1']
                            ];
                        }
                    }

                    //Tìm tổ con => merge => xóa ổ con
                    foreach($odichTest as $k => $od) {
                        if($this->checkContains($odichTest, $od)) {
                            unset($odichTest[$k]);
                        } else {
                            if($this->getIntersect($odichTest, $od)) {
                                $odichTest[$k] = $od + $this->getIntersect($odichTest, $od);
                            }
                        }
                    }
                }
            }
        }
        //Xóa các ổ dịch trùng lặp
        $odichTest = array_unique($odichTest, SORT_REGULAR);

        $odichTest = collect($odichTest)->map(function ($d, $k1) use ($cabenh, $dataCollapse, $radius) {
            $ids = collect($d)->pluck('id');
            $q_cb = (new Query())->select(new Expression("ST_Union(ST_Buffer(geom::geography, {$radius})::geometry)"))->from('cabenh')->andFilterWhere(['gid' => $ids])->createCommand()->getRawSql();
            $to_ah = (new Query())->select('khupho, tento, tenphuong, tenquan, maphuong, maquan')->from(['ranh_to'])
                ->where("ST_Intersects(({$q_cb}), geom)")
                ->all()
            ;
            return [
                'id'      => $k1,
                'cabenhs' => collect($d)->map(function ($s, $k2) use ($cabenh, $dataCollapse, $d) {
                    $minDate = collect($d)->where('day', collect($d)->min('day'))->first();
                    $key = array_keys($d, $minDate);
                    return [
                        'id'     => $k2,
                        'date'   => data_get($cabenh, "{$k2}.ngaymacbenh_nv"),
                        'nearby' => $this->getNearbySub($k2, $dataCollapse, $key[0]),
                    ];
                })->values(),
                'to_ah' => $this->renderPartial('to_ah', ['to_ah' => $to_ah])
            ];
        });

        return $odichTest;
    }

    private function getIntersect($odichTest, $od){
        foreach($odichTest as $od1) {
            if($od1 != $od && array_intersect_key($od1, $od)) {
                return $od1;
            }
        }
        return false;
    }

    private function checkContains($odichTest, $od){
        foreach($odichTest as $od1) {
            if($od1 != $od && count(array_intersect_key($od, $od1)) == count($od)) {
                return true;
            }
        }
        return false;
    }
}
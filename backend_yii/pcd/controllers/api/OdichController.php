<?php
namespace pcd\controllers\api;

use common\controllers\MyApiController;
use pcd\modules\pt_nguyco\models\PtNguyco;
use pcd\models\CabenhSxh;
use pcd\models\CabenhSxhNn;
use yii\db\Query;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class OdichController extends MyApiController
{
    public function actionTimDnc(){
        $ids = request('cabenhIds');
        $distance = 200;
        $sql = CabenhSxh::find()->select(new Expression("ST_Union(ST_Buffer(geom::geography, {$distance})::geometry) geom"))->andWhere(['gid' => $ids])->createCommand()->getRawSql();
        $models = PtNguyco::find()->with(['quan', 'phuong'])->andWhere(new Expression("ST_Intersects(geom, ({$sql}))"))->all();
        $data = ArrayHelper::toArray($models, [PtNguyco::className() => (new PtNguyco)->getPopupFields()]);
        return [
            'count' => count($models),
            'data' => $data,
            'html' => $this->renderPartial('dnc', ['models' => $models]),
        ];
    }

    protected function getTableCabenhOd(){
        return (new Query())->from(CabenhSxh::tableName())->andWhere(new Expression("((ht_dieutri = '1' AND chuandoan = '1') OR (ht_dieutri = '0' AND loai_xm_cb IN (7,8)))"));
    }

    public function actionTimCabenh($table = 'cabenh_sxh'){

        $cabenhIds = request('cabenhIds');
        $dataInput = collect($cabenhIds);
        $radius = 200;
        $table = $this->getTableCabenhOd();

        list($ids1, $dataMap1) = $this->timCabenhLienQuan($cabenhIds, $table, $radius, 'sau');
        list($ids2, $dataMap2) = $this->timCabenhLienQuan($cabenhIds, $table, $radius,'truoc');

        $ids = $ids1->merge($ids2)->unique();
        $dataMap = $dataMap1->merge($dataMap2);

        $cabenhs = collect(($table == 'cabenh_sxh_nn' ? CabenhSxhNn::className() : CabenhSxh::className())::find()->where(['gid' => $ids])
            ->indexBy('gid')->all())->map(function ($i) {return $i->toArray(
        );});

        $dataInput = $dataInput->map(function($item) use($cabenhs){
            return [
                $cabenhs[$item]['gid'] => [
                    'id' => $cabenhs[$item]['gid'],
                    'date' => $cabenhs[$item]['ngaymacbenh_nv'],
                ]
            ];
        })->collapse()->keyBy('id');

        return [
            'cabenhs' => $cabenhs,
            'odichs' => $this->findOdich($dataInput, $dataMap, $cabenhs, $radius)
        ];
    }

    protected function findOdich($dataInput, $dataMap, $cabenhs, $radius){
        //collapse các cặp ca bệnh
        $dataCollapse = collect($dataMap)->collapse()->filter(function($item){
            $cb_d1 = strtotime($item['date1']);
            $cb_d2 = strtotime($item['date2']);
           return $cb_d2 >= $cb_d1;
        })->unique();

        //Sắp xếp các cặp ca bệnh theo thứ tự thời gian tăng dần
        $dataCollapse = $dataCollapse->sortBy(function($item){
            return [$item['date1'], $item['date2']];
        });

        //Tìm các cặp ca bệnh thỏa ca khởi phát và thứ phát
        $caKpTps = $dataCollapse->filter(function ($item) {
            return $item['day'] <= 14;
        });

        if($caKpTps == null) return [];

        //Format lại định dạng các ổ dịch
        $odichs = [];
        foreach($caKpTps as $kptp) {
            $odich = [
                $kptp['id1'] => ['id' => $kptp['id1'], 'date' => $kptp['date1']],
                $kptp['id2'] => ['id' => $kptp['id2'], 'date' => $kptp['date2']],
            ];

            array_push($odichs, $odich);
        }

        //Tìm các ca bệnh tiếp theo trong các ổ dịch
        foreach($odichs as &$odich) {
            foreach($dataCollapse as $cb){
                $ng_kp = strtotime(collect($odich)->first()['date']);
                $cb_d1 = strtotime($cb['date1']);
                $cb_d2 = strtotime($cb['date2']);
                if((in_array($cb['id1'], array_keys($odich)) && !in_array($cb['id2'], array_keys($odich))) && $cb_d1 > $ng_kp && $cb_d2 > $ng_kp) {
                    $odich[$cb['id2']] = [
                        'id' => $cb['id2'],
                        'date' => $cb['date2']
                    ];
                }    
            }
        }
        
        //Ổ dịch đầu tiên chứa tất cả các ca bệnh đầu vào thì lấy
        $result = null;
        foreach($odichs as $odich) {
            $inOdich = true;
            $odichIds = array_keys($odich);
            foreach($dataInput as $cb) {
                if(!in_array($cb['id'], $odichIds)) { $inOdich = false; }
            }
            
            if($inOdich) {
                $result = $odich; 
                break;
            }
        }

        if(!$result) return [];
        // $odich = $dataInput->merge($odich)->unique()->keyBy('id')->all();

        $dataCol = collect($dataMap)->collapse();

        $result = collect(array($result))->sortBy('date')->map(function ($d, $k1) use ($cabenhs, $dataCol, $radius) {
            $ids = collect($d)->pluck('id');
            $q_cb = (new Query())->select(new Expression("ST_Union(ST_Buffer(geom::geography, {$radius})::geometry)"))->from('cabenh_sxh')->andFilterWhere(['gid' => $ids])->createCommand()->getRawSql();
            $to_ah = (new Query())->select('khupho, tento, tenphuong, tenquan, maphuong, maquan')->from(['ranh_to'])
                ->where("ST_Intersects(({$q_cb}), geom)")
                ->all()
            ;
            return [
                'id'      => $k1,
                'cabenhs' => collect($d)->map(function ($s, $k2) use ($cabenhs, $dataCol, $d) {
                    $minDate = collect($d)->where('date', collect($d)->min('date'))->first();
                    $key = array_keys($d, $minDate);
                    return [
                        'id'     => $k2,
                        'date'   => data_get($cabenhs, "{$k2}.ngaymacbenh_nv"),
                        'nearby' => $this->getNearbySub($k2, $dataCol, $key[0]),
                    ];
                })->sortBy(function($item){
                    $date = strtotime(str_replace('/', '-', $item['date']));
                    $d = date('Y-m-d', $date);
                    return $d;
                })->values(),
                'to_ah' => $this->renderPartial('to_ah', ['to_ah' => $to_ah])
            ];
        });

        return $result;
    }

    public function timCabenhLienQuan($cabenhIds, $table, $radius, $thoidiem) {
        list($distanceAlias, $dayAlias) = ['distance', 'day'];
        list($numday, $distance) = ['abs(sxh1.ngaymacbenh_nv - sxh2.ngaymacbenh_nv)', 'ST_Distance([[sxh1.geom]]::geography, [[sxh2.geom]]::geography)'];
        $ids = collect($cabenhIds);
        $dataMap = collect();
        $radius = 200;

        foreach (range(1, 100) as $val) {
            $subQuery = (new Query())->select('gid, ngaymacbenh_nv, geom, maphuong, maquan')
                ->from($table)->andWhere(['gid' => $ids]);
            $query = (new Query())
                ->select(['sxh1.gid id1', 'sxh2.gid id2', $distanceAlias => $distance, $dayAlias => $numday, 'date1' => 'sxh1.ngaymacbenh_nv', 'date2' => 'sxh2.ngaymacbenh_nv']);
            
            if($thoidiem == 'sau') {
                $query->from(['sxh1' => $subQuery, 'sxh2' => $table])->andWhere('sxh2.ngaymacbenh_nv >= sxh1.ngaymacbenh_nv');
            } else {
                $query->from(['sxh1' => $table, 'sxh2' => $subQuery])->andWhere('sxh2.ngaymacbenh_nv > sxh1.ngaymacbenh_nv');
            }
                
            $query->andWhere(['<=', $numday, 30])                
                ->andWhere('sxh1.gid <> sxh2.gid')
                ->andWhere("ST_DWithin (sxh1.geom::geography, sxh2.geom::geography, {$radius})")
                ->orderBy(['sxh1.ngaymacbenh_nv' => SORT_ASC, 'sxh2.ngaymacbenh_nv' => SORT_ASC]);

            if (role('phuong')) {
                $query->andWhere(['and', ['sxh1.maphuong' => userInfo()->ma_phuong], ['sxh2.maphuong' => userInfo()->ma_phuong]]);
            } else if (role('quan')) {
                $query->andWhere(['and', ['sxh1.maquan' => userInfo()->ma_quan], ['sxh2.maquan' => userInfo()->ma_quan]]);
            }
                
            $q = collect($query->all());
            $data = $q->pluck('id1')->concat($q->pluck('id2'))->unique();
            $tmp = $ids->concat($data)->unique();
            
            if($dataMap->last() == $q && !empty($ids)){
                break;
            }

            $ids = $tmp;
            $dataMap = $dataMap->push($q);
        }
        return [$ids, $dataMap];
    }

    public function actionTimCabenhBackup($table = 'cabenh_sxh'){

        list($distanceAlias, $dayAlias) = ['distance', 'day'];
        list($numday, $distance) = ['abs(sxh1.ngaymacbenh_nv - sxh2.ngaymacbenh_nv)', 'ST_Distance([[sxh1.geom]]::geography, [[sxh2.geom]]::geography)'];
        $dataInput = $ids = collect(request('cabenhIds'));
        $dataMap = collect();
        $radius = 200;
        $ng_nv = (new Query())->select('ngaymacbenh_nv')->from($table)->where(['gid' => $ids])->all();

        foreach (range(1, 100) as $val) {
            $subQuery = (new Query())->select('gid, ngaymacbenh_nv, geom, maphuong, maquan')
                ->from($table)->andWhere(['gid' => $ids]);
            $query = (new Query())
                ->select(['sxh1.gid id1', 'sxh2.gid id2', $distanceAlias => $distance, $dayAlias => $numday, 'date1' => 'sxh1.ngaymacbenh_nv', 'date2' => 'sxh2.ngaymacbenh_nv'])
                ->from(['sxh1' => $subQuery, 'sxh2' => $table])
                ->andWhere(['<=', $numday, 30])
                ->andWhere('sxh2.ngaymacbenh_nv >= sxh1.ngaymacbenh_nv')
                ->andWhere('sxh1.gid <> sxh2.gid')
                ->andWhere("ST_DWithin (sxh1.geom::geography, sxh2.geom::geography, {$radius})")
                ->orderBy(['sxh1.ngaymacbenh_nv' => SORT_ASC, 'sxh2.ngaymacbenh_nv' => SORT_ASC]);

                if (role('phuong')) {
                    $query->andWhere(['and', ['sxh1.maphuong' => userInfo()->ma_phuong], ['sxh2.maphuong' => userInfo()->ma_phuong]]);
                } else if (role('quan')) {
                    $query->andWhere(['and', ['sxh1.maquan' => userInfo()->ma_quan], ['sxh2.maquan' => userInfo()->ma_quan]]);
                }
                
            $q = collect($query->all());
            $data = $q->pluck('id1')->concat($q->pluck('id2'))->unique();
            $tmp = $ids->concat($data)->unique();
            // if ($tmp->count() == $ids->count() && !empty($ids)) {
            //     break;
            // }
            
            if($dataMap->last() == $q && !empty($ids)){
                break;
            }

            $ids = $tmp;
            $dataMap = $dataMap->push($q);
        }

        $cabenhs = collect(($table == 'cabenh_sxh_nn' ? CabenhSxhNn::className() : CabenhSxh::className())::find()->where(['gid' => $ids])
            ->indexBy('gid')->all())->map(function ($i) {return $i->toArray(
            // ['hoten', 'ngaymacbenh_nv', 'gid']
        );});

        $dataInput = $dataInput->map(function($item) use($cabenhs){
            return [
                $cabenhs[$item]['gid'] => [
                    'id' => $cabenhs[$item]['gid'],
                    'date' => $cabenhs[$item]['ngaymacbenh_nv'],
                ]
            ];
        })->collapse()->keyBy('id');

        return [
            'cabenhs' => $cabenhs,
            'odichs' => $this->findOdich($dataInput, $dataMap, $cabenhs, $radius)
        ];
    }

    public function actionToAh(){
        $ids = request('cabenhIds', []);
        $distance = request('distance', 200);
        $ids = array_filter($ids);
        if(empty($ids)){
            return [
                'html' => 'Không tìm thấy tổ ảnh hưởng'
            ];
        }

        $q_cb = (new Query())->select(new Expression("ST_Union(ST_Buffer(geom::geography, {$distance})::geometry)"))->from('cabenh_sxh')->andFilterWhere(['gid' => $ids])->createCommand()->getRawSql();
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
        $typeFind = request('table') ? request('table') : $table;
        $table = $this->getTableCabenhOd();

        if(role('admin') && $typeFind === 'cabenh_sxh'){
            return [];
        } elseif (!role('admin') && $typeFind === 'cabenh_sxh_nn'){
            return [];
        }

        $request = request();
        $date_from = $request->post('ngmacbenh_from');
        $date_to = $request->post('ngmacbenh_to', date('d/m/Y'));
        $day1 = $request->post('day1', 14);
        $day2 = $request->post('day2', 30);
        $maquan = $request->post('maquan');
        $maphuong = $request->post('maphuong');
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
                    ->andWhere('sxh2.ngaymacbenh_nv >= sxh1.ngaymacbenh_nv')
                ;

                // if (role('phuong')) {
                //     $query->andWhere(['sxh1.maphuong' => userInfo()->ma_phuong]);
                // } else if (role('quan')) {
                //     $query->andWhere(['sxh1.maquan' => userInfo()->ma_quan]);
                // }
                if (role('phuong')) {
                    $query->andWhere(['sxh1.maphuong' => userInfo()->ma_phuong]);
                } else if (role('quan')) {
                    $query->andWhere(['sxh1.maquan' => userInfo()->ma_quan]);
                    if($maphuong) {
                        $query->andWhere(['sxh1.maphuong' => $maphuong]);
                    }
                }
            } else {
                $subQuery = (new Query())->select('gid, ngaymacbenh_nv, geom, is_nghingo, maquan, maphuong')
                    ->from($table)
//                    ->where(['is_nghingo' => $typeFind == 'cabenh_sxh' ? null : 1])
                    ->andWhere(['gid' => $ids]);
                $query = $query
                    ->from(['sxh1' => $subQuery, 'sxh2' => $table])
                    ->andWhere(['<=', $numday, $day2])
                    ->andWhere(['BETWEEN', 'sxh1.ngaymacbenh_nv', $date_from, $date_to])
                    ->andWhere(['BETWEEN', 'sxh2.ngaymacbenh_nv', $date_from, $date_to])
                    ->andWhere('sxh2.ngaymacbenh_nv >= sxh1.ngaymacbenh_nv')
                ;
            }

            // if (role('phuong')) {
            //     $query->andWhere(['and', ['sxh1.maphuong' => userInfo()->ma_phuong], ['sxh2.maphuong' => userInfo()->ma_phuong]]);
            // } else if (role('quan')) {
            //     $query->andWhere(['and', ['sxh1.maquan' => userInfo()->ma_quan], ['sxh2.maquan' => userInfo()->ma_quan]]);
            //     if($maphuong) {
            //         $query->andWhere(['and', ['sxh1.maphuong' => $maphuong], ['sxh2.maphuong' => $maphuong]]);
            //     }
            // }

            // if (in_array('sxh', $loaibenh)) {
            //     $query->andWhere('sxh1.cdc_cbn_sxh = 1 AND sxh2.cdc_cbn_sxh = 1');
            // }

            $query->andWhere('sxh1.gid <> sxh2.gid')
                ->andWhere("ST_DWithin (sxh1.geom::geography, sxh2.geom::geography, {$radius})")
//                ->andWhere(['sxh1.is_nghingo' => $typeFind == 'cabenh_sxh' ? null : 1])
//                ->andWhere(['sxh2.is_nghingo' => $typeFind == 'cabenh_sxh' ? null : 1])
                ->orderBy(['sxh1.ngaymacbenh_nv' => SORT_ASC, 'sxh2.ngaymacbenh_nv' => SORT_ASC]);

            $q = collect($query->all());

            $data = $q->pluck('id1')->concat($q->pluck('id2'))->unique();
            $tmp = $ids->concat($data)->unique();

            // if (
            //     $tmp->count() == $ids->count()
            //     && !empty($ids)
            // ) {
            //     break;
            // }
            if($dataMap->last() == $q && !empty($ids)){
                break;
            }

            $ids = $tmp;
            $dataMap = $dataMap->push($q);
        }

        // $dataMap = session()->set('od', $dataMap);
        // $ids = session()->set('ids', $ids);
        // $dataMap = session()->get('od');
        // $ids = session()->get('ids');

        $odich_1 = $dataMap->first();
        // $this->kptp = session()->get('kptp');
        $odich_n = $dataMap->last();
        $cabenhs = collect((CabenhSxh::className())::find()->where(['gid' => $ids])
            ->indexBy('gid')->all())->map(function ($i) {return $i->toArray(
            // ['hoten', 'ngaymacbenh_nv', 'gid']
        );});

        // dd($this->buildFirstOd($odich_1, $odich_n, $cabenh));
        // dd($this->buildOdich($odich_1));

        return [
            'cabenhs' => $cabenhs,
            // 'odichs'  => $this->buildOdich($odich_n),
            // 'odich'  => $this->buildFirstOd($odich_1, $odich_n, $cabenhs),
            'odichs'  => $this->oDichBuild($odich_1, $dataMap, $cabenhs, $radius),
        ];
    }

    protected function buildFirstOd($dataMap, $map_n, $cb)
    {
        $dataMap = collect($dataMap)->recursive();
        $od = [];
        $i = 0;
        foreach ($dataMap as $v) {
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
        $dataCollapse = collect($dataMap)->collapse()->sortBy(function($item){
            $day = 30 - $item['day'];
            return [$item['date2'], $item['day'], $item['id1']];
        });

        $dataCollapse = $dataCollapse->unique(function($item){
            $sumid = $item['id1'] + $item['id2'];
            return [$item['day'], $item['distance'], $sumid];
        })->unique('id2')->sortBy(function ($item){
            return [$item['date1'], $item['date2']];
        });

        $arrId = [];
        $odichTest = [];
        if (empty($odich_1)) return [];

        $odichKp = $odich_1->filter(function ($item, $k) use ($dataCollapse){
           return $dataCollapse->contains($item);
        });
        foreach ($odichKp as $key => $od) {
            if (in_array($od['id1'], $arrId) || in_array($od['id2'], $arrId)) {
            } else {
                array_push($arrId, $od['id1'], $od['id2']);
                array_push($odichTest, [
                    $od['id1'] => ['id' => $od['id1'], 'date' => $od['date1']],
                    $od['id2'] => ['id' => $od['id2'], 'date' => $od['date2']]
                ]);
            }
        }

        $ca_cc = $this->getCbCuoiCung($odichTest);
        foreach($dataCollapse as $cb) {

            //Xác định ca bệnh có thể liên quan tới những ổ dịch nào?
            foreach ($odichTest as $key => $od) {
                if ((in_array($cb['id1'], array_keys($od)) && !in_array($cb['id2'], array_keys($od))) &&
                    !in_array($cb['id2'], $ca_cc)) {
                    $odichTest[$key][$cb['id2']] = [
                        'id' => $cb['id2'],
                        'date' => $cb['date2']
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
            $ca_cc = $this->getCbCuoiCung($odichTest);

        }

        //Xóa các ổ dịch trùng lặp
        $odichTest = array_unique($odichTest, SORT_REGULAR);

        $dataCol = collect($dataMap)->collapse();
        $odichTest = collect($odichTest)->map(function ($d, $k1) use ($cabenh, $dataCol, $radius) {
            $ids = collect($d)->pluck('id');
            $q_cb = (new Query())->select(new Expression("ST_Union(ST_Buffer(geom::geography, {$radius})::geometry)"))->from('cabenh_sxh')->andFilterWhere(['gid' => $ids])->createCommand()->getRawSql();
            $to_ah = (new Query())->select('khupho, tento, tenphuong, tenquan, maphuong, maquan')->from(['ranh_to'])
                ->where("ST_Intersects(({$q_cb}), geom)")
                ->all()
            ;
            return [
                'id'      => $k1,
                'cabenhs' => collect($d)->map(function ($s, $k2) use ($cabenh, $dataCol, $d) {
                    $minDate = collect($d)->where('date', collect($d)->min('date'))->first();
                    $key = array_keys($d, $minDate);
                    return [
                        'id'     => $k2,
                        'date'   => data_get($cabenh, "{$k2}.ngaymacbenh_nv"),
                        'nearby' => $this->getNearbySub($k2, $dataCol, $key[0]),
                    ];
                })->sortBy(function($item){
                    $date = strtotime(str_replace('/', '-', $item['date']));
                    $d = date('Y-m-d', $date);
                    return $d;
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

    private function getCbCuoiCung($odich){
        $cacc_id = collect($odich)->map(function($item){
           return end($item)['id'];
        })->all();
        return $cacc_id;
    }

    protected function findOdichBackup($dataInput, $dataMap, $cabenhs, $radius){
        $dataCollapse = collect($dataMap)->collapse()->filter(function($item){
            $cb_d1 = strtotime($item['date1']);
            $cb_d2 = strtotime($item['date2']);
           return $cb_d2 >= $cb_d1;
        })->unique();

        $dataCollapse = $dataCollapse->sortBy(function($item){
            return [$item['date1'], $item['date2']];
        });

        $caKpTp = $dataCollapse->filter(function ($item) {
            return $item['day'] <= 14;
        })->first();

        if($caKpTp == null) return [];

        $odich = [
            $caKpTp['id1'] => ['id' => $caKpTp['id1'], 'date' => $caKpTp['date1']],
            $caKpTp['id2'] => ['id' => $caKpTp['id2'], 'date' => $caKpTp['date2']],
        ];

        foreach($dataCollapse as $cb){
            $ng_kp = strtotime(collect($odich)->first()['date']);
            $cb_d1 = strtotime($cb['date1']);
            $cb_d2 = strtotime($cb['date2']);
            if((in_array($cb['id1'], array_keys($odich)) && !in_array($cb['id2'], array_keys($odich))) && $cb_d1 > $ng_kp && $cb_d2 > $ng_kp) {
                $odich[$cb['id2']] = [
                    'id' => $cb['id2'],
                    'date' => $cb['date2']
                ];
            }

        }
        $odich = $dataInput->merge($odich)->unique()->keyBy('id')->all();

        $dataCol = collect($dataMap)->collapse();
        $odich = collect(array($odich))->sortBy('date')->map(function ($d, $k1) use ($cabenhs, $dataCol, $radius) {
            $ids = collect($d)->pluck('id');
            $q_cb = (new Query())->select(new Expression("ST_Union(ST_Buffer(geom::geography, {$radius})::geometry)"))->from('cabenh_sxh')->andFilterWhere(['gid' => $ids])->createCommand()->getRawSql();
            $to_ah = (new Query())->select('khupho, tento, tenphuong, tenquan, maphuong, maquan')->from(['ranh_to'])
                ->where("ST_Intersects(({$q_cb}), geom)")
                ->all()
            ;
            return [
                'id'      => $k1,
                'cabenhs' => collect($d)->map(function ($s, $k2) use ($cabenhs, $dataCol, $d) {
                    $minDate = collect($d)->where('date', collect($d)->min('date'))->first();
                    $key = array_keys($d, $minDate);
                    return [
                        'id'     => $k2,
                        'date'   => data_get($cabenhs, "{$k2}.ngaymacbenh_nv"),
                        'nearby' => $this->getNearbySub($k2, $dataCol, $key[0]),
                    ];
                })->sortBy(function($item){
                    $date = strtotime(str_replace('/', '-', $item['date']));
                    $d = date('Y-m-d', $date);
                    return $d;
                })->values(),
                'to_ah' => $this->renderPartial('to_ah', ['to_ah' => $to_ah])
            ];
        });

        return $odich;

    }
}
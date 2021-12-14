<?php
/**
 * Created by PhpStorm.
 * User: THANHTUNG
 * Date: 10-Dec-17
 * Time: 8:13 PM
 */

namespace pcd\controllers\api;

use common\controllers\MyApiController;
use common\models\User;
use pcd\models\RanhTo;
use pcd\models\VCbsxh;
use pcd\services\VungDich;
use yii\db\Query;

class MapsController extends MyApiController
{


    protected function buildOdich($dataMap){
        $odich = collect([]);
        $data = collect($dataMap)
            ->recursive();
        $incre = 1;
        $data->map(function ($item, $k) use ($data, $odich, &$incre){
            $od = $odich->pluck('cabenhs')->collapse()->pluck('id');

            list($id1, $id2) = [$item->get('id1'), $item->get('id2')];

            $data = collect([
                ['id' => $id1, 'nearby' => $this->getNearby($id1, $data)],
                ['id' => $id2, 'nearby' => $this->getNearby($id2, $data)],
            ]);
            $inter = $data->pluck('id')->intersect($od);

            if($inter->isEmpty()){
                // Tạo mới ỏ dịch
                $odich = $odich->put($incre, [
                    'id' => $incre,
                    'cabenhs' => $data->indexBy('id')
                ]);
                $incre = $incre + 1;
            } else {
                // Tìm ổ dịch
                $fobj = $inter->first();
                $res = $odich->filter(function ($i) use ($fobj){
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

    public function actionTimOdich(){
        $request = request();
        $date_from = $request->post('ngmacbenh_from');
        $date_to = $request->post('ngmacbenh_to', date('d/m/Y'));
        $loaibenh = $request->post('loaibenh', []);
        $day1 = $request->post('day1', 14);
        $day2 = $request->post('day2', 30);
        $radius = $request->post('day2', 200);

        $table = 'v_khoanhvung';
//        $table = 'khoanhvung_test';

        list($distanceAlias, $dayAlias) = ['distance', 'day'];
        list($numday, $distance) = ['abs(sxh1.ngaymacbenh_nv - sxh2.ngaymacbenh_nv)', 'ST_Distance([[sxh1.geom]]::geography, [[sxh2.geom]]::geography)'];
        $ids = collect();
        $dataMap = collect();

        foreach (range(1, 100) as $val){
            $query = (new Query())
                ->select(['sxh1.macabenh id1', 'sxh2.macabenh id2', $distanceAlias => $distance, $dayAlias => $numday]);

            if($val == 1){
                $query = $query->from(['sxh1' => $table, 'sxh2' => $table])
                    ->andWhere(['<=', $numday, $day1])
                    ->andWhere(['BETWEEN', 'sxh1.ngaymacbenh_nv', $date_from, $date_to]);

                if(role('phuong')){
                    $query->andWhere(['sxh1.ma_phuong' => userInfo()->ma_phuong]);
                } else if (role('quan')){
                    $query->andWhere(['sxh1.ma_quan' => userInfo()->ma_quan]);
                }

            } else {
                $subQuery = (new Query())->select('cdc_cbn_sxh, ma_phuong, macabenh, ngaymacbenh_nv, geom')
                    ->from($table)->andWhere(['macabenh' => $ids]);
                $query = $query
                    ->from(['sxh1' => $subQuery, 'sxh2' => $table])
                    ->andWhere(['<=', $numday, $day2]);
            }

            if(in_array('sxh', $loaibenh)){
                $query->andWhere('sxh1.cdc_cbn_sxh = 1 AND sxh2.cdc_cbn_sxh = 1');
            }

            $query->andWhere('sxh1.macabenh <> sxh2.macabenh')
                ->andWhere("ST_DWithin (sxh1.geom::geography, sxh2.geom::geography, {$radius})")
                ->orderBy('sxh1.ngaymacbenh_nv');

            $query = collect($query->all());

            $data = $query->pluck('id1')->concat($query->pluck('id2'))->unique();
            $tmp = $ids->concat($data)->unique();

            if(
                $tmp->count() == $ids->count()
                && !empty($ids)
            ){
                break;
            }

            $ids = $tmp;
            $dataMap = $dataMap->push($query);
        }


        $cabenh = collect((new Query())->from('v_list_cabenh')->where(['macabenh' => $ids])->all())->indexBy('macabenh');


        return [
            'cabenh' => $cabenh,
            'odich' => $this->buildOdich($dataMap->last())
        ];


    }

    protected function getNearby($id, $data){
        $res = $data
            ->filter(function ($item) use ($id){
                return $item->get('id1') == $id || $item->get('id2') == $id;
            })
            ->map(function ($item) use ($id){
                return [
                    'id' => $id == $item->get('id1') ? $item->get('id2') : $item->get('id1'),
                    'distance' => $item->get('distance'),
                    'day' => $item->get('day')
                ];
            })
        ;
        return $res->unique('id')->indexBy('id')->all();
    }

    public function actionFilterSxh(){
        $post = [
            'datefrom' => request('datefrom'),
            'dateto' => request('dateto') ?: date('d/m/Y'),
            'loaibenh' => request('loaibenh') ?: [],
        ];

        $sxh = !in_array('sxh', $post['loaibenh']) ? 0 : VCbsxh::find()->filterSXH($post)->andWhere(['>=', 'cdc_cbn_sxh', 1])->count();
        $sot = !in_array('sot', $post['loaibenh']) ? 0 : VCbsxh::find()->filterSXH($post)->andWhere(['>=', 'cdc_cbn_sot', 1])->count();
        $khac = !in_array('khac', $post['loaibenh']) ? 0 : VCbsxh::find()->filterSXH($post)->andWhere(['>=', 'cdc_cbn_benhkhac', 1])->count();

        return [
            'sxh' => $sxh,
            'sot' => $sot,
            'khac' => $khac
        ];
    }

    public function actionVungdich()
    {

        $vd = new VungDich();
        $vd->init();
        $vd->xulyChinh();
    }

    public function actionRanhto()
    {
        $wkt = $this->request->post('wkt');
        $totiepgiap = RanhTo::find()->whereIntersect($wkt)->all();

        return [
            'totiepgiap' => $totiepgiap,
            'viewto' => $this->renderPartial('totiepgiap', compact('totiepgiap')),
        ];
    }
}
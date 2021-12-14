<?php

namespace pcd\controllers\admin;

use Carbon\Carbon;
use common\models\Query;
use pcd\controllers\AppController;
use pcd\models\HcPhuong;
use Yii;
use yii\base\DynamicModel;
use pcd\models\HcQuan;
use yii\db\Expression;

class TableController extends AppController
{
    public function actionIndex()
    {
        $this->updateCabenhSxh1();
        $this->updateDieutraSxh();
        $this->updateChuyenca();
        $this->updateXacminhCb();
//        $this->updateGiapranh();

        return '';
    }

    protected function updateCabenhSxh1()
    {
        $tblCabenhName = 'cabenh_sxh';
        $tblMaterCabenhName = 'm_cabenh_sxh';

        $tblCabenhColumns = Yii::$app->db->schema->getTableSchema($tblCabenhName)->getColumnNames();
        $tblMaterCabenhColumns = Yii::$app->db->schema->getTableSchema($tblMaterCabenhName)->getColumnNames();

        $diff = array_diff($tblCabenhColumns, $tblMaterCabenhColumns);
        $diffMaster = array_diff($tblMaterCabenhColumns, $tblCabenhColumns);
        $errorValues = implode(", ", $diffMaster);
        $warningValues = implode(", ", $diff);

        if ($diffMaster) {
            echo("Không thể copy dữ liệu. Bảng {$tblCabenhName} thiếu các cột sau: {$errorValues}");
        } else {
            $tblCabenhColumns = array_filter($tblCabenhColumns, function ($item) {
                return !in_array($item, ['created_at', 'updated_at', 'created_by', 'updated_by', 'ten_qh', 'ten_px', 'is_nghingo', 'tenquan', 'tenphuong']);
            });

            $values = implode(", ", $tblCabenhColumns);
            $this->truncateTbl($tblCabenhName);
            Yii::$app->db->createCommand("INSERT INTO {$tblCabenhName} ({$values}) SELECT {$values} FROM {$tblMaterCabenhName}")->execute();

            if ($diff) {
                echo("Đã cập nhật - tbl: {$tblCabenhName}. Phát hiện danh sách các cột không sử dụng: {$warningValues}");
            } else {
                echo("Đã cập nhật - tbl: {$tblCabenhName}");
            }
        }
    }

    protected function updateCabenhSxh()
    {
//        $tblCabenhName = 'cabenh_sxh';
//        $tblCabenhColumns = Yii::$app->db->schema->getTableSchema($tblCabenhName)->getColumnNames();
//        $data = (new Query())
//            ->select([
//                'gid' => 'cb.macabenh', 'chuyenca' => 'cb.chuyenca_filter',
//                'cb.diachi1', 'cb.benhnhan1', 'cb.sonha1', 'cb.duong1', 'cb.to1', 'cb.khupho1', 'cb.qh1', 'cb.px1', 'cb.dienthoai1',
//                'dt.diachi2', 'dt.sonha2', 'dt.duong2', 'dt.to2', 'dt.khupho2', 'dt.qh2', 'dt.px2', 'tinh2', 'tinhkhac2', 'dt.dienthoai2',
//                'dt.diachi3', 'dt.benhnhan3', 'dt.sonha3', 'dt.duong3', 'dt.to3', 'dt.khupho3', 'dt.qh3', 'dt.px3', 'dt.tinh3', 'dt.tinhkhac3', 'dt.dienthoai3',
//            ])
//            ->from(['cb' => 'cabenh'])
//            ->leftJoin(['dt' => 'dieutra_sxh1'], 'cb.macabenh = dt.macabenh')
//            ->all();
    }

    public function truncateTbl($tableName)
    {
        Yii::$app->db->createCommand("TRUNCATE TABLE {$tableName}")->execute();
    }

    protected function updateDieutraSxh()
    {
        $tblDieutraName = 'dieutra_sxh';
        $tblMaterDieutraName = 'm_dieutra_sxh';

        $tblDieutraColumns = Yii::$app->db->schema->getTableSchema($tblDieutraName)->getColumnNames();
        $tblMaterDieutraColumns = Yii::$app->db->schema->getTableSchema($tblMaterDieutraName)->getColumnNames();

        $diff = array_diff($tblDieutraColumns, $tblMaterDieutraColumns);
        $diffMaster = array_diff($tblMaterDieutraColumns, $tblDieutraColumns);
        $errorValues = implode(", ", $diffMaster);
        $warningValues = implode(", ", $diff);

        if ($diffMaster) {
            echo("Không thể copy dữ liệu. Bảng {$tblDieutraName} thiếu các cột sau: {$errorValues}");
        } else {
            $values = implode(", ", $tblDieutraColumns);
            $this->truncateTbl($tblDieutraName);
            Yii::$app->db->createCommand("INSERT INTO {$tblDieutraName} ({$values}) SELECT {$values} FROM {$tblMaterDieutraName}")->execute();

            if ($diff) {
                echo("Đã cập nhật - tbl: {$tblDieutraName}. Phát hiện danh sách các cột không sử dụng: {$warningValues}");
            } else {
                echo("Đã cập nhật - tbl: {$tblDieutraName}");
            }
        }
    }

    protected function updateChuyenca()
    {
        $tblChuyenca = 'chuyenca';
        $cbs = (new Query())->select([
            'gid'      => 'cb.macabenh',
            'maquan'   => 'cb.ma_quan',
            'maphuong' => 'cb.ma_phuong',
            'cb.px1',
            'dt.qh2',
            'dt.px2',
            'dt.px3',
            'chuyenca1',
            'chuyenca2',
            'nguoidieutra',
        ])
            ->from(['cb' => 'cabenh'])
            ->leftJoin(['dt' => 'dieutra_sxh1'], 'cb.macabenh = dt.macabenh')
            ->where('cb.chuyenca1 IS NOT NULL')
            ->all();

        $list = collect();
        foreach ($cbs as $k => $cb) {
            $item = new DynamicModel($cb);

            if ($item->chuyenca1) {
                $list->push([
                    'cabenh_id'   => $item->gid,
                    'type'        => 1,
                    'nguoichuyen' => null,
                    'qh_chuyen'   => substr($item->chuyenca1, 1, 3),
                    'px_chuyen'   => $item->chuyenca1,
                    'nguoinhan'   => null,
                    'qh_nhan'     => $item->qh2,
                    'px_nhan'     => $item->px2,
                    'readed_at'   => new Expression('NOW()'),
                    'is_locked'   => 1,
                ]);


                if ($item->chuyenca2) {
                    $list->push([
                        'cabenh_id'   => $item->gid,
                        'type'        => 2,
                        'nguoichuyen' => null,
                        'qh_chuyen'   => substr($item->chuyenca2, 1, 3),
                        'px_chuyen'   => $item->chuyenca2,
                        'nguoinhan'   => null,
                        'qh_nhan'     => substr($item->chuyenca1, 1, 3),
                        'px_nhan'     => $item->chuyenca1,
                        'readed_at'   => new Expression('NOW()'),
                        'is_locked'   => 1,
                    ]);
                }
            }
        }

        $connection = \Yii::$app->db;

        $transaction = $connection->beginTransaction();

        try {
            $this->truncateTbl($tblChuyenca);

            $connection->createCommand()->batchInsert('chuyenca',
                array_keys($list->first()),
                $list->all())
                ->execute();

            $transaction->commit();
            echo('Đã cập nhật - tbl: ' . $tblChuyenca);
        } catch (\Exception $e) {
            $transaction->rollback();
        }
    }

    protected function updateGiapranh()
    {
        $giapranhQuan = (new Query())
            ->select(['qh.q1', 'items' => new Expression('json_agg(qh.q2)')])
            ->from([
                'qh' => (
                (new Query())->select(['q1' => 'a.maquan', 'q2' => 'b.maquan'])
                    ->from(['a' => 'hc_quan', 'b' => 'hc_quan'])
                    ->andWhere(new Expression("ST_Intersects(a.geom, b.geom) AND a.gid != b.gid ORDER BY a.order"))
                )
            ])
            ->groupBy(['qh.q1'])
            ->all();

        foreach ($giapranhQuan as $quan) {
            $maquan = $quan['q1'];
            $items = json_decode($quan['items']);
            $all = array_merge($items, [$maquan]);
            $extent = data_get((new Query())->select(['geometry' => 'ST_AsGeoJSON(Box2D(ST_Extent(geom))::geometry)'])->from('hc_quan')->andWhere(['maquan' => $maquan])->one(), 'geometry');
            $boundary = data_get((new Query())->select(['geometry' => 'ST_AsGeoJSON(ST_Simplify(ST_Buffer(ST_Union(geom)::geography, 100)::geometry, 0.0001))'])->from('hc_quan')->andWhere(['maquan' => $all])->one(), 'geometry');

            $data = [
                'items'    => $items,
                'extent'   => json_decode($extent, true),
                'boundary' => json_decode($boundary, true)
            ];

            HcQuan::updateAll(['giapranh' => $data], "maquan = '{$maquan}'");
        }

        $giapranhPhuong = (new Query())
            ->select(['px.p1', 'items' => new Expression('json_agg(px.p2)')])
            ->from([
                'px' => ((new Query())->select(['p1' => 'a.maphuong', 'p2' => 'b.maphuong'])
                    ->from(['a' => 'hc_phuong', 'b' => 'hc_phuong'])
                    ->andWhere(new Expression("ST_Intersects(a.geom, b.geom) AND a.gid != b.gid ORDER BY a.order")))
            ])
            ->groupBy(['px.p1'])
            ->all();

        foreach ($giapranhPhuong as $phuong) {
            $maphuong = $phuong['p1'];
            $items = json_decode($phuong['items']);
            $all = array_merge($items, [$maphuong]);
            $extent = data_get((new Query())->select(['geometry' => 'ST_AsGeoJSON(Box2D(ST_Extent(geom))::geometry)'])->from('hc_phuong')->andWhere(['maphuong' => $maphuong])->one(), 'geometry');
//            dd($maphuong, (new Query())->select(['geometry' => 'ST_AsGeoJSON(ST_Simplify(ST_Buffer(ST_Union(geom)::geography, 100), 2))'])->from('hc_phuong')->andWhere(['maphuong' => $all])->createCommand()->getRawSql());
            $boundary = data_get((new Query())->select(['geometry' => 'ST_AsGeoJSON(ST_Simplify(ST_Buffer(ST_Union(geom)::geography, 100)::geometry, 0.0001))'])->from('hc_phuong')->andWhere(['maphuong' => $all])->one(), 'geometry');
            $data = [
                'items'    => $items,
                'extent'   => json_decode($extent, true),
                'boundary' => json_decode($boundary, true)
            ];

            HcPhuong::updateAll(['giapranh' => $data], "maphuong = '{$maphuong}'");

        }

        echo("Đã cập nhật - Giáp ranh quận phường");
    }




    public function updateXacminhCb()
    {
        $tblXacminhCb = 'xacminh_cb';

        $data = (new Query())
            ->select([
                'gid'       => 'cb.macabenh', 'chuyenca' => 'cb.chuyenca_filter',
                'cb.diachi1', 'cb.benhnhan1', 'cb.sonha1', 'cb.duong1', 'cb.to1', 'cb.khupho1', 'cb.qh1', 'cb.px1', 'cb.dienthoai1',
                'dt.diachi2', 'dt.sonha2', 'dt.duong2', 'dt.to2', 'dt.khupho2', 'dt.qh2', 'dt.px2', 'tinh2', 'tinhkhac2', 'dt.dienthoai2',
                'dt.diachi3', 'dt.benhnhan3', 'dt.sonha3', 'dt.duong3', 'dt.to3', 'dt.khupho3', 'dt.qh3', 'dt.px3', 'dt.tinh3', 'dt.tinhkhac3', 'dt.dienthoai3',
                'chuandoan' => 'dt.xacdinh', 'ht_dieutri' => 'cb.loaibc'
            ])
            ->from(['cb' => 'cabenh'])
            ->leftJoin(['dt' => 'dieutra_sxh1'], 'cb.macabenh = dt.macabenh')
//            ->limit(1000)
//            ->where('cb.macabenh = 52894')
            ->all();

        $lists = [];
        foreach ($data as $k => $m) {

            $c1 = !is_null($m['diachi2']);
            $c2 = !is_null($m['diachi3']) || !is_null($m['benhnhan3']);
            $c3 = $m['chuyenca'] == 2;
            $xm_cbs = [['is_diachi' => $m['diachi1'], 'is_benhnhan' => $m['benhnhan1'], 'tinh' => 'HCM', 'qh' => $m['qh1'], 'px' => $m['px1']]];
            $list = [];
            $list[0] = ['cabenh_id' => $m['gid'], 'is_diachi' => $m['diachi1'], 'is_benhnhan' => $m['benhnhan1'], 'dienthoai' => $m['dienthoai1'], 'sonha' => $m['sonha1'], 'duong' => $m['duong1'], 'to_dp' => $m['to1'], 'khupho' => $m['khupho1'], 'px' => $m['px1'], 'qh' => $m['qh1'], 'tinh' => 'HCM', 'tinh_dc_khac' => null,
                       'is_locked' => $c2 ? 1 : 0,
                       'type'      => 1,
                       'loai_xm'   => null
            ];

            if ($c1) {
                array_push($xm_cbs, ['is_diachi' => $m['diachi2'], 'is_benhnhan' => null, 'tinh' => $m['tinh2'], 'qh' => $m['qh2'], 'px' => $m['px2']]);

                $list[1] = ['cabenh_id' => $m['gid'], 'is_diachi' => $m['diachi2'], 'is_benhnhan' => null, 'dienthoai' => $m['dienthoai2'], 'sonha' => $m['sonha2'], 'duong' => $m['duong2'], 'to_dp' => $m['to2'], 'khupho' => $m['khupho2'], 'px' => $m['px2'], 'qh' => $m['qh2'], 'tinh' => $m['tinh2'], 'tinh_dc_khac' => $m['tinhkhac2'],
                           'is_locked' => $c2 ? 1 : 0,
                           'type'      => 0,
                           'loai_xm'   => null
                ];
            }

            $list[0]['loai_xm'] = $this->setLoaiXmCb($m, $xm_cbs[0], isset($xm_cbs[1]) ? $xm_cbs[1] : []);

            if ($c2) {
                array_push($xm_cbs, ['is_diachi' => $m['diachi3'], 'is_benhnhan' => $m['benhnhan3'], 'tinh' => $m['tinh3'], 'qh' => $m['qh3'], 'px' => $m['px3']]);
                if($m['diachi3'] == 0){
                    $sonha3 = $m['sonha2'];$duong3 = $m['duong2'];$to3 = $m['to2'];$khupho3 = $m['khupho2'];
                } else {
                    $sonha3 = $m['sonha3'] ;$duong3 = $m['duong3'] ;$to3 = $m['to3'] ;$khupho3 = $m['khupho3'] ;
                }

                $tinh3 = is_null($m['tinh3']) ? $m['tinh2'] : $m['tinh3'];
                $qh3 = is_null($m['qh3']) ? $m['qh2'] : $m['qh3'];
                $px3 = is_null($m['px3']) ? $m['px2'] : $m['px3'];
                $list[2] = ['cabenh_id' => $m['gid'], 'is_diachi' => $m['diachi3'], 'is_benhnhan' => $m['benhnhan3'], 'dienthoai' => $m['dienthoai3'], 'sonha' => $sonha3, 'duong' => $duong3, 'to_dp' => $to3, 'khupho' => $khupho3, 'px' => $px3, 'qh' => $qh3, 'tinh' => $tinh3, 'tinh_dc_khac' => $m['tinhkhac3'],
                           'is_locked' => $m['chuyenca'] == 2 ? 1 : 0,
                           'type'      => 1,
                           'loai_xm'   => null
                ];
            }

            if ($c3) {
                array_push($xm_cbs, ['is_diachi' => 0, 'is_benhnhan' => null, 'tinh' => 'HCM', 'qh' => $m['qh1'], 'px' => $m['px1']]);

                $list[3] = ['cabenh_id' => $m['gid'], 'is_diachi' => 0, 'is_benhnhan' => null, 'dienthoai' => $m['dienthoai1'], 'sonha' => $m['sonha1'], 'duong' => $m['duong1'], 'to_dp' => $m['to1'], 'khupho' => $m['khupho1'], 'px' => $m['px1'], 'qh' => $m['qh1'], 'tinh' => 'HCM', 'tinh_dc_khac' => null,
                           'is_locked' => 1,
                           'type'      => 0,
                           'loai_xm'   => null
                ];
            }

            if($c2){
                $list[2]['loai_xm'] = $this->setLoaiXmCb($m, $xm_cbs[2], isset($xm_cbs[3]) ? $xm_cbs[3] : []);
            }
            array_push($lists, $list);
        }


        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        $lists = array_collapse($lists);
//        dd($data, $lists);

        try {
            $this->truncateTbl($tblXacminhCb);
            $connection->createCommand()->batchInsert($tblXacminhCb,
                ['cabenh_id', 'is_diachi', 'is_benhnhan', 'dienthoai', 'sonha', 'duong', 'to_dp', 'khupho', 'px', 'qh', 'tinh', 'tinh_dc_khac', 'is_locked', 'type', 'loai_xm'],
                $lists)
                ->execute();

            echo("Đã cập nhật - tbl: {$tblXacminhCb}");
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollback();
        }

    }

    protected function setLoaiXmCb($m, $p_xm, $l_xm)
    {
        $is_bn = data_get($p_xm, 'is_benhnhan');
        $is_dc = data_get($p_xm, 'is_diachi');
        $px1 = data_get($p_xm, 'px');
        $qh1 = data_get($p_xm, 'qh');

        $is_dc2 = data_get($l_xm, 'is_diachi');
        $px2 = data_get($l_xm, 'px');
        $qh2 = data_get($l_xm, 'qh');
        $tinh2 = data_get($l_xm, 'tinh');

        $setCbn = function ($cond = null) use($m){
            if($cond){
                return $cond;
            }

            if ($m['chuandoan'] == 1 || $m['ht_dieutri'] === 0) {
                return 8;
            } else {
                return 7;
            }
        };


        $setKbn = function ($px1, $qh1, $px2, $qh2, $tinh2, $cond1, $cond2, $cond3) use($setCbn){
            if($tinh2 == 'HCM'){
                if($qh1 == $qh2){
                    if($px1 == $px2){
//                        dd(1);
                        return $setCbn($cond3);
                    } else {
                        return $cond1;
                    }
                } else {
                    return $cond2;
                }
            } else {
                return $cond3;
            }
        };

        if ($is_bn == 1) {
            return $setCbn();
        } else {
            if ($is_dc == 1) {
                if ($is_dc2 == 1) {
                    return $setKbn($px1, $qh1, $px2, $qh2, $tinh2, 4, 5, 6);
                } else {
                    return is_null($is_dc2) ? null : 6;
                }
            } else {
                if ($is_dc2 == 1) {
                    return $setKbn($px1, $qh1, $px2, $qh2, $tinh2, 1, 2, 3);
                } else {
                    return is_null($is_dc2) ? null : 3;
                }
            }
        }
    }
}
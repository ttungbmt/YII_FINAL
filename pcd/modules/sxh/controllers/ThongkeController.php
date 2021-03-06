<?php

namespace pcd\modules\sxh\controllers;

use pcd\controllers\AppController;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use pcd\modules\dm\models\DmKhupho;
use pcd\modules\dm\models\DmToDp;
use pcd\modules\sxh\forms\KhuphoForm;
use pcd\modules\sxh\models\DietLq;
use pcd\modules\sxh\models\Odich;
use pcd\modules\sxh\models\PhunHc;
use ttungbmt\db\Query;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class ThongkeController extends AppController
{
//    public $enableCsrfValidation = false;

    public function actionOdich(){
        $dm_loai_od = api('dm_loaiodich');

        if(request()->isPost){
            $loai_tk = request()->post('loai_tk');
            $date_from = request()->post('date_from');
            $date_to = request()->post('date_to');
            $maquan = request()->post('maquan');
            $maphuong = request()->post('maphuong');
            $dm_loai_od = api('dm_loaiodich');

            $od = (new Query())
                ->select('id odich_id, sonocgia, loai_od, dncs_count, px.tenphuong, px.maphuong, px.tenquan, px.maquan')->from(['od' => Odich::tableName()])
                ->leftJoin(['px' => HcPhuong::tableName()], 'px.maphuong = od.maphuong')
            ;

            $tb1 = (new Query())
                ->select('phc.*, od.loai_od, od.tenquan, od.tenphuong, od.dncs_count')->from(['phc' => PhunHc::tableName()])
                ->leftJoin(['od' => $od], 'od.odich_id = phc.odich_id')
                ->andFilterWhere(['od.maquan' => $maquan])
                ->andFilterWhere(['od.maphuong' => $maphuong])
                ->andFilterDate(['ngayxuly' => [$date_from, $date_to]])
            ;

            if($loai_tk == 1){
                return $this->asJson([
                    'fields' => [
                        ['key' => 'stt', 'label' => '#', 'type' => 'serial'],
                        ['key' => 'ngayxuly', 'label' => 'Ngày xử lý', 'format' => 'html'],
                        ['key' => 'loai_od', 'label' => 'Loại xử lý'],
                        ['key' => 'tt', 'label' => 'Lần phun', 'tdAttr' => ['data-t' => 'n']],
                        ['key' => 'tenquan', 'label' => 'Quận/ huyện',],
                        ['key' => 'tenphuong', 'label' => 'Phường/ xã',],
                        ['key' => 'khupho', 'label' => 'Khu phố/ Ấp (tổ)',],
                        ['key' => 'somaynho', 'label' => 'Số máy phun nhỏ đeo vai', 'tdAttr' => ['data-t' => 'n']],
                        ['key' => 'somaylon', 'label' => 'Máy phun lớn trên xe', 'tdAttr' => ['data-t' => 'n']],
                        ['key' => 'loai_hc', 'label' => 'Tên hóa chất',],
                        ['key' => 'solit_hc', 'label' => 'Số lít hóa chất (chưa pha)', 'tdAttr' => ['data-t' => 'n']],
                        ['key' => 'sonha_kphc', 'label' => 'Tỷ lệ nóc gia không PHC (%)', 'tdAttr' => ['data-t' => 'n']],
                        ['key' => 'songuoi_tg', 'label' => 'Tổng nhân sự tham gia', 'tdAttr' => ['data-t' => 'n']],
                        ['key' => 'dncs_count', 'label' => 'Số điểm nguy cơ trong ổ dịch', 'tdAttr' => ['data-t' => 'n']],
                        ['key' => 'dncs_odxp', 'label' => 'Số điểm nguy cơ trong ổ dịch xử phạt', 'tdAttr' => ['data-t' => 'n']],
                    ],
                    'data' => collect($tb1->all())->map(function ($i) use($dm_loai_od){
                        return array_merge($i, [
                            'ngayxuly' => Html::a(dbToDate($i['ngayxuly']), ['/sxh/odich/update', 'id' => $i['odich_id']], ['title' => 'Xem chi tiết ổ dịch', 'target' => '_blank']),
                            'loai_od' => data_get($dm_loai_od, $i['loai_od']),
                            'sonha_kphc' => number_format ($i['sonocgia_tt'] > 0 ? ($i['sonocgia_tt']-$i['sonocgia_xl'])*100/$i['sonocgia_tt'] : 0, '1'),
                            'sonocgia_tt' => $i['sonocgia_tt'],
                            'sonocgia_xl' => $i['sonocgia_xl'],
                        ]);
                    })
                ]);
            }

            $tb2 = (new Query())
                ->select('dlq.*, od.loai_od, od.tenquan, od.tenphuong, od.sonocgia')->from(['dlq' => DietLq::tableName()])
                ->leftJoin(['od' => $od], 'od.odich_id = dlq.odich_id')
                ->andFilterDate(['ngayxuly' => [$date_from, $date_to]])
                ->andFilterWhere(['od.maquan' => $maquan])
            ;

            if($loai_tk == 2){
                return $this->asJson([
                    'fields' => [
                        ['key' => 'stt', 'label' => '#', 'type' => 'serial'],
                        ['key' => 'ngayxuly', 'label' => 'Ngày xử lý', 'format' => 'html'],
                        ['key' => 'tt', 'label' => 'Lần diệt lăng quăng', 'tdAttr' => ['data-t' => 'n']],
                        ['key' => 'tenquan', 'label' => 'Quận/ huyện',],
                        ['key' => 'tenphuong', 'label' => 'Phường/ xã',],
                        ['key' => 'khupho', 'label' => 'Khu phố/ Ấp (tổ)',],
                        ['key' => 'tyle_sonha', 'label' => 'Số nhà diệt lăng quăng / tổng số nhà', 'tdAttr' => ['data-t' => 'n']],
                        ['key' => 'songuoi', 'label' => 'Số người tham gia', 'tdAttr' => ['data-t' => 'n']],
                    ],
                    'data' => collect($tb2->all())->map(function ($i){
                        return array_merge($i, [
                            'ngayxuly' => Html::a(dbToDate($i['ngayxuly']), ['/sxh/odich/update', 'id' => $i['odich_id']], ['title' => 'Xem chi tiết ổ dịch', 'target' => '_blank']),
                            'tt' => "Lần {$i['tt']}",
                            'tyle_sonha' => "{$i['sonha']} / {$i['sonocgia']}",
                        ]);
                    })
                ]);
            }


            $field = $maquan ? ['key' => 'maphuong', 'name' => 'tenphuong', 'label' => 'Phường xã', 'table' => HcPhuong::tableName(), 'filter' => ['maquan' => $maquan]] : ['key' => 'maquan', 'name' => 'tenquan', 'label' => 'Quận huyện', 'table' => HcQuan::tableName(), 'filter' => ['maquan' => null]];

            $phc = (new Query())->select('odich_id, MIN(tt) min_tt, MAX ( tt ) m_tt, COUNT(tt) c_tt, SUM ( solit_hc ) solit_hc, MIN(ngayxuly) ngayxuly')->from(['phc' => PhunHc::tableName()])->groupBy('odich_id')->andFilterDate(['ngayxuly' => [$date_from, $date_to]]);
            $phc_px = (new Query()) ->select("od.{$field['key']}, COUNT(DISTINCT od.maphuong) px_phc")->from(['tb' => PhunHc::tableName()])->leftJoin(['od' => Odich::tableName()], 'od.id = tb.odich_id')
                ->andFilterDate(['ngayxuly' => [$date_from, $date_to]])
                ->groupBy('od.'.$field['key'])->having('MAX (tt) = 1');

            $dlq = (new Query())->select('odich_id, MAX ( tt ) m_tt_dlq, MIN(ngayxuly) ngayxuly')->from(['phc' => DietLq::tableName()])->groupBy('odich_id')->andFilterDate(['ngayxuly' => [$date_from, $date_to]]);
            $dlq_px = (new Query())->select("od.{$field['key']}, COUNT(DISTINCT od.maphuong) px_dlq")->from(['tb' => DietLq::tableName()])->leftJoin(['od' => Odich::tableName()], 'od.id = tb.odich_id')->groupBy('od.'.$field['key'])
                ->andFilterDate(['ngayxuly' => [$date_from, $date_to]]);

            $tb3_od = (new Query())
                ->select([
                    $field['key'] => "od.{$field['key']}",
                    'xl_m' => 'SUM ( CASE WHEN min_tt = 1 AND (loai_od = 1 OR loai_od = 5)  THEN 1 END )',
                    'px_xl_m' => 'COUNT(DISTINCT CASE WHEN min_tt = 1 AND (loai_od = 1 OR loai_od = 5) THEN maphuong END)',
                    'xl1' => 'SUM ( CASE WHEN loai_od = 1 THEN 1 END )',
                    'xl2' => 'SUM ( CASE WHEN loai_od = 2 THEN 1 END )',
                    'px_xl2' => 'COUNT(DISTINCT CASE WHEN loai_od = 2 THEN maphuong END)',
                    'xl3' => 'SUM ( CASE WHEN loai_od = 3 THEN 1 END )',
                    'xl4' => 'SUM ( CASE WHEN loai_od = 4 THEN 1 END )',
                    'xl5' => 'SUM ( CASE WHEN loai_od = 5 THEN 1 END )',
                    'tong_odxl' => 'SUM(phc.c_tt)',
                    'solit_hc' => 'SUM (phc.solit_hc)',
                    'soluot_dlq' => 'SUM (dlq.m_tt_dlq)',
                    'dncs_count' => 'SUM(od.dncs_count)',
                ])
                ->from(['od' => Odich::tableName()])
                ->leftJoin(['phc' => $phc], 'phc.odich_id = od.id')
                ->leftJoin(['dlq' => $dlq], 'dlq.odich_id = od.id')
                ->andFilterDate(['COALESCE(phc.ngayxuly, dlq.ngayxuly)' => [$date_from, $date_to]])
                ->groupBy('od.'.$field['key'])
            ;

            $tb3 = (new Query())
                ->select("hc.{$field['name']} name, od.*, phc_px.px_phc, dlq_px.px_dlq")->from(['hc' => $field['table']])
                ->leftJoin(['od' => $tb3_od], "od.{$field['key']} = hc.{$field['key']}")
                ->leftJoin(['phc_px' => $phc_px], "phc_px.{$field['key']} = hc.{$field['key']}")
                ->leftJoin(['dlq_px' => $dlq_px], "dlq_px.{$field['key']} = hc.{$field['key']}")
                ->andFilterWhere($field['filter'])
                ->orderBy('order');

            if($loai_tk == 3){
                $group1 = 'Ổ dịch mới';
                $group2 = 'Phân loại ổ dịch';

                return $this->asJson([
                    'fields' => array_merge([
                        ['key' => 'stt', 'label' => '#', 'type' => 'serial'],
                        ['key' => 'name', 'label' => $field['label'], 'thStyle' => 'min-width: 150px'],
                        ['key' => 'xl_m', 'label' => 'Số ổ dịch mới xử lý', 'tdAttr' => ['data-t' => 'n'], 'group' => $group1],
                        ['key' => 'px_xl_m', 'label' => 'Số PX xử lý', 'tdAttr' => ['data-t' => 'n'], 'group' => $group1],
                        ['key' => 'xl1', 'label' => 'Ổ dịch', 'tdAttr' => ['data-t' => 'n'], 'group' => $group2],
                        ['key' => 'xl2', 'label' => 'Ổ dịch diện rộng', 'tdAttr' => ['data-t' => 'n'], 'group' => $group2],
                        ['key' => 'px_xl2', 'label' => 'Số PX xử lý ổ dịch diện rộng', 'tdAttr' => ['data-t' => 'n'], 'group' => $group2],
                        ['key' => 'xl3', 'label' => 'Ổ dịch liên PX', 'tdAttr' => ['data-t' => 'n'], 'group' => $group2],
                        ['key' => 'xl4', 'label' => 'Ổ dịch liên QH', 'tdAttr' => ['data-t' => 'n'], 'group' => $group2],
                        ['key' => 'xl5', 'label' => 'Ổ dịch ca dương tính', 'tdAttr' => ['data-t' => 'n'], 'group' => $group2],

                        ['key' => 'tong_xl', 'label' => 'Tổng số ổ dịch được xử lý', 'tdAttr' => ['data-t' => 'n']],
                    ], [
                        ['key' => 'tong_odxl', 'label' => 'Tổng lượt ổ dịch được xử lý', 'tdAttr' => ['data-t' => 'n']],
                        ['key' => 'solit_hc', 'label' => 'Số lít hóa chất (chưa pha)', 'tdAttr' => ['data-t' => 'n']],
                        ['key' => 'px_dlq', 'label' => 'Số PX tổ chức diệt lăng quăng', 'tdAttr' => ['data-t' => 'n']],
                        ['key' => 'soluot_dlq', 'label' => 'Số lượt diệt lăng quăng', 'tdAttr' => ['data-t' => 'n']],
                        ['key' => 'dncs_count', 'label' => 'Số điểm nguy cơ trong ổ dịch', 'tdAttr' => ['data-t' => 'n']],
                        ['key' => 'dncs_odxp', 'label' => 'Số điểm nguy cơ trong ổ dịch xử phạt', 'tdAttr' => ['data-t' => 'n']],
                    ]),
                    'data' => collect($tb3->all())->map(function ($i) use($dm_loai_od){
                        $tong_xl = collect($i)->only(['xl1', 'xl2', 'xl3', 'mxl4', 'mxl5'])->sum();

                        return array_merge($i, [
                            'tong_xl' => $tong_xl == 0 ? null : $tong_xl,
                        ]);
                    })
                ]);
            }
        }


        return $this->render('odich');
    }

    public function actionKhupho(){
        $model = new KhuphoForm();
        if($model->load(request()->all())){
            $maquan = $model->maquan;
            $maphuong = $model->maphuong;


            $q0 = (new Query())
                ->select('kp.maquan, kp.maphuong, kp.khupho, COUNT(tdp.*) to_dp')
                ->from(['kp' => DmKhupho::tableName()])
                ->leftJoin(['tdp' => DmToDp::tableName()], "kp.khupho = tdp.khupho AND kp.maphuong = tdp.maphuong AND kp.maquan = tdp.maquan")
                ->andFilterWhere(['kp.maphuong' => $maphuong])
                ->groupBy(new Expression('1,2,3'))
            ;

            $field = $maquan ? (
                !$maphuong ? ['code' => 'maphuong', 'name' => 'tenphuong', 'label' => 'Phường xã'] : []
            ) : ['code' => 'maquan', 'name' => 'tenquan', 'label' => 'Quận huyện'];

            $q = $maphuong ? $q0 : (new Query())
                ->select("px.{$field['code']} code, px.{$field['name']} name, COUNT(kp.khupho) khupho, SUM(kp.to_dp)::int to_dp")
                ->from(['px' => HcPhuong::tableName()])
                ->leftJoin(['kp' => $q0], "kp.maphuong = px.maphuong AND kp.maquan = px.maquan")
                ->andFilterWhere(['kp.maphuong' => $maphuong])
                ->andFilterWhere(['kp.maquan' => $maquan])
                ->groupBy(new Expression('1,2'))
            ;


            $data = collect($q->all())
                ->sortBy('khupho', SORT_NATURAL)
                ->sortBy('name', SORT_NATURAL)
                ->values();

            return $this->asJson(['data' => $data->all(), 'field' => $field]);
        }

        return $this->render('khupho', compact('model'));
    }

}
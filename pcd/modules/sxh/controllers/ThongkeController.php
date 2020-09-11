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
            $hc = request()->post('hc');
            $dm_loai_od = api('dm_loaiodich');

            $od = (new Query())
                ->select('id odich_id, sonocgia, loai_od, dncs_count, px.tenphuong, px.tenquan, px.maquan')->from(['od' => Odich::tableName()])
                ->leftJoin(['px' => HcPhuong::tableName()], 'px.maphuong = od.maphuong')
            ;

            $tb1 = (new Query())
                ->select('phc.*, od.loai_od, od.tenquan, od.tenphuong, od.dncs_count')->from(['phc' => PhunHc::tableName()])
                ->leftJoin(['od' => $od], 'od.odich_id = phc.odich_id')
                ->andFilterWhere(['od.maquan' => $hc])
                ->andFilterDate(['ngayxuly' => [$date_from, $date_to]])
            ;

            if($loai_tk == 1){
                return $this->asJson([
                    'fields' => [
                        ['key' => 'ngayxuly', 'label' => 'Ngày xử lý', 'format' => 'html'],
                        ['key' => 'loai_od', 'label' => 'Loại xử lý'],
                        ['key' => 'tt', 'label' => 'Lần phun',],
                        ['key' => 'tenquan', 'label' => 'Quận/ huyện',],
                        ['key' => 'tenphuong', 'label' => 'Phường/ xã',],
                        ['key' => 'khupho', 'label' => 'Khu phố/ Ấp (tổ)',],
                        ['key' => 'somaynho', 'label' => 'Số máy phun nhỏ đeo vai',],
                        ['key' => 'somaylon', 'label' => 'Máy phun lớn trên xe',],
                        ['key' => 'loai_hc', 'label' => 'Tên hóa chất',],
                        ['key' => 'solit_hc', 'label' => 'Số lít hóa chất (chưa pha)',],
                        ['key' => 'sonha_kphc', 'label' => 'Tỷ lệ nóc gia không PHC (%)',],
                        ['key' => 'songuoi_tg', 'label' => 'Tổng nhân sự tham gia',],
                        ['key' => 'dncs_count', 'label' => 'Số điểm nguy cơ trong ổ dịch',],
                        ['key' => 'dncs_odxp', 'label' => 'Số điểm nguy cơ trong ổ dịch xử phạt',],
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
                ->andFilterWhere(['od.maquan' => $hc])
            ;

            if($loai_tk == 2){
                return $this->asJson([
                    'fields' => [
                        ['key' => 'ngayxuly', 'label' => 'Ngày xử lý', 'format' => 'html'],
                        ['key' => 'tt', 'label' => 'Lần diệt lăng quăng',],
                        ['key' => 'tenquan', 'label' => 'Quận/ huyện',],
                        ['key' => 'tenphuong', 'label' => 'Phường/ xã',],
                        ['key' => 'khupho', 'label' => 'Khu phố/ Ấp (tổ)',],
                        ['key' => 'tyle_sonha', 'label' => 'Số nhà diệt lăng quăng / tổng số nhà',],
                        ['key' => 'songuoi', 'label' => 'Số người tham gia',],
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


            $field = $hc ? ['key' => 'maphuong', 'name' => 'tenphuong', 'label' => 'Phường xã', 'table' => HcPhuong::tableName(), 'filter' => ['maquan' => $hc]] : ['key' => 'maquan', 'name' => 'tenquan', 'label' => 'Quận huyện', 'table' => HcQuan::tableName(), 'filter' => ['maquan' => null]];

            $phc = (new Query()) ->select('odich_id, MAX ( tt ) m_tt, SUM ( solit_hc ) solit_hc ')->from(['phc' => PhunHc::tableName()])->groupBy('odich_id');
            $phc_px = (new Query()) ->select("od.{$field['key']}, COUNT(DISTINCT od.maphuong) px_phc")->from(['tb' => PhunHc::tableName()])->leftJoin(['od' => Odich::tableName()], 'od.id = tb.odich_id')->groupBy('od.'.$field['key'])->having('MAX (tt) = 1');

            $dlq = (new Query()) ->select('odich_id, MAX ( tt ) m_tt_dlq, SUM ( solit_hc ) solit_hc ')->from(['phc' => PhunHc::tableName()])->groupBy('odich_id');
            $dlq_px = (new Query()) ->select("od.{$field['key']}, COUNT(DISTINCT od.maphuong) px_dlq")->from(['tb' => DietLq::tableName()])->leftJoin(['od' => Odich::tableName()], 'od.id = tb.odich_id')->groupBy('od.'.$field['key']);

            $tb3_od = (new Query())
                ->select([
                    $field['key'] => "od.{$field['key']}",
                    'mxl1' => 'SUM ( CASE WHEN m_tt = 1 AND loai_od = 1 THEN 1 END )',
                    'mxl2' => 'SUM ( CASE WHEN m_tt = 1 AND loai_od = 2 THEN 1 END )',
                    'mxl3' => 'SUM ( CASE WHEN m_tt = 1 AND loai_od = 3 THEN 1 END )',
                    'mxl4' => 'SUM ( CASE WHEN m_tt = 1 AND loai_od = 4 THEN 1 END )',
                    'tong_odxl' => 'SUM ( CASE WHEN loai_od IS NOT NULL THEN 1 END )',
                    'px_od_xldr' => 'COUNT(DISTINCT CASE WHEN loai_od = 2 THEN maphuong END)',
                    'solit_hc' => 'SUM (phc.solit_hc)',
                    'soluot_dlq' => 'SUM (dlq.m_tt_dlq)',
                    'dncs_count' => 'SUM(od.dncs_count)',
                ])
                ->from(['od' => Odich::tableName()])
                ->leftJoin(['phc' => $phc], 'phc.odich_id = od.id')
                ->leftJoin(['dlq' => $dlq], 'dlq.odich_id = od.id')
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
                $so_px = is_null($hc) ? [
                    ['key' => 'px_phc', 'label' => 'Số PX có ổ dịch mới được xử lý'],
                    ['key' => 'px_od_xldr', 'label' => 'Số PX xử lý ổ dịch diện rộng'],
                ] : [
                    ['key' => 'px_phc', 'label' => 'PX có ổ dịch mới được xử lý'],
                    ['key' => 'px_od_xldr', 'label' => 'PX có xử lý ổ dịch diện rộng']
                ];

                return $this->asJson([
                    'fields' => array_merge([
                        ['key' => 'name', 'label' => $field['label'], 'thStyle' => 'min-width: 150px'],
                        ['key' => 'mxl1', 'label' => 'Số ổ dịch mới xử lý'],
                        ['key' => 'mxl2', 'label' => 'Số ổ dịch mới xử lý diện rộng'],
                        ['key' => 'mxl3', 'label' => 'Số ổ dịch mới liên PX'],
                        ['key' => 'mxl4', 'label' => 'Số ổ dịch mới liên QH'],
                        ['key' => 'tong_odmxl', 'label' => 'Tổng số ổ dịch mới được xử lý'],
                    ], $so_px, [
                        ['key' => 'tong_odxl', 'label' => 'Tổng số ổ dịch được xử lý'],
                        ['key' => 'solit_hc', 'label' => 'Số lít hóa chất (chưa pha)'],
                        ['key' => 'px_dlq', 'label' => 'Số PX tổ chức diệt lăng quăng'],
                        ['key' => 'soluot_dlq', 'label' => 'Số lượt diệt lăng quăng'],
                        ['key' => 'dncs_count', 'label' => 'Số điểm nguy cơ trong ổ dịch'],
                        ['key' => 'dncs_odxp', 'label' => 'Số điểm nguy cơ trong ổ dịch xử phạt'],
                    ]),
                    'data' => collect($tb3->all())->map(function ($i) use($dm_loai_od){
                        $tong_odmxl = collect($i)->only(['mxl1', 'mxl2', 'mxl3', 'mxl4'])->sum();
                        $px_od_xldr = $i['px_od_xldr'];

                        return array_merge($i, [
                            'tong_odmxl' => $tong_odmxl == 0 ? null : $tong_odmxl,
                            'px_od_xldr' => $px_od_xldr == 0 ? null : $px_od_xldr,
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
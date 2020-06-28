<?php

namespace pcd\modules\sxh\controllers;

use pcd\controllers\AppController;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use pcd\modules\sxh\models\DietLq;
use pcd\modules\sxh\models\Odich;
use pcd\modules\sxh\models\PhunHc;
use ttungbmt\db\Query;
use yii\helpers\ArrayHelper;

class ThongkeController extends AppController
{
//    public $enableCsrfValidation = false;

    public function actionOdich(){
        $dm_loai_od = api('dm_loaiodich');

        if(request()->isPost){
            $loai_tk = request()->post('loai_tk');
            $date_from = request()->post('date_from');
            $date_to = request()->post('date_to');
            $dm_loai_od = api('dm_loaiodich');

            $od = (new Query())
                ->select('id odich_id, sonocgia, loai_od, dncs_count, px.tenphuong, px.tenquan')->from(['od' => Odich::tableName()])
                ->leftJoin(['px' => HcPhuong::tableName()], 'px.maphuong = od.maphuong')
            ;

            $tb1 = (new Query())
                ->select('phc.*, od.loai_od, od.tenquan, od.tenphuong, od.dncs_count')->from(['phc' => PhunHc::tableName()])
                ->leftJoin(['od' => $od], 'od.odich_id = phc.odich_id')
                ->andFilterDate(['ngayxuly' => [$date_from, $date_to]])
            ;

            if($loai_tk == 1){
                return $this->asJson([
                    'fields' => [
                        ['key' => 'ngayxuly', 'label' => 'Ngày xử lý'],
                        ['key' => 'loai_od', 'label' => 'Loại xử lý',],
                        ['key' => 'tt', 'label' => 'Lần phun',],
                        ['key' => 'tenquan', 'label' => 'Quận/ huyện',],
                        ['key' => 'tenphuong', 'label' => 'Phường/ xã',],
                        ['key' => 'khupho', 'label' => 'Khu phố/ Ấp (tổ)',],
                        ['key' => 'somaynho', 'label' => 'Số máy phun nhỏ đeo vai',],
                        ['key' => 'somaylon', 'label' => 'Máy phun lớn trên xe',],
                        ['key' => 'loai_hc', 'label' => 'Tên hóa chất',],
                        ['key' => 'solit_hc', 'label' => 'Số lít hóa chất (chưa pha)',],
                        ['key' => 'sonha_kphc', 'label' => 'Số nhà không phun được / tổng số nhà',],
                        ['key' => 'songuoi_tg', 'label' => 'Tổng nhân sự tham gia',],
                        ['key' => 'dncs_count', 'label' => 'Số điểm nguy cơ trong ổ dịch',],
                        ['key' => 'dncs_odxp', 'label' => 'Số điểm nguy cơ trong ổ dịch xử phạt',],
                    ],
                    'data' => collect($tb1->all())->map(function ($i) use($dm_loai_od){
                        return array_merge($i, [
                            'ngayxuly' => dbToDate($i['ngayxuly']),
                            'loai_od' => data_get($dm_loai_od, $i['loai_od']),
                            'tt' => "Lần {$i['tt']}",
                        ]);
                    })
                ]);
            }

            $tb2 = (new Query())
                ->select('dlq.*, od.loai_od, od.tenquan, od.tenphuong, od.sonocgia')->from(['dlq' => DietLq::tableName()])
                ->leftJoin(['od' => $od], 'od.odich_id = dlq.odich_id')
                ->andFilterDate(['ngayxuly' => [$date_from, $date_to]])
            ;

            if($loai_tk == 2){
                return $this->asJson([
                    'fields' => [
                        ['key' => 'ngayxuly', 'label' => 'Ngày xử lý',],
                        ['key' => 'tt', 'label' => 'Lần diệt lăng quăng',],
                        ['key' => 'tenquan', 'label' => 'Quận/ huyện',],
                        ['key' => 'tenphuong', 'label' => 'Phường/ xã',],
                        ['key' => 'khupho', 'label' => 'Khu phố/ Ấp (tổ)',],
                        ['key' => 'tyle_sonha', 'label' => 'Số nhà diệt lăng quăng / tổng số nhà',],
                        ['key' => 'songuoi', 'label' => 'Số người tham gia',],
                    ],
                    'data' => collect($tb2->all())->map(function ($i){
                        return array_merge($i, [
                            'ngayxuly' => dbToDate($i['ngayxuly']),
                            'tt' => "Lần {$i['tt']}",
                            'tyle_sonha' => "{$i['sonha']} / {$i['sonocgia']}",
                        ]);
                    })
                ]);
            }

            $phc = (new Query()) ->select('odich_id, MAX ( tt ) m_tt, SUM ( solit_hc ) solit_hc ')->from(['phc' => PhunHc::tableName()])->groupBy('odich_id');
            $phc_px = (new Query()) ->select('od.maquan, COUNT(DISTINCT od.maphuong) px_phc')->from(['tb' => PhunHc::tableName()])->leftJoin(['od' => Odich::tableName()], 'od.id = tb.odich_id')->groupBy('od.maquan')->having('MAX (tt) = 1');

            $dlq = (new Query()) ->select('odich_id, MAX ( tt ) m_tt_dlq, SUM ( solit_hc ) solit_hc ')->from(['phc' => PhunHc::tableName()])->groupBy('odich_id');
            $dlq_px = (new Query()) ->select('od.maquan, COUNT(DISTINCT od.maphuong) px_dlq')->from(['tb' => DietLq::tableName()])->leftJoin(['od' => Odich::tableName()], 'od.id = tb.odich_id')->groupBy('od.maquan')->having('MAX (tt) = 1');


            $tb3_od = (new Query())
                ->select([
                    'maquan' => 'od.maquan',
                    'mxl1' => 'SUM ( CASE WHEN m_tt = 1 AND loai_od = 1 THEN 1 END )',
                    'mxl2' => 'SUM ( CASE WHEN m_tt = 1 AND loai_od = 2 THEN 1 END )',
                    'mxl3' => 'SUM ( CASE WHEN m_tt = 1 AND loai_od = 3 THEN 1 END )',
                    'mxl4' => 'SUM ( CASE WHEN m_tt = 1 AND loai_od = 4 THEN 1 END )',
                    'tong_odxl' => 'SUM ( CASE WHEN loai_od IS NOT NULL THEN 1 END )',
                    'solit_hc' => 'SUM (phc.solit_hc)',
                    'soluot_dlq' => 'SUM (dlq.m_tt_dlq)',
                    'dncs_count' => 'SUM(od.dncs_count)',
                ])
                ->from(['od' => Odich::tableName()])
                ->leftJoin(['phc' => $phc], 'phc.odich_id = od.id')
                ->leftJoin(['dlq' => $dlq], 'dlq.odich_id = od.id')
                ->groupBy('od.maquan')
            ;


            $tb3 = (new Query())
                ->select('qh.tenquan, od.*, phc_px.px_phc, dlq_px.px_dlq')->from(['qh' => HcQuan::tableName()])
                ->leftJoin(['od' => $tb3_od], 'od.maquan = qh.maquan')
                ->leftJoin(['phc_px' => $phc_px], 'phc_px.maquan = qh.maquan')
                ->leftJoin(['dlq_px' => $dlq_px], 'dlq_px.maquan = qh.maquan')
                ->orderBy('order');

            if($loai_tk == 3){
                return $this->asJson([
                    'fields' => [
                        ['key' => 'tenquan', 'label' => 'Quận huyện', 'thStyle' => 'min-width: 150px'],
                        ['key' => 'mxl1', 'label' => 'Số ổ dịch mới xử lý'],
                        ['key' => 'mxl2', 'label' => 'Số ổ dịch mới xử lý diện rộng'],
                        ['key' => 'mxl3', 'label' => 'Số ổ dịch mới liên PX'],
                        ['key' => 'mxl4', 'label' => 'Số ổ dịch mới liên QH'],
                        ['key' => 'tong_odxl', 'label' => 'Tổng số ổ dịch mới được xử lý'],
                        ['key' => 'px_phc', 'label' => 'Số PX có ổ dịch mới được xử lý'],
                        ['key' => 'ngayxuly', 'label' => 'Số PX xử lý ổ dịch diện rộng'],
                        ['key' => 'ngayxuly', 'label' => 'Tổng số ổ dịch được xử lý'],
                        ['key' => 'solit_hc', 'label' => 'Số lít hóa chất (chưa pha)'],
                        ['key' => 'px_dlq', 'label' => 'Số PX tổ chức diệt lăng quăng'],
                        ['key' => 'soluot_dlq', 'label' => 'Số lượt diệt lăng quăng'],
                        ['key' => 'dncs_count', 'label' => 'Số điểm nguy cơ trong ổ dịch'],
                        ['key' => 'dncs_odxp', 'label' => 'Số điểm nguy cơ trong ổ dịch xử phạt'],
                    ],
                    'data' => collect($tb3->all())->map(function ($i) use($dm_loai_od){
                        return array_merge($i, [

                        ]);
                    })
                ]);
            }
        }


        return $this->render('odich');
    }
}
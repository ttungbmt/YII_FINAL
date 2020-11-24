<?php

namespace pcd\controllers\admin;

use common\models\Query;
use pcd\controllers\AppController;
use pcd\forms\TkForm;
use pcd\models\Cabenh;
use pcd\models\Danso;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use pcd\models\VDmQuan1;

class ThongkeController extends AppController
{
    public $data;

    public function init()
    {
        parent::init();
        $this->request = Yii::$app->request;
    }

    public function actionIndex()
    {
        $this->data['qh'] = ArrayHelper::map(VDmQuan1::find()->orderBy('ten_qh')->asArray()->all(), 'ma_qh', 'ten_qh');
        $this->data['model'] = new TkForm();

        return $this->render('index', $this->data);
    }

    public function actionAjax()
    {
        $data = $this->request->post();

        $model = new TkForm();

        if ($model->load($data) && $model->validate()) {
            $model->xulyTK();
            if (!role('phuong')) {
                $this->data['model'] = $model;
                return $this->renderPartial('loaitk/_kpa_quan', $this->data);
            }
        }

        $this->data['model'] = $model;
        return $this->renderPartial('loaitk/_kpa', $this->data);

    }

    public function actionMacbenh()
    {

        $request = Yii::$app->request;
        $loaibenh = $request->post('loaibenh');
        $nam = (int)$request->post('nam');
        if ($request->isPost && $nam) {
            $tyle_mac = Yii::$app->db->createCommand(
                "SELECT quan, tyle FROM (
                    SELECT quan, to_char(thoigian,'YYYY')::int as nam, sum(macbenh) as tyle, loaibenh FROM tk_macbenh GROUP BY quan, to_char(thoigian,'YYYY'), loaibenh
                ) tyle_mac
                WHERE nam =" . $nam . " AND loaibenh ='" . $loaibenh . "'
                ORDER BY tyle"
            )->queryAll();

            $sotuvong = Yii::$app->db->createCommand(
                "SELECT quan, tongso FROM (
                    SELECT quan, to_char(thoigian,'YYYY')::int as nam, sum(tuvong) as tongso, loaibenh FROM tk_tuvong GROUP BY quan, to_char(thoigian,'YYYY'), loaibenh
                ) sotuvong
                WHERE nam =" . $nam . " AND loaibenh ='" . $loaibenh . "'
                ORDER BY tongso"
            )->queryAll();

            if (!$tyle_mac) {
                Yii::$app->session->setFlash('warning', 'Không tìm thấy dữ liệu mắc bệnh');
            } elseif (!$sotuvong) {
                Yii::$app->session->setFlash('warning', 'Không tìm thấy dữ liệu tử vong');
            }

            return $this->render('macbenh', [
                'tyle_mac' => $tyle_mac,
                'sotuvong' => $sotuvong,
            ]);
        }

        return $this->render('macbenh');
    }

    # http://localhost:1111/dichte/thongke/cabenh


    public function actionCabenh()
    {
        $request = Yii::$app->request;
        $thang = (int)$request->post('thang');
        $nam = (int)$request->post('nam');
        if ($request->isPost && $nam) {
            if ($thang) {
                $tkThang = Yii::$app->db->createCommand(
                    "SELECT to_char(ngaymacbenh,'dd')::int ngay, count(to_char(ngaymacbenh,'dd'))::int as tongcong, chuandoan, to_char(ngaymacbenh,'MM')::int as thang, to_char(ngaymacbenh,'YYYY')::int as nam  FROM cabenh
                    WHERE to_char(ngaymacbenh,'YYYY')::int = " . $nam . " AND to_char(ngaymacbenh,'MM')::int = " . $thang . "
                    GROUP BY to_char(ngaymacbenh,'dd')::int, to_char(ngaymacbenh,'MM')::int, to_char(ngaymacbenh,'YYYY')::int, chuandoan
                    HAVING (chuandoan = 'SXH' OR chuandoan = 'TCM')
                    ORDER BY to_char(ngaymacbenh,'dd')::int;"
                )->queryAll();

                $sxh = $this->filterDichte($tkThang)['sxh'];
                $tcm = $this->filterDichte($tkThang)['tcm'];
                if (!$tcm && $sxh) {

                } elseif ($tcm && !$sxh) {

                } else {

                }

                $numday = cal_days_in_month(CAL_GREGORIAN, 9, 2015);

                // Tạo mảng
                for ($i = 1; $i <= $numday; $i++) {
                    if (isset($sxh[$i])) {
                        $sxh_thang[$i] = $sxh[$i];
                    } else {
                        $sxh_thang[$i] = [
                            'ngay'      => $i,
                            'nam'       => reset($sxh)['nam'],
                            'thang'     => reset($sxh)['thang'],
                            'tongcong'  => 0,
                            'chuandoan' => 'SXH',
                        ];
                    }
                }

                for ($i = 1; $i <= $numday; $i++) {
                    if (isset($tcm[$i])) {
                        $tcm_thang[$i] = $tcm[$i];
                    } else {
                        $tcm_thang[$i] = [
                            'ngay'      => $i,
                            'nam'       => reset($tcm)['nam'],
                            'thang'     => reset($tcm)['thang'],
                            'tongcong'  => 0,
                            'chuandoan' => 'TCM',
                        ];
                    }
                }
                // Tạo mảng Chart
                $chartData = [];
                foreach ($sxh_thang as $ngay => $item) {
                    array_push($chartData, [
                        'ngay' => $ngay,
                        'sxh'  => $item['tongcong'],
                        'tcm'  => $tcm_thang[$ngay]['tongcong'],
                    ]);
                }

                return $this->render('index_demo', [
                    'tkThang' => [
                        'sxh'       => $sxh_thang,
                        'tcm'       => $tcm_thang,
                        'chartData' => $chartData,
                    ],
                ]);
            }

            $tkNam = Yii::$app->db->createCommand(
                "SELECT to_char(ngaymacbenh,'YYYY')::int as nam, to_char(ngaymacbenh,'MM')::int as thang, count(to_char(ngaymacbenh,'MM'))::int as tongcong, chuandoan FROM cabenh
                GROUP BY to_char(ngaymacbenh,'YYYY'), to_char(ngaymacbenh,'MM'), chuandoan
                HAVING to_char(ngaymacbenh,'YYYY')::int = " . $nam . " AND (chuandoan = 'SXH' OR chuandoan = 'TCM')
                ORDER BY to_char(ngaymacbenh,'MM');"
            )->queryAll();

            if (empty($tkNam) && !$tkNam) {
                Yii::$app->session->setFlash('warning', 'Không tìm thấy dữ liệu');

                return $this->render('index_demo');
            }


            $sxh = $this->filterDichte($tkNam)['sxh'];
            $tcm = $this->filterDichte($tkNam)['tcm'];


            // Tạo mảng
            for ($i = 1; $i <= 12; $i++) {
                if (!isset($sxh[$i])) {
                    $sxh[$i] = [
                        'nam'       => $tkNam,
                        'thang'     => $i,
                        'tongcong'  => 0,
                        'chuandoan' => 'SXH',
                    ];
                }
                if ($sxh[$i]) {
                    $sxh_nam[$i] = $sxh[$i];
                } else {
                    $sxh_nam[$i] = [
                        'nam'       => reset($sxh)['nam'],
                        'thang'     => $i,
                        'tongcong'  => 0,
                        'chuandoan' => 'SXH',
                    ];
                }
            }

            for ($i = 1; $i <= 12; $i++) {
                if (!isset($tcm[$i])) {
                    $tcm[$i] = [
                        'nam'       => $tkNam,
                        'thang'     => $i,
                        'tongcong'  => 0,
                        'chuandoan' => 'TCM',
                    ];
                }
                if ($tcm[$i]) {
                    $tcm_nam[$i] = $tcm[$i];
                } else {
                    $tcm_nam[$i] = [
                        'nam'       => reset($tcm)['nam'],
                        'thang'     => $i,
                        'tongcong'  => 0,
                        'chuandoan' => 'TCM',
                    ];
                }
            }

            // Tạo mảng Chart
            $chartData = [];
            foreach ($sxh_nam as $thang => $item) {
                array_push($chartData, [
                    'thang' => $thang,
                    'sxh'   => $item['tongcong'],
                    'tcm'   => $tcm_nam[$thang]['tongcong'],
                ]);
            }

            return $this->render('index_demo', ['tkNam' => [
                'sxh'       => $sxh_nam,
                'tcm'       => $tcm_nam,
                'chartData' => $chartData,
            ]]);
        }


        return $this->render('index_demo');
    }

    public function filterDichte($tk)
    {

        // Bộ lọc
        foreach ($tk as $k => $item) {
            if ($item['chuandoan'] == 'SXH') {
                if (array_key_exists("ngay", $item)) {
                    $sxh[(int)$item['ngay']] = $item;
                } else {
                    $sxh[(int)$item['thang']] = $item;
                }

            } elseif ($item['chuandoan'] == 'TCM') {
                if (array_key_exists("ngay", $item)) {
                    $tcm[(int)$item['ngay']] = $item;
                } else {
                    $tcm[(int)$item['thang']] = $item;
                }
            }
        }
        $sxh = isset($sxh) ? $sxh : [];
        $tcm = isset($tcm) ? $tcm : [];

        return ['sxh' => $sxh, 'tcm' => $tcm];
    }

    public function getLayout()
    {
        return $this->layout;
    }


}
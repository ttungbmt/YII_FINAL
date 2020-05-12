<?php

namespace pcd\controllers\admin;

use pcd\controllers\AppController;
use pcd\models\CabenhSxh;
use pcd\models\OdichSxh;
use pcd\supports\RoleHc;
use Yii;
use yii\db\Expression;
use yii\db\Query;

class SiteController extends AppController {
    public function actionNotification() {
        $model = (new Query())
            ->select('xmcabenh, count(*)')
            ->from('v_list_cabenh')
            ->groupBy('xmcabenh');

        $model2 = (new Query())
            ->select('chuyenca_filter, count(*)')
            ->from('v_list_cabenh')
            ->groupBy('chuyenca_filter');

        $subQuery = (new Query())
            ->select('cb.ma_phuong, cb.ma_quan, dt.*')->from('cabenh cb')
            ->leftJoin('dieutra_sxh1 dt', 'cb.macabenh = dt.macabenh');


        $model3 = (new Query())
            ->addSelect('sum(cdc_cbn_sxh)+sum(cdc_cbn_ksxh) cdc_cbn')
            ->addSelect('sum(cdc_kbn_pxk)+sum(cdc_kbn_qhk)+sum(cdc_kbn_tk) cdc_kbn')
            ->addSelect('sum(kdc_pxk)+sum(kdc_qhk)+sum(kdc_tk) kdc_kbn')
            ->from(['sxh' => $subQuery]);


        roleCond()->filterCabenh($subQuery);
        roleCond()->filterCabenh($model);
        roleCond()->filterCabenh($model2);

        roleCond()->filterCabenh($model3);


        $tk_dieutra = collect($model->all())->sortBy('xmcabenh');
        $tk_chuyenca = collect($model2->all())->filter(function ($value, $key) {
            return !is_null($value['chuyenca_filter']);
        })->sortBy('chuyenca_filter');
        $tk_dc_bn = collect($model3->one());


        return $this->renderJson([
            'view' => $this->renderPartial('notification', [
                'tk_dieutra'  => $tk_dieutra,
                'tk_chuyenca' => $tk_chuyenca,
                'tk_dc_bn'    => $tk_dc_bn,
            ])
        ]);
    }

    public function actionChangelog() {
        return $this->render('changelog');
    }

    public function actionDocGuide() {
        $url = roleCond()->docGuideUrl();
        return $this->render('doc_guide', compact('url'));
    }

    public function actionVideoGuide() {
        $media = [
            ['title' => 'Nhập excel', 'content' => 'Hướng dẫn nhập dữ liệu ca bệnh excel vào CSDL, hệ thống sẽ tự động chuyển dữ liệu xuống các quận, phường.', 'url' => asset('/storage/video/1. Nhap excel.mp4')],
            ['title' => 'Nhập phiếu điều tra', 'content' => 'Hướng dẫn nhập phiếu điều tra sốt xuất huyết để tiến hành khoanh vùng dịch bệnh.', 'url' => asset('storage/video/2. Nhap phieu dieu tra.mp4')],
            ['title' => 'Chuyển ca bệnh', 'content' => 'Chuyển ca bệnh sang phường xã khác', 'url' => asset('storage/video/3. Chuyen ca.mp4')],
            ['title' => 'Định vị bằng điện thoại Android', 'content' => 'Định vị vị trí ca bệnh bằng điện thoại Android', 'url' => asset('storage/video/Dinh vi bang dien thoai.mp4')],
            ['title' => 'Đổi mật khẩu người dùng', 'content' => 'Đổi mật khẩu người dùng', 'url' => asset('storage/video/Dinh vi bang dien thoai.mp4')],
            ['title' => 'Xuất file ảnh ổ dịch', 'content' => 'Lưu/In ổ dịch ra các định dạng ảnh, dán vào word, excel,..', 'url' => asset('storage/video/Chup anh ca benh.mp4')],
        ];

        return $this->render('video_guide', compact('media'));
    }

    public function actionContact() {
        return $this->render('contact');
    }

    public function actionIndex() {
        $host = data_get($_SERVER, 'HTTP_HOST');

        if (!Yii::$app->request->isSecureConnection && $host == 'pcd.hcmgis.vn') {
            $url = Yii::$app->request->getAbsoluteUrl();
            $url = str_replace('http:', 'https:', $url);
            return $this->redirect($url);
        }

        $role = RoleHc::init();

        //Số lượng ca bệnh
        $cabenhs = CabenhSxh::find();
        $role->filterCabenhSxh($cabenhs);
        $cabenhs = $cabenhs->count();

        //Số lượng user
        $users = (new Query())
            ->select('COUNT(*)')
            ->from('user')
            ->column();

        //Số lượng ổ dịch sxh
        $odichs = OdichSxh::find();
        $role->filterCabenhSxh($odichs);
        $odichs = $odichs->count();

        //Số lượng bệnh viện
        $benhviens = (new Query())
            ->select('COUNT(*)')
            ->from('benhvien')
            ->column();


        $week1 = $this->createBieudo(1);
        $week2 = $this->createBieudo(2);
        $week3 = $this->createBieudo(3);
        $week4 = $this->createBieudo(4);

        return $this->render('index', [
            'users'     => $users,
            'cabenhs'   => $cabenhs,
            'odichs'    => $odichs,
            'benhviens' => $benhviens,
            'week1'     => $week1,
            'week2'     => $week2,
            'week3'     => $week3,
            'week4'     => $week4,
        ]);
    }

    protected function createBieudo($type) {
        $role = RoleHc::init();
        // 1: Nội trú TP gửi về
        // 2: Nội trú, ngoại trú TP gửi về
        // 3: Nội trú thực tế
        // 4: Nội trú, ngoại trú thực tế

        $date = "COALESCE(ngaynhapvien, ngaymacbenh)";
        $q = (new Query())
            ->select([
                'year'   => "date_part('year', {$date})",
                'weekly' => "date_part('week', {$date})",
                'count'  => "COUNT(*)",
            ])
            ->from('cabenh_sxh')
            ->where(new Expression("date_part('year', {$date}) BETWEEN date_part('year', NOW())-1 AND date_part('year', NOW())"))
            ->groupBy('year, weekly')
            ->orderBy('weekly, year');

        if ($type == 1) {
            $q->andWhere(['tp_guive' => 1, 'ht_dieutri' => '1']);
        } elseif ($type == 2) {
            $q->andWhere(['tp_guive' => 1]);
        } elseif ($type == 3) {
            $q->andWhere(['ht_dieutri' => 1]);
            $q->andWhere(['<>', 'is_trave', 1]);
        } elseif ($type == 4) {
            $q->andWhere(['<>', 'is_trave', 1]);
        }

        $role->filterCabenhSxh($q);

        return collect($q->all())->groupBy('weekly')->map(function ($item, $k) {
            $p_i = $item->firstWhere('year', date('Y') - 1);
            $i = $item->firstWhere('year', date('Y'));
            return [
                'weekly' => $k,
                'p_year' => data_get($p_i, 'count', 0),
                'year'   => data_get($i, 'count', 0),
            ];
        })->values()->all();
    }
}
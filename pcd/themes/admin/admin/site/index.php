<?php

use ttungbmt\amcharts\AmCharts;
use yii\helpers\Html;

$this->title = 'Trang chủ';
$buildChart = function ($dataProvier, $title){
    return AmCharts::widget([
        'height'               => '400px',
        'valueAxes'            => [
            ['title' => 'Số lượng ca bệnh']
        ],
        'defaultPluginOptions' => [
            'titles' => [['text' => $title." ".(date('Y')-1)."-".date('Y')."/ Tuần", 'size' => 16, 'color' => '#FF8000']],
            'legend'         => [
                'enabled' => true
            ],
            'title'          => '',
            'chartScrollbar' => [
                'enabled'         => true,
                'scrollbarHeight' => 10,
                'dragIconHeight'  => 25
            ],
            'categoryField'  => 'weekly',
            'graphs'         => [
                [
                    'title'        => 'Năm '.date('Y'),
                    'type'        => 'column',
                    'valueField'  => 'year',
                    'fillAlphas'  => 1,
                    'lineColor'   => '#66BB6A',
                    'balloonText' => 'Tuần [[weekly]]: [[value]]',
                    'columnWidth' => 0.7,
                ],
                [
                    'title'        => 'Năm '.(date('Y')-1),
                    'valueField'    => 'p_year',
                    'bullet'        => 'round',
                    'lineColor'     => '#ff0000',
                    'lineThickness' => 2,
                    'balloonText'   => 'Tuần [[weekly]]: [[value]]',
                ],

            ],
            'dataProvider'   => $dataProvier
        ]
    ]);
}
?>

<style type="text/css">
    .amcharts-chart-div > a {
        display: none !important;
    }
</style>
<?php if(role('quan|phuong')):?>
    <div class="alert alert-primary border-0 alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <span class="font-weight-semibold text-uppercase">Thông báo!</span>
        <br> - Hiện tại hệ thống vừa được cập nhật nên không thể tránh khỏi những lỗi kỹ thuật về tài khoản và chức năng. Mong quý anh/chị thông cảm cho sự bất tiện này ảnh hưởng tiến độ công việc, hiện chúng tôi đang hoàn tất chỉnh sửa để hệ thống được tốt hơn. Chân thành cám ơn.
        <br> - Trường hợp không nhập được phiếu điều tra. Quý anh/ chị gửi mail thông tin liên hệ và hình ảnh chụp lỗi cho TÙNG (ttungbmt@gmail.com - 0796628733) để được xử lỷ ngay, kịp tiến độ công việc
    </div>
<?php endif;?>

<div class="system-statistic row">
    <div class="col-md-3">
        <div class="card card-body bg-success-400 has-bg-image">
            <div class="media no-margin">
                <div class="media-body">
                    <h3 class="no-margin"><?= isset($cabenhs) ? $cabenhs : "0"; ?></h3>
                    <span class="text-uppercase text-size-mini">Ca bệnh</span>
                </div>
                <div class="media-right media-middle">
                    <i class="icon-brain icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-body bg-danger-400 has-bg-image">
            <div class="media no-margin">
                <div class="media-body">
                    <h3 class="no-margin"><?= isset($odichs) ? $odichs : "0"; ?></h3>
                    <span class="text-uppercase text-size-mini">Ổ dịch</span>
                </div>
                <div class="media-right media-middle">
                    <i class="icon-cart4 icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-body bg-pink-400 has-bg-image">
            <div class="media no-margin">
                <div class="media-body">
                    <h3 class="no-margin"><?= isset($benhviens) ? $benhviens[0] : "0"; ?></h3>
                    <span class="text-uppercase text-size-mini">Bệnh viện</span>
                </div>
                <div class="media-right media-middle">
                    <i class="icon-office icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-body bg-indigo-400 has-bg-image">
            <div class="media no-margin">
                <div class="media-body">
                    <h3 class="no-margin"><?= isset($users) ? $users[0] : "0"; ?></h3>
                    <span class="text-uppercase text-size-mini">Người dùng</span>
                </div>
                <div class="media-right media-middle">
                    <i class="icon-user-tie icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" >
    <div class="col-md-6">
        <div class="card card-white">
            <?= $buildChart($week1, 'Biểu đồ sốt xuất huyết nội trú TP gửi về ') ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-white">
            <?= $buildChart($week2, 'Biểu đồ sốt xuất huyết nội trú, ngoại trú TP gửi về') ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-white">
            <?= $buildChart($week3, 'Biểu đồ sốt xuất huyết nội trú thực tế') ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-white">
            <?= $buildChart($week4, 'Biểu đồ sốt xuất huyết nội trú, ngoại trú thực tế') ?>
        </div>
    </div>
    <div class="col-md-9">

    </div>


</div>

<div class="row">
    <div class="col-md-9">
        <?= Html::tag('div', null, ['style' => 'min-height: 200px', 'data' => ['action' => 'embed', 'url' => url(['/api/thongke/thongke', 'type' => 'all'])]]) ?>
    </div>
    <?php if(role('admin')):?>
        <div class="col-md-3">
            <?= Html::tag('div', null, ['style' => 'min-height: 200px', 'data' => ['action' => 'embed', 'url' => url(['/api/thongke/activity'])]]) ?>
        </div>
    <?php endif; ?>

</div>
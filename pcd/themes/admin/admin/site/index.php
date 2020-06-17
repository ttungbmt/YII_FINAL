<?php

use Carbon\Carbon;
use kartik\widgets\DatePicker;
use ttungbmt\amcharts\AmCharts;
use yii\helpers\Html;

$this->title = 'Trang chủ';
$buildChart = function ($dataProvier, $max, $title) {
    return AmCharts::widget([
        'height' => '400px',
        'valueAxes' => [
            ['title' => 'Số lượng ca bệnh', 'maximum' => $max]
        ],
        'defaultPluginOptions' => [
            'titles' => [['text' => $title . " " . (date('Y') - 1) . "-" . date('Y') . "/ Tuần", 'size' => 16, 'color' => '#FF8000']],
            'legend' => [
                'enabled' => true
            ],
            'title' => '',
            'chartScrollbar' => [
                'enabled' => true,
                'scrollbarHeight' => 10,
                'dragIconHeight' => 25
            ],
            'categoryField' => 'weekly',
            'graphs' => [
                [
                    'title' => 'Năm ' . date('Y'),
                    'type' => 'column',
                    'valueField' => 'year',
                    'fillAlphas' => 1,
                    'lineColor' => '#66BB6A',
                    'balloonText' => 'Tuần [[weekly]]: [[value]]',
                    'columnWidth' => 0.7,
                ],
                [
                    'title' => 'Năm ' . (date('Y') - 1),
                    'valueField' => 'p_year',
                    'bullet' => 'round',
                    'lineColor' => '#ff0000',
                    'lineThickness' => 2,
                    'balloonText' => 'Tuần [[weekly]]: [[value]]',
                ],

            ],
            'dataProvider' => $dataProvier
        ]
    ]);
};
$max1 = collect($week1)->merge($week3)->max('p_year');
$max2 = collect($week2)->merge($week4)->max('p_year');

?>

<style type="text/css">
    .amcharts-chart-div > a {
        display: none !important;
    }
</style>
<?php if (role('quan|phuong')): ?>
    <div class="alert alert-primary border-0 alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <span class="font-weight-semibold text-uppercase">Thông báo!</span>
        <br> - Hiện tại hệ thống vừa được cập nhật nên không thể tránh khỏi những lỗi kỹ thuật về tài khoản và chức
        năng. Mong quý anh/chị thông cảm cho sự bất tiện này ảnh hưởng tiến độ công việc, hiện chúng tôi đang hoàn tất
        chỉnh sửa để hệ thống được tốt hơn. Chân thành cám ơn.
        <br> - Trường hợp không nhập được phiếu điều tra. Quý anh/ chị gửi mail thông tin liên hệ và hình ảnh chụp lỗi
        cho TÙNG (ttungbmt@gmail.com - 0796628733) để được xử lỷ ngay, kịp tiến độ công việc
    </div>
<?php endif; ?>

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

<div class="row">
    <div class="col-md-6">
        <div class="card card-white">
            <?= $buildChart($week1, $max1,'Biểu đồ sốt xuất huyết nội trú TP gửi về ') ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-white">
            <?= $buildChart($week2, $max2,'Biểu đồ sốt xuất huyết nội trú, ngoại trú TP gửi về') ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-white">
            <?= $buildChart($week3, $max1,'Biểu đồ sốt xuất huyết nội trú thực tế') ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-white">
            <?= $buildChart($week4, $max2,'Biểu đồ sốt xuất huyết nội trú, ngoại trú thực tế') ?>
        </div>
    </div>
    <div class="col-md-9">

    </div>


</div>

<form method="GET">

<div class="flex mb-2">
    <div class="self-center mr-2">
        <b class="mr-2">Ngày báo cáo:</b> Từ ngày
    </div>
    <div>
        <?= DatePicker::widget([
            'name' => 'date_from',
            'type' => DatePicker::TYPE_INPUT,
            'value' => request()->get('date_from', Carbon::create(2020,1,1)->format('d/m/Y')),
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy'
            ]
        ])?>
    </div>
    <div class="self-center mr-2">
        đến ngày
    </div>
    <div>
        <?= DatePicker::widget([
            'name' => 'date_to',
            'type' => DatePicker::TYPE_INPUT,
            'value' => request()->get('date_from', date('d/m/Y')),
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy'
            ]
        ])?>
    </div>
    <div>
        <button type="submit" class="btn btn-primary ml-2">Lọc dữ liệu</button>
    </div>
</div>
</form>


<div class="row">
    <div class="col-md-9">
        <?= Html::tag('div', null, ['style' => 'min-height: 200px', 'data' => ['action' => 'embed', 'url' => url(['/api/thongke/thongke', 'type' => 'all', 'date_from' => request('date_from'), 'date_to' => request('date_to')])]]) ?>
    </div>
    <?php if (role('admin')): ?>
        <div class="col-md-3">
            <?= Html::tag('div', null, ['style' => 'min-height: 200px', 'data' => ['action' => 'embed', 'url' => url(['/api/thongke/activity'])]]) ?>
        </div>
    <?php endif; ?>

</div>
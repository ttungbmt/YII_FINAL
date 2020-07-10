<?php
use Carbon\Carbon;

$date_from = request()->get('date_from', Carbon::create(2020,1,1)->format('d/m/Y'));
$date_to = request()->get('date_to', date('d/m/Y'));
$params = [
    'date_from' => $date_from,
    'date_to' => $date_to,
    'field_date' => 'ngaybaocao'
];
?>
<div class="card">
    <!--Thống kê-->
    <ul class="nav nav-tabs nav-tabs-bottom nav-justified mb-0">
        <li class="nav-item"><a href="#tab1" data-toggle="tab" class="nav-link active text-uppercase font-weight-semibold" aria-expanded="true">Điều tra ca bệnh</a></li>
        <li class="nav-item"><a href="#tab2" data-toggle="tab" class="nav-link text-uppercase font-weight-semibold" aria-expanded="false">Xác minh ca bệnh</a></li>
        <li class="nav-item"><a href="#tab3" data-toggle="tab" class="nav-link text-uppercase font-weight-semibold" aria-expanded="false">Chuyển ca</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab1">
            <?= $this->render('_dieutra', ['tk_dieutra' => $tk_dieutra, 'params' => $params])?>
        </div>

        <div class="tab-pane fade" id="tab2">
            <?= $this->render('_xacminh', ['tk_xacminh' => $tk_xacminh, 'params' => $params])?>
        </div>

        <div class="tab-pane fade" id="tab3">
            <?= $this->render('_chuyenca', ['tk_chuyenca' => $tk_chuyenca, 'params' => $params])?>
        </div>
    </div>
</div>
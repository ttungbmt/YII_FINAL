<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<!-- amCharts javascript sources -->
<script type="text/javascript" src="http://www.amcharts.com/lib/3/amcharts.js"></script>
<script type="text/javascript" src="http://www.amcharts.com/lib/3/serial.js"></script>
<script type="text/javascript" src="http://www.amcharts.com/lib/3/themes/light.js"></script>



<?php $form = ActiveForm::begin(['options'=>[
    'class'=>'form-horizontal',
    'enctype' => 'multipart/form-data'
]]); ?>

<div class="content" style="margin: 0 auto; width: 600px;">
    <legend>Thống kê ca bệnh</legend>

    <div class="form-group clearfix">
        <label class="control-label col-sm-2" for="nam">Năm:</label>
        <div class="col-sm-5">
            <input type="text" name="nam" class="form-control" placeholder="Nhập năm" required pattern="\d{4}" value="2015">
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="nam">Tháng:</label>
        <div class="col-sm-5">
            <input type="text" name="thang" class="form-control" placeholder="Nhập tháng" pattern="\d{1,2}" value="">
        </div>
    </div>

    <div class="clearfix"></div>
        <button type="submit" class="btn btn-primary col-sm-offset-2">Thống kê</button>
</div>
<?php if(isset($tkNam)): ?>

<table class="table table-hover" style="margin-top: 20px;">
    <thead>
    <tr>
        <th>Loại/ Tháng</th>
        <?php for ($i = 1; $i <= 12; $i++): ?>
        <th><?= $i ?></th>
        <?php endfor; ?>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>SXH</td>
        <?php foreach($tkNam['sxh'] as $item): ?>
        <td><?= $item['tongcong'] ?></td>
        <?php endforeach ?>
    </tr>
    <tr>
        <td>TCM</td>
        <?php foreach($tkNam['tcm'] as $item): ?>
            <td><?= $item['tongcong'] ?></td>
        <?php endforeach ?>
    </tr>
    </tbody>

</table>

    <!-- amCharts javascript code -->
    <script type="text/javascript">
        var chartData = <?php echo json_encode($tkNam['chartData']); ?>;

        AmCharts.makeChart("chartdiv",
            {
                "type": "serial",
                "categoryField": "thang",
                "startDuration": 1,
                "theme": "light",
                "categoryAxis": {
                    "gridPosition": "start"
                },
                "trendLines": [],
                "graphs": [
                    {
                        "balloonText": "[[title]] of [[category]]:[[value]]",
                        "bullet": "round",
                        "id": "AmGraph-1",
                        "title": "Số xuất huyết",
                        "valueField": "sxh"
                    },
                    {
                        "balloonText": "[[title]] of [[category]]:[[value]]",
                        "bullet": "square",
                        "id": "AmGraph-2",
                        "title": "Tay chân miệng",
                        "valueField": "tcm"
                    }
                ],
                "guides": [],
                "valueAxes": [
                    {
                        "id": "ValueAxis-1",
                        "stackType": "regular",
                        "title": "Tổng số ca bệnh"
                    }
                ],
                "allLabels": [],
                "balloon": {},
                "legend": {
                    "enabled": true,
                    "useGraphSettings": true
                },
                "titles": [
                    {
                        "id": "Title-1",
                        "size": 15,
                        "text": "Biểu đồ thống kê theo năm"
                    }
                ],
                "dataProvider": chartData
            }
        );
    </script>
    <div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>


<?php endif; ?>


<!---------------------------------------------------------->

<?php if(isset($tkThang)): ?>
    <?php //d($tkThang) ?>

    <table class="table table-hover" style="margin-top: 20px;">
        <thead>
        <tr>
            <th>Loại/ Ngày</th>
            <?php foreach($tkThang['sxh'] as $k => $item): ?>
                <th><?= $k ?></th>
            <?php endforeach ?>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>SXH</td>
            <?php foreach($tkThang['sxh'] as $item): ?>
                <td><?= $item['tongcong'] ?></td>
            <?php endforeach ?>
        </tr>
        <tr>
            <td>TCM</td>
            <?php foreach($tkThang['tcm'] as $item): ?>
                <td><?= $item['tongcong'] ?></td>
            <?php endforeach ?>
        </tr>
        </tbody>
    </table>

    <!-- amCharts javascript code -->
    <script type="text/javascript">
        var chartData = <?php echo json_encode($tkThang['chartData']); ?>;

        AmCharts.makeChart("chartdiv",
            {
                "type": "serial",
                "categoryField": "ngay",
                "startDuration": 1,
                "theme": "light",
                "categoryAxis": {
                    "gridPosition": "start"
                },
                "trendLines": [],
                "graphs": [
                    {
                        "balloonText": "[[title]] of [[category]]:[[value]]",
                        "bullet": "round",
                        "id": "AmGraph-1",
                        "title": "Số xuất huyết",
                        "valueField": "sxh"
                    },
                    {
                        "balloonText": "[[title]] of [[category]]:[[value]]",
                        "bullet": "square",
                        "id": "AmGraph-2",
                        "title": "Tay chân miệng",
                        "valueField": "tcm"
                    }
                ],
                "guides": [],
                "valueAxes": [
                    {
                        "id": "ValueAxis-1",
                        "stackType": "regular",
                        "title": "Tổng số ca bệnh"
                    }
                ],
                "allLabels": [],
                "balloon": {},
                "legend": {
                    "enabled": true,
                    "useGraphSettings": true
                },
                "titles": [
                    {
                        "id": "Title-1",
                        "size": 15,
                        "text": "Biểu đồ thống kê theo tháng"
                    }
                ],
                "dataProvider": chartData
            }
        );
    </script>
    <div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>

<?php endif; ?>



<?php ActiveForm::end(); ?>
<style>
    .form-inline.macbenh .form-group{
        margin: 20px;
        margin-right: 10px;
    }
    input[type="number"].form-control {
        padding: 3px 10px 5px 10px;

    }
    .amcharts-chart-div > a {
        display: none!important;
    }

    .table th{
        font-size: 15px;
    }
    .table td{
        font-size: 14px;
    }
</style>


<form class="form-inline macbenh" role="form" method="POST">
    <div class="form-group">
        <label for="loaibenh">Chọn loại bệnh:</label>
        <select name="loaibenh" class="form-control" style="width: 140px;height: 31px;font-size: 14px;">
            <option value="SXH" <?= (Yii::$app->request->post('loaibenh')=='SXH' ? 'selected' : '')?> > Sốt xuất huyết </option>
            <option value="TCM" <?= (Yii::$app->request->post('loaibenh')=='TCM' ? 'selected' : '')?>> Tay chân miệng </option>
        </select>
    </div>
    <div class="form-group">
        <label for="nam">Chọn năm:</label>
        <input type="text" class="form-control" id="nam" name="nam" required pattern="[0-9]{4}" placeholder="yyyy" value="<?=Yii::$app->request->post('nam')?>">
    </div>
    <button type="submit" class="btn btn-primary">Thống kê</button>
</form>
<?php if(isset($tyle_mac) && $tyle_mac): ?>

<!-- amCharts javascript code -->
<script type="text/javascript">
    var dataMacbenh = <?= json_encode($tyle_mac); ?>;

    AmCharts.makeChart("chartMacbenh", _.extend(chartColumn, {
            categoryField: "quan",
            graphs: [
                {
                    "balloonText": "[[title]]:[[value]]",
                    "fillAlphas": 1,
                    "id": "AmGraph-1",
                    "title": "Sốt xuất huyết",
                    "type": "column",
                    "valueField": "tyle",
                    "labelText": "[[value]]",
                }
            ],
            "valueAxes": [
                {
                    "id": "ValueAxis-1",
                    "title": " Số mắc/100.000 dân",
                }
            ],
            "titles": [
                {
                    id: "Title-1",
                    size: 18,
                    color: "#FC6042",
                    text: "Biểu đồ thống kê tỷ lệ mắc bệnh năm "+ <?= Yii::$app->request->post('nam') ?>
                }
            ],
            dataProvider: dataMacbenh,
        })
    );


</script>

<div id="chartMacbenh" style="width: 100%; min-height: 400px; background-color: #FFFFFF;" ></div>
<?php endif;?>
<hr>

<?php if(isset($sotuvong) && $sotuvong): ?>
<script !src="">
    var dataTuvong = <?= json_encode($sotuvong); ?>;

    AmCharts.makeChart("chartTuvong",
        _.extend(chartPie,
            {
                titleField: "quan",
                valueField: "tongso",
                legend: {
                    enabled: true,
                    align: "center",
                    markerType: "circle",
                    position: "bottom"
                },
                "titles": [
                    {
                        id: "Title-1",
                        size: 18,
                        color: "#FC6042",
                        text: "Biểu đồ thống kê số lượng tử vong "+ <?= Yii::$app->request->post('nam') ?>
                    }
                ],
                dataProvider: dataTuvong,

            }
        )
    );
</script>
<div class="col-md-8">
    <div id="chartTuvong" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
</div>
<div class="col-md-4">
    <h4 class="center">Bảng thống kê số lượng tử vong</h4>

    <table class="table table-bordered mt20">
        <thead>
        <tr>
            <th>STT</th>
            <th>Quận/ huyện</th>
            <th>Số lượng</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($sotuvong as $k => $item): ?>
        <tr>
            <td><?= $k+1 ?></td>
            <td><?= $item['quan'] ?></td>
            <td><?= $item['tongso'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>



<?php endif;?>
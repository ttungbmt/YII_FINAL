<?php

use kartik\widgets\DatePicker;
use pcd\models\CabenhSxh;
use pcd\models\KehoachXulyOdsxh;
use pcd\models\XulyOdsxh;
use ttungbmt\map\Map;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pcd\models\CabenhSxhNn;
use pcd\models\VCabenhSxhNn;

$inpDate = ['class' => 'form-control i-datepicker', 'placeholder' => 'DD/MM/YYYY' ];
$ids = array_filter(explode(',', request()->get('ids', '')));
$tbl = request()->get('table', '');

$cbRes = $ids ? CabenhSxh::find()->andFilterWhere(['gid' => $ids])->indexBy('gid')->all() : [];
$cabenhs = collect($ids)->map(function ($i) use($cbRes){return data_get($cbRes, $i);});
$cabenhs = $model->cabenhs ? $model->cabenhs : $cabenhs;

$cabenh_ids = array_filter(explode(',', request()->get('cabenh_ids', '')));

if($cabenh_ids){
    $cbUpdate = CabenhSxh::find()->andFilterWhere(['gid' => $cabenh_ids])->indexBy('gid')->all();
    $cabenhs = collect($cabenh_ids)->map(function ($i) use($cbUpdate){return data_get($cbUpdate, $i);});
}

$geojson = isset($geomodich) ? json_decode($geomodich[0]) : null;
$latlngsCb = [];
foreach($cabenhs as $cb) {
    $geomcb = [$cb['geom'][1], $cb['geom'][0]];
    array_push($latlngsCb, $geomcb);
}

$loaiodich = api('dm_loaiodich');
$khXulyOdsxh = KehoachXulyOdsxh::findOne(['odich_id' => $model->id]);
$khXulyOdsxh = $khXulyOdsxh ? $khXulyOdsxh : new KehoachXulyOdsxh();
?>

<div class="odich-sxh-form">
    <?php if($geojson) : ?>
        <div id="odich-map" style="height: 500px;">

        </div>
    <?php endif; ?>
    <?php $form = ActiveForm::begin([
        'id' => 'frmOdich'
    ]); ?>
    <?php //echo Map::widget(['model' => $model]) ?>

    <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
    <h5 class="text-primary bold">
        <span class="badge badge-flat border-primary text-primary">I</span> CA BỆNH TRONG Ổ DỊCH
        <button id="openOdSxh" type="button" class="pull-right btn btn-<?= $model->status ? 'danger': 'primary' ?> btn-xs"> <?= $model->status ? 'Kết thúc ổ dịch': 'Mở ổ dịch' ?></button>
    </h5>
    <div class="clearfix"></div>
    <div class="table-responsive">
        <table class="table" id="tbCabenh">
            <thead>
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Tuổi</th>
                <?php if($tbl != 'cabenh_sxh_nn'):?>
                <th>Tổ</th>
                <th>Khu phố</th>
                <th>Phường xã</th>
                <th>Quận huyện</th>
                <?php endif; ?>
                <th>Ngày mắc bệnh</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="listCabenh">
            <?php if(!empty($cabenhs) ):?>
                <?php foreach ($cabenhs as $k => $val): ?>
                    <tr id="<?= $val['gid'] ?>">
                        <td>
                            <?= $val['gid'] ?>
                            <input type="hidden" name="cabenhSxh[<?= $val['gid'] ?>][gid]" value="<?= $val['gid'] ?>">
                            <input type="hidden" name="cabenhSxh[<?= $val['gid'] ?>][ngaymacbenh_nv]" value="<?= date('d/m/Y', strtotime(str_replace('/','-', $val['ngaymacbenh_nv']))) ?>">
                        </td>
                        <td><?= $val['hoten'] ?> </td>
                        <td><?= $val['tuoi'] ?> </td>
                        <?php if($tbl != 'cabenh_sxh_nn'):?>
                        <td><?= $val['to_dp'] ?></td>
                        <td><?= $val['khupho'] ?></td>
                        <td><?= $val->hcPhuong['tenquan'] ?></td>
                        <td><?= $val->hcPhuong['tenphuong'] ?></td>
                        <?php endif; ?>
                        <td><?= date('d/m/Y', strtotime(str_replace('/','-', $val['ngaymacbenh_nv']))) ?></td>
                        <td><a><i class="icon-cancel-square rvCabenh controlCabenh"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif;?>
            </tbody>
        </table>
    </div>
    <?php if (request()->isAjax):?>
        <button type="button" id="btnLoadCabenh" class="btn btn-success m-10">Thêm các ca bệnh đã chọn</button>
    <?php endif; ?>



    <h5 class="text-primary bold">
        <span class="badge badge-flat border-primary text-primary mt-3">II</span> KẾ HOẠCH XỬ LÝ Ổ DỊCH
        <a href="<?=url(['/admin/odich-sxh/export-khxl', 'id' => $model->id])?>" target="_blank" type="button" class="ml-2 btn badge bg-warning-400"> Xuất kế hoạch xử lý</a>
    </h5>
    <?php echo $this->render('_kehoach_xl', ['form' => $form, 'model' => $model, 'khXulyOdsxh' => $khXulyOdsxh, 'cabenhs' => $cabenhs])?>

    <h5 class="text-primary bold">
        <span class="badge badge-flat border-primary text-primary mt-3">III</span> QUẢN LÝ VÀ XỬ LÝ Ổ DỊCH
    </h5>
    <div class="row">
        <?= $form->field($model, 'is_nghingo')->textInput(['type' => 'hidden', 'value' => $tbl == 'cabenh_sxh_nn' ? 1 : 0])->label(false) ?>
        <div class="col-md-6">
            <?= $form->field($model, 'loaiodich')->dropDownList($loaiodich, ['prompt' => 'Chọn loại ổ dịch...'])
            ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ngayxacdinh')->widget(DatePicker::classname()); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'ngayphathien')->widget(DatePicker::classname()); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ngaydukienkt')->widget(DatePicker::classname())?>

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ngaykt')->widget(DatePicker::classname())?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'dientichdk')->textInput(['type' => 'number', 'placeholder' => 'Diện tích ổ dịch dự kiến'])->label('Diện tích dự kiến') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            Chỉ số ban đầu:
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'BI_bandau')->textInput(); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'CI_bandau')->textInput(); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'HI_bandau')->textInput(); ?>
        </div>
    </div>

    <?php foreach ($model->xulyOdsxhs as $k => $val) : ?>
        <?php $lanxl = $val->lanxl; $i = $val->id ?>
        <?= $form->field($val, "[$i]lanxl")->hiddenInput()->label(false) ?>
        <h6 class="text-primary bold">
            <span class="badge badge-flat border-primary text-primary"><?= $lanxl ?></span> Xử lý lần <?= $lanxl ?> <br>
        </h6>
        <h6 class="text-primary bold">
            Diệt lăng quăng lần <?= $lanxl ?>
        </h6>
        <div class="row">
            <div class="col-md-12">Ngày diệt lăng quăng <?= $lanxl ?>:</div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]tungaydlq")->textInput(array_merge($inpDate, ['value' => date( 'd/m/Y', strtotime( $val->tungaydlq ) )]))->label('Từ ngày'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]denngaydlq")->textInput(array_merge($inpDate, ['value' => date( 'd/m/Y', strtotime( $val->tungaydlq ) )]))->textInput($inpDate)->label('Đến ngày'); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($val, "[$i]sotodlq")->label('Số tổ DLQ ' . $lanxl); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($val, "[$i]tentodlq")->label('Tên tổ DLQ ' . $lanxl); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($val, "[$i]sokhuphodlq")->label('Số khu phố DLQ ' . $lanxl); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($val, "[$i]tenkhuphodlq")->label('Tên khu phố DLQ ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]sonhadukiendlq")->label('Số nhà trong các tổ dự kiến DLQ ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]sonhaduocdlq")->label('Số nhà được DLQ ' . $lanxl); ?>
            </div>
            <div class="col-md-3">
                Chỉ số trước phun <?= $lanxl ?>:
            </div>
            <div class="col-md-3">
                <?= $form->field($val, "[$i]truoc_bi")->label('BI_' . $lanxl); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($val, "[$i]truoc_ci")->label('CI_' . $lanxl); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($val, "[$i]truoc_hi")->label('HI_' . $lanxl); ?>
            </div>
        </div>

        <h6 class="text-primary bold">
            Phun hóa chất <?= $lanxl ?>
        </h6>
        <div class="row">
            <div class="col-md-12">
                Ngày PHC <?= $lanxl ?>:
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]tungayphc")->textInput($inpDate)->label('Từ ngày'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]denngayphc")->textInput($inpDate)->label('Đến ngày'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]sotophc")->label('Số tổ PHC ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]tentophc")->label('Tên tổ PHC ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]sokhuphophc")->label('Số khu phố PHC ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]tenkhuphophc")->label('Tên khu phố PHC ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]sohodukienphc")->label('Số hộ dự kiến PHC ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]sohoduocphc")->label('Số hộ được PHC ' . $lanxl); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]tenhc1")->label('Tên HC ' . $lanxl.'_1'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]solithc1")->label('Số lít ' . $lanxl.'_1'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]tenhc2")->label('Tên HC ' . $lanxl.'_2'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($val, "[$i]solithc2")->label('Số lít ' . $lanxl.'_2'); ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($val, "[$i]tyle")->label('Tỷ lệ hộ dân mở cửa lần ' . $lanxl); ?>
            </div>
        </div>

    <?php endforeach; ?>
    <div id="tpl-addXuly"></div>

    <div class="row">
        <div class="col-md-6">
            <button type="button" id="btnAddXulyOdichsxh" class="btn btn-success m-10">Thêm xử lý ổ dịch</button>
        </div>

        <div class="col-md-6">
            <?php if (!Yii::$app->request->isAjax && can(['odich.create', 'odich.update'])) { ?>
                <div class="form-group pull-right">
                    <button type="button" class="btn btn-success">Xuất báo cáo xử lý</button>
                    <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary', 'style' => 'margin-left: 10px', 'id' => 'submitBtn']) ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<script id="tpl-xuly-odsxh" type="text/x-handlebars-template">​
    <?php
    $xuly_odsxh = new XulyOdsxh();
    ?>
    <?= $form->field($xuly_odsxh, "[{{i}}]lanxl")->hiddenInput(['value' => '{{i}}'])->label(false) ?>
    <h6 class="text-primary bold">
        <span class="badge badge-flat border-primary text-primary">{{ lanxl }}</span> Xử lý lần {{ lanxl }} <br>
    </h6>
    <h6 class="text-primary bold">
        Diệt lăng quăng lần {{ lanxl }}
    </h6>
    <div class="row">
        <div class="col-md-12">Ngày diệt lăng quăng {{ lanxl }}:</div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]tungaydlq")->textInput($inpDate)->label('Từ ngày'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]denngaydlq")->textInput($inpDate)->label('Đến ngày'); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($xuly_odsxh, "[{{i}}]sotodlq")->label('Số tổ DLQ {{lanxl}}'); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($xuly_odsxh, "[{{i}}]tentodlq")->label('Tên tổ DLQ {{lanxl}}'); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($xuly_odsxh, "[{{i}}]sokhuphodlq")->label('Số khu phố DLQ {{lanxl}}'); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($xuly_odsxh, "[{{i}}]tenkhuphodlq")->label('Tên khu phố DLQ {{lanxl}}'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]sonhadukiendlq")->label('Số nhà trong các tổ dự kiến DLQ {{lanxl}}'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]sonhaduocdlq")->label('Số nhà được DLQ {{lanxl}}'); ?>
        </div>
        <div class="col-md-3">
            Chỉ số trước phun {{ lanxl }}:
        </div>
        <div class="col-md-3">
            <?= $form->field($xuly_odsxh, "[{{i}}]truoc_bi")->label('BI_{{lanxl}}'); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($xuly_odsxh, "[{{i}}]truoc_ci")->label('CI_{{lanxl}}'); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($xuly_odsxh, "[{{i}}]truoc_hi")->label('HI_{{lanxl}}'); ?>
        </div>
    </div>

    <h6 class="text-primary bold">
        Phun hóa chất {{lanxl}}
    </h6>
    <div class="row">
        <div class="col-md-12">
            Ngày PHC {{lanxl}}:
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]tungayphc")->textInput($inpDate)->label('Từ ngày'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]denngayphc")->textInput($inpDate)->label('Đến ngày'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]sotophc")->label('Số tổ PHC {{lanxl}}'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]tentophc")->label('Tên tổ PHC {{lanxl}}'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]sokhuphophc")->label('Số khu phố PHC {{lanxl}}'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]tenkhuphophc")->label('Tên khu phố PHC {{lanxl}}'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]sohodukienphc")->label('Số hộ dự kiến PHC {{lanxl}}'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]sohoduocphc")->label('Số hộ được PHC {{lanxl}}'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]tenhc1")->label('Tên HC {{lanxl}}_1'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]solithc1")->label('Số lít {{lanxl}}_1'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]tenhc2")->label('Tên HC {{lanxl}}_2'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($xuly_odsxh, "[{{i}}]solithc2")->label('Số lít {{lanxl}}_2'); ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($xuly_odsxh, "[{{i}}]tyle")->label('Tỷ lệ hộ dân mở cửa lần {{lanxl}}'); ?>
        </div>
    </div>


    ​</script>
<script src="<?='/libs/bower/leaflet/dist/leaflet-src.js'?>"></script>
<link rel="stylesheet" href="<?= '/libs/bower/leaflet/dist/leaflet.css' ?>"/>
<script src="<?=url('/pcd/resources/public_html/libs/custom/typeahead/handlebars.js')?>"></script>
<script src="<?=url('/pcd/resources/public_html/libs/bower/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>
<script src="<?=url('/pcd/resources/public_html/libs/bower/bootstrap-datepicker/dist/locales/bootstrap-datepicker.vi.min.js')?>"></script>
<script src="<?=url('https://cdn.jsdelivr.net/npm/sortablejs')?>"></script>

<?php if($geojson) : ?>
    <script>
        var map = L.map('odich-map').setView([10.784770, 106.690009], 10);
        var hcmgismap = L.tileLayer.wms('https://pcd.hcmgis.vn/geoserver/gwc/service/wms', {
            layers: 'hcm_map:hcm_map_all',
            transparent: true,
            maxZoom: 26,
            format: 'image/png',
            attribution: 'HCMGIS'
        }).addTo(map);

        var geojson = <?= json_encode($geojson) ?>;
        var latlngsCb = <?= json_encode($latlngsCb) ?>;

        var odich = L.geoJSON(geojson).addTo(map);
        var centerOdich = odich.getBounds().getCenter();
        map.setView(centerOdich, 16);

        for(var i in latlngsCb) {
            var marker = L.marker(latlngsCb[i]).addTo(map);
        }
    </script>
<?php endif; ?>

<script>
    var arrRemove = [];
    var count = parseInt('<?=isset($lanxl)?: 0;?>') + 1;
    $('#btnAddXulyOdichsxh').click(e => {
        let num = count++;
        let data = {
            i: num
        }

        let tpl = Handlebars.compile ($('#tpl-xuly-odsxh').html());
        let html = tpl(data);
        $($.parseHTML( html )).appendTo( '#tpl-addXuly' );

        $('.i-datepicker').datepicker({
            format: "dd/mm/yyyy",
            todayBtn: "linked",
            language: "vi",
            calendarWeeks: true,
            todayHighlight: true,
            autoclose: true,
        });
    })

    $('.controlCabenh').on('click', function () {
        let _this = $(this);
        let row = _this.parent().parent().parent();
        if(_this.hasClass('rvCabenh')) {
            row.css('background', '#FFB6C1');
            _this.removeClass('icon-cancel-square rvCabenh');
            _this.addClass('icon-reset resetCabenh');
            arrRemove.push(row.attr('id'));

            _this.append('<input type="hidden" name="arrRemove[' + row.attr('id') + ']" value="' + row.attr('id') + '">');
        } else if(_this.hasClass('resetCabenh')) {
            _this.removeClass('icon-reset resetCabenh');
            _this.addClass('icon-cancel-square rvCabenh');
            row.css('background', 'none');
            arrRemove.splice($.inArray(row.attr('id'), arrRemove),1);

            _this.empty();
        }
    })

    Sortable.create(listCabenh, {
        animation: 150
    });


</script>


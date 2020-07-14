<?php
use kartik\widgets\DatePicker;
use kartik\widgets\DepDrop;
use yii\widgets\ActiveForm;

$this->title = 'Thống kê';
$maquan = userInfo()->ma_quan;
$maphuong = userInfo()->ma_phuong;
$date_cat = [
    'ngaymacbenh' => 'Ngày mắc bệnh',
    'ngaynhapvien' => 'Ngày nhập viện',
    'ngaybaocao' => 'Ngày báo cáo',
];
$month = date('m')-3;
$month = $month > 10 ? "$month": "0".$month;
?>

<div id="thongke" xmlns="http://www.w3.org/1999/html">

    <?php $form = ActiveForm::begin([
        'action' => 'ajax',
        'options' =>['id' => 'formtk', 'v-on:submit' => 'onSubmit'],
        'enableClientValidation' => false
    ]); ?>

    <input type="hidden" name="ownpx" id="ownpx" value="<?=$maphuong?>">

    <div class="card card-white border-left-lg border-left-info">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">
                <span class="font-weight-semibold"><i class="icon-statistics position-left"></i> Thống kê</span>
            </h6>
            <div class="heading-elements">
<!--                <a href="#" class="mr-20" data-toggle="modal" data-target="#tkcabenh" ><i class="icon-bars-alt"></i> Thống kê chung</a>-->
                <button type="submit" class="btn btn-info btn-labeled btn-labeled-left btn-rounded">
                    <b><i class="icon-graph"></i></b> Thống kê
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'tinh')->dropDownList(['hcm' => 'Hồ Chí Minh']); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ma_quan')->dropDownList(api('/dm/quan?role=true'), [
                        'prompt'  => 'Chọn quận huyện...',
                        'id'      => 'drop-quan',
                        'options' => [
                            $maquan => ['Selected' => true],
                        ]
                    ]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ma_phuong')->widget(DepDrop::className(), [
                        'options'       => ['prompt' => 'Chọn phường...'],
                        'pluginOptions' => [
                            'depends'      => ['drop-quan'],
                            'url'          => url(['/api/dm/phuong?role=true']),
                            'initialize'   => $maquan == true,
                            'placeholder'  => 'Chọn phường...',
                            'ajaxSettings' => ['data' => ['value' => $maphuong]],
                        ],
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'loaitk')->dropDownList(['sxh' => 'Sốt xuất huyết']); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'chuandoan')->dropDownList(['sxh' => 'Sốt xuất huyết']); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'date_cat')->dropDownList($date_cat, ['prompt' => 'Chọn thời gian...']); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'date_from')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'DD/MM/YYYY', 'value' => '01/'.$month.'/'.date('Y')],
                    ]); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'date_to')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'DD/MM/YYYY', 'value' => date('d/m/Y')],
                    ]); ?>
                </div>
            </div>

            <hr style="border-style: dashed;">

            <div id="ketqua">

            </div>
        </div>

    </div>
<!--    </form>-->
    <?php ActiveForm::end(); ?>
</div>


<?php $this->beginBlock('scripts') ?>
<script src="<?=url('/libs/bower/excellentexport/dist/excellentexport.js')?>"></script>
<script>
    $(function() {
        $( "#formtk" ).submit(function( e ) {
            $('#ketqua').html('<div class="progress"> <div class="progress-bar progress-bar-info progress-bar-striped active" style="width: 100%"> <span class="sr-only">100% hoàn thành</span> </div> </div>')
            e.preventDefault();
            let data = $('#formtk').serializeArray();
            data.push({name: 'exportExcel', value: true})

            $.post("<?=url('/admin/thongke/ajax')?>", data, function( res ) {
                $('#ketqua').html(res);
            });
        });
    });
</script>
<?php $this->endBlock() ?>

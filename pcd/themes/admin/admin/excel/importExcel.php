<?php use kartik\widgets\Select2;
use yii\widgets\ActiveForm;

$this->title = 'Nhập ca bệnh';
?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-primary no-border">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Đóng</span>
        </button>
        <span class="text-semibold">THÀNH CÔNG:</span> <?= Yii::$app->session->getFlash('success') ?></a>.
    </div>
<?php endif; ?>

<div id="nhapCB" class="card card-white border-left-lg border-left-info">
    <?php $form = ActiveForm::begin(['options' => [
        'enctype' => 'multipart/form-data',
//                'class'=>'form-inline',
    ]]); ?>
    <div class="card-header header-elements-inline">
        <h6 class="card-title">

            <span class="text-semibold"><i class="icon-import position-left"></i> Nhập ca bệnh</span>
        </h6>
        <div class="heading-elements">
            <i class="icon-download4"></i>&nbsp; <a href="<?= asset('/storage/samples/dsCabenh.xlsx') ?>">Tải file
                mẫu</a>
        </div>

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'formatExcel')->widget(Select2::classname(), [
                    'data' => [
                        'd/m/Y' => 'dd/mm/YYYY',
                        'm/d/Y' => 'mm/dd/YYYY',
                    ],
                    'options' => ['placeholder' => 'Định dạng ngày']
                ])->label(false) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'file')->fileInput()->label(false) ?>
            </div>
            <div class="col-md-4">
                <div class="form-group float-right">
                    <button type="submit" class="btn btn-info btn-labeled btn-labeled-left btn-rounded">
                        <b><i class="icon-spinner4"></i></b> Xem trước
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

    <div class="card-body">

        <?= $this->render('//messages/errors') ?>

        <?php if (isset($dsCabenh) && $dsCabenh): ?>
            <div class="table-responsive i-nicescroll">
                <div class="form" style="width: 2500px">
                    <?php $form = ActiveForm::begin([
                        'options' => ['id' => 'formCB', 'class' => 'table']]); ?>
                    <table>
                        <tr>
                            <th>STT</th>
                            <th>BV</th>
                            <th>ICD</th>
                            <th>T_BENH</th>
                            <th>SHS</th>
                            <th>HO TEN</th>
                            <th>PHAI</th>
                            <th>TUOI</th>
                            <th>DIA CHI</th>
                            <th>NGHE NGHIEP</th>
                            <th>ME</th>
                            <th>DT</th>
                            <th>QH</th>
                            <th>PX</th>
                            <th>NG_NV</th>
                            <th>NG_BC</th>
                            <th>Nam NV</th>
                            <th>Thang NV</th>
                            <th>Tuan NV</th>
                            <th>Nam BC</th>
                            <th>Thang BC</th>
                            <th>Tuan BC</th>
                            <th>Hình thức điều trị</th>
                        </tr>
                        <?php foreach ($dsCabenh as $i => $item): ?>
                            <tr>
                                <td class="text-center">
                                    <div class="form-group"> <?= $i + 1; ?> </div>
                                </td>
                                <td><?= $form->field($item, "[$i]bv")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]icd")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]tbenh")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]shs")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]ho_ten")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]phai")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]tuoi")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]dia_chi")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]nghe_nghiep")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]me")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]dt")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]qh")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]px")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]ngnv")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]ngbc")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]nam_nv")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]thang_nv")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]tuan_nv")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]nam_bc")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]thang_bc")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]tuan_bc")->label(false); ?></td>
                                <td><?= $form->field($item, "[$i]hinh_thuc_dieu_tri")->label(false); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left btn-rounded mb-20">
                        <b><i class="icon-spinner4"></i></b> Nhập CSDL
                    </button>
                    <?php ActiveForm::end(); ?>
                </div><!-- form -->
            </div>

        <?php else: ?>
            <!--            <div class="alert alert-info alert-styled-left alert-bordered">-->
            <!--                <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>-->
            <!--                <span class="text-semibold">Hướng dẫn!</span> Vui lòng chọn nút thêm file và xem trước để nhập dữ liệu ca bệnh. Tên file: dsCabenh-->
            <!--            </div>-->
        <?php endif; ?>
    </div>


</div>

<div class="alert" style="border: 1px solid rgba(0, 188, 212, 0.52); background-color: white;">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <h6 class="alert-heading text-semibold"><span class="badge bg-blue-400">1</span> Hướng dẫn</h6>
    <p>Nhấn nút + để chọn file excel nhập dữ liệu, thiết lập định dạng ngày giống hệ thống</p>
    <h6 class="alert-heading text-semibold"><span class="badge bg-blue-400">2</span> Ghi chú</h6>
    <p><span class="text-semibold">Các trường bắt buộc:</span> Bệnh viện, Chẩn đoán, Họ tên, Quận huyện, Phường xã</p>
    <p><span class="text-semibold">T_BENH:</span> SOT XUAT HUYET, TAY CHAN MIENG</p>
</div>
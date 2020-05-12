<?php
use pcd\RolePQSrv;
use pcd\models\DmPhuong;
use pcd\services\RolePQService;
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;

$current_role = RolePQService::getCurrentUser();
$ma_quan = $current_role->ma_quan;
if(!$ma_quan && $current_role->cap_hanhchinh == 'phuong'){
    $ma_quan = DmPhuong::find()->where(['ma_phuong' => $current_role->ma_hanhchinh])->one()->ma_quan;
}

?>
<script src="<?=url_home('core/libs/bower/excellentexport/excellentexport.min.j')?>"></script>

<div class="row">
    <div class="col-md-8">

        <div id="xuatPhieuSXH">
            <?php $form = ActiveForm::begin([
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]); ?>
            <input type="hidden" name="ownpx" id="ownpx" value="<?=$current_role->ma_phuong?>">
            <div class="card card-white border-left-lg border-left-info">
                <div class="card-header">
                    <h6 class="card-title">
                        <span class="text-semibold"><i class="icon-statistics position-left"></i> Xuất phiếu điều tra</span>
                    </h6>
                    <div class="heading-elements">
                        <!--                <a href="#" class="mr-20" data-toggle="modal" data-target="#tkcabenh" ><i class="icon-bars-alt"></i> Thống kê chung</a>-->
                        <button type="submit" class="btn btn-info btn-labeled btn-rounded">
                            <b><i class="icon-database-export"></i></b> Xuất dữ liệu
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <?= $form->field($model, 'tinh')->dropDownList(['hcm' => 'Hồ Chí Minh']); ?>
                    <?= $form->field($model, 'ma_quan')->dropDownList(RolePQSrv::listQh(),[
                        'id' => 'qh',
                        'prompt' => 'Chọn...',
                        'options' => [$ma_quan => ['Selected'=>true]]
                    ]); ?>
                    <?= $form->field($model, 'ma_phuong')->widget(DepDrop::classname(), [
                        'pluginOptions'=>[
                            'depends'=>[
                                'qh'
                            ],
                            'placeholder' => 'Chọn...',
                            'initialize' => true,
                            'url' => url_home('api/role-list-px'),
                        ]
                    ]); ?>
                    <?= $form->field($model, 'chuandoan')->dropDownList(['sxh' => 'Sốt xuất huyết']); ?>
                    <h5 class="text-primary">Bộ lọc </h5>
                    <p>Ngày nhận thông báo</p>
                    <?= $form->field($model, 'datebc_from')->textInput(['class' => 'form-control i-datepicker', 'placeholder' => 'DD/MM/YYYY']); ?>
                    <?= $form->field($model, 'datebc_to')->textInput([
                        'class' => 'form-control i-datepicker',
                        'placeholder' => 'DD/MM/YYYY',
                        'value' => date('d/m/Y')
                    ]); ?>

                </div>

            </div>
            <!--    </form>-->
            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>

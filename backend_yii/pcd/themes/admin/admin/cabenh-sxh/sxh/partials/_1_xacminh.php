<?php
use pcd\modules\pcd\services\RolePQSrv;
use pcd\modules\role_phuongquan\services\PQService;
use kartik\helpers\Html;
use kartik\widgets\DepDrop;
$disabled = $psxh->chuyenca1 && PQService::getRolePQOfCurrentUser()->cap_hanhchinh == 'phuong' ? true : false;
$role = PQService::getRolePQOfCurrentUser();

?>

<div class="row">
    <div class="col-md-3">
        <?= $form->field($psxh, 'qh1')->dropDownList(RolePQSrv::listQh(),[
            'id' => 'qh1',
            'disabled' => $disabled,
            'v-model' => 'psxh.qh1',
            'prompt' => 'Chọn...',
            'options' => [
                co_pqpx()->selectQH($psxh->qh1) => ['Selected' => true],
            ]
        ]);?>
    </div>
    <div class="col-md-3">
        <input type="hidden" id="px1_param" value="<?= $psxh->px1; ?>">
        <?= $form->field($psxh, 'px1')->widget(DepDrop::classname(), [
            'options' => ['v-model' => 'psxh.px1'],
            'pluginOptions'=>[
                'depends'=>[
                    'qh1'
                ],
                'placeholder' => 'Chọn...',
                'initialize' => true,
                'url' => url_home('apis/role-list-px'),
                'params' => ['px1_param']
            ]
        ]); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($psxh, 'maso')->textInput(['disabled'=>true]); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($psxh, 'ngaynhanthongbao')->textInput(['disabled' => $disabled, 'placeholder' => 'DD/MM/YYY', 'class' => 'form-control i-datepicker']);?>
    </div>
    <div class="col-md-6">
        <?= $form->field($psxh, 'ngaydieutra')->textInput(['disabled' => $disabled, 'placeholder' => 'DD/MM/YYY', 'class' => 'form-control i-datepicker']); ?>
    </div>
</div>

<!-- 1. XÁC MINH CA BỆNH ------------------------->
<div class="phieu-title mb-2">
    <span class="badge badge-flat border-primary text-primary bold">1</span> Xác minh ca bệnh
</div>
<div class="row">
    <div class="col-md-3">
        <?= $form->field($psxh, 'hoten')->textInput(['disabled' => $disabled, 'v-model' => 'psxh.hoten', ]); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($psxh, 'phai')->radioList($dm_phai, ['itemOptions' => ['disabled' => $disabled]]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($psxh, 'ngaysinh')->textInput(['disabled' => $disabled, 'class' => 'form-control i-datepicker']); ?>

    </div>
    <div class="col-md-3">
        <?= $form->field($psxh, 'tuoi')->textInput(['disabled' => $disabled, 'type' => 'number']); ?>
    </div>
</div>


<!-- ĐỊA CHỈ 1 ------------------------->
<div class="row">
    <div class="col-md-3">
        <?= $form->field($psxh, 'diachi1')->radioList($yesno, [
            'item' => function ($index, $label, $name, $checked, $value) use($disabled) {
                return Html::radio($name, $checked, ['disabled' => $disabled, 'v-model' => 'psxh.diachi1', 'number'=>'true', 'value' => $value, 'label' => Html::encode($label),]);
            },
        ]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($psxh, 'benhnhan1')->radioList($yesno, [
            'item' => function ($index, $label, $name, $checked, $value) use($disabled){
                return Html::radio($name, $checked, ['disabled' => $disabled, 'v-model' => 'psxh.benhnhan1', 'number'=>'true', 'value' => $value, 'label' => Html::encode($label),]);
            },
        ]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($psxh, 'dienthoai1')->textInput(['disabled' => $disabled]); ?>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label cursor-pointer"><i>Vị trí(cũ)</i></label>
            <div><?=$psxh->vitri1?></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <?= $form->field($psxh, 'sonha1')->textInput(['disabled' => $disabled]); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($psxh, 'duong1')->textInput(['disabled' => $disabled]); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($psxh, 'to1')->textInput(['disabled' => $disabled]); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($psxh, 'khupho1')->textInput(['disabled' => $disabled]); ?>
    </div>
</div>

        <!-- ĐỊA CHỈ 2 ------------------------->
        <div v-if="psxh.benhnhan1==0" class="animated" transition="bounce">
            <hr class="dashed">
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($psxh, 'diachi2')->radioList($yesno, ['itemOptions' => ['disabled' => $disabled, 'v-model' =>'psxh.diachi2', 'number'=>'true']]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($psxh, 'dienthoai2')->textInput(['disabled' => $disabled]); ?>
                </div>
            </div>
            <div v-if="psxh.diachi2==1" class="animated" transition="bounce">
                <div class="row">
                    <div class="col-md-6">
                        <?=$form->field($psxh, 'tinh2')->dropDownList([
                            'HCM' => 'Hồ Chí Minh',
                            'TinhKhac' => 'Tỉnh khác',
                        ], [
                            'v-model' => 'psxh.tinh2',
                            'disabled' => $disabled,
                            'options' => ['HCM' => ['Selected' => true]]
                        ]);?>
                    </div>
                    <div v-if="psxh.tinh2=='HCM'">
                        <div class="col-md-3">
                            <?= $form->field($psxh, 'qh2')->dropDownList(co_pqpx()->listQH(),[
                                'disabled' => $disabled,
                                'id' => 'qh2',
                                'prompt' => 'Chọn...',
                                'v-model' => 'psxh.qh2',
                                'options' => [$psxh->qh2 => ['Selected' => true],]
                            ]); ?>
                        </div>
                        <div class="col-md-3">
                            <input type="hidden" id="px2_param" value="<?= $psxh->px2; ?>">
                            <?= $form->field($psxh, 'px2')->widget(DepDrop::classname(), [
                                'options' => ['v-model' => 'psxh.px2'],
                                'pluginOptions'=>[
                                    'depends'=>[
                                        'qh2'
                                    ],
                                    'placeholder' => 'Chọn...',
                                    'initialize' => true,
                                    'url' => url_home('apis/role-list-px?filter=0'),
                                    'params' => ['px2_param']
                                ]

                            ]); ?>
                        </div>
                    </div>
                    <div v-if="psxh.tinh2 !='HCM'">
                        <div class="col-md-6">
                            <?= $form->field($psxh, 'tinhkhac2')->textInput(['disabled' => $disabled])->label('Địa chỉ tỉnh khác'); ?>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="psxh.tinh2=='HCM'">
                    <div class="col-md-3">
                        <?= $form->field($psxh, 'sonha2')->textInput(['disabled' => $disabled]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($psxh, 'duong2')->textInput(['disabled' => $disabled]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($psxh, 'to2')->textInput(['disabled' => $disabled]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($psxh, 'khupho2')->textInput(['disabled' => $disabled]) ?>
                    </div>
                </div>

            </div>

        </div>
        <?php if($psxh->chuyenca1): ?>
            <?php
                $disabled_dc3 = false;
                if($psxh->chuyenca_filter == 2) $disabled_dc3 = true;
            ?>
            <hr class="dashed">
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($psxh, 'diachi3')->radioList($yesno, ['itemOptions' => ['v-model' =>'psxh.diachi3', 'number'=>'true', 'disabled' => $disabled_dc3]]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($psxh, 'benhnhan3')->radioList($yesno, ['itemOptions' => ['v-model' =>'psxh.benhnhan3', 'number'=>'true', 'disabled' => $disabled_dc3]]) ?>
                </div>
            </div>
            <div v-if="psxh.diachi3==1" class="animated" transition="bounce">
                <div class="row">
                    <div class="col-md-6">
                        <?=$form->field($psxh, 'tinh3')->dropDownList([
                            'HCM' => 'Hồ Chí Minh',
                            'TinhKhac' => 'Tỉnh khác',
                        ], [
                            'disabled' => $disabled_dc3,
                            'v-model' => 'psxh.tinh3',
                            'options' => ['HCM' => ['Selected' => true]]
                        ]);?>
                    </div>
                    <div v-if="psxh.tinh3=='HCM'">
                        <div class="col-md-3">
                            <?= $form->field($psxh, 'qh3')->dropDownList(co_pqpx()->listQH(),[
                                'disabled' => $disabled_dc3,
                                'id' => 'qh3',
                                'prompt' => 'Chọn...',
                                'options' => [$psxh->qh3 => ['Selected' => true]]
                            ]); ?>
                        </div>
                        <div class="col-md-3">
                            <input type="hidden" id="px3_param" value="<?= $psxh->px3; ?>">
                            <?= $form->field($psxh, 'px3')->widget(DepDrop::classname(), [
                                'options' => ['v-model' => 'psxh.px3'],
                                'pluginOptions'=>[
                                    'depends'=>[
                                        'qh3'
                                    ],
                                    'placeholder' => 'Chọn...',
                                    'initialize' => true,
                                    'url' => url_home('apis/role-list-px?filter=0'),
                                    'params' => ['px3_param']
                                ]
                            ]); ?>
                        </div>
                    </div>
                    <div v-if="psxh.tinh3 !='HCM'">
                        <div class="col-md-6">
                            <?= $form->field($psxh, 'tinhkhac3')->textInput(['disabled' => $disabled_dc3])->label('Địa chỉ tỉnh khác'); ?>
                        </div>
                    </div>
                </div>

                <div class="row" v-if="psxh.tinh3 =='HCM'">
                    <div class="col-md-3">
                        <?= $form->field($psxh, 'sonha3')->textInput(['disabled' => $disabled_dc3]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($psxh, 'duong3')->textInput(['disabled' => $disabled_dc3]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($psxh, 'to3')->textInput(['disabled' => $disabled_dc3]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($psxh, 'khupho3')->textInput(['disabled' => $disabled_dc3]) ?>
                    </div>
                </div>

            </div>

        <?php endif; ?>


<div v-if="psxh.diachi1 ==1 && psxh.benhnhan1 ==1" class="animated" transition="bounce">
    <hr class="dashed">
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($psxh, 'benhnoikhac')->radioList($yesno, ['itemOptions' => ['v-model' =>'psxh.benhnoikhac', 'number'=>'true']]) ?>
        </div>
    </div>
    <div v-if="psxh.benhnoikhac==1" class="animated" transition="bounce">
        <div class="row">
            <div class="col-md-6">
                <?=$form->field($psxh, 'tinhkhac')->dropDownList([
                    'HCM' => 'Hồ Chí Minh',
                    'TinhKhac' => 'Tỉnh khác',
                ], [
                    'v-model' => 'psxh.tinhkhac',
                    'options' => ['HCM' => ['Selected' => true]]
                ]);?>
            </div>
            <div v-if="psxh.tinhkhac !='HCM'">
                <div class="col-md-6">
                    <?= $form->field($psxh, 'tinhnoikhac')->textInput(['disabled' => $disabled])->label('Địa chỉ tỉnh khác'); ?>
                </div>
            </div>
            <div v-if="psxh.tinhkhac == 'HCM'">
                <div class="col-md-3">
                    <?= $form->field($psxh, 'qhkhac')->dropDownList(co_pqpx()->listQH(),[
                        'id' => 'qhkhac',
                        'prompt' => 'Chọn...',
                        'options' => [$psxh->qhkhac => ['Selected' => true]]
                    ]); ?>
                </div>
                <div class="col-md-3">
                    <input type="hidden" id="pxkhac_param" value="<?= $psxh->pxkhac; ?>">
                    <?= $form->field($psxh, 'pxkhac')->widget(DepDrop::classname(), [
                        'options' => ['v-model' => 'psxh.pxkhac'],
                        'pluginOptions'=>[
                            'depends'=>[
                                'qhkhac'
                            ],
                            'placeholder' => 'Chọn...',
                            'initialize' => true,
                            'url' => url_home('apis/role-list-px?filter=0'),
                            'params' => ['pxkhac_param']
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="row" v-if="psxh.tinhkhac == 'HCM'">
            <div class="col-md-3">
                <?= $form->field($psxh, 'sonhakhac') ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($psxh, 'duongkhac') ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($psxh, 'tokhac')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($psxh, 'khuphokhac')->textInput() ?>
            </div>
        </div>



    </div>
</div>



<script !src="">
    $(function () {
        $('#vphieusxh-px1').on('depdrop.afterChange', function(event) {
            $(this).attr('disabled', <?=$disabled ?: 'false'?>)
        });
        $('#vphieusxh-px2').on('depdrop.afterChange', function(event) {
            $(this).attr('disabled', <?=$disabled ?: 'false'?>)
        });

    });
</script>

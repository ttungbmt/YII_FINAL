<?php
use kartik\helpers\Html;
use kartik\widgets\DatePicker;
use kartik\widgets\DepDrop;
use pcd\models\XacminhCb;
?>

<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'ngaynhanthongbao')->widget(DatePicker::className(), ['options' => ['disabled' => $locked]]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'ngaydieutra')->widget(DatePicker::className(), ['options' => ['disabled' => $locked]]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'maso')->textInput(['disabled' => true]); ?>
    </div>
</div>

<!-- 1. XÁC MINH CA BỆNH ------------------------->
<div class="phieu-title mb-2">
    <span class="badge badge-flat badge-pill border-primary text-primary">1</span> Xác minh ca bệnh
</div>

<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'hoten')->textInput(['disabled' => $locked, 'v-model' => 'm.hoten']); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'phai')->radioList($dm_phai, ['inline' => true, 'itemOptions' => ['disabled' => $locked]]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'ngaysinh')->widget(DatePicker::className(), ['options' => ['disabled' => $locked]]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'tuoi')->textInput(['disabled' => $locked, 'type' => 'number']); ?>
    </div>
</div>

<?php
$k_new = 0;
$newXm = new XacminhCb();
$params = [
    'form' => $form,
    'dm_tinh' => $dm_tinh,
    'dm_quan' => $dm_quan,
    'url_phuong' => $url_phuong,
    'yesno' => $yesno,
    'count' => $c_xmcb = count($xacminhCbs)
];
?>

<?php foreach (array_values($xacminhCbs) as $k => $xm):?>
    <?php $k_new = $k; ?>
    <?=$this->render('partials/_diachi', array_merge($params, ['k' => $k_new, 'xm' => $xm, 'model' => $model]))?>
<?php endforeach?>

<div v-if="shown_benhnoikhac">
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, "benhnoikhac")->radioList($yesno, ['inline' => true, 'itemOptions' => ['v-model.number' => "m.benhnoikhac"]])->label("Bệnh nhân ở nơi khác")?>
        </div>
    </div>
    <div v-if="m.benhnoikhac == 1">
        <div class="row">
            <div class="col-md-3">
                <?=$form->field($model, "sonhakhac")->textInput()->label("Số nhà khác")?>
            </div>
            <div class="col-md-3">
                <?=$form->field($model, "duongkhac")->textInput()->label("Đường khác")?>
            </div>
            <div class="col-md-3">
                <?=$form->field($model, "tokhac")->textInput()->label("Tổ khác")?>
            </div>
            <div class="col-md-3">
                <?=$form->field($model, "khuphokhac")->textInput()->label("Khu phố khác")?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=$form->field($model, "tinhkhac")->dropDownList($dm_tinh, [
                    'v-model' => "m.tinhkhac",
                ])->label("Tỉnh khác")?>
            </div>
            <div class="col-md-6" v-if="m.tinhkhac == 'HCM'">
                <div class="row">
                    <div class="col-md-6">
                        <?=$form->field($model, "qhkhac")->dropDownList($dm_quan, [
                            'prompt' => 'Chọn quận huyện...',
                            'id'      => "drop-quan-khac",
                        ])->label("Quận huyện khác")?>
                    </div>
                    <div class="col-md-6">
                        <?=$form->field($model, "pxkhac")->widget(DepDrop::className(), [
                            'options'       => ['prompt' => 'Chọn phường xã...'],
                            'pluginOptions' => [
                                'depends' => ["drop-quan-khac"],
                                'initialize' => true,
                                'ajaxSettings' => ['data' => ['value' => $model->pxkhac]],
                                'url'     => $url_phuong,
                            ],
                        ])->label("Phường xã khác")?>
                    </div>
                </div>
            </div>

            <div class="col-md-6" v-if="m.tinhkhac == 'TinhKhac'">
                <?=$form->field($model, "tinhnoikhac")->textInput()->label("Địa chỉ tỉnh khác")?>
            </div>
        </div>
    </div>
</div>

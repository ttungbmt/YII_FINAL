<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use ttungbmt\map\Map;

/* @var $this yii\web\View */
/* @var $model pcd\models\PhieuGs */
/* @var $form yii\widgets\ActiveForm */

$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' Phiếu giám sát';
$yn = [1 => 'Có', 0 => 'Không'];
$dm_mucdich_gs = api('dm_mucdich_gs');
?>
<?php $form = ActiveForm::begin(); ?>
<h5 class="font-weight-semibold"><?=$model->dnc->ten_cs?></h5>

<div class="phieu-gs-form" id="gs-form">
    <?= $form->field($model, 'pt_nguyco_id')->hiddenInput()->label(false) ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'ngay_gs')->widget(\kartik\widgets\DatePicker::className()) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'nguoi_gs')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'mucdich_gs')->radioList($dm_mucdich_gs) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'vc_nc')->textInput(['type' => 'number', 'min' => 0]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'vc_lq')->textInput(['type' => 'number', 'min' => 0]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'dexuat_xp')->radioList($yn, ['itemOptions' => ['v-model.number' => 'm.dexuat_xp']]) ?>
        </div>
        <div class="col-md-3" v-if="m.dexuat_xp==1">
            <?= $form->field($model, 'xuphat')->radioList($yn, ['itemOptions' => ['v-model.number' => 'm.xuphat']]) ?>
        </div>
        <div class="col-md-3" v-if="shownNgayxp">
            <?= $form->field($model, 'ngayxuphat')->widget(\kartik\widgets\DatePicker::className(), ['options' => ['v-model' => 'm.ngayxuphat']]) ?>
        </div>
    </div>

    <?php if (!request()->isAjax): ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? lang('Create') : lang('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>

<script>
    $(function () {
        let vm = new Vue({
            el: '#gs-form',
            data: {
                m: <?=json_encode($model->toArray())?>
            },
            watch: {
                'm.dexuat_xp': 'resetDate',
                'm.xuphat': 'resetDate',
            },
            computed: {
                shownNgayxp(){
                    return this.m.dexuat_xp == 1 && this.m.xuphat == 1
                }
            },
            mounted: function () {
                this.resetDate()
            },
            methods: {
                resetDate(){
                    if(this.shownNgayxp) {
                        this.$nextTick(() => {
                            let el = $('#phieugs-ngayxuphat'),
                                id = el.data('krajeeKvdatepicker')
                            el.kvDatepicker(window[id]);
                        });
                    }
                }
            }
        })
        console.log(vm);
        // console.log(vm.$destroy(););
    })

</script>

<?php

use yii\bootstrap\Html;

$dm_mucdich_gs = api('dm_mucdich_gs');
$yn = [1 => 'Có', 0 => 'Không'];
$template = '{label}<span class="text-danger">*</span>{input}';

?>
<div class="gs-wrapper">
    <h6 class="bg-dark py-1 px-2 rounded header-elements-inline">
        Giám sát lần <?= $i + 1 ?>
        <div class="header-elements">
            <button type="button"
                    class="btn btn-remove-item btn-outline bg-pink-400 text-white btn-icon rounded-round ml-2"
                    title="Xóa lần giám sát"><i class="icon-bin2"></i></button>
        </div>
    </h6>
    <?= $form->field($model, "[{$i}]id")->hiddenInput()->label(false) ?>
    <div class="row">
        <div class="col-md-3"><?= $form->field($model, "[{$i}]ngay_gs", ['template' => $template])->widget(\kartik\widgets\DatePicker::className()) ?></div>
        <div class="col-md-3"><?= $form->field($model, "[{$i}]nguoi_gs", ['template' => $template])->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-6">
            <?= $form->field($model, "[{$i}]mucdich_gs", ['template' => $template])->radioList($dm_mucdich_gs) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, "[{$i}]vc_nc", ['template' => $template])->textInput(['type' => 'number', 'min' => 0]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, "[{$i}]vc_lq", ['template' => $template])->textInput(['type' => 'number', 'min' => 0]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, "[{$i}]dexuat_xp")->radioList($yn) ?>
        </div>
        <div class="col-md-3 clx-xuphat-<?=$i?>">
            <?= $form->field($model, "[{$i}]xuphat")->radioList($yn) ?>
        </div>
        <div class="col-md-3 clx-xuphat-<?=$i?>">
            <?= $form->field($model, "[{$i}]ngayxuphat")->widget(\kartik\widgets\DatePicker::className()) ?>
        </div>
    </div>
</div>

<script>
    $(function () {
        let dexuat_xp = '<?=$model->dexuat_xp?>'
        toggleDexuatXp(dexuat_xp)

        $('input[name="PhieuGs[<?=$i?>][dexuat_xp]"]').change(function () {
            toggleDexuatXp($(this).val())
        })
        
        function toggleDexuatXp(val) {
            if(val === '1') {
                $('.clx-xuphat-<?=$i?>').show()
            } else {
                $('.clx-xuphat-<?=$i?>').hide()
            }
        }
    })
</script>
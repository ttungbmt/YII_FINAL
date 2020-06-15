<?php

use gsnc\models\DmQuan;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model gsnc\models\Dmloaibv */
/* @var $form yii\widgets\ActiveForm */
$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' Loại bệnh viện';
?>
<div  class="dmloaibv-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-body" id="pageApp"  v-cloak>
            <page v-bind="pageData"></page>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<?php
$this->beginBlock('scripts');
$this->registerJsFile('/themes/admin/main/js/plugins/forms/selects/bootstrap_multiselect.js', ['depends' => [\common\assets\AppPluginAsset::className()]]);
$this->registerJsFile('/projects/gsnc/pages/dist/baocao-cln/main.js?v='.params('version'), ['depends' => [\common\assets\AppPluginAsset::className()]]);
$this->registerJsVar('pageData', [
    'cat' => [
        'thoigian' => toInpOptions(api('dm_thoigian')),
        'chitieu_kd' => api('dm_chitieu_kd'),
        'yesno' => api('dm_yesno'),
        'yesno_qd' => api('dm_yesno_qd'),
        'yesno_qd1' => api('dm_yesno_qd1'),
        'tanggiam' => api('dm_tanggiam'),
        'donvi_bc' => toInpOptions(api('dm/donvi-bc')),
        'donvi_cn' => api('dm/donvi-cn?donvi_bc_id='.$model->donvi_bc),
    ],
    'form' => $model->toArray(),
    'schema' => $model->toSchema()
])
?>

<?php $this->endBlock() ?>




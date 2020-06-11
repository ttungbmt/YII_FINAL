<?php

use gsnc\models\DmQuan;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model gsnc\models\Dmloaibv */
/* @var $form yii\widgets\ActiveForm */
$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' Loại bệnh viện';

$dm_thoigian = [
    '6 THANG' => '6 tháng',
    '1 NAM' => '1 năm'
];


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
$this->registerJsFile('/projects/gsnc/pages/dist/baocao-cln/main.js?v='.params('version'), ['depends' => [\common\assets\AppPluginAsset::className()]]);
$this->registerJsVar('pageData', [
    'cat' => [
        'thoigian' => toInpOptions($dm_thoigian),
        'yesno' => [1 => 'Có', 2 => 'Không'],
        'yesno_qd' => [1 => 'Đẩy đủ theo quy định', 2 => 'Không đầy đủ theo quy định'],
        'yesno_qd1' => [1 => 'Đúng quy định', 2 => 'Không đúng quy định'],
        'tanggiam' => [1 => 'Tăng', 2 => 'Giảm'],
        'donvi_bc' => toInpOptions(api('dm/donvi-bc')),
        'donvi_cn' => api('dm/donvi-cn?donvi_bc_id='.$model->donvi_bc)
    ],
    'form' => $model->toArray(),
    'schema' => $model->toSchema()
])
?>

<?php $this->endBlock() ?>




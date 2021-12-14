<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' Phun chủ động';
?>
<div id="page-app">
    <page-form></page-form>
</div>

<?php $this->beginBlock('scripts'); ?>
<?php

$options = ['depends' => [\common\assets\AppPluginAsset::className()]];
$this->registerJsFile('https://cdn.jsdelivr.net/npm/axios@0.21.1/dist/axios.min.js', $options);
$this->registerJsFile('/pcd/pages/dist/phun-cd/app.js?v='.params('version'), $options);
$this->registerJsVar('pageData', [
    'form' => $formData,
    'cat' => $cat,
])
?>

<?php $this->endBlock(); ?>

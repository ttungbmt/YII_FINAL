<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' Ổ dịch';
?>
    <style>
        .ql-container {min-height: 100px}
    </style>

<div id="page-app">
    <page-form-odich></page-form-odich>
</div>

<?php $this->beginBlock('scripts'); ?>
<?php

$options = ['depends' => [\common\assets\AppPluginAsset::className()]];
$this->registerCssFile('https://unpkg.com/leaflet@1.6.0/dist/leaflet.css', $options);
$this->registerCssFile('https://cdn.jsdelivr.net/npm/leaflet-extra-markers@1.2.1/dist/css/leaflet.extra-markers.min.css', $options);
$this->registerJsFile('https://unpkg.com/leaflet@1.6.0/dist/leaflet.js', $options);
$this->registerJsFile('/pcd/pages/dist/odich-sxh/main.js?v='.params('version'), $options);
$this->registerJsVar('pageData', [
    'form' => $formData,
    'cat' => $cat,
    'map' => $map
])
?>
<?php $this->endBlock(); ?>



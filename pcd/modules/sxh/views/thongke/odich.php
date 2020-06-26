<?php
$this->title = 'Thống kê ổ dịch'
?>

<div id="page-app">
    <page-thongke-odich></page-thongke-odich>
</div>

<?php $this->beginBlock('scripts'); ?>
<?php
$options = ['depends' => [\common\assets\AppPluginAsset::className()]];
$this->registerJsFile('https://cdn.jsdelivr.net/npm/excellentexport@3.4.3/dist/excellentexport.min.js', $options);
$this->registerJsFile('/pcd/pages/dist/odich-sxh-thongke/main.js?v='.params('version'), $options);
$this->registerJsVar('pageData', [

])
?>
<?php $this->endBlock(); ?>
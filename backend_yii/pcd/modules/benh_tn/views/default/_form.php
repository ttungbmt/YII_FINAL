<div id="taw"></div>
<div id="page-app">
    <page-cabenh-khac></page-cabenh-khac>
</div>

<?php $this->beginBlock('scripts'); ?>
<?php
$model->chuandoan_bd = $model->chuandoan_bd ?? request('chuandoan_bd');
$options = ['depends' => [\common\assets\AppPluginAsset::className()]];
$this->registerJsFile('/pcd/pages/dist/cabenh-khac/main.js?v='.params('version'), $options);
//$this->registerJsFile('http://localhost:8080/cabenh-khac/main.js', $options);
$this->registerJsVar('pageData', [
    'form' => $model->toArray(),
    'cat' => []
])
?>
<?php $this->endBlock(); ?>

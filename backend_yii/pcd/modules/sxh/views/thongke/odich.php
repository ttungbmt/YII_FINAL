<?php
$this->title = 'Thống kê ổ dịch';
$maquan = userInfo()->maquan;
$dm_qh = toInpOptions(\pcd\models\HcQuan::find()->select('tenquan, maquan')->andFilterWhere(['maquan' => $maquan])->orderBy('order')->pluck('tenquan', 'maquan')->all());
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
    'form' => [
        'loai_tk' => 1,
        'hc' => $maquan,
        'maquan' => $maquan
    ],
    'cat' => [
        'qh' => $dm_qh
    ]
])
?>
<?php $this->endBlock(); ?>
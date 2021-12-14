<?php $this->beginBlock('styles') ?>
<link rel="preload" as="script" href="<?=asset('assets/map2/main.js')?>">
<link rel="preload" as="script" href="<?=asset('assets/map2/css/main.css')?>">
<link rel="preload" as="script" href="<?=asset('assets/map2/vendor.js')?>">
<link rel="preload" as="script" href="<?=asset('assets/map2/vendor_redux.js')?>">
<link rel="preload" as="script" href="<?=asset('assets/map2/ext_react.js')?>">
<link rel="preload" as="script" href="<?=asset('assets/map2/ext_leaflet.js')?>">
<link rel="preload" as="script" href="<?=asset('assets/map2/ext_app.js')?>">
<link rel="preload" as="script" href="<?=asset('assets/map2/css/ext_app.css')?>">
<link rel="preload" as="script" href="<?=asset('assets/map2/ext_other.js')?>">
<link rel="preload" as="script" href="<?=asset('assets/map2/manifest.js')?>">

<link href="<?=asset('assets/map2/css/main.css')?>" rel="stylesheet">
<link href="<?=asset('assets/map2/css/ext_app.css')?>" rel="stylesheet">
<?php $this->endBlock() ?>

<noscript>
    <a href="http://enable-javascript.com/">Javascript must me enabled to use this site.</a>
</noscript>
<react>
</react>

<?php $this->beginBlock('scripts') ?>
<script src="<?=asset('assets/map2/manifest.js')?>"></script>
<script src="<?=asset('assets/map2/main.js')?>"></script>
<script src="<?=asset('assets/map2/vendor.js')?>"></script>
<script src="<?=asset('assets/map2/vendor_redux.js')?>"></script>
<script src="<?=asset('assets/map2/ext_react.js')?>"></script>
<script src="<?=asset('assets/map2/ext_leaflet.js')?>"></script>
<script src="<?=asset('assets/map2/ext_app.js')?>"></script>
<script src="<?=asset('assets/map2/ext_other.js')?>"></script>

<?php $this->endBlock() ?>

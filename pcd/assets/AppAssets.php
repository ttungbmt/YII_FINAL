<?php
namespace pcd\assets;

use yii\web\AssetBundle;

class AppAssets extends AssetBundle
{
    public $basePath = '@webroot/pcd/assets';
    public $baseUrl = '@web/pcd/assets';

    public $css = [
        'css/app.css'
    ];

    public $js = [
    ];
}
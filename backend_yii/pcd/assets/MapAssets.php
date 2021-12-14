<?php
namespace pcd\assets;
use yii\web\AssetBundle;

class MapAssets extends AssetBundle{
    public $basePath = '@webroot/pcd/assets';
    public $baseUrl = '@web/pcd/assets';

    public $css = [
        'https://unpkg.com/leaflet@1.0.3/dist/leaflet.css',
    ];

    public $js = [
        'https://unpkg.com/leaflet@1.0.3/dist/leaflet.js',
        'http://rowanwins.github.io/leaflet-easyPrint/dist/bundle.js',
        'https://cdn.jsdelivr.net/npm/leaflet-choropleth@1.1.4/dist/choropleth.js',
        'https://cdn.jsdelivr.net/npm/leaflet.minichart@0.2.5/dist/leaflet.minichart.js',
        'https://cdn.jsdelivr.net/npm/jquery-serializeobject@1.0.0/jquery.serializeObject.min.js',
    ];
}
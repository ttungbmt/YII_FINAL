<?php
namespace ttungbmt\leaflet\plugins\extraMarker;
use ttungbmt\leaflet\LeafLetAsset;
use yii\web\AssetBundle;

class ExtraMarkerAsset extends AssetBundle
{
    public $sourcePath = '@npm/leaflet-extra-markers/dist';

    public $css        = [
        'css\leaflet.extra-markers.min.css',
    ];

    public $depends    = [
        LeafLetAsset::class
    ];

    public function init()
    {
        $this->js = YII_DEBUG ? ['js\leaflet.extra-markers.js',] : ['js\leaflet.extra-markers.min.js'];
    }
}

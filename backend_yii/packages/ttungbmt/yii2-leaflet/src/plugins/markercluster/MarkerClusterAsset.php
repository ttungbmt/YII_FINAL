<?php
namespace ttungbmt\leaflet\plugins\markercluster;
use yii\web\AssetBundle;

class MarkerClusterAsset extends AssetBundle
{
//    public $sourcePath = '@npm/leaflet-extra-markers/dist';

    public $css        = [
        'https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.4.1/dist/MarkerCluster.min.css',
    ];

    public $depends    = [
        \ttungbmt\leaflet\LeafLetAsset::class
    ];

    public function init()
    {
        $this->js = YII_DEBUG ? ['https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.min.js',] : ['https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.min.js'];

    }
}

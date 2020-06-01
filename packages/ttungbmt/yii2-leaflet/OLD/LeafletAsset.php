<?php
namespace ttungbmt\leaflet;

class LeafletAsset extends \yii\web\AssetBundle
{
    public $publishOptions = [
//        'forceCopy' => true,  // pjax not working if true
//        'only' => [
//
//        ]
    ];

    public $css = [
        'node_modules/leaflet/dist/leaflet.css',
        'node_modules/leaflet-contextmenu/dist/leaflet.contextmenu.css',
        'node_modules/leaflet-extra-markers/dist/css/leaflet.extra-markers.min.css',
        'node_modules/leaflet.locatecontrol/dist/L.Control.Locate.min.css',
        'custom/map.css'
    ];

    public $js = [
        'node_modules/leaflet/dist/leaflet.js',
        'node_modules/leaflet.gridlayer.googlemutant/Leaflet.GoogleMutant.js',
        'node_modules/leaflet-contextmenu/dist/leaflet.contextmenu.js',
        'node_modules/leaflet-extra-markers/dist/js/leaflet.extra-markers.min.js',
        'node_modules/leaflet.locatecontrol/dist/L.Control.Locate.min.js',
        'node_modules/proj4/dist/proj4.js',
        'node_modules/proj4leaflet/src/proj4leaflet.js',
//        'https://cdn.jsdelivr.net/npm/minivents@2.2.0/dist/minivents.js',
//        'libs/leaflet-boundary-canvas/src/BoundaryCanvas.js',
//        'node_modules/proj4/dist/proj4.js',
        'custom/map.js',
        'http://yii2app.prod/admin/map-test.js'
    ];

    public function init()
    {
        parent::init();
        $this->sourcePath = dirname(__DIR__) . '/assets';
    }
}
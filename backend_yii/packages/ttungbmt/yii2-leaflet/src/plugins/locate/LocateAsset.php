<?php
namespace ttungbmt\leaflet\plugins\locate;
use yii\web\AssetBundle;

class LocateAsset extends AssetBundle
{
    public $sourcePath = '@bower/leaflet.locatecontrol/dist';

    public $css        = [];

    public $js         = ['L.Control.Locate.min.js'];

    public $depends    = [
        \ttungbmt\leaflet\LeafLetAsset::class
    ];

    public function init()
    {
        $this->css = YII_DEBUG ? ['L.Control.Locate.css'] : ['L.Control.Locate.min.css'];
    }
}

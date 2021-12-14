<?php
namespace ttungbmt\leaflet\plugins\draw;
use yii\web\AssetBundle;

class DrawAsset extends AssetBundle
{
    public $sourcePath = '@bower/leaflet.draw/dist';

    public $css        = ['leaflet.draw.css'];

    public $js         = [];

    public $depends    = [
        \ttungbmt\leaflet\LeafLetAsset::class
    ];

    public function init()
    {
        $this->js = YII_DEBUG ? ['leaflet.draw-src.js'] : ['leaflet.draw.js'];
    }
}

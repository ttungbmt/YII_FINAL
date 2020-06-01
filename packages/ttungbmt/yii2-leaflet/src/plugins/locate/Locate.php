<?php
namespace ttungbmt\leaflet\plugins\locate;

use ttungbmt\leaflet\Plugin;
use yii\web\JsExpression;

class Locate extends Plugin
{
    public $clientOptions = [
        'icon' => 'icon-target',
        'position' => 'bottomright'
    ];

    public function getPluginName()
    {
        return 'leaflet:locate';
    }

    public function registerAssetBundle($view)
    {
        LocateAsset::register($view);
        return $this;
    }

    public function encode()
    {
        $options = $this->getOptions();
        $name = $this->getName();
        $map = $this->map;
        $js = "L.control.locate($options)" . ($map !== null ? ".addTo($map);" : "");
        if (!empty($name)) {
            $js = "\nlet $name = $js" . ($map !== null ? "" : ";");
        }

        return new JsExpression($js);
    }
}
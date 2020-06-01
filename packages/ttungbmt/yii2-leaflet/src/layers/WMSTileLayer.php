<?php
namespace ttungbmt\leaflet\layers;

use yii\web\JsExpression;

class WMSTileLayer extends TileLayer
{
    public $defaultClientOptions = [
        'transparent' => true,
        'format' => 'image/png'
    ];

    public function encode()
    {
        $options = $this->getOptions();
        $name = $this->getName();
        $map = $this->map;
        $js = "L.tileLayer.wms('$this->urlTemplate', $options)" . ($map !== null ? ".addTo($map);" : "");
        if (!empty($name)) {
            $js = "let $name = $js" . ($map !== null ? "" : ";");
            $js .= $this->getEvents();
        }
        return new JsExpression($js);
    }
}
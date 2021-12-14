<?php
namespace ttungbmt\leaflet\layers;

use yii\web\JsExpression;

class GoogleLayer extends TileLayer
{
    public $urlTemplate = 'http://{s}.google.com/vt/lyrs={map}&x={x}&y={y}&z={z}';

    /**
     * Returns the javascript ready code for the object to render
     *
     * @return \yii\web\JsExpression
     */
    public function encode()
    {
        $this->clientOptions = array_merge([
            'map'         => $this->convertType($this->clientOptions['type']),
            'subdomains'  => ['mt0', 'mt1', 'mt2', 'mt3'],
            'attribution' => '&copy; Google Maps',
        ], $this->clientOptions);

        $options = $this->getOptions();
        $name = $this->getName();
        $map = $this->map;

        $js = "L.tileLayer('$this->urlTemplate', $options)" . ($map !== null ? ".addTo($map);" : "");
        if (!empty($name)) {
            $js = "let $name = $js" . ($map !== null ? "" : ";");
            $js .= $this->getEvents();
        }

        return new JsExpression($js);
    }

    protected function convertType($mapType)
    {
        /*
         h = roads only
         m = standard roadmap
         p = terrain
         r = somehow altered roadmap
         s = satellite only
         t = terrain only
         y = hybrid
         */

        switch ($mapType) {
            case 'roadmap':
                return 'm';
            case 'satellite':
                return 's';
            case 'terrain':
                return 't';
            case 'hybrid':
                return 'y';
            default:
                return $mapType;
        }
    }
}
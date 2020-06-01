<?php
namespace ttungbmt\leaflet\plugins\markercluster;

use ttungbmt\leaflet\layers\Marker;
use ttungbmt\leaflet\Plugin;
use yii\web\JsExpression;
use yii\helpers\Json;

class MarkerCluster extends Plugin
{
    public $url = false;
    /**
     * @var string the icon name
     * @see https://github.com/lvoogdt/Leaflet.awesome-markers#properties
     */
    private $_markers = [];

    /**
     * Returns the plugin name
     * @return string
     */
    public function getPluginName()
    {
        return 'plugin:markercluster';
    }

    public function getMarkers()
    {
        return $this->_markers;
    }

    /**
     * @param Marker $marker
     *
     * @return static the plugin
     */
    public function addMarker(Marker $marker)
    {
        $marker->name = $marker->map = null;
        $this->_markers[] = $marker;
        return $this;
    }

    public function panToMarkerId($id){
        return "console.log(yii2Leaflet.apps.{$this->map}.\$els.{$this->getName(true)})";
    }

    /**
     * Registers plugin asset bundle
     *
     * @param \yii\web\View $view
     *
     * @return mixed
     * @codeCoverageIgnore
     */
    public function registerAssetBundle($view)
    {
        MarkerClusterAsset::register($view);
        return $this;
    }

    /**
     * Returns the javascript ready code for the object to render
     * @return \yii\web\JsExpression
     */
    public function encode()
    {
        $markers = $this->getMarkers();
        if (empty($markers) && $this->url == false) {
            return "";
        }

        $js = [];
        $map = $this->map;
        $options = $this->getOptions();
        $name = $this->getName(true);

        $js[] = "let $name = this.\$els.$name  = L.markerClusterGroup($options);";

        if ($markers) {
            foreach ($markers as $marker) {
                $js[] = "{$marker->encode()};\n$name.addLayer({$marker->name});";
            }
        }

        $js[] = "$map.addLayer($name); console.log($name);";

        return new JsExpression(implode("\n", $js));
    }

}
<?php
/**
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace ttungbmt\leaflet\controls;


use Illuminate\Support\Arr;
use ttungbmt\leaflet\layers\LayerGroup;
use ttungbmt\leaflet\layers\TileLayer;
use ttungbmt\leaflet\LeafLet;
use yii\base\InvalidParamException;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * Layers The layers control gives users the ability to switch between different base layers and switch overlays on/off.
 *
 * @see http://leafletjs.com/reference.html#control-layers
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package ttungbmt\leaflet\controls
 */
class Layers extends Control
{
    /**
     * @var \ttungbmt\leaflet\layers\TileLayer[]
     */
    private $_baseLayers = [];

    /**
     * @param mixed $baseLayers
     *
     * @throws \yii\base\InvalidParamException
     */
    public function setBaseLayers(array $baseLayers)
    {
        foreach ($baseLayers as $key => $layer) {
            if (!($layer instanceof TileLayer)) {
                throw new InvalidParamException("All baselayers should be of type TileLayer ");
            }
            $this->_baseLayers[$key] = $layer;
        }
    }

    /**
     * @return \ttungbmt\leaflet\layers\TileLayer[]
     */
    public function getBaseLayers()
    {
        return $this->_baseLayers;
    }

    /**
     * @return array of encoded base layers
     */
    public function getEncodedBaseLayers()
    {
        $layers = [];
        $baseLayers = $this->getBaseLayers();

        if(collect($baseLayers)->whereNotNull('map')->isEmpty() && !empty($baseLayers)){
            $baseLayers[0]->map = $this->map;
        }

        foreach ($baseLayers as $key => $layer) {
            $layer->name = null;
            $layers[$key] = new JsExpression(str_replace(";", "", $layer->encode()));
        }
        return $layers;
    }

    public function getLinesEncodedBaseLayers(){
        $lines = '';

        foreach (  $layers = $this->getEncodedBaseLayers() as $key => $baselayer){
            $lines .= $baselayer.";\n";
        }

        return $lines;
    }

    public function getNamesLayers($type){
        $names = [];
        $layers = ($type == 'overlay') ? $this->getOverlays() : $this->getBaseLayers();

        foreach ($layers as $key => $layer){
            $title = $layer->title;
            $names[$title ? $title : 'None'] = new JsExpression($layer->getName());
        }

        return $names;
    }

    /**
     * @var \ttungbmt\leaflet\layers\Layer[]
     */
    private $_overlays = [];

    /**
     * @param \ttungbmt\leaflet\layers\LayerGroup[] $overlays
     *
     * @throws \yii\base\InvalidParamException
     */
    public function setOverlays($overlays)
    {
        foreach ($overlays as $key => $overlay) {
            if (!($overlay instanceof LayerGroup)) {
                throw new InvalidParamException("All overlays should be of type LayerGroup");
            }
            $this->_overlays[$key] = $overlay;
        }
    }

    /**
     * @return \ttungbmt\leaflet\layers\Layer[]
     */
    public function getOverlays()
    {
        return $this->_overlays;
    }

    /**
     * @return array of encoded overlays
     */
    public function getEncodedOverlays()
    {
        $overlays = [];
        /**
         * @var \ttungbmt\leaflet\layers\LayerGroup $overlay
         */
        foreach ($this->getOverlays() as $key => $overlay) {
            $overlays[$key] = $overlay->oneLineEncode();
        }
        return $overlays;
    }

    /**
     * Returns the javascript ready code for the object to render
     * @return \yii\web\JsExpression
     */
    public function encode()
    {
        $this->clientOptions['position'] = $this->position;
        $layersLines = $this->getLinesEncodedBaseLayers();
        $overlaysLines = $this->getEncodedOverlays();
        $options = $this->getOptions();
        $name = $this->name;
        $map = $this->map;

        $layers = empty($layersLines) ? '{}' : Json::encode($this->getNamesLayers('basemap'));
        $overlays = empty($overlaysLines) ? '{}' : Json::encode($this->getNamesLayers('overlay'));

        $js = "L.control.layers($layers, $overlays, $options)" . ($map !== null ? ".addTo($map);" : "");
        if (!empty($name)) {
            $js = "let $name = $js" . ($map !== null ? "" : ";");

        }

        $js = "\n$layersLines".$js;

        return new JsExpression($js);
    }
}

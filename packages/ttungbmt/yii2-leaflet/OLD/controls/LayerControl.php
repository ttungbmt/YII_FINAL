<?php
namespace ttungbmt\leaflet\controls;

use ttungbmt\leaflet\controls\Layers;
use ttungbmt\leaflet\layers\TileLayer;
use yii\base\InvalidArgumentException;
use yii\web\JsExpression;

class LayerControl extends Layers
{
    protected $_baseLayers = [];
    protected $_overlays = [];

    /**
     * @return \ttungbmt\leaflet\layers\TileLayer[]
     */
    public function getBaseLayers()
    {
        return $this->_baseLayers;
    }

    public function setBaseLayers(array $baseLayers)
    {
        foreach ($baseLayers as $key => $layer) {

            if (!($layer instanceof TileLayer)) {
                dd($layer);
                throw new InvalidArgumentException("All baselayers should be of type TileLayer ");
            }

            $this->_baseLayers[$key] = $layer;
        }
    }

    /**
     * @return array of encoded base layers
     */
    public function getEncodedBaseLayers()
    {
        $layers = [];
        foreach ($this->getBaseLayers() as $key => $layer) {
//            $layer->name = null;
            $layers[$key] = $layer->name ? new JsExpression($layer->name) : new JsExpression(str_replace(";", "", $layer->encode()));
        }

        return $layers;
    }

    public function getEncodedBaseLayersLines(){
        $lines = '';

        foreach ($this->getBaseLayers() as $key => $layer) {
            $lines .= $layer->name ? new JsExpression($layer->encode()."\n") : '';
        }
        return $lines;
    }



    /**
     * @return \ttungbmt\leaflet\layers\Layer[]
     */
    public function getOverlays()
    {
        return $this->_overlays;
    }

    public function setOverlays($overlays)
    {
        foreach ($overlays as $key => $overlay) {
            $this->_overlays[$key] = $overlay;
        }
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
            $overlays[$key] = $overlay->name ? new JsExpression($overlay->name) : (method_exists($overlay, 'oneLineEncode') ? $overlay->oneLineEncode() : new JsExpression(str_replace(";", "", $overlay->encode())));
        }
        return $overlays;
    }

    public function getEncodedOverlaysLines(){
        $lines = '';
        /**
         * @var \ttungbmt\leaflet\layers\LayerGroup $overlay
         */
        foreach ($this->getOverlays() as $key => $overlay) {
            $lines .= $overlay->name ? (method_exists($overlay, 'oneLineEncode') ? $overlay->oneLineEncode() : new JsExpression($overlay->encode()."\n")) : '';
        }
        return $lines;
    }

    public function encode()
    {
        $layers = $this->getEncodedBaseLayersLines();
        $overlays = $this->getEncodedOverlaysLines();

        return " \n".$layers.$overlays.parent::encode();
    }


}
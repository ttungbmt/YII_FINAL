<?php
namespace ttungbmt\leaflet\plugins\extraMarker;

use ttungbmt\leaflet\Plugin;
use yii\web\JsExpression;
use yii\helpers\Json;

class ExtraMarker extends Plugin
{
    /**
     * @var string the icon name
     * @see https://github.com/lvoogdt/Leaflet.awesome-markers#properties
     */
    public $icon;

    /**
     * Generates the code to generate a maki marker. Helper method made for speed purposes.
     *
     * @param string $icon the icon name
     * @param array $options the maki marker icon
     *
     * @return string the resulting js code
     */
    public function make($icon, $options = [])
    {
        $options['icon'] = $icon;
        $options = Json::encode($options);
        return new JsExpression("L.ExtraMarkers.icon($options)");
    }

    /**
     * Returns the plugin name
     * @return string
     */
    public function getPluginName()
    {
        return 'plugin:extramarker';
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
        ExtraMarkerAsset::register($view);
        return $this;
    }

    /**
     * Returns the javascript ready code for the object to render
     * @return \yii\web\JsExpression
     */
    public function encode()
    {
        $icon = $this->icon;

        if (empty($icon)) return "";

        $this->clientOptions['icon'] = $icon;
        $options = $this->getOptions();
        $name = $this->getName();

        $js = "L.ExtraMarkers.icon($options)";

        if (!empty($name)) {
            $js = "let $name = $js;";
        }

        return new JsExpression($js);
    }

}
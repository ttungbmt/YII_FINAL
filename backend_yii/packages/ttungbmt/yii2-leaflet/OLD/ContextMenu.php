<?php

namespace ttungbmt\leaflet;

use ttungbmt\leaflet\Plugin;
use yii\web\JsExpression;

class ContextMenu extends Plugin
{

    /**
     * Returns the plugin name
     *
     * @return string
     */
    public function getPluginName()
    {
        return 'plugin:contextmenu';
    }

    /**
     * Registers plugin asset bundle
     *
     * @param \yii\web\View $view
     *
     * @return mixed
     */
    public function registerAssetBundle($view)
    {
        return $this;
    }

    /**
     * Returns the javascript ready code for the object to render
     *
     * @return \yii\web\JsExpression
     */
    public function encode()
    {
        $options = $this->getOptions();
        $name = $this->getName();

//        $js = "L.AwesomeMarkers.icon($options)";
//        if (!empty($name)) {
//            $js = "var $name = $js;";
//        }
//
//        return new JsExpression($js);
    }
}
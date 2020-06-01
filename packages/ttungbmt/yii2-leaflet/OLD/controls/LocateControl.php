<?php
namespace ttungbmt\leaflet\controls;

use yii\web\JsExpression;

class LocateControl extends \ttungbmt\leaflet\controls\Control
{
    public $position = 'bottomright';
    /**
     * Returns the javascript ready code for the object to render
     *
     * @return \yii\web\JsExpression
     */

    public function encode()
    {
        $this->clientOptions = array_merge([
            'icon' => 'icon-target',
            'position' => $this->position
        ], $this->clientOptions);

        $options = $this->getOptions();
        $name = $this->getName();
        $map = $this->map;
        $js = "L.control.locate($options)" . ($map !== null ? ".addTo($map);" : "");
        if (!empty($name)) {
            $js = "let $name = $js" . ($map !== null ? "" : ";");
        }
        return new JsExpression($js);
    }
}
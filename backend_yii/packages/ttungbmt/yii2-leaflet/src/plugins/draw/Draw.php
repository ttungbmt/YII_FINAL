<?php
namespace ttungbmt\leaflet\plugins\draw;

use ttungbmt\leaflet\Plugin;
use yii\web\JsExpression;

class Draw extends Plugin
{
    public $featureGroup;

    public $clientOptions = [
        'draw' => [
            'rectangle' => false,
            'polyline' => false,
            'circle' => false,
            'circlemarker' => false,
            'polygon' => false,
        ]
    ];

    public function getPluginName()
    {
        return 'leaflet:draw';
    }

    public function registerAssetBundle($view)
    {
        DrawAsset::register($view);
        return $this;
    }

    public function encode()
    {
        $this->clientOptions = array_merge($this->clientOptions, [
            'edit' => [
                'featureGroup' => new JsExpression($this->featureGroup->name),
                'poly' => [
                    'allowIntersection' => true
                ]
            ]
        ]);

        $options = $this->getOptions();
        $name = $this->getName();
        $map = $this->map;

        $js = "new L.Control.Draw($options)" . ($map !== null ? ".addTo($map);" : "");
        if (!empty($name)) {
            $js = "\nlet $name = $js" . ($map !== null ? "" : ";");

            if($map !== null && $this->featureGroup){
                $featureName = $this->featureGroup->name;

                $js .= "\n{$map}
    .on(L.Draw.Event.CREATED, (e) => { 
        if(e.layer instanceof L.Marker) this.setMarker(e.layer.getLatLng());
        {$featureName}.clearLayers()
        let layer = e.layer
        layer.setIcon(this.getDefaultIcon())
        {$featureName}.addLayer(layer)
    })
    .on(L.Draw.Event.EDITED, (e) => { 
        e.layers.eachLayer(l => { if(l instanceof L.Marker) this.setMarker(l.getLatLng()) })
    })  
    .on(L.Draw.Event.DELETED, (e) => { 
        e.layers.eachLayer(l => { if(l instanceof L.Marker) this.removeMarker(l.getLatLng()) })
    })
    ";
            }
        }

//        $js = 'console.log(123)';

//        $options = $this->getOptions();
//        $name = $this->getName();
//        $map = $this->map;
//        $js = "L.control.locate($options)" . ($map !== null ? ".addTo($map);" : "");
//        if (!empty($name)) {
//            $js = "\nlet $name = $js" . ($map !== null ? "" : ";");
//        }

        return new JsExpression($js);
    }
}
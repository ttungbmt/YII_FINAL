<?php

namespace ttungbmt\leaflet;

use ttungbmt\leaflet\controls\Layers;
use ttungbmt\leaflet\controls\Locate;
use ttungbmt\leaflet\controls\Zoom;
use ttungbmt\leaflet\layers\FeatureGroup;
use ttungbmt\leaflet\layers\GoogleLayer;
use ttungbmt\leaflet\layers\HCMGISLayer;
use ttungbmt\leaflet\layers\LayerGroup;
use ttungbmt\leaflet\layers\MapboxLayer;
use ttungbmt\leaflet\layers\OSMLayer;
use ttungbmt\leaflet\layers\WMSTileLayer;
use ttungbmt\leaflet\types\LatLng;
use yii\helpers\ArrayHelper;

trait LeafletTrait
{
    public function setMap($config){
        if(isset($config['plugins']) && $plugins = array_filter($config['plugins'])){
            foreach ($plugins as $p){
                $this->installPlugin($p);
            }
        }

        if(isset($config['layers']) && $layers = $config['layers']){
            foreach ($layers as $l){
                if($l instanceof LayerGroup){
                    $this->addLayerGroup($l);
                } else {
                    $this->addLayer($l);
                }
            }
        }

    }

    /**
     * Merge default options
     */
    protected function mergeDefaultOptions()
    {
        if (isset($this->defaultClientOptions['center']) && empty($this->center)) {
            $center = $this->defaultClientOptions['center'];
            $this->center = new LatLng(['lat' => $center[0], 'lng' => $center[1]]);
        }

        if (isset($this->defaultClientOptions['zoom']) && empty($this->zoom)) {
            $this->zoom = $this->defaultClientOptions['zoom'];
        }

        $this->clientOptions = ArrayHelper::merge($this->defaultClientOptions, $this->clientOptions);
    }

    public function addDefaultControls()
    {
        $this->addControl(new Zoom(['position' => 'bottomright']));

        $layersControl = new Layers([
            'baseLayers' => [
                new OSMLayer(),
                new GoogleLayer(['map' => $this->name]),
                new MapboxLayer(),
                new HCMGISLayer(),
                new WMSTileLayer([
                    'title' => 'HCMGIS',
                    'urlTemplate' => 'https://pcd.hcmgis.vn/geoserver/gwc/service/wms',
                    'clientOptions' => [
                        'layers' => 'hcm_map:hcm_map_all'
                    ]
                ])
            ]
        ]);
        $this->addControl($layersControl);
    }

    public function setDefaultCenter()
    {
        $this->center = new LatLng(['lat' => 10.795465, 'lng' => 106.648383]);
    }
}
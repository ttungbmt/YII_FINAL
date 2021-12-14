<?php
namespace ttungbmt\leaflet\widgets;


use ttungbmt\leaflet\types\LatLng;
use ttungbmt\leaflet\Leaflet;
use yeesoft\models\Setting;
use yii\base\Widget;

class MapBuilder extends Widget
{
    public $key;
    public $config = [];
    public $leaflet = [];

    public function run(){
        if(empty($this->config)){
            $setting = Setting::findOne(['key' => $this->key]);

            if(!$setting){
                echo 'Not found Map Builder';
                return null;
            }
            $this->config = json_decode($setting->value, true);
        }

        $this->config = collect($this->config);
        $config = $this->config;
        $leaflet = new Leaflet([
            'center' => new LatLng(['lat' => $config->dget('center.0'), 'lng' => $config->dget('center.1')]),
            'zoom' => $config->dget('zoom', 9)
        ]);
        $this->leaflet = $leaflet;

        $this->handleLayers();
        $this->handleControls();

        echo Map::widget(['leaflet' => $leaflet]);
    }

    public function handleLayers(){
        $layers = $this->config->dget('layers', []);
        $this->leaflet->addLayers($layers);
    }

    public function handleControls(){
        $geocoder = $this->config->dget('controls.geocoder');
        if($geocoder){
            $this->leaflet->addGeocoderControl();
        }

        $draw = $this->config->dget('controls.draw');
        if($draw){
            $this->leaflet->addDrawControl();
        }
    }
}
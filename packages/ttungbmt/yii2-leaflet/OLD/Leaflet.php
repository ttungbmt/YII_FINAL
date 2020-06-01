<?php

namespace ttungbmt\leaflet;

use ttungbmt\leaflet\controls\Zoom;
use ttungbmt\leaflet\layers\FeatureGroup;
use ttungbmt\leaflet\layers\Layer;
use ttungbmt\leaflet\layers\LayerGroup;
use ttungbmt\leaflet\layers\Marker;
use ttungbmt\leaflet\types\LatLng;
use nanson\postgis\behaviors\GeometryBehavior;
use Phayes\GeoPHP\Geometry\Point;
use ttungbmt\leaflet\controls\LayerControl;
use ttungbmt\leaflet\controls\LocateControl;
use ttungbmt\leaflet\plugins\draw\Draw;
use ttungbmt\leaflet\plugins\geocoder\Geocoder;
use ttungbmt\leaflet\plugins\geocoder\services\ServiceHCMGIS;
use yii\web\JsExpression;

class Leaflet extends \ttungbmt\leaflet\LeafLet
{
    use LeafletTrait;

    public $app = 'mapApp';

    public $model;

    protected $layerControl;

    public static $classMap = [
        'TileLayer'    => \ttungbmt\leaflet\layers\TileLayer::class,
        'WMSTileLayer' => \ttungbmt\leaflet\layers\WMSTileLayer::class,
        'GoogleLayer'  => \ttungbmt\leaflet\layers\GoogleLayer::class,
    ];

    public $selectors = [
        'inpLat' => '#inpLat',
        'inpLng' => '#inpLng',
        'tarea' => '#tareaGeoJSON'
    ];

    public $defaultBaseLayer = 'Google';

    public function init()
    {
        parent::init();
        $this->setDefaultZoom();
    }

    public function setDefaultZoom(){
        if(!isset($this->clientOptions['zoomControl'])){
            $this->setDefaultClientOptions([
                'zoomControl' => false
            ]);
            $this->addControl(new Zoom(['position' => 'bottomright']));
        }
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function addLayerAdv($layer)
    {
        if(is_array($layer)){
            $layer = $this->array2Layer($layer);
        }

        $this->addLayer($layer);
    }

    public function addGeocoderControl($service = null)
    {
        $service = $service ? $service : new ServiceHCMGIS();

        $geocoderPlugin = new Geocoder([
            'name'          => 'geocoder',
            'service'       => $service,
            'clientOptions' => [
                'placeholder'        => 'Nhập vị trí tìm kiếm ...',
                'defaultMarkGeocode' => false,
                'position'           => 'topleft',
            ],
            'clientEvents'  => [
                'markgeocode' => new JsExpression('function(e){ addMarker({latlng: e.geocode.center}) }')
            ]
        ]);
        $this->installPlugin($geocoderPlugin);
    }

    public function addDrawControl($options = []){
        $featureGroup = new FeatureGroup(['name' => 'drawnItems']);
        $options = array_merge(['featureGroup' => $featureGroup], $options);

        $drawPlugin = new Draw($options);

        $this->addLayerGroup($options['featureGroup']);
        $this->installPlugin($drawPlugin);
    }

    protected function array2Layer($arr){
        $classMap = self::$classMap;

        $opts = collect($arr['options']);
        $layerClass = $classMap[$arr['name']];

        $options = [
            'name' => data_get($arr, '_name', uniqid('layer_')),
            'clientOptions' => $opts->all()
        ];

        if ($urlTemplate = $opts->get('url')) {
            $options['urlTemplate'] = $urlTemplate;
        }

        if (data_get($arr, 'checked') == true || data_get($arr, 'title') == $this->defaultBaseLayer) {
            $options['map'] = $this->name;
        }

        return  new $layerClass($options);
    }

    public function addDefaultBaseLayers()
    {
        $list = collect(require __DIR__ . '/fixtures/baselayers.php');
        // Make array

        $baseLayers = $list->map(function ($i){
            return [
                $i['title'] => $this->array2Layer($i)
            ];
        })->collapse();

        // Set base layer
        $layerControl = $this->getLayerControl();
        $layerControl->setBaseLayers($baseLayers->all());

        return $this;
    }

    protected function getLayerControl(){
        $layerControl = $this->layerControl ? $this->layerControl : new LayerControl();
        $this->addControl($layerControl);
        return $layerControl;
    }

    public function addLayers($layers){
        $layerControl = $this->getLayerControl();
        $arr = [];

        foreach ($layers as $l){
            if($l['type'] === 'base'){
                $arr['baseLayers'][$l['title']] = $this->array2Layer($l);
            } else {
                $arr['overlays'][$l['title']] = $this->array2Layer($l);
            }
        }

        if($baseLayers = data_get($arr, 'baseLayers')){
            $layerControl->setBaseLayers($baseLayers);
        }

        if($overlays = data_get($arr, 'overlays')){
            $layerControl->setOverlays($overlays);
        }

    }

    public function initForm($params)
    {
        $this->model = $params['model'];
        $this->selectors = array_merge($this->selectors, data_get($params, 'selectors', []));

        $this->clientOptions = array_merge([
            'zoomControl'      => false,
            'contextmenu'      => true,
            'contextmenuItems' => [
                ['text' => '<i class="icon-location4"></i> Thêm điểm', 'callback' => new JsExpression('addMarker')],
                '-',
                ['text' => '<i class="icon-google"></i> Xem thông tin', 'callback' => new JsExpression('showInfo')],
            ],
        ], $this->clientOptions);

        $layerGroup = new LayerGroup();
        $layerGroup->setName('group');

        if ($this->model->geom) {
            if(collect($this->model->behaviors)->first(function ($i){return $i->type === GeometryBehavior::GEOMETRY_POINT && $i->attribute === 'geom';})){
                if($this->model->geom instanceof Point){
                    $lat = $this->model->geomLat;
                    $lng = $this->model->geomLng;
                } else {
                    $lat = $this->model->geom[1];
                    $lng = $this->model->geom[0];
                }

                $latlng = new LatLng(['lat' =>$lat, 'lng' => $lng]);

                $marker = new Marker([
                    'latLng'        => $latlng,
                    //'popupContent'  => 'Hi!',
                    'clientOptions' => [
                        'icon'                    => new JsExpression("defaultIcon"),
                        'draggable'               => true,
                        'contextmenu'             => true,
                        'contextmenuInheritItems' => false,
                        'contextmenuItems'        => [
                            ['text' => '<i class="icon-bin"></i> Xóa điểm', 'callback' => new JsExpression('removeMarker')],
                            '-',
                            ['text' => '<i class="icon-google"></i> Xem thông tin', 'callback' => new JsExpression('function(e){ showInfo({latlng: e.relatedTarget.getLatLng()}) }')],
                        ]
                    ],
                    'clientEvents'  => [
                        'moveend' => new JsExpression("moveEndMarker")
                    ]
                ]);

                $marker->setName('location');
                $layerGroup->addLayer($marker);
                $this->clientOptions['center'] = $latlng;
            }
        }

        $this->jsForm();

        // Add layers
        $this->addDefaultBaseLayers();
        $this->addLayerGroup($layerGroup);
        // Add controls
        $this->addControl(new LocateControl());
        $this->addGeocoderControl();
    }

    public function jsForm(){
        $inpLat = $this->selectors['inpLat'];
        $inpLng = $this->selectors['inpLng'];

        $this->appendJs(<<< JS
        
function setLatLng(latlng) {
   $('$inpLat').val(latlng.lat);
   $('$inpLng').val(latlng.lng);
}

function resetLatLng() {
   $('$inpLat').val('');
   $('$inpLng').val('');
}

function moveEndMarker(e) {
 setLatLng(e.target.getLatLng())
}

function addMarker({latlng}){
   let marker = L.marker(latlng, {icon: defaultIcon, draggable: true}).on('moveend', moveEndMarker);
   group.clearLayers();
   group.addLayer(marker);
   setLatLng(latlng)
   map.panTo(latlng)
   // map.fitBounds(L.latLngBounds([latlng]))
};

function removeMarker(e){
   group.clearLayers();
   resetLatLng()
}

function showInfo({latlng}) {
    let {lat, lng} = latlng
    window.open('https://www.google.com/maps/place/'+[lat, lng].join(','));
}




JS
        );
    }
}
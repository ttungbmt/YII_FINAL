<?php

use ttungbmt\leaflet\layers\FeatureGroup;
use ttungbmt\leaflet\layers\Marker;
use ttungbmt\leaflet\Leaflet;
use ttungbmt\leaflet\plugins\draw\Draw;
use ttungbmt\leaflet\plugins\extraMarker\ExtraMarker;
use ttungbmt\leaflet\plugins\locate\Locate;
use ttungbmt\leaflet\types\LatLng;

$leaflet = new Leaflet();
$featureGroup = new FeatureGroup();

$leaflet->setMap([
    'layers' => [
        $featureGroup
    ],
    'plugins' => [
        Yii::$app->request->isSecureConnection ? new Locate() : null,
        new ExtraMarker(['name' => 'extraMarker']),
        new Draw([
            'featureGroup' => $featureGroup
        ]),
    ],
]);

$cluster = new \ttungbmt\leaflet\plugins\markercluster\MarkerCluster([
    'name' => 'cluster',
    'clientEvents' => [

    ]
]);
$leaflet->installPlugin($cluster);

if ($model->geom) {
    $latlng = [$model->geom[1], $model->geom[0]];
    $leaflet->clientOptions['bounds'] = [
        $latlng, $latlng
    ];
    $icon = $leaflet->plugins->extraMarker->make('fa fa-circle-o', ['markerColor' => 'cyan']);
    $marker = new Marker([
        'latLng' => new LatLng(['lat' => $latlng[0], 'lng' => $latlng[1]]),
        'icon' => $icon,
        'popupContent' => '123'
    ]);
//    $featureGroup->addLayer($marker);
    $cluster->addMarker($marker);
}
?>

<button class="btn btn-primary mb-2" onclick="<?=$cluster->panToMarkerId(1)?>">Zoom to point</button>

<?= $leaflet->widget() ?>


<?php
use ttungbmt\leaflet\types\LatLng;
use ttungbmt\leaflet\Leaflet;
use yii\web\JsExpression;

$inpLat = isset($inpLat) ? $inpLat : '#inpLat';
$inpLng = isset($inpLng) ? $inpLng : '#inpLng';

$leaflet = new Leaflet([
    'center' => new LatLng(['lat' => 10.804476, 'lng' => 106.639384])
]);

$leaflet->initForm([
    'model' => $model,
    'selectors' => [
        'inpLat' => $inpLat,
        'inpLng' => $inpLng,
    ]
]);

$drawnItems = new \ttungbmt\leaflet\layers\FeatureGroup(['name' => 'drawnItems']);
$leaflet->addLayerGroup($drawnItems);
$drawPlugin = new \ttungbmt\leaflet\plugins\draw\Draw([
    'name' => 'drawControl',
    'featureGroup' => $drawnItems,
    'clientEvents' => [
        'draw:created' => new JsExpression("function(e){
            $drawnItems->name.addLayer(e.layer)
        }")
    ]
]);
$leaflet->installPlugin($drawPlugin);
?>

<?= \ttungbmt\leaflet\widgets\Map::widget([
    'leaflet' => $leaflet
]) ?>
<?php
namespace ttungbmt\leaflet\layers;

class MapboxLayer extends TileLayer
{
    public $title = 'Mapbox';

    public $urlTemplate = 'https://api.tiles.mapbox.com/v4/{map}/{z}/{x}/{y}.png?access_token={accessToken}';

    public $clientOptions = [
        'map'         => 'mapbox.streets',
        'accessToken' => 'pk.eyJ1IjoidHR1bmdibXQiLCJhIjoiY2EzNDFhZjU4ZThkNzY5NTU3M2U1YWFiNmY4OTE3OWQifQ.Bo1ss5J4UjPPOjmq9S3VQw',
        'attribution' => 'Map data &copy; <a href=\'http://mapbox.com\'>Mapbox</a>',
    ];
}
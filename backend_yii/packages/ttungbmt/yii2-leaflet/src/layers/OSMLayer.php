<?php
namespace ttungbmt\leaflet\layers;

class OSMLayer extends TileLayer
{
    public $title = 'OSM';

    public $urlTemplate = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

    public $clientOptions = [
        'attribution' => '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    ];
}
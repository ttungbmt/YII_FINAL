<?php
namespace ttungbmt\leaflet;

trait LeafletTrait
{
    public function setDefaultClientOptions($options){
        $this->clientOptions = array_merge($options, $this->clientOptions);
    }
}
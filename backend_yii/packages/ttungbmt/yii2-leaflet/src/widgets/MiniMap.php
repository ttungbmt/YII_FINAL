<?php
namespace ttungbmt\leaflet\widgets;

use yii\base\Widget;

class MiniMap extends Widget
{
    public $model;

    public function run()
    {
        return $this->render('minimap', [
            'model' => $this->model
        ]);
    }
}
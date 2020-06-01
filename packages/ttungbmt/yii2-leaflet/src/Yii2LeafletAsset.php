<?php
namespace ttungbmt\leaflet;

use yii\web\AssetBundle;

class Yii2LeafletAsset extends AssetBundle
{
    public $publishOptions = [
        'forceCopy' => true,  // pjax not working if true
    ];

    public $depends    = [
        \ttungbmt\leaflet\LeafLetAsset::class
    ];

    public function init()
    {
        parent::init();

        $this->sourcePath = dirname(__DIR__).'/assets';

        $this->css = [
            'css/yii2-leaflet.css',
        ];

        $this->js = [
            'js/yii2-leaflet.js',
        ];

    }
}
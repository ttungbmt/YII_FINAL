<?php
namespace ttungbmt\yii\alpine;

use yii\web\AssetBundle;

class AlpineAsset extends AssetBundle
{
    public $publishOptions = [
        'forceCopy' => true,  // pjax not working if true
    ];

    public function init()
    {
        parent::init();

        $this->sourcePath = dirname(__DIR__).'/assets/js';

        $this->js = [
            'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js',
            'alpine-helper.js'
        ];
    }


}
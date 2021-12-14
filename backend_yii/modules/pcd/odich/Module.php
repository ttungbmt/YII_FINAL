<?php

namespace pcd\modules\odich;
use yii\web\GroupUrlRule;

/**
 * odich module definition class
 */
class Module extends \yii\base\Module implements \yii\base\BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'pcd\modules\odich\controllers';

    public function bootstrap($app)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

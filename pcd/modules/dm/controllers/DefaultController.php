<?php
namespace pcd\modules\dm\controllers;

use pcd\controllers\AppController;

/**
 * Default controller for the `dm` module
 */
class DefaultController extends AppController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

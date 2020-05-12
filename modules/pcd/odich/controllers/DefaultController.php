<?php

namespace pcd\modules\odich\controllers;

use common\controllers\BackendController;
use yii\web\Controller;

/**
 * Default controller for the `odich` module
 */
class DefaultController extends BackendController
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

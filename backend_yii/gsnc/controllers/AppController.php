<?php
namespace gsnc\controllers;
use common\controllers\BackendController;
use yii\filters\VerbFilter;

class AppController extends BackendController
{
    public function init()
    {
        parent::init();
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
}
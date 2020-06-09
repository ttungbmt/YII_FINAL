<?php
namespace gsnc\controllers\admin;

use app\models\BaocaoCln;
use gsnc\controllers\AppController;
use gsnc\models\search\BaocaoClnSearch;
use ttungbmt\actions\IndexAction;

class BaocaoClnController extends AppController
{
   public $modelClass = BaocaoCln::class;

   public function actions()
   {
       return array_merge(parent::actions(), [
           'index' => [
               'class' => IndexAction::class,
               'modelClass' => BaocaoClnSearch::class
           ]
       ]);
   }
}
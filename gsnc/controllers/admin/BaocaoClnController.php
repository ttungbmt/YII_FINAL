<?php
namespace gsnc\controllers\admin;

use app\models\BaocaoCln;
use gsnc\controllers\AppController;
use gsnc\models\search\BaocaoClnSearch;
use ttungbmt\actions\CreateAction;
use ttungbmt\actions\DeleteAction;
use ttungbmt\actions\IndexAction;
use ttungbmt\actions\UpdateAction;

class BaocaoClnController extends AppController
{
   public $modelClass = BaocaoCln::class;

   public function actions()
   {
       return array_merge(parent::actions(), [
           'index' => [
               'class' => IndexAction::class,
               'modelClass' => BaocaoClnSearch::class
           ],
           'create' => [
               'class' => CreateAction::class,
               'modelClass' => $this->modelClass
           ],
           'update' => [
               'class' => UpdateAction::class,
               'modelClass' => $this->modelClass
           ],
           'delete' => [
               'class' => DeleteAction::class,
               'modelClass' => $this->modelClass
           ]
       ]);
   }
}
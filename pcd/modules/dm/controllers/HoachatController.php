<?php
namespace pcd\modules\dm\controllers;

use pcd\controllers\AppController;
use pcd\modules\dm\models\DmToDp;
use pcd\modules\dm\models\search\DmHoachatSearch;
use ttungbmt\actions\CreateAction;
use ttungbmt\actions\DeleteAction;
use ttungbmt\actions\IndexAction;
use ttungbmt\actions\UpdateAction;
use ttungbmt\actions\ViewAction;

class HoachatController extends AppController
{
    protected $modelClass = 'pcd\modules\dm\models\DmHoachat';

    public function actions(){
        return array_merge(parent::actions(), [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => DmHoachatSearch::class
            ],
            'view' => [
                'title' => 'Chi tiết Hóa chất #{id}',
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass
            ],
            'create' => [
                'title' => 'Thêm mới Hóa chất',
                'class' => CreateAction::class,
                'modelClass' => $this->modelClass
            ],
            'update' => [
                'title' => 'Cập nhật Hóa chất #{id}',
                'class' => UpdateAction::class,
                'modelClass' => $this->modelClass
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'modelClass' => $this->modelClass,
                'successCallback' => [$this, 'deleteRelated']
            ]
        ]);
    }

    public function deleteRelated($model){
        DmToDp::deleteAll(['khupho' => $model->khupho, 'maphuong' => $model->maphuong]);
    }
}

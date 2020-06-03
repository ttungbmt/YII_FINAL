<?php
namespace pcd\modules\dm\controllers;

use pcd\controllers\AppController;
use pcd\modules\dm\models\DmToDp;
use pcd\modules\dm\models\search\DmKhuphoSearch;
use ttungbmt\actions\CreateAction;
use ttungbmt\actions\DeleteAction;
use ttungbmt\actions\IndexAction;
use ttungbmt\actions\UpdateAction;
use ttungbmt\actions\ViewAction;

class KhuphoController extends AppController
{
    protected $modelClass = 'pcd\modules\dm\models\DmKhupho';

    public function actions(){
        return array_merge(parent::actions(), [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => DmKhuphoSearch::class
            ],
            'view' => [
                'title' => 'Chi tiết khu phố #{id}',
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass
            ],
            'create' => [
                'title' => 'Thêm mới khu phố',
                'class' => CreateAction::class,
                'modelClass' => $this->modelClass
            ],
            'update' => [
                'title' => 'Cập nhật khu phố #{id}',
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

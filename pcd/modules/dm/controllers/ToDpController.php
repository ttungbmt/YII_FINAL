<?php
namespace pcd\modules\dm\controllers;

use pcd\controllers\AppController;
use pcd\modules\dm\models\DmToDp;
use pcd\modules\dm\models\search\DmToDpSearch;
use ttungbmt\actions\CreateAction;
use ttungbmt\actions\DeleteAction;
use ttungbmt\actions\IndexAction;
use ttungbmt\actions\UpdateAction;
use ttungbmt\actions\ViewAction;

class ToDpController extends AppController
{
    protected $modelClass = 'pcd\modules\dm\models\DmToDp';

    public function actions(){
        return array_merge(parent::actions(), [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => DmToDpSearch::class
            ],
            'view' => [
                'title' => 'Chi tiết tổ dân phố #{id}',
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass
            ],
            'create' => [
                'title' => 'Thêm mới tổ dân phố',
                'class' => CreateAction::class,
                'modelClass' => $this->modelClass
            ],
            'update' => [
                'title' => 'Cập nhật tổ dân phố #{id}',
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

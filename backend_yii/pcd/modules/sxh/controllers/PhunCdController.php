<?php

namespace pcd\modules\sxh\controllers;

use pcd\controllers\AppController;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use pcd\modules\dm\models\DmHoachat;
use pcd\modules\sxh\forms\OdichForm;
use pcd\modules\sxh\forms\PhunCdForm;
use pcd\modules\sxh\models\Odich;
use pcd\modules\sxh\models\search\PhunCdSearch;
use pcd\supports\RoleHc;
use ttungbmt\actions\CreateAction;
use ttungbmt\actions\DeleteAction;
use ttungbmt\actions\ExportWordAction;
use ttungbmt\actions\IndexAction;
use ttungbmt\actions\UpdateAction;

/**
 * PhunCdController implements the CRUD actions for PhunCd model.
 */
class PhunCdController extends AppController
{
    public $enableCsrfValidation = false;
    public $modelClass = Odich::class;

    public function actions()
    {
        $errorMessage = 'Biên bản xử lý có một số thông tin nhập chưa đúng. Xin vui lòng kiểm tra lại biên bản';

        return array_merge(parent::actions(), [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => PhunCdSearch::class
            ],
            'create' => [
                'class' => CreateAction::class,
                'modelClass' => PhunCdForm::class,
                'redirectUrl' => ['index'],
                'messages' => [
                    'error' => $errorMessage
                ],
                'viewParams' => [$this, 'getPageData'],
                'handler' => 'saveModel'
            ],
            'update' => [
                'class' => UpdateAction::class,
                'modelClass' => PhunCdForm::class,
                'redirectUrl' => false,
                'messages' => [
                    'error' => $errorMessage
                ],
                'viewParams' => [$this, 'getPageData'],
                'handler' => 'saveModel'
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'modelClass' => $this->modelClass,
            ],
//            'export-word' => [
//                'class'    => ExportWordAction::class,
//                'fileName' => 'BienbanXL_OD',
//                'getData'  => [$this, 'getDataWord'],
//            ]
        ]);
    }

    public function getPageData(){
        $id = request()->get('id');
        $model = PhunCdForm::findById($id);
        $hoachat = DmHoachat::pluck('ten_hc', 'ten_hc');

        return [
            'formData' => $model->toFormArray(),
            'cat' => [
                'hoachat' => $hoachat,
                'loai_xl' => [1 => 'Phun chủ động ĐNC', 2 => 'Phun chủ động cộng đồng'],
                'qh' => HcQuan::getList(),
                'px' => HcPhuong::getList(),
                'loai_ks' => api('dm_loai_ks')
            ]
        ];
    }

}

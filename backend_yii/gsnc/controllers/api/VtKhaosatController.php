<?php
namespace gsnc\controllers\api;

use common\controllers\ActiveController;
use yii\web\Link;

class VtKhaosatController extends ActiveController
{
    public $modelClass = 'gsnc\resources\VtKhaosatResource';

    public function actionSearch(){
        $searchModel = new $this->modelClass;
        $dataProvider = $searchModel->search(request()->all());

        $pagination = $dataProvider->getPagination();
        $models = $dataProvider->getModels();
        $items = collect($models)->map(function ($item) {
            return $item->toArray([], ['geometry']);
        });


        $pjax_id = 'vt-khaosat-list';
        $data = [
            'pjax_id' => $pjax_id,
            'items' => $items,
            '_key'  => 'vt_khaosat',
            '_meta' => [
                'totalCount'  => $pagination->totalCount,
                'pageCount'   => $pagination->getPageCount(),
                'currentPage' => $pagination->getPage() + 1,
                'perPage'     => $pagination->getPageSize(),
            ],
            '_link' => Link::serialize($pagination->getLinks()),
        ];

        $pageSize = $pagination->getPageSize();
        $offset = $pagination->getOffset();
        $links = collect($pagination->getLinks());

        return [
            "label" => "Vị trí khảo sát",
            "total" => $pagination->totalCount,
            "per_page" => $pageSize,
            "current_page" => $pagination->getPage() + 1,
            "last_page" => $pagination->getPageCount(),
            "first_page_url" => $links->get('first'),
            "last_page_url" => $links->get('last'),
            "next_page_url" => $links->get('next'),
            "prev_page_url" => $links->get('prev'),
            "path" => $links->get('self'),
            "from" => $offset+1,
            "to" => $offset+$pageSize,
            "resources" => $items
        ];
//        return $this->renderAjax('index', compact('dataProvider', 'items', 'data'));
    }
}
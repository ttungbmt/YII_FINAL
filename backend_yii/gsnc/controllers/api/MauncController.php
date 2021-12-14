<?php
namespace gsnc\controllers\api;

use common\controllers\ActiveController;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Link;

class MauncController extends ActiveController
{
    public $modelClass = 'gsnc\resources\MauncResource';

    public function actionSearch(){
        /** @var \yii\data\Pagination $pagination */

        $searchModel = new $this->modelClass;
        $dataProvider = $searchModel->search(request()->all());

        $pagination = $dataProvider->getPagination();
        $models = $dataProvider->getModels();
        $items = collect($models)->map(function ($item) {
            return $item->toArray([], ['geometry']);
        });


        $pjax_id = 'maudatnuoc-list';
        $data = [
            'pjax_id' => $pjax_id,
            'items' => $items,
            '_key'  => 'maunc',
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
            "label" => "Mẫu nước",
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
            "resources" => $this->transformData($items)
        ];
//        return $this->renderAjax('index', compact('dataProvider', 'items', 'data'));
    }

    protected function transformData($items){
//        $data = [
//            'component' => 'list',
//            'items' => [
//                ['icon' => '', 'title' => '', 'sub_title' => '', 'caption']
//            ]
//        ];
//        foreach ($items as $k => $i){
//            $data['component'] = 'list';
//            $data['items'] = 'list';
//
//        }
        return $items;
    }




}
<?php

namespace pcd\controllers\api;


use common\controllers\MyApiController;
use pcd\search\PgRaumauSearch;
use yii\db\Query;

class SearchController extends MyApiController
{
    public function actionVungrau()
    {
        $request = request();

        $maquan = $request->post('maquan');
        $maphuong = $request->post('maphuong');
        $loairau = $request->post('loairau');
        $hoten_ngct = $request->post('hoten_ngct');
        $hoten_chudat = $request->post('hoten_chudat');

        $tbRm = 'v_raumau';
        $query = (new Query())->select([
            'geometry' => 'ST_AsGeoJSON(Box2D(ST_Extent(geom))::geometry)'
        ])->from($tbRm);

        $query
            ->andFilterWhere(['maquan' => $maquan])
            ->andFilterWhere(['maphuong' => $maphuong]);


        !$hoten_ngct || $query->andFilterWhere(['ilike', 'hoten_ngct', "{$hoten_ngct}"]);
        !$hoten_chudat || $query->andFilterWhere(['ilike', 'hoten_chudat', "{$hoten_chudat}"]);


        $resp = $query->one();

        $geometry = data_get(json_decode(data_get($resp, 'geometry')), 'coordinates.0');
        $latlng = function ($coords, $num) {
            return array_reverse(array_slice(data_get($coords, $num), 0, 2));
        };
        $searchModel = new PgRaumauSearch();
        $postData = app('request')->post();
        $postData['ma_loairau'] = $loairau;
        $params = [$searchModel->formName() => $postData];


        $dataProvider = $searchModel->search($params);
//        <script src="/themes/admin/main/js/core/libraries/bootstrap.min.js"></script>
        $view = $this->renderAjax('@app/views/admin/pg-raumau/index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'partial' => true
        ]);
//        $view = str_replace('<script src="/themes/admin/main/js/core/libraries/bootstrap.min.js"></script>',"",$view);
//        $view = str_replace('<script src="/themes/admin/main/js/core/libraries/jquery.min.js"></script>',"",$view);
//        $view = str_replace('krajeeYiiConfirm(\'krajeeDialog\');',"",$view);

        return [
            'bounds' => $geometry ? [
                $latlng($geometry, 2),
                $latlng($geometry, 0),
            ] : [],
            'html' => $view
        ];
    }
}
<?php

namespace pcd\modules\sxh\controllers;

use common\models\Query;
use Illuminate\Support\Arr;
use pcd\controllers\AppController;
use pcd\models\CabenhSxh;
use pcd\models\OdichSxh;
use pcd\modules\sxh\forms\SxhForm;
use yii\db\Expression;
use yii\helpers\Url;
use yii\httpclient\Client;


class DefaultController extends AppController
{
    public function actions()
    {
        $actions = parent::actions();

        $actions['export-dieutra'] = [
            'class' => 'common\actions\ExportWordAction',
            'fileName' => 'PhieuDt_SXH',
            'getData' => [$this, 'getDataDieutra'],
        ];

        $actions['export-xuphat'] = [
            'class' => 'common\actions\ExportWordAction',
            'fileName' => 'BienBanXuLyOdich',
            'view' => 'template-word-xuphat',
            'getData' => [$this, 'getDataXuphat'],
        ];

        return $actions;
    }

    public function getDataXuphat()
    {
        $id = request('id');
        $model = new OdichSxh();
        return ['m' => $model];
    }


    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpdate($id = null)
    {
        $model = new SxhForm();
        $model->loadForm($id);
        return $this->render('update', compact('model'));
    }

    public function actionSave($id)
    {
        $model = new SxhForm();
        $data = collect(['errors' => [], 'warnings' => []]);
        $model->validateForm($id, $data);

        $is_chuyenca = request('status.is_chuyenca');
        $is_save = $model->saveForm($id, $data);

        return $this->asJson([
            'is_save' => $is_save,
            'redirect_url' => ((!$id || $is_chuyenca) && $is_save) ? url(['update', 'id' => $model->id]) : null,
            'model' => $model->toArray(),
            'errors' => $data->get('errors'),
            'warnings' => $data->get('warnings'),
            'messages' => $data->get('messages'),
        ]);
    }

    public function getDataDieutra()
    {
        $id = request('id');
        $model = new SxhForm();
        $model->loadForm($id);
        return ['m' => $model];
    }

    public function actionCheckOdich($cabenh_id)
    {
        $odichs = collect((new Query())->select(new Expression('DISTINCT odich_id'))->andWhere(['resource_id' => $cabenh_id])->from('odich_sxh_poly')->all());

        if($odichs->isNotEmpty()){
            return $this->asJson($odichs->map(function ($i){
                $id = $i['odich_id'];
                return ['id' => $id, 'url' => "/sxh/odich/update?id=".$id, 'action' => 'show'];
            }));
        }

        $client = new Client();

        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl(Url::to('/api/odich/tim-cabenh', true))
            ->setData(['cabenhIds' => [$cabenh_id]])
            ->send();

        $content = $response->getContent();
        $ids = collect(data_get(json_decode($response->getContent(), true), 'odichs.0.cabenhs'))->pluck('id');
        $odichs = collect((new Query())->select(new Expression('DISTINCT odich_id'))->andWhere(['resource_id' => $ids])->from('odich_sxh_poly')->all());

        if ($odichs->isNotEmpty()) {
            return $this->asJson($odichs->map(function ($i) {
                $cabenhs = OdichSxh::findOne($i['odich_id']);
                $cb_ids = collect($cabenhs->cabenhs)->pluck('gid');
                $id = $i['odich_id'];
                return ['id' => $id, 'cabenhs' => $cb_ids, 'url' => "/sxh/odich/update?id={$id}&cabenh_ids=".$cb_ids->implode(','), 'action' => 'update'];
            }));
        }

        return $this->asJson([
            [
                'cabenhs' => $ids,
                'url' => "/sxh/odich/create?cabenh_ids=".$ids->implode(','),
                'action' => 'create'
            ]
        ]);

    }

}

<?php

namespace ttungbmt\leaflet\modules\mapbuilder\models\search;

use ttungbmt\leaflet\modules\mapbuilder\models\MapBuilder;
use yeesoft\models\Setting;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

class MapBuilderSearch extends MapBuilder
{
    public function rules()
    {
        return [
            [['key'], 'string']
        ];
    }

    public function search($params)
    {
        $request = \Yii::$app->request;

        $query = MapBuilder::find()->andWhere(['group' => 'mapbuilder']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['key' => $this->id]);
//        $query = Setting::find()->andWhere(['group' => 'mapbuilder']);
//
//        $data = collect([
//            ['id' => 1],
//            ['id' => 2],
//            ['id' => 3],
//        ];
//
//        $this->load($params);
//
//        $query->andFilterWhere(['key' => $this->id]);
//
//        $dataProvider = new ArrayDataProvider([
//            'allModels' => $data,
//        ]);
//
        return $dataProvider;
    }
}
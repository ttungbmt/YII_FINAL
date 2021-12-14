<?php

namespace pcd\modules\dm\models\search;

use pcd\modules\dm\models\DmHoachat;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DmKhuphoSearch represents the model behind the search form about `pcd\modules\dm\models\DmKhupho`.
 */
class DmHoachatSearch extends DmHoachat
{
    public function rules()
    {
        return [
            ['ten_hc', 'safe']
        ];
    }


    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = $this::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ten_hc' => $this->ten_hc,
        ]);


        return $dataProvider;
    }
}

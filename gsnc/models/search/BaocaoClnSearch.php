<?php

namespace gsnc\models\search;

use app\models\BaocaoCln;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PoiBenhvienBenhvienSearch represents the model behind the search form of `gsnc\models\PoiBenhvien`.
 */
class BaocaoClnSearch extends BaocaoCln
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = $this::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        return $dataProvider;
    }

}

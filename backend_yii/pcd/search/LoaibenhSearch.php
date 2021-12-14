<?php

namespace pcd\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use pcd\models\Loaibenh;

/**
 * LoaibenhSearch represents the model behind the search form about `pcd\modules\pcd\models\Loaibenh`.
 */
class LoaibenhSearch extends Loaibenh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['mabenh', 'tenbenh'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Loaibenh::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'mabenh', $this->mabenh])
            ->andFilterWhere(['like', 'tenbenh', $this->tenbenh]);

        return $dataProvider;
    }
}

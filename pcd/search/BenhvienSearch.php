<?php

namespace pcd\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use pcd\models\Benhvien;

/**
 * BenhvienSearch represents the model behind the search form about `app\models\Benhvien`.
 */
class BenhvienSearch extends Benhvien
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mabenhvien'], 'integer'],
            [['tenbenhvien', 'diachi', 'maso', 'tenvt'], 'safe'],
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
        $query = Benhvien::find();

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
            'mabenhvien' => $this->mabenhvien,
        ]);

        $query->andFilterWhere(['ilike', 'tenbenhvien', $this->tenbenhvien])
            ->andFilterWhere(['ilike', 'diachi', $this->diachi])
            ->andFilterWhere(['ilike', 'maso', $this->maso])
            ->andFilterWhere(['ilike', 'tenvt', $this->tenvt]);

        return $dataProvider;
    }
}

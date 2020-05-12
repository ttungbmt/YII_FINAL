<?php

namespace pcd\modules\dm\models\search;

use pcd\supports\RoleHc;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use pcd\modules\dm\models\Ranhto;

/**
 * RanhtoSearch represents the model behind the search form of `pcd\modules\dm\models\Ranhto`.
 */
class RanhtoSearch extends Ranhto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gid'], 'integer'],
            [['objectid', 'shape_leng', 'shape_le_1', 'shape_area'], 'number'],
            [['tenphuong', 'tenquan', 'tento', 'khupho', 'maquan', 'maphuong', 'geom'], 'safe'],
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
        $roles = RoleHc::init();
        $query = Ranhto::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'gid' => $this->gid,
        ]);

        $query->andFilterWhere(['ilike', 'tenphuong', $this->tenphuong])
            ->andFilterWhere(['ilike', 'tenquan', $this->tenquan])
            ->andFilterWhere(['ilike', 'tento', $this->tento])
            ->andFilterWhere(['ilike', 'khupho', $this->khupho])
            ->andFilterWhere(['ilike', 'maquan', $this->maquan])
            ->andFilterWhere(['ilike', 'maphuong', $this->maphuong])
        ;

        $roles->filterHc($query);
        return $dataProvider;
    }
}

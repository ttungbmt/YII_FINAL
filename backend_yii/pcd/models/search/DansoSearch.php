<?php

namespace pcd\models\search;

use pcd\supports\RoleHc;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use pcd\models\Danso;

/**
 * DansoSearch represents the model behind the search form of `pcd\models\Danso`.
 */
class DansoSearch extends Danso
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nam', 'danso', 'uoctinh'], 'integer'],
            [['ma_hc'], 'safe'],
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
        $query = Danso::find();

        $roles = RoleHc::init();

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
            'id' => $this->id,
            'nam' => $this->nam,
            'danso' => $this->danso,
            'uoctinh' => $this->uoctinh,
        ]);

        $query->andFilterWhere(['ilike', 'ma_hc', $this->ma_hc]);

        if(role('phuong')){
            $query->andWhere([
                'type' => 2,
                'ma_hc' => userInfo()->maphuong
            ]);
        }
        else if(role('quan')){
            $query->andWhere([
                'type' => 1,
                'ma_hc' => userInfo()->maquan
            ]);
        }


        return $dataProvider;
    }
}

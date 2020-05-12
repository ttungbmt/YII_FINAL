<?php

namespace pcd\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use pcd\models\XnHuyetthanh;

/**
 * XnHuyetthanhSearch represents the model behind the search form of `pcd\models\XnHuyetthanh`.
 */
class XnHuyetthanhSearch extends XnHuyetthanh
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['maso', 'hoten', 'ngaynhanmau', 'phai', 'namsinh', 'diachi', 'donvi_gui', 'duan', 'yeucau_xn', 'ketqua', 'ketluan', 'loai_xn'], 'safe'],
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
        $query = XnHuyetthanh::find();

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
            'ngaynhanmau' => $this->ngaynhanmau,
        ]);

        $query->andFilterWhere(['ilike', 'maso', $this->maso])
            ->andFilterWhere(['ilike', 'hoten', $this->hoten])
            ->andFilterWhere(['ilike', 'phai', $this->phai])
            ->andFilterWhere(['ilike', 'namsinh', $this->namsinh])
            ->andFilterWhere(['ilike', 'diachi', $this->diachi])
            ->andFilterWhere(['ilike', 'donvi_gui', $this->donvi_gui])
            ->andFilterWhere(['ilike', 'duan', $this->duan])
            ->andFilterWhere(['ilike', 'yeucau_xn', $this->yeucau_xn])
            ->andFilterWhere(['ilike', 'loai_xn', $this->loai_xn])
            ->andFilterWhere(['ilike', 'ketqua', $this->ketqua])
            ->andFilterWhere(['ilike', 'ketluan', $this->ketluan]);



        return $dataProvider;
    }
}

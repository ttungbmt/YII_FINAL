<?php

namespace pcd\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use pcd\models\CabenhSxh;

/**
 * DmDichteSearch represents the model behind the search form about `pcd\models\DmDichte`.
 */
class CabenhSxhNnSearch extends CabenhSxh
{

    public function rules()
    {
        return [
            [['gid', 'tuoi', 'is_nghingo'], 'integer'],
            [['benhvien', 'chuandoan_bd', 'hoten', 'ngaymacbenh_nv', 'geom'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CabenhSxh::find()->where(['is_nghingo' => 1])->with([
            'hcPhuong'
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['ilike', 'benhvien', $this->benhvien])
            ->andFilterWhere(['ilike', 'chuandoan_bd', $this->chuandoan_bd])
            ->andFilterWhere(['ilike', 'hoten', $this->hoten])
            ->andFilterWhere(['ilike', 'tuoi', $this->tuoi])
            ->andFilterWhere(['=', 'ngaymacbenh_nv', $this->ngaymacbenh_nv])
            ;

        return $dataProvider;
    }
}

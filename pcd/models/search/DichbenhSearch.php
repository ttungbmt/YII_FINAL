<?php

namespace pcd\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\pcd\import\models\Dichbenh;

/**
 * DichbenhSearch represents the model behind the search form of `modules\pcd\import\models\Dichbenh`.
 */
class DichbenhSearch extends Dichbenh
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gid', 'tuoi'], 'integer'],
            [['benhvien', 'chuandoan_bd', 'shs', 'hoten', 'phai', 'diachi', 'nghenghiep', 'me', 'dienthoai', 'maquan', 'maphuong', 'ngaynhapvien', 'ngaybaocao', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc', 'hinhthuc_dt'], 'safe'],
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
        $query = Dichbenh::find();

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
            'tuoi' => $this->tuoi,
            'ngaynhapvien' => $this->ngaynhapvien,
            'ngaybaocao' => $this->ngaybaocao,
        ]);

        $query->andFilterWhere(['ilike', 'benhvien', $this->benhvien])
            ->andFilterWhere(['ilike', 'chuandoan_bd', $this->chuandoan_bd])
            ->andFilterWhere(['ilike', 'shs', $this->shs])
            ->andFilterWhere(['ilike', 'hoten', $this->hoten])
            ->andFilterWhere(['ilike', 'phai', $this->phai])
            ->andFilterWhere(['ilike', 'diachi', $this->diachi])
            ->andFilterWhere(['ilike', 'nghenghiep', $this->nghenghiep])
            ->andFilterWhere(['ilike', 'me', $this->me])
            ->andFilterWhere(['ilike', 'dienthoai', $this->dienthoai])
            ->andFilterWhere(['ilike', 'maquan', $this->maquan])
            ->andFilterWhere(['ilike', 'maphuong', $this->maphuong])
            ->andFilterWhere(['ilike', 'nam_nv', $this->nam_nv])
            ->andFilterWhere(['ilike', 'thang_nv', $this->thang_nv])
            ->andFilterWhere(['ilike', 'tuan_nv', $this->tuan_nv])
            ->andFilterWhere(['ilike', 'nam_bc', $this->nam_bc])
            ->andFilterWhere(['ilike', 'thang_bc', $this->thang_bc])
            ->andFilterWhere(['ilike', 'tuan_bc', $this->tuan_bc])
            ->andFilterWhere(['ilike', 'hinhthuc_dt', $this->hinhthuc_dt]);

        return $dataProvider;
    }
}

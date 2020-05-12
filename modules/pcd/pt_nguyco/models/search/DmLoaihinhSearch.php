<?php
namespace modules\pcd\pt_nguyco\models\search;

use modules\pcd\pt_nguyco\models\DmLoaihinh;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DmLoaihinhSearch represents the model behind the search form about `pcd\models\DmLoaihinh`.
 */
class DmLoaihinhSearch extends DmLoaihinh
{

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nhom', 'ten_lh', 'tanxuat', 'thaydoi'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = DmLoaihinh::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['nhom' => $this->nhom]);
        $query->andFilterSearch(['ilike', 'ten_lh', $this->ten_lh]);


        return $dataProvider;
    }
}

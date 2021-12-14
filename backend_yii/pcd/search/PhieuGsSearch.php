<?php

namespace pcd\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use pcd\models\PhieuGs;

/**
 * PhieuGsSearch represents the model behind the search form about `pcd\models\PhieuGs`.
 */
class PhieuGsSearch extends PhieuGs
{

    public function rules()
    {
        return [
            [['id', 'pt_nguyco_id', 'vc_nc', 'vc_lq', 'dexuat_xp', 'xuphat'], 'integer'],
            [['ngay_gs', 'nguoi_gs', 'mucdich_gs', 'ngayxuphat'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
                $query = PhieuGs::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        
        
        return $dataProvider;
    }
}

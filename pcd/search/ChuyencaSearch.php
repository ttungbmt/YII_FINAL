<?php

namespace pcd\search;

use pcd\models\Chuyenca;
use pcd\supports\RoleHc;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ChuyencaSearch represents the model behind the search form about `pcd\models\Chuyenca`.
 */
class ChuyencaSearch extends Chuyenca
{

    public $hoten;
    public $tenphuong;
    public $tenquan;
    public $loaica;
    public function rules()
    {
        return [
            [['loaica'], 'integer'],
            [['id', 'cabenh_id', 'type', 'created_by', 'updated_by', 'is_locked', 'is_chuyentiep'], 'integer'],
            [['hoten', 'nguoichuyen', 'qh_chuyen', 'px_chuyen', 'nguoinhan', 'qh_nhan', 'px_nhan', 'created_at', 'updated_at', 'ten_qh_nhan', 'ten_px_nhan', 'ten_qh_chuyen', 'ten_px_chuyen', 'readed_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $maphuong = userInfo()->ma_phuong;
        $query = $this->find()
            ->with(['cabenhSxh', 'nhan', 'chuyen'])
        ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'       => ['defaultOrder' => ['cabenh_id' => SORT_DESC, 'id' => SORT_ASC]],
        ]);

        $this->load($params);


        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $roles = RoleHc::init();

        $ca = Chuyenca::find();
        if ($this->loaica == 3) {
            // Ca nhận
            $ca = $ca->where(['type' => 1, 'px_nhan' => $maphuong])->pluck('cabenh_id')->unique()->all();
            $query->andFilterWhere(['cabenh_id' => $ca]);
        } elseif ($this->loaica == 4) {
            // Ca trả về
            $ca = $ca->where(['type' => 2, 'px_nhan' => $maphuong])->pluck('cabenh_id')->unique()->all();
            $query->andFilterWhere(['cabenh_id' => $ca]);
        } elseif ($this->loaica == 1) {
            // Ca trả về
            $ca = $ca->where(['type' => 2, 'px_nhan' => $maphuong])->pluck('cabenh_id')->unique()->all();
            $roles->filterCabenhSxh($query);
            $query->andFilterWhere(['NOT IN', 'cabenh_id', $ca]);
        } else {
            // Ca chuyển
            $ca = $ca->where(['type' => 1, 'px_chuyen' => $maphuong])->pluck('cabenh_id')->unique()->all();
            $query->andFilterWhere(['cabenh_id' => $ca]);
        }



        return $dataProvider;
    }
}

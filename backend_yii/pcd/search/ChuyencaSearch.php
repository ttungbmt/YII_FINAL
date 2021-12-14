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

    public function init()
    {
        parent::init();
        $this->loaica = $this->loaica ? $this->loaica : 2;
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $roles = RoleHc::init();
        $query = $this->find()->with(['cabenhSxh', 'nhan', 'chuyen']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'       => ['defaultOrder' => ['cabenh_id' => SORT_DESC, 'id' => SORT_ASC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $ca = Chuyenca::find()->select(['gid' => 'cabenh_id']);
        if(role('phuong')){
            $field = ['prefix' => 'px', 'value' => userInfo()->maphuong];
        } else {
            $field = ['prefix' => 'qh', 'value' => userInfo()->maquan];
        }

        if ($this->loaica == 2) {
            // Ca chuyển
            $ca = $ca->where(['is_chuyentiep' => 1, $field['prefix'].'_chuyen' => $field['value']]);
            $query->andFilterWhere(['cabenh_id' => $ca]);
        } elseif ($this->loaica == 3) {
            // Ca nhận
            $ca = $ca->where(['is_chuyentiep' => 1, $field['prefix'].'_nhan' => $field['value']]);
            $query->andFilterWhere(['cabenh_id' => $ca]);
        } elseif ($this->loaica == 4) {
            // Ca trả về
            $ca = $ca->where(['is_chuyentiep' => 0, $field['prefix'].'_nhan' => $field['value']]);
            $query->andFilterWhere(['cabenh_id' => $ca]);
        } elseif ($this->loaica == 1) {
            // Ca TP
            $ca = $ca->where([$field['prefix'].'_nhan' => $field['value']]);
            $query->andFilterWhere(['NOT IN', 'cabenh_id', $ca]);
        }

        return $dataProvider;
    }
}

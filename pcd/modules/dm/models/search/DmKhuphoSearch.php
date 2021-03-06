<?php

namespace pcd\modules\dm\models\search;

use pcd\supports\RoleHc;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use pcd\modules\dm\models\DmKhupho;

/**
 * DmKhuphoSearch represents the model behind the search form about `pcd\modules\dm\models\DmKhupho`.
 */
class DmKhuphoSearch extends DmKhupho
{

    public function rules()
    {
        return [
            [['gid'], 'integer'],
            [['maquan', 'maphuong', 'khupho'], 'safe'],
        ];
    }

    public function init()
    {
        parent::init();

        if ($maquan = (string)userInfo()->maquan) {
            $this->maquan = $maquan;
        }
        if($maphuong = (string)userInfo()->maphuong){
            $this->maquan = $maquan;
            $this->maphuong = $maphuong;
        }
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $role = RoleHc::init();
        $query = $this::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $role->filterMahc($query);

        $query->andFilterWhere([
            'maquan' => $this->maquan,
            'maphuong' => $this->maphuong,
            'khupho' => $this->khupho,
        ]);

        return $dataProvider;
    }
}

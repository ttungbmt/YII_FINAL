<?php

namespace pcd\modules\dm\models\search;

use pcd\supports\RoleHc;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use pcd\modules\dm\models\DmToDp;
use yii\db\Expression;

/**
 * DmToDp represents the model behind the search form about `pcd\modules\dm\models\DmToDp`.
 */
class DmToDpSearch extends DmToDp
{
    public $order;

    public function rules()
    {
        return [
            [['gid'], 'integer'],
            [['order', 'maquan', 'maphuong', 'khupho', 'to_dp'], 'safe'],
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

    public function formName()
    {
        return '';
    }


    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $role = RoleHc::init();
        $query = $this::find()->with(['quan', 'phuong']);
        $this->load($params);

        ($this->order === 'natural' && !request()->has('sort')) && $query->orderBy(new Expression('LENGTH(khupho), khupho, LENGTH(to_dp), to_dp'));

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => [
                'gid' => SORT_DESC,
            ]],
        ]);

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

        $query->andFilterSearch(['ilike', 'to_dp', $this->to_dp,]);

        return $dataProvider;
    }
}

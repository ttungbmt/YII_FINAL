<?php

namespace pcd\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use pcd\models\Bookmark;

/**
 * BookmarkSearch represents the model behind the search form about `pcd\models\Bookmark`.
 */
class BookmarkSearch extends Bookmark
{

    public function rules()
    {
        return [
            [['name', 'description', 'geom', 'ip'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Bookmark::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query
            ->andFilterDate(['ilike', 'name', $this->name])
            ->andFilterDate(['ilike', 'description', $this->description])
            ->andFilterDate(['ilike', 'ip', $this->ip]);


        return $dataProvider;
    }
}

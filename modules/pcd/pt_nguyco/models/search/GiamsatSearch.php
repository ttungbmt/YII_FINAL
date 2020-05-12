<?php
namespace modules\pcd\pt_nguyco\models\search;

use modules\pcd\pt_nguyco\models\PtNguyco;
use pcd\supports\RoleHc;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PtNguycoSearch represents the model behind the search form about `pcd\models\PtNguyco`.
 */
class GiamsatSearch extends PtNguyco
{
    public $date_from;
    public $date_to;
    public $year;

    public function rules()
    {
        return [
            [['gid'], 'integer'],
            [['maso', 'ten_cs', 'sonha', 'tenduong', 'khupho', 'to_dp', 'maphuong', 'maquan', 'nhom', 'loaihinh', 'tochuc_gs', 'ngaycapnhat', 'ngayxoa', 'ghichu', 'phancap_ql', 'thuchien', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:d/m/Y'],
            [['year'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $roles = RoleHc::init();
        $query = PtNguyco::find()->with(['quan', 'phuong']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'       => ['defaultOrder' => ['gid' => SORT_DESC]],
        ]);

        $this->load($params);
        if(request('year')){
            $this->year = request('year');
        }


        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'maquan' => $this->maquan,
            'maphuong' => $this->maphuong,
        ]);
        $query->andFilterWhere(['EXTRACT(YEAR FROM ngaycapnhat)' => $this->year]);
        $query->andFilterDate(['ngaycapnhat' => [$this->date_from, $this->date_to]]);

        $roles->filterHc($query);
        return $dataProvider;
    }
}

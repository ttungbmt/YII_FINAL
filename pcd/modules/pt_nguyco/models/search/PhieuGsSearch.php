<?php

namespace pcd\modules\pt_nguyco\models\search;

use pcd\modules\pt_nguyco\models\PhieuGs;
use pcd\supports\RoleHc;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PhieuGsSearch represents the model behind the search form about `pcd\models\PhieuGs`.
 */
class PhieuGsSearch extends PhieuGs
{
    public $date_from;
    public $date_to;
    public $maquan;
    public $maphuong;

    public function rules()
    {
        return [
            [['id', 'pt_nguyco_id', 'vc_nc', 'vc_lq', 'dexuat_xp', 'xuphat'], 'integer'],
            [['maphuong', 'maquan', 'ngay_gs', 'nguoi_gs', 'mucdich_gs', 'ngayxuphat'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:d/m/Y'],
        ];
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'nhom' => 'Nhóm',
            'loaihinh' => 'Loại hình',
        ]);
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $roles = RoleHc::init();
        $query = $this->find()
            ->with(['dnc', 'dnc.quan', 'dnc.phuong', 'dnc.dm_loaihinh'])
            ->select('ph.*')
            ->alias('ph')
            ->leftJoin(['pt' => 'pt_nguyco'], 'pt.gid = ph.pt_nguyco_id')
        ;
//        $query = PhieuGs::find()->with([
//            'dnc',
//            'dnc.quan' => function ($query) use($roles){
//
//            },
//            'dnc.phuong' => function ($query) use($roles){
//
//            }]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'maphuong' => $this->maphuong
        ]);

        $query->andFilterDate(['ngay_gs' => [$this->date_from, $this->date_to]]);
        $roles->filterHc($query);
        return $dataProvider;
    }
}

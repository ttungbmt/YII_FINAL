<?php
namespace pcd\modules\pt_nguyco\models\search;
use Carbon\Carbon;
use pcd\modules\pt_nguyco\models\PhieuGs;
use pcd\modules\pt_nguyco\models\PtNguyco;
use pcd\supports\RoleHc;
use ttungbmt\db\Query;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * PtNguycoSearch represents the model behind the search form about `pcd\models\PtNguyco`.
 */
class PtNguycoSearch extends PtNguyco
{
    public $date_from;
    public $date_to;
    public $year;
    public $month;
    public $col_tk;
    public $loai_tk;


    public function rules()
    {
        return [
            [['gid', 'loaihinh_id'], 'integer'],
            [['loai_tk', 'col_tk', 'year', 'month', 'dienthoai', 'maso', 'ten_cs', 'sonha', 'tenduong', 'khupho', 'to_dp', 'maphuong', 'maquan', 'nhom', 'loaihinh', 'tochuc_gs', 'ngaycapnhat', 'ngayxoa', 'ghichu', 'phancap_ql', 'thuchien', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:d/m/Y'],

        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function formName()
    {
        return '';
    }

    public function init()
    {
        parent::init();

        $role = RoleHc::init();
        $role->initFormHc($this);
    }


    public function search($params)
    {
        $roles = RoleHc::init();
        $query = PtNguyco::find()
            ->with(['quan', 'phuong', 'loaihinh'])
        ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['gid' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $filter = request()->get('filter_dnc');
        if($filter === '0'){
            $query->andWhere('loaihinh_id IS NULL');
        } elseif ($filter === '1'){
            $query->andWhere('created_by = 1');
        } elseif ($filter === '2'){
            $query->andWhere(new Expression("ST_Intersects(geom , (SELECT ST_Union(geom) geom FROM hc_quan)) = false"));
        } elseif ($filter === '3'){
            $query->andWhere(new Expression("geom IS NULL"));
        }

        $query->andFilterWhere([
            'maquan' => $this->maquan,
            'maphuong' => $this->maphuong,
            'loaihinh_id' => $this->loaihinh_id,
        ]);

        $query->andFilterSearch(['ilike', 'dienthoai', $this->dienthoai]);
        $query->andFilterSearch(['ilike', 'khupho', $this->khupho]);
        $query->andFilterSearch(['ilike', 'to_dp', $this->to_dp]);
        $query->andFilterSearch(['ilike', 'ten_cs', $this->ten_cs]);
        $query->andFilterSearch(['ilike', 'sonha', $this->sonha]);
        $query->andFilterSearch(['ilike', 'tenduong', $this->tenduong]);


        $q2 = (new Query())->select('pt_nguyco_id gid')
            ->from(['pgs' => PhieuGs::tableName()])
            ->leftJoin(['dnc' => PtNguyco::tableName()], 'dnc.gid = pgs.pt_nguyco_id')
            ->groupBy('pgs.pt_nguyco_id')
            ->andFilterWhere([
                'dnc.loaihinh_id' => $this->loaihinh_id,
                'dnc.maquan' => $this->maquan,
                'dnc.maphuong' => $this->maphuong,
            ])
        ;

        if($this->col_tk){
            switch ($this->col_tk){
                case 'dauthang':
                    $dateMonth = $this->getDateMonth();
                    $query->andWhere("(ngayxoa > '{$dateMonth}' OR ngayxoa IS NULL) AND ngaycapnhat < '{$dateMonth}'");
                    break;
                case 'daxoa':
                    $query->andWhere("TO_CHAR( ngayxoa, 'MM/YYYY' ) = '{$this->month}'");
                    break;
                case 'moi':
                    $query->andWhere("TO_CHAR( ngaycapnhat, 'MM/YYYY' ) = '{$this->month}'");
                    break;
                case 'cuoithang':
                    $dateMonth = Carbon::createFromFormat('m/Y', $this->month)->endOfMonth()->format('Y-m-d');
                    $query->andWhere("ngaycapnhat <= '{$dateMonth}' AND (ngayxoa >= '{$dateMonth}' OR ngayxoa IS NULL)");
                    break;
                case 'gs':
                case 'luot_gs':
                    $q2->having(new Expression("MAX ( CASE WHEN TO_CHAR( ngay_gs, 'MM/YYYY' ) = '{$this->month}' THEN 1 END ) = 1"));
                    $query->andWhere(['gid' => $q2]);
                    break;
                case 'lq':
                    $q2->having(new Expression("MAX ( CASE WHEN ( TO_CHAR( ngay_gs, 'MM/YYYY' ) = '{$this->month}' AND vc_lq > 0 ) THEN 1 END ) = 1"));
                    $query->andWhere(['gid' => $q2]);
                    break;
                case 'dx_xp':
                    $q2->having(new Expression("MAX ( CASE WHEN ( TO_CHAR( ngay_gs, 'MM/YYYY' ) = '{$this->month}' AND dexuat_xp = 1 ) THEN 1 END ) = 1"));
                    $query->andWhere(['gid' => $q2]);
                    break;
                case 'xp':
                    $q2->having(new Expression("MAX ( CASE WHEN ( TO_CHAR( ngay_gs, 'MM/YYYY' ) = '{$this->month}' AND xuphat = 1 ) THEN 1 END ) = 1"));
                    $query->andWhere(['gid' => $q2]);
                    break;
            }
        }

        if($this->loai_tk == 'xuphat'){
            if($this->month){
                $q2->having(new Expression("MAX ( CASE WHEN ( TO_CHAR( ngay_gs, 'MM/YYYY' ) = '{$this->month}' AND ngayxuphat IS NOT NULL ) THEN 1 END ) = 1"));
            } else {
                $q2->having(new Expression("MAX ( CASE WHEN ( TO_CHAR( ngay_gs, 'YYYY' ) = '{$this->year}' AND ngayxuphat IS NOT NULL ) THEN 1 END ) = 1"));
            }
            $query->andWhere(['gid' => $q2]);
        }

        $query->andFilterDate(['ngaycapnhat' => [$this->date_from, $this->date_to]]);

        $roles->filterHc($query);

        return $dataProvider;
    }

    public function getDateMonth(){
        return Carbon::createFromFormat('m/Y', $this->month)->setDay(1)->format('Y-m-d');
    }
}

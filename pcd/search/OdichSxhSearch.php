<?php
namespace pcd\search;

use Carbon\Carbon;
use pcd\models\CabenhSxh;
use pcd\models\OdichSxh;
use pcd\models\OdichSxhPoly;
//use pcd\supports\RoleHc;
use pcd\supports\RoleHc;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * OdichSxhSearch represents the model behind the search form about `app\models\OdichSxh`.
 *
 * @property mixed ngayxacdinh
 */
class OdichSxhSearch extends OdichSxh
{
    public $date_from;
    public $date_to;
    public $field_date;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maquan', 'maphuong', 'field_date'], 'string'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:d/m/Y'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = $this->find()
            ->with(['cabenhs', 'xulyOdsxhs'])
        ;

        $this->load($params);
        $this->load($params, '');


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'       => ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => [
                'defaultPageSize' => 10,
            ],
        ]);


        if (!$this->validate()) {
             $query->where('0=1');
            return $dataProvider;
        }

        RoleHc::init()->filterMahc($query);

        $query->andFilterWhere([
            'maquan' => $this->maquan,
            'maphuong' => $this->maphuong,
        ]);

        $query->andFilterDate([$this->field_date => [$this->date_from, $this->date_to]]);

        return $dataProvider;
    }

    public function fields()
    {
        return [
            'id',
            'cabenhs' => function($model){
                return $model->cabenhs;
            }
        ];
    }

    public function getConfigs($dataProvider) {
        $columns = $this->getColumns();

        return [
            'columns' => $columns,
            'form'    => Yii::$app->controller->renderAjax('_search_odich'),
        ];
    }

    public function getColumns() {
        $columns = [
            [
                'label'     => 'Ngày mắc bệnh ca đầu tiên',
                'width' => '130px',
                'attribute' => 'ngaymacbenh_1',
                'value' => function($model){
                    return data_get($model->cabenhs, '0.ngaymacbenh');
                }
            ],
            [
                'label'     => 'Ngày xác định',
                'attribute' => 'ngayxacdinh',
                'width' => '130px',
            ],
            [
                'label'     => 'KP',
                'attribute' => 'khupho',
                'value' => function($model){
                    return collect($model->cabenhs)->pluck('khupho')->unique()->filter()->implode(', ');
                }
            ],
            [
                'label'     => 'PX',
                'attribute' => 'px',
                'value' => function($model){
                    $cbs = collect($model->cabenhs);
                    $qhs = $cbs->pluck('px')->unique()->filter()->map(function ($v) use($cbs){
                        return data_get($cbs->firstWhere('px', $v), 'hcPhuong.tenphuong', '');
                    });
                    return $qhs->unique()->implode(', ');
                }
            ],
            [
                'label'     => 'QH',
                'attribute' => 'qh',
                'value' => function($model){
                    $cbs = collect($model->cabenhs);
                    $qhs = $cbs->pluck('qh')->unique()->filter()->map(function ($v) use($cbs){
                        return data_get($cbs->firstWhere('qh', $v), 'hcQuan.tenquan', '');
                    });
                    return $qhs->implode(', ');
                }
            ],
            [
                'label'     => 'Số ca',
                'attribute' => 'soca',
                'value' => function($model){
                    return collect($model->cabenhs)->count();
                }
            ],
            [
                'label'     => 'Ngày ca gần nhất',
                'attribute' => 'ngaymacbenh_last',
                'value' => function($model){
                    return data_get(collect($model->cabenhs)->last(), 'ngaymacbenh');
                }
            ],
            [
                'label'     => 'Số lần xử lý',
                'attribute' => 'solan_xl',
                'value' => function($model){
                    return collect($model->phunHcs)->count();
                }
            ],
            [
                'label'     => 'Tình trạng',
                'attribute' => 'tinhtrang',
                'value' => function($model){
                    if($model->ngayketthuc_td){
//                        $date = Carbon::createFromFormat('d/m/Y', $model->ngayketthuc_td);
//                        if($date > Carbon::now()) {
//                            return 'Kết thúc';
//                        } else {
//                            return 'Hoạt động';
//                        }
                        return 'Kết thúc';
                    }
                    return 'Hoạt động';
                }
            ],
        ];

        return $columns;
    }

    public function extraAttrs() {
        $dm_chuandoan = api('dm_chuandoan');

        return [
            'gid' => 'id',
            'cabenhs' => function($model) use($dm_chuandoan) {
                return ArrayHelper::toArray($model->cabenhs, [
                    CabenhSxh::className() => [
                        'gid',
                        'hoten',
                        'ngaymacbenh',
                        'ngaynhapvien',
                        'ngaymacbenh_nv' => function($m){
                            return $m->ngaymacbenh ? $m->ngaymacbenh : $m->ngaynhapvien;
                        },
                        'ngaybaocao',
                        'chuandoan' => function ($m) use ($dm_chuandoan) {
                            if ($m->chuandoan == 3) {
                                return data_get($m, 'chuandoan_khac');
                            }
                            return data_get($dm_chuandoan, is_null($m->chuandoan) ? '' : $m->chuandoan);
                        },
                        'geometry' => function($m){
                            return $m->toGeometry();
                        }
                    ]
                ]);
            }
        ];
    }



}

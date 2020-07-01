<?php
namespace pcd\search;

use pcd\supports\RoleHc;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use pcd\modules\pt_nguyco\models\PtNguyco;
use yii\helpers\Html;

/**
 * PtNguycoSearch represents the model behind the search form about `pcd\models\PtNguyco`.
 */
class PtNguycoSearch extends PtNguyco
{
    public $date_from;
    public $date_to;
    public $year;

    public function rules()
    {
        return [
            [['gid'], 'integer'],
            [['dienthoai', 'maso', 'ten_cs', 'sonha', 'tenduong', 'khupho', 'to_dp', 'maphuong', 'maquan', 'nhom', 'loaihinh_id', 'tochuc_gs', 'ngaycapnhat', 'ngayxoa', 'ghichu', 'phancap_ql', 'thuchien', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:d/m/Y'],
        ];
    }

    public function formName() {
        return '';
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $roles = RoleHc::init();
        $query = $this->find()->with(['quan', 'phuong']);

        $this->load($params, '');

        $pageSize = request('length', 10);
        $value = request('search.value');

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => ['defaultOrder' => ['gid' => SORT_DESC]],
            'pagination' => (($pageSize == -1) ? false : [
                'defaultPageSize' => 10,
                'pageSize'        => $pageSize,
            ]),
        ]);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query
            ->andFilterSearch([
                'maquan' => $this->maquan,
                'maphuong' => $this->maphuong,
                'nhom' => $this->nhom,
                'loaihinh_id' => $this->loaihinh_id,
            ]);


        $query->andFilterSearch(['ilike', 'dienthoai', $this->dienthoai]);
        $query->andFilterSearch(['ilike', 'khupho', $this->khupho]);
        $query->andFilterSearch(['ilike', 'to_dp', $this->to_dp]);
        $query->andFilterSearch(['ilike', 'ten_cs', $this->ten_cs]);
        $query->andFilterSearch(['ilike', 'sonha', $this->sonha]);
        $query->andFilterSearch(['ilike', 'tenduong', $this->tenduong]);

        $query->andFilterDate(['ngaycapnhat' => [$this->date_from, $this->date_to]]);

        $roles->filterHc($query);


        return $dataProvider;
    }

    public function getConfigs($dataProvider) {
        $columns = $this->getColumns();

        return [
            'columns' => $columns,
            'form'    => Yii::$app->controller->renderAjax('_search_dnc'),
        ];
    }

    public function getColumns() {
        $columns = [
            [
                'label'     => 'Tên chủ đơn vị/ Người chịu trách nhiệm',
                'attribute' => 'ten_cs',
                'width'     => '180px'
            ],
            ['label' => 'Địa chỉ', 'width'     => '200px', 'attribute' => 'diachi', 'value' => function ($model) {
                if($model->sonha || $model->tenduong) return collect([$model->sonha, $model->tenduong])->filter()->implode(' ');
                return Html::tag('span', $model->diachi, ['class' => 'text-danger']);
            }],
            [
                'label'     => 'Quận',
                'attribute' => 'tenquan',
                'width' => '82px',
                'value'     => function ($model) {
                    return data_get($model->quan, 'tenquan');
                }
            ],
            [
                'label'     => 'Phường',
                'attribute' => 'tenphuong',
                'width' => '110px',
                'value'     => function ($model) {
                    return data_get($model->phuong, 'tenphuong');
                }
            ],
            [
                'label'     => 'Khu phố - tổ dân phố',
                'attribute' => 'khupho_to',
                'value'     => function ($model) {
                    return collect([$model->khupho, $model->to_dp])->filter()->implode(' - ');
                }
            ],
            [
                'label'     => 'Nhóm',
                'attribute' => 'nhom',
                'width' => '77px',
            ],
            [
                'label'     => 'Loại hình',
                'attribute' => 'loaihinh',
                'width' => '130px',
                'value'     => function ($model) {
                    if($model->loaihinh_id && $lh = $model->dm_loaihinh)  {
                        $str = $lh->ten_lh;
                        if(in_array($lh->id, [20,21,22]) && $model->loaihinh){
                            $str = $str." ({$model->loaihinh})";
                        }
                        return $str;
                    };
                    return '';
                }
            ],
            ['label' => 'Điện thoại', 'attribute' => 'dienthoai'],
            ['label' => 'Ngày cập nhật', 'attribute' => 'ngaycapnhat'],

        ];

        return $columns;
    }

    public function extraAttrs() {
        return [
            'gid',
            'geometry'    => function ($model) {
                return $model->toGeometry();
            },
        ];
    }

}

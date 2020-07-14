<?php

namespace pcd\modules\sxh\models\search;
use pcd\models\Loaibenh;
use pcd\supports\RoleHc;
use Yii;
use yii\data\ActiveDataProvider;

class SxhSearch extends \pcd\models\CabenhSxh {
    public $date_type;
    public $date_from;
    public $date_to;

    public function init() {
        parent::init();
        $this->date_type = 'ngaybaocao';
    }

    public function rules() {
        return array_merge(parent::rules(), [
            ['date_type', 'string'],
            [['date_from', 'date_to'], 'date', 'format' => 'DD/MM/YYYY'],
        ]);
    }

    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'date_type' => 'Loại ngày',
            'date_from' => 'Từ ngày',
            'date_to' => 'Đến ngày',
        ]);
    }

    public function formName() {
        return '';
    }

    public function search($params) {
        $roles = RoleHc::init();

        $query = $this->find()
            ->with(['hcPhuong', 'hcQuan', 'xacminhCbs']);

        $this->load($params, 'form');
        $this->setAttributes($params);

//        $page = request('page', 1);
        $pageSize = request('length', 10);
        $value = request('search.value');

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => ['defaultOrder' => ['gid' => SORT_DESC]],
            'pagination' => (($pageSize == -1) ? false : [
                'defaultPageSize' => 10,
                'pageSize'        => $pageSize,
//                'page' => $page,
            ]),
        ]);

        if (role('phuong')) {
            $roles->filterMahc($query, 'px');
        } elseif (role('quan')) {
            $roles->filterMahc($query, 'qh');
        }

        $query
            ->andFilterWhere([
                'loaidieutra' => $this->loaidieutra,
                'px'          => $this->px,
                'qh'          => $this->qh,
                'ht_dieutri'  => $this->ht_dieutri,
                'chuandoan'   => $this->chuandoan,
                'maquan'   => $this->maquan,
                'maphuong'   => $this->maphuong,
            ]);

        $query
            ->andFilterWhere(['ilike', 'hoten', $this->hoten ? $this->hoten : $value])
            ->andFilterWhere(['ilike', 'sonha', $this->sonha])
            ->andFilterWhere(['ilike', 'duong', $this->duong])
            ->andFilterWhere(['ilike', 'to_dp', $this->to_dp])
            ->andFilterWhere(['ilike', 'khupho', $this->khupho])
            ->andFilterWhere(['=', 'ngaymacbenh', $this->ngaymacbenh])
            ->andFilterDate(['=', 'ngaynhapvien', $this->ngaynhapvien]
        );

        if($this->date_type && ($this->date_from || $this->date_to)){
            $query->andFilterDate([
                $this->date_type => [$this->date_from, $this->date_to]
            ]);
        }


        return $dataProvider;
    }

    public function getConfigs($dataProvider) {
        $columns = $this->getColumns();

        return [
            'columns' => $columns,
            'form'    => Yii::$app->controller->renderAjax('_search_sxh'),
        ];
    }

    public function getColumns() {
        $dm_loaidieutra = api('dm_loaidieutra');
        $dm_ht_dieutri = api('dm_ht_dieutri');
        $dm_chuandoan = api('dm_chuandoan');
        $dm_loaicabenh = api('dm_loaicabenh');
        $dm_benh = Loaibenh::pluck('tenbenh', 'mabenh')->all();

        $columns = [
            [
                'label'     => 'Họ tên',
                'attribute' => 'hoten',
                'width'     => '175px'
            ],
//            ['label' => 'Hành động', 'attribute' => 'actions'],
            ['label' => 'Điều tra',  'width'     => '128px', 'attribute' => 'loaidieutra', 'value' => function ($model) use ($dm_loaidieutra) {
                return is_null($model->loaidieutra) ? '' : data_get($dm_loaidieutra, $model->loaidieutra);
            }],
            ['label' => 'Ca bệnh',  'width'     => '80px', 'attribute' => 'loaicabenh', 'value' => function ($model) use ($dm_loaicabenh) {
                return data_get($dm_loaicabenh, is_null($model->loaicabenh) ? '' : $model->loaicabenh);
            }],
            ['label' => 'Bệnh', 'width'     => '72px', 'attribute' => 'chuandoan_bd'],
            ['label' => 'Ngày báo cáo', 'attribute' => 'ngaybaocao'],
            ['label' => 'Địa chỉ', 'width'     => '200px', 'attribute' => 'diachi', 'value' => function ($model) {
                $lastXm = array_last($model->xacminhCbs);
                if (!$lastXm) return '';
                return collect([$lastXm->sonha, $lastXm->duong])->filter()->implode(' ');
            }],
            ['label' => 'Tổ', 'attribute' => 'to_dp'],
            ['label' => 'Khu phố', 'attribute' => 'khupho', 'value' => 'khupho'],
            [
                'label'     => 'Quận',
                'attribute' => 'tenquan',
                'width' => '82px',
                'value'     => function ($model) {
                    return data_get($model->hcQuan, 'tenquan');
                }
            ],
            [
                'label'     => 'Phường',
                'attribute' => 'tenphuong',
                'width' => '100px',
                'value'     => function ($model) {
                    return data_get($model->hcPhuong, 'tenphuong');
                }
            ],
            ['label' => 'Phái', 'attribute' => 'phai'],
            ['label' => 'Tuổi', 'attribute' => 'tuoi'],
            ['label' => 'Ngày nhập viện', 'attribute' => 'ngaynhapvien'],
            ['label' => 'Ngày xuất viện', 'attribute' => 'ngayxuatvien'],
            ['label' => 'Chuẩn đoán', 'width' => '160px', 'attribute' => 'chuandoan', 'value' => function ($model) use ($dm_chuandoan) {
                if ($model->chuandoan == 3) return $model->chuandoan_khac;
                return opt($dm_chuandoan)->{$model->chuandoan};
            }],
            ['label' => 'Hình thức điều trị', 'width' => '100px', 'attribute' => 'ht_dieutri', 'value' => function ($model) use ($dm_ht_dieutri) {
                return opt($dm_ht_dieutri)->{$model->ht_dieutri};
            }],
        ];

        return $columns;
    }

    public function extraAttrs() {
        return [
            'gid',
            'maquan',
            'maphuong',
            'khupho_to' => function ($model) {
                return collect([$model->khupho, $model->to_dp])->filter()->implode(' - ');
            },
            'DT_RowId'    => function ($model) {
                return "row_{$model->gid}";
            },
            'DT_RowClass' => function ($model) {
                $class = '';
                if ($model->geom) {
                    $class = 'table-info';
                } elseif ($model->loaidieutra == 0) {
                    $class = 'table-danger';
                }

                return $class;
            },
            'diachi_full' => function ($model) {
                $sonha = trim($model->sonha);
                $duong = trim($model->duong);
                $khupho = trim($model->khupho);
                $to_dp = trim($model->to_dp);
                $quan = data_get($model->hcQuan, 'tenquan');
                $phuong = data_get($model->hcPhuong, 'tenphuong');
                $str = $sonha;
                if ($duong) $str .= " {$duong}";
                if ($khupho) $str .= ", Khu phố {$khupho}";
                if ($to_dp) $str .= ", Tổ {$to_dp}";
                if ($phuong) $str .= ", {$phuong}";
                if ($quan) $str .= ", {$quan}";

                return $str;
            },
            'geometry'    => function ($model) {
                return $model->toGeometry();
            },
            'ngaybaocao',
            'ngaymacbenh',
            'ngaymacbenh_nv' => function ($model) {
                return $model->ngaymacbenh ? $model->ngaymacbenh : $model->ngaynhapvien;
            },
        ];
    }


}
<?php
namespace pcd\modules\sxh\controllers;

use Illuminate\Support\Str;
use pcd\controllers\AppController;
use pcd\models\CabenhSxh;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use pcd\modules\pt_nguyco\models\PtNguyco;
use pcd\modules\sxh\models\Odich;
use pcd\modules\sxh\models\OdichSxhXuly;
use pcd\modules\sxh\models\search\OdichSearch;
use ttungbmt\actions\CreateAction;
use ttungbmt\actions\DeleteAction;
use ttungbmt\actions\ExportWordAction;
use ttungbmt\actions\IndexAction;
use ttungbmt\actions\UpdateAction;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class OdichController extends AppController
{
    public $enableCsrfValidation = false;
    public $modelClass = Odich::class;

    public function actions()
    {
        return array_merge(parent::actions(), [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => OdichSearch::class
            ],
            'create' => [
                'class' => CreateAction::class,
                'modelClass' => $this->modelClass,
                'viewParams' => [$this, 'getPageData'],
                'handler' => 'saveModel'
            ],
            'update' => [
                'class' => UpdateAction::class,
                'modelClass' => $this->modelClass,
                'viewParams' => [$this, 'getPageData'],
                'handler' => 'saveModel'
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'modelClass' => $this->modelClass,
                'handler' => 'saveModel'
            ],
            'export-word' => [
                'class'    => ExportWordAction::class,
                'fileName' => 'BienbanXL_OD',
                'getData'  => [$this, 'getDataWord'],
            ]
        ]);
    }

    public function getDataWord(){
        $id = request()->get('id');
        $model = Odich::findOne($id);

        $data_map = collect($model->attributes());

        $dm_loai_od = api('dm_loaiodich');
        $dm_loai_ks = api('dm_loai_ks');

        $arr = [
            'tenquan' => ['value' => 'quan.tenquan'],
            'tenphuong' => ['value' => 'phuong.tenquan'],
        ];
        $toFilterValue = function ($options){
            return function ($model) use($options){
                $filter = collect($options['filter']);
                $value = $options['value'];
                return $filter->get($model->{$value}, '');
            };
        };


        $m1 = ArrayHelper::toArray($model, [
            Odich::class => $data_map->merge([
                'tenquan' => 'quan.tenquan',
                'tenphuong' => 'phuong.tenphuong',
                'cabenhs' => function($model){
                    return ArrayHelper::toArray($model->cabenhs, [CabenhSxh::class => [
                        'gid',
                        'hoten',
                        'tuoi',
                        'khupho',
                        'to_dp',
                        'tenquan' => 'hcQuan.tenquan',
                        'tenphuong' => 'hcPhuong.tenphuong',
                        'ngaymacbenh',
                        'ngaybaocao',
                    ]]);
                },
                'loai_od' => $toFilterValue(['filter' => $dm_loai_od, 'value' => 'loai_od']),
            ])->all()
        ]);

        $m2 = [
//            'tong_ho_gd_ccn' => function() use($m1){
//                return collect($m1['donvi_cns'])->sum('soho');
//            },
        ];


        $data_func = [
            'checkbox' => function($value){
                $content = $value ? '' : '';
                return Html::tag('span', $content, ['style' => "font-family:'Wingdings 2'"]);
            },
            'if' => function($v1 = '', $v2 =''){
                return !is_null($v1) ? $v1 : $v2;
            }
        ];

        $data_final = collect(['m' => opt(array_merge($m1, $m2))])->merge($data_func)->all();
//        dd($data_final);

        return $data_final;
    }

    public function getPageData(){
        $id = request()->get('id');
        $odich = Odich::findOne($id);
        $odich = $odich ? $odich : new Odich();

        if($odich->cabenhs){
            $sxhs = $odich->cabenhs;
        } else {
            $cabenh_ids = array_map('trim',explode(',', request()->get('cabenh_ids')));
            $sxhs = CabenhSxh::find()->andWhere(['in', 'gid', $cabenh_ids])->all();
        }

        $cabenhs = ArrayHelper::toArray($sxhs, [
            CabenhSxh::class => [
                'gid',
                'hoten', 'tuoi', 'khupho', 'to_dp', 'ngaymacbenh', 'ngaybaocao', 'ngaymacbenh_nv',
                'geometry' => function($model){
                    return $model->toGeometry();
                },
                'px' => function($model){
                    return $model->hcPhuong ? data_get($model, 'hcPhuong.tenphuong') : '';
                },
                'qh' => function($model){
                    return $model->hcQuan ? data_get($model, 'hcQuan.tenquan') : '';
                }
            ]
        ]);
        $xuly = opt($odich->xuly ? $odich->xuly->toArray() : (new OdichSxhXuly())->toArray());

        $odich = ArrayHelper::toArray($odich, [Odich::class => [
            'id',
            'loai_od',
            'ngayxacdinh',
            'ngayphathien',
            'ngaydukien_kt',
            'ngayketthuc',
            'ngaybatdau_gs',
            'donvi_xp',
            'hdtt_hinhthuc', 'hdtt_thoigian', 'hdtt_diadiem',
            'ngayketthuc_td',
            'danhgia',
            'nguoithuchien',
            'dienthoai',
        ]]);

        return [
            'formData' => array_merge($odich, [
                'cabenhs' => $cabenhs,
                'khaosat_cts' => $xuly->khaosat_cts,
                'diet_lqs' => $xuly->diet_lqs,
                'dncs' => $xuly->dncs,
                'phun_hcs' => $xuly->phun_hcs,
                'phamvi' => $xuly->phamvi,
            ]),
            'cat' => [
                'loai_od' => api('dm_loaiodich'),
                'loai_ks' => api('dm_loai_ks'),
            ]
        ];
    }

    public function actionToAh(){
        $distance = 200;
        $ids = request('cabenhIds', []);

        $q_cb = (new Query())->select(new Expression("ST_Union(ST_Buffer(geom::geography, {$distance})::geometry)"))->from('cabenh_sxh')->andFilterWhere(['gid' => $ids])->createCommand()->getRawSql();
        $to_ah = collect((new Query())->select('khupho, tento, tenphuong, tenquan, maphuong, maquan')->from(['ranh_to'])
            ->where("ST_Intersects(({$q_cb}), geom)")
            ->all())
        ;

        $maquan = userInfo()->maquan;
        $maphuong = userInfo()->maphuong;
        $giap_qh = HcQuan::find()->select('maquan')->andWhere(new Expression("ST_Intersects(geom, (SELECT geom FROM hc_quan WHERE maquan = '{$maquan}'))"))->andWhere(['<>', 'maquan', $maquan])->pluck('maquan');
        $giap_px = HcPhuong::find()->select('maphuong')->andWhere(new Expression("ST_Intersects(geom, (SELECT geom FROM hc_phuong WHERE maphuong = '{$maphuong}'))"))->andWhere(['<>', 'maphuong', $maphuong])->pluck('maphuong');

        $px = $to_ah->where('maphuong', $maphuong)->sortBy('khupho', SORT_NATURAL);
        $lien_px = $to_ah->whereIn('maphuong', $giap_px)->sortBy('khupho', SORT_NATURAL);
        $lien_qh = $to_ah->whereIn('maquan', $giap_qh)->sortBy('khupho', SORT_NATURAL);


        return $this->renderPartial('to_ah', [
            'px' => $px,
            'lien_px' => $lien_px,
            'lien_qh' => $lien_qh,
        ]);
    }

    public function actionDncs(){
        $ids = request('cabenhIds', []);
        $distance = 200;
        $sql = CabenhSxh::find()->select(new Expression("ST_Union(ST_Buffer(geom::geography, {$distance})::geometry) geom"))->andWhere(['gid' => $ids])->createCommand()->getRawSql();
        $data = ArrayHelper::toArray(PtNguyco::find()->with(['quan', 'phuong', 'dm_loaihinh'])->andWhere(new Expression("ST_Intersects(geom, ({$sql}))"))->all(), [
            PtNguyco::class => [
                'ten_cs',
                'nhom',
                'loaihinh' => function($model){
                    if($lh = $model->dm_loaihinh){
                        if(in_array($lh->id, [20, 21, 22]) && $model->loaihinh) return "Khác ({$model->loaihinh})";
                        return $model->dm_loaihinh->ten_lh;
                    }
                    return '';
                },
                'khupho',
                'to_dp',
                'tenphuong' => function($model){
                    return $model->phuong->tenphuong;
                },
                'tenquan' => function($model){
                    return $model->quan->tenquan;
                },
                'diachi'=> function($model){
                    return collect([$model->sonha, $model->tenduong])->implode(' ');
                },
            ]
        ]);

        return $this->asJson([
            'data' => $data
        ]);
    }
}
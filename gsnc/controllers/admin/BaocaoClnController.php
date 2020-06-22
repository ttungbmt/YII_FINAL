<?php

namespace gsnc\controllers\admin;

use app\models\BaocaoCln;
use gsnc\controllers\AppController;
use gsnc\models\search\BaocaoClnSearch;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ttungbmt\actions\CreateAction;
use ttungbmt\actions\DeleteAction;
use ttungbmt\actions\IndexAction;
use ttungbmt\actions\UpdateAction;
use ttungbmt\actions\ExportWordAction;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class BaocaoClnController extends AppController
{
    public $enableCsrfValidation = false;
    public $modelClass = BaocaoCln::class;

    public function actions()
    {
        $actions['export-dieutra'] = [
            'class'    => 'common\actions\ExportWordAction',
            'fileName' => 'PhieuDt_SXH',
            'getData'  => [$this, 'getDataDieutra'],
        ];
        return array_merge(parent::actions(), [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => BaocaoClnSearch::class
            ],
            'create' => [
                'class' => CreateAction::class,
                'modelClass' => $this->modelClass,
                'handler' => 'saveModel'
            ],
            'update' => [
                'class' => UpdateAction::class,
                'modelClass' => $this->modelClass,
                'handler' => 'saveModel'
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'modelClass' => $this->modelClass
            ],
            'export-word' => [
                'class'    => ExportWordAction::class,
                'fileName' => 'Baocao',
                'getData'  => [$this, 'getBaocaoData'],
            ]
        ]);
    }

    public function getBaocaoData(){
        $id = request()->get('id');
        $model = BaocaoCln::findOne($id);

        $data_map = collect($model->data->toArray())->keys()->mapWithKeys(function ($name) use($model){
            return [$name => function () use($name, $model){
                return data_get($model, 'data.'.$name);
            }];
        });

        $dm_donvi_cn = collect(api('dm/donvi-cn?donvi_bc_id='.$model->donvi_bc));
        $dm_yesno = collect(api('dm_yesno'));
        $dm_yesno_qd = collect(api('dm_yesno_qd'));
        $dm_chitieu_kd = collect(api('dm_chitieu_kd'));


        $m1 = ArrayHelper::toArray($model, [
            BaocaoCln::class => $data_map->merge([
                'thoigian',
                'donvi_bc',
                'ten_dv' => function($model){
                    return $model->donvi_bc == 'THANH PHO' ? 'SỞ Y TẾ TP. HỒ CHÍ MINH' : Str::upper('UBND '.$model->donviBc->tenquan);
                },

                'donvi_cns' => function($model) use($dm_donvi_cn, $dm_yesno, $dm_yesno_qd){
                    $dv = data_get($model, 'data.donvi_cns', []);
                    return collect($dv)->map(function ($v, $k) use($dm_donvi_cn, $dm_yesno, $dm_yesno_qd){
                        $ov = opt($v);
                        return array_merge($v, [
                            'ten_dv' => $dm_donvi_cn->firstWhereGet('value', $ov->ten_dv, 'label'),
                            'lap_hs' => $dm_yesno->get($ov->lap_hs),
                            'hs_daydu' => $dm_yesno->get($ov->hs_daydu),
                            'bienphap' => $dm_yesno->get($ov->bienphap),
                            'somau' => $dm_yesno_qd->get($ov->somau),
                            'tanxuat' => $dm_yesno_qd->get($ov->tanxuat),
                            'chedo_bc' => $dm_yesno_qd->get($ov->chedo_bc),
                            'chedo_tt' => $dm_yesno_qd->get($ov->chedo_tt),
                        ]);
                    });
                },
                'donvi_thnks' => function($model) use($dm_yesno){
                    $dv = data_get($model, 'data.donvi_thnks', []);
                    return collect($dv)->map(function ($v, $k) use($dm_yesno){
                        $ov = opt($v);
                        return array_merge($v, [
                            'thunghiem' => $dm_yesno->get($ov->thunghiem),

                        ]);
                    });
                },
                'coso_cns' => function($model) use($dm_chitieu_kd, $dm_donvi_cn){
                    $dv = data_get($model, 'data.coso_cns', []);
                    return collect($dv)->map(function ($v, $k) use($dm_chitieu_kd, $dm_donvi_cn){
                        $ov = opt($v);
                        $mv = collect($v)->except(['ten_cs'])->map(function ($i, $k) use($dm_chitieu_kd){
                            return ['label' => $dm_chitieu_kd->get($k), 'value' => $i];
                        });
                        return [
                            'ten_cs' => $dm_donvi_cn->firstWhereGet('value', $ov->ten_cs, 'label'),
                            'chitieu_kd' => $mv->all()
                        ];
                    });
                },
            ])->all()
        ]);

        $m2 = [
            'tong_ho_gd_ccn' => function() use($m1){
                return collect($m1['donvi_cns'])->sum('soho');
            },
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

        return $data_final;
    }
}
<?php

namespace gsnc\controllers\admin;

use app\models\BaocaoCln;
use gsnc\controllers\AppController;
use gsnc\models\search\BaocaoClnSearch;
use Illuminate\Support\Arr;
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

        $m1 = ArrayHelper::toArray($model, [
            BaocaoCln::class => $data_map->merge([
                'thoigian',
                'donvi_bc',
                'ten_dv' => function($model){
                    return $model->donvi_bc == 'THANH PHO' ? 'SỞ Y TẾ TP. HỒ CHÍ MINH' : Str::upper('UBND '.$model->donviBc->tenquan);
                },
                'tong_ho_gd_ccn' => function($model) use($data_map){
                    return ;
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

        $data_final = collect(['m' => (object)array_merge($m1, $m2)])->merge($data_func)->all();

//        dd($data_final);

        return $data_final;
    }
}
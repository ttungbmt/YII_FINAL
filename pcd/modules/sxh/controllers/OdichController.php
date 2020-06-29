<?php
namespace pcd\modules\sxh\controllers;

use Illuminate\Support\Str;
use pcd\controllers\AppController;
use pcd\models\CabenhSxh;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use pcd\models\OdichSxhPoly;
use pcd\modules\pt_nguyco\models\PtNguyco;
use pcd\modules\sxh\forms\OdichForm;
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
        $errorMessage = 'Biên bản xử lý có một số thông tin nhập chưa đúng. Xin vui lòng kiểm tra lại biên bản';

        return array_merge(parent::actions(), [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => OdichSearch::class
            ],
            'create' => [
                'class' => CreateAction::class,
                'modelClass' => OdichForm::class,
                'redirectUrl' => ['index'],
                'messages' => [
                    'error' => $errorMessage
                ],
                'viewParams' => [$this, 'getPageData'],
                'handler' => 'saveModel'
            ],
            'update' => [
                'class' => UpdateAction::class,
                'modelClass' => OdichForm::class,
                'redirectUrl' => false,
                'messages' => [
                    'error' => $errorMessage
                ],
                'viewParams' => [$this, 'getPageData'],
                'handler' => 'saveModel'
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'modelClass' => $this->modelClass,
            ],
            'export-word' => [
                'class'    => ExportWordAction::class,
                'fileName' => 'BienbanXL_OD',
                'getData'  => [$this, 'getDataWord'],
            ]
        ]);
    }

    public function getPageData(){
        $id = request()->get('id');
        $odich = OdichForm::findById($id);

        return [
            'formData' => $odich->toFormArray(),
            'cat' => [
                'loai_od' => api('dm_loaiodich'),
                'loai_ks' => api('dm_loai_ks'),
                'qh' => collect(HcQuan::find()->select('tenquan,maquan,order')->orderBy('order')->pluck('tenquan', 'maquan'))->map(function ($i, $k){
                    return ['label' => $i, 'value' => (string)$k];
                })->values()->all(),
                'px' => collect(HcPhuong::find()->select('maquan,tenphuong,maphuong,order')->orderBy('order')->all())->map(function ($i, $k){
                    return ['label' => $i['tenphuong'], 'value' => (string)$i['maphuong'], 'extra' => ['maquan' => $i['maquan']]];
                })->values()->all(),
            ]
        ];
    }

    public function actionToAh(){
        $distance = 200;
        $ids = request('cabenhIds', []);
        $maquan = request()->post('maquan', userInfo()->maquan);
        $maphuong = request()->post('maphuong', userInfo()->maphuong);

        $q_cb = (new Query())->select(new Expression("ST_Union(ST_Buffer(geom::geography, {$distance})::geometry)"))->from('cabenh_sxh')->andFilterWhere(['gid' => $ids])->createCommand()->getRawSql();
        $to_ah = collect((new Query())->select('khupho, tento, tenphuong, tenquan, maphuong, maquan')->from(['ranh_to'])
            ->where("ST_Intersects(({$q_cb}), geom)")
            ->all())
        ;


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


        $m1 = ArrayHelper::toArray($model, [
            Odich::class => $data_map->merge([
                'tenquan' => 'quan.tenquan',
                'tenphuong' => 'phuong.tenphuong',
                'khaosat_cts' => function($model) use($dm_loai_ks){
                    return collect(data_get($model, 'xuly.khaosat_cts', []))->map(function ($i) use($dm_loai_ks){
                        return array_merge($i, [
                            'loai_ks' => toFilterValue(['filter' => $dm_loai_ks, 'value' => 'loai_ks'])(opt($i)),
                        ]);
                    })->all();
                },
                'dncs' => function($model){
                    $dncs = PtNguyco::find()->andWhere(['gid' => data_get($model, 'xuly.dncs', [])])->all();
                    return ArrayHelper::toArray($dncs, [PtNguyco::class => PtNguyco::rawFields()]);
                },
                'diet_lqs' => 'dietLqs',
                'phun_hcs' => 'phunHcs',
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
                'loai_od' => toFilterValue(['filter' => $dm_loai_od, 'value' => 'loai_od']),
            ])->all()
        ]);

        $m2 = [

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

    public function actionDncs(){
        $ids = request('cabenhIds', []);
        $odich_id = request('odich_id', null);
        $distance = 200;
        $sql = CabenhSxh::find()->select(new Expression("ST_Union(ST_Buffer(geom::geography, {$distance})::geometry) geom"))->andWhere(['gid' => $ids])->createCommand()->getRawSql();
        $data = ArrayHelper::toArray(PtNguyco::find()->with(['quan', 'phuong', 'dm_loaihinh'])->andWhere(new Expression("ST_Intersects(geom, ({$sql}))"))->all(), [
            PtNguyco::class => PtNguyco::rawFields()
        ]);

        return $this->asJson([
            'data' => $data
        ]);
    }
}
<?php
namespace pcd\modules\sxh\forms;

use Illuminate\Support\Arr;
use pcd\models\CabenhSxh;
use pcd\modules\pt_nguyco\models\PtNguyco;
use pcd\modules\sxh\models\Odich;
use yii\helpers\ArrayHelper;

class OdichForm extends Odich
{
    public $dup_odich;
    public $has_cabenhs;

    public function rules()
    {
        return array_merge(parent::rules(),[
            [['maquan', 'maphuong', 'ngayxacdinh', 'ngayphathien', 'loai_od'], 'required'],
            ['has_cabenhs', function () {
                if(collect(request('cabenhs', []))->isEmpty())  $this->addError('has_cabenhs', 'Danh sách ca bệnh không được bỏ trống');
            }, 'skipOnEmpty' => false,],
            ['dup_odich', function ($attribute, $params, $validator) {
                if(!$this->id){
                    $models = collect($this->find()->with('cabenhs')->andFilterWhere([
                        'ngayxacdinh' => $this->ngayxacdinh,
                        'maquan' => $this->maquan,
                        'maphuong' => $this->maphuong,
                    ])->all())->map(function ($i){
                        return Arr::pluck($i->cabenhs, 'gid');
                    });
                    foreach ($models as $m){
                        $cabenhs = collect(request('cabenhs', []));
                        if(count($m) !== 0 && $cabenhs->pluck('gid')->intersect($m)->count() === $cabenhs->count() ){
                            $this->addError('dup_odich', 'Ổ dịch đã trùng với ổ dịch khác trên hệ thống');
                            return;
                        }

                    }
                }

            }, 'skipOnEmpty' => false,],
        ]);
    }

    public static function findById($id){
        $model = self::findOne($id);
        return $model ? $model : new self;
    }

     public function toFormArray(){
        return ArrayHelper::toArray($this, [self::class => [
            'id',
            'maphuong',
            'maquan',
            'sonocgia',
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
            'diet_lqs' => 'dietLqs',
            'phun_hcs' => function($model){
                return collect($model->phunHcs)->map(function ($i){
                    return array_merge($i->toArray(), ['loai_hc' => array_map('trim', explode(',', $i->loai_hc))]);
                });
            },
            'cabenhs' => function($model){
                $ids = collect(explode(',', request()->get('cabenh_ids')))->map(function ($i){return trim($i);})->filter();
                $cabenhs = $ids->isEmpty() ? $model->cabenhs : CabenhSxh::find()->andWhere(['in', 'gid', $ids->all()])->all();
                $sxhPolys = collect($this->sxhPolys);

                return ArrayHelper::toArray($cabenhs, [
                    CabenhSxh::class => [
                        'poly_id' => function($model) use($sxhPolys){
                            return data_get($sxhPolys->firstWhere('resource_id', $model->gid), 'id');
                        },
                        'gid', 'hoten', 'tuoi', 'khupho', 'to_dp', 'ngaymacbenh', 'ngaybaocao', 'ngaymacbenh_nv',
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
            },
            'xuly_id' => 'xuly.id',
            'khaosat_cts' => 'xuly.khaosat_cts',
            'khaosat_cts' => function($model){
                return $model->xuly && $model->xuly->khaosat_cts ? $model->xuly->khaosat_cts : [];
            },
            'phamvi_gis' => 'xuly.phamvi_gis',
            'phamvi_px' => 'xuly.phamvi_px',
            'dncs' => function($model){
                if($model->xuly && $model->xuly->dncs) {
                    $dncs = PtNguyco::find()->andWhere(['gid' => $model->xuly->dncs->toArray()])->all();
                    return ArrayHelper::toArray($dncs, [PtNguyco::class => PtNguyco::rawFields()]);
                }
                return  [];
            },
        ]]);
    }


}
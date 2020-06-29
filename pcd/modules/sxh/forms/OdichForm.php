<?php
namespace pcd\modules\sxh\forms;

use pcd\models\CabenhSxh;
use pcd\modules\pt_nguyco\models\PtNguyco;
use pcd\modules\sxh\models\Odich;
use yii\helpers\ArrayHelper;

class OdichForm extends Odich
{
    public function rules()
    {
        return [
            [['maquan', 'maphuong', 'ngayxacdinh', 'ngayphathien', 'loai_od'], 'required'],
        ];
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
            'phun_hcs' => 'phunHcs',
            'cabenhs' => function($model){
                $ids = array_map('trim',explode(',', request()->get('cabenh_ids')));
                $cabenhs = $model->cabenhs ? $model->cabenhs : CabenhSxh::find()->andWhere(['in', 'gid', $ids])->all();
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
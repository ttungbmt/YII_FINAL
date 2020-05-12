<?php
namespace modules\pcd\pt_nguyco\controllers\api;

use common\controllers\ApiController;
use modules\pcd\pt_nguyco\models\DmLoaihinh;

class DmController extends ApiController
{
    public function actionLoaihinh(){
        $query = DmLoaihinh::find()->asArray()->all();

        $nhom = [
            1 => 'Các loại hình điểm nguy cơ giao trách nhiệm giám sát cho chủ sở hữu hoặc người đứng đầu',
            2 => 'Các loại hình điểm nguy cơ không yêu cầu đặt chỉ tiêu xóa nhưng phải giám sát định kỳ',
            3 => 'Các loại hình điểm nguy cơ bắt buộc phải xóa trong thời gian nhất định do Chính quyền địa phương quyết định'
        ];
        $data = collect($query)->groupBy('nhom')->mapWithKeys(function ($v, $k) use ($nhom){
            $label = data_get($nhom, $k);
            return [$label => $v->pluck('ten_lh', 'id')->map(function ($v) use ($k){
                return "({$k}) {$v}";
            })->all()];
        });
        return $data->all();
    }

    public function actionNhom(){
        return DmLoaihinh::find()->orderBy('nhom')->pluck('nhom', 'nhom')->all();
    }
}
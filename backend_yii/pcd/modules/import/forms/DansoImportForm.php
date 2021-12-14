<?php
namespace pcd\modules\import\forms;
use common\models\DynamicImportForm;

class DansoImportForm extends DynamicImportForm {
    public function attributeLabels(){
        return [

        ];
    }

    public function rules()
    {
        $add_prefix = function ($i, $range){ return array_map(function ($v) use($i, $range){ return $i.$v; }, $range);};
        $col = array_merge($add_prefix('',range('1995', '2025')), $add_prefix('ds_uoc_',range('2017', '2025')));

        $rules = [
            [['tt', 'ten_qh'], 'string'],
            [$col, 'string']
        ];

        return $rules;
    }

    public function fields(){
        $data = collect();


        return $data->collapse()->all();
    }
}
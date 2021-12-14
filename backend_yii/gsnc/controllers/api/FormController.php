<?php
namespace gsnc\controllers\api;
use common\controllers\MyApiController;

class FormController extends MyApiController
{
    public function actionIndex(){
        $actionLink = function ($params){return array_merge(['component' => 'link-field', 'icon' => 'fal fa-info-circle', 'target' => '_blank', 'text' => 'Chi tiết'], $params);};

        $dm_qcvn = api('/dm/qcvn');
        $dm_maunc = api('/dm/maunc');
        $dm_dat = [0 => 'Không đạt', 1 => 'Đạt'];

        return [
            [
                'id' => 'maunc',
                'label' => 'Mẫu nước',
                'request' => ['method' => 'POST', 'url' => '/api/maunc/search'],
                'selected' => true,
                'schema' => [
                    ['component' => 'select-field', 'label' => 'QCVN', 'name' => 'qcvn_id', 'options' => $dm_qcvn],
                    ['component' => 'select-field', 'label' => 'Loại mẫu', 'name' => 'loaimau_id', 'options' => $dm_maunc],
                    ['component' => 'select-field', 'label' => 'HL & VL', 'name' => 'hl_vs', 'options' => $dm_dat, 'className' => 'col-span-2'],
                    ['component' => 'text-field', 'label' => 'Địa chỉ', 'name' => 'diachi', 'className' => 'col-span-2'],
                ],
                'popup' => [
                    'linkLayer' => 'maunc'
                ],
                'list' => [
                    'layout' => 'list',
                    'avatar' => 'https://www.flaticon.com/svg/static/icons/svg/2114/2114534.svg',
                    'heading' => '#{{mamau}} - {{loaimau}}',
                    'content' => [
                        ['icon' => 'fad fa-calendar-edit', 'text' => '{{ngaylaymau}}'],
                        ['icon' => 'fas fa-address-book', 'text' => '{{diachi}}'],
                    ]
                ]
            ],
            [
                'id' => 'vt_khaosat',
                'label' => 'Vị trí khảo sát',
                'request' => ['method' => 'POST', 'url' => '/api/vt-khaosat/search'],
                'schema' => [
                    ['component' => 'text-field', 'label' => 'Tên chủ hộ', 'name' => 'tenchuho'],
                ],
                'popup' => [
                    'linkLayer' => 'vt_khaosat'
                ],
                'list' => [
                    'layout' => 'list',
                    'avatar' => 'https://w7.pngwing.com/pngs/818/133/png-transparent-computer-icons-survey-methodology-laborious-miscellaneous-angle-logo-thumbnail.png',
                    'heading' => '{{tenchuho}}',
                    'content' => [
                        ['icon' => 'fad fa-calendar-edit', 'text' => '{{ngaykhaosat}}'],
                        ['icon' => 'fas fa-address-book', 'text' => '{{diachi}} ,{{tenphuong}}, {{tenquan}}'],
                    ]
                ]
            ]
        ];
    }

    public function actionMaunc(){
        return [];
    }

    public function actionVtKhaosat(){
        return [];
    }
}
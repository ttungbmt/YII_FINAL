<?php

use yii\web\User;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id'           => 'app-pcd',
    'defaultRoute' => 'admin/site/index',

    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'pcd\controllers',
    'modules'             => [
        'workout' => [
            'class' => 'pcd\modules\workout\Module',
        ],
        'thongke'   => [
            'class' => 'modules\pcd\thongke\Module',
        ],
        'pt_nguyco' => [
            'class' => 'pcd\modules\pt_nguyco\Module',
        ],
        'import'    => [
            'class' => 'pcd\modules\import\Module',
        ],
        'benh_tn'   => [
            'class' => 'pcd\modules\benh_tn\Module',
        ],
        'sxh'     => [
            'class' => 'pcd\modules\sxh\Module',
        ],
        'dm' => [
            'class' => 'pcd\modules\dm\Module',
        ],
//        'odich' => [
//            'class' => 'pcd\modules\odich\Module',
//        ],
    ],

    'components' => [
        'api'  => [
            'class'   => 'common\components\Api',
            'dataMap' => [
                dirname(__DIR__) . '/fixtures/danhmuc.php',
            ]
        ],
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/admin',
                'baseUrl'  => '@web/pcd',
                'pathMap'  => [
                    '@app/views' => [
                        '@app/themes/admin',
                        '@common/themes/admin',
                    ],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'pcd*' => [
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],

        'user'       => [
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'request'    => [
            'csrfParam' => '_csrf-pcd',
            'parsers'   => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'session'    => [
            // this is the name of the session cookie used for login on the pcd
            'name' => 'advanced-pcd',
        ],
        'log'        => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'class'           => 'yii\web\UrlManager',
            'showScriptName'  => false, // Disable index.php
            'enablePrettyUrl' => true, // Disable r= routes
            'rules'           => [
                'api/pt_nguyco/dm/loaihinh' => 'pt_nguyco/api/dm/loaihinh',
                'api/pt_nguyco/dm/nhom'     => 'pt_nguyco/api/dm/nhom',
                'maps/configs'     => 'sxh/maps/configs',
            ]
        ],
    ],
    'params'     => $params,

    'as beforeRequest' => [
        'class'  => 'yii\filters\AccessControl',
        'only'   => ['admin/*'],
        'except' => [
            //'admin/*'
        ],
        'rules'  => [
            [
                'allow' => true,
                'roles' => ['@']
            ],
        ],
    ],
];



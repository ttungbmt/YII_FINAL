<?php

use Illuminate\Support\Str;

$HOST = $_SERVER['HTTP_HOST'];
$DOMAIN = explode('.', $HOST)[0];

$db = [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=192.168.1.40;dbname=yte_dichte;port=5432;',
    'username' => 'postgres',
    'password' => 'postgres',
    'charset' => 'utf8',
];

if(Str::of(explode('.', $HOST)[1])->startsWith('local')){
//    $db['dsn'] = 'pgsql:host=192.168.1.40;dbname=yte_dichte_test;port=5432;';
}

if($DOMAIN === 'pcd-test'){
    $db['dsn'] = 'pgsql:host=192.168.1.40;dbname=yte_dichte_test_1;port=5432;';
}

return $db;

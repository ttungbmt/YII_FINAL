<?php

use Carbon\Carbon;
use Cmixin\BusinessTime;

Yii::setAlias('@pcd', dirname(__DIR__));
Yii::setAlias('@pcd_theme', dirname(__DIR__). '/themes');

BusinessTime::enable(Carbon::class, [
    'monday' => ['07:30-12:00', '13:00-17:00'],
    'tuesday' => ['07:30-12:00', '13:00-17:00'],
    'wednesday' => ['07:30-12:00', '13:00-17:00'],
    'thursday' => ['07:30-12:00', '13:00-17:00'],
    'friday' => ['07:30-12:00', '13:00-17:00'],
    'saturday' => [],
    'sunday' => [],
]);

include_once __DIR__.'./events.php';
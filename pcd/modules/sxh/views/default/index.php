<?php
use yii\widgets\ActiveForm;

$this->title = 'Danh sách SXH';

use kartik\export\ExportMenu;
use yii\data\ArrayDataProvider;

$dp1 = new ArrayDataProvider(['allModels' => [
    ['id' => 1, 'fruit' => 'Apples', 'quantity' => '100'],
    ['id' => 2, 'fruit' => 'Oranges', 'quantity' => '60'],
    ['id' => 3, 'fruit' => 'Bananas', 'quantity' => '160'],
    ['id' => 4, 'fruit' => 'Pineapples', 'quantity' => '90'],
    ['id' => 5, 'fruit' => 'Grapes', 'quantity' => '290'],
]]);

echo ExportMenu::widget([
    'dataProvider' => $dp1,
    'columns' => ['id', 'fruit', 'quantity'],
    'options' => ['id'=>'expMenu1'], // optional to set but must be unique
    'target' => ExportMenu::TARGET_BLANK
]);
?>

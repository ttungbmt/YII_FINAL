<?php
use yii\bootstrap4\Html;

$columns = array_merge([
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
],
    $searchModel->getColumns(),
    [
        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{view}{update}{delete}{download}',
            'urlCreator' => function ($action, $model, $key, $index) {
                return url([$action, 'id' => $key]);
            },
            'updateOptions' => ['title' => lang('Update'), 'data-toggle' => 'tooltip'],
            'buttons' => [
                'download' => function ($url, $model, $key) {
                    return Html::a("<i class='icon-download4'></i>", ['/sxh/odich/export-word', 'id' => $model->getId()], ['title' => 'Tải phiếu điều tra', 'data-toggle' => 'tooltip', 'data-method' => 'POST', 'data-pjax' => 0, 'target' => '_blank']);
                }
            ],
            'visibleButtons' => ['view' => false]
        ],
    ]);

return $columns;
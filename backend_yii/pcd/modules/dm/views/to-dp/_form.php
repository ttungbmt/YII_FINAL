<?php

use pcd\supports\RoleHc;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;


/* @var $this yii\web\View */
/* @var $model pcd\modules\dm\models\DmToDp */
/* @var $form yii\widgets\ActiveForm */

$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' tổ dân phố';

$maquan = (string)userInfo()->maquan;
if ($maquan && !$model->maquan) $model->maquan = $maquan;

$maphuong = (string)userInfo()->maphuong;
if ($maphuong && !$model->maphuong) {
    $model->maquan = $maquan;
    $model->maphuong = $maphuong;

}

try {
    $geojson = \pcd\modules\dm\models\DmToDp::find()->select('ST_AsGeoJSON(ST_PointOnSurface(geom)) geom')->andWhere(['gid' => $model->gid])->asArray()->one();
    $center = array_reverse(data_get(json_decode($geojson['geom'], true), 'coordinates'));
} catch (Exception $e){
    $center = [10.779927, 106.691651];
}

$role = RoleHc::init();
$this->registerJsVar('pageData', [
    'form' => $model->toArray(),
    'map' => [
        'config' => [
            'center' => $center,
            'zoom' => 18
        ],
        'layers' => [
            [
                'type' => 'wms',
                'key' => 'ranhphuong',
                'title' => 'Ranh phường',
                'options' => [
                    'url'        => '/geoserver/ows?',
                    'layers'     => 'dichte:hc_phuong',
                    'cql_filter' => $role->getGapranhCQL('', 'phuong'),
                    'zIndex' => 3
                ],
            ],
            [
                'type' => 'wms',
                'key' => 'ranhto-cu',
                'title' => 'Ranh tổ (2016)',
                'options' => [
                    'url'        => '/geoserver/ows?',
                    'layers'     => 'dichte:ranh_to',
                    'cql_filter' => $role->getGapranhCQL('', null),
                    'zIndex' => 3
                ],
            ],
            [
                'type' => 'wms',
                'key' => 'ranhto-cu',
                'title' => 'Ranh tổ',
                'options' => [
                    'url'        => '/geoserver/ows?',
                    'layers'     => 'dichte:dm_to_dp',
                    'cql_filter' => $role->getGapranhCQL('', null),
                    'zIndex' => 4
                ],
            ]
        ]
    ]
])
?>
    <div id="page-app">
        <div class="card">
            <page-to-dp>
                <template v-slot:default="{form}">
                    <div class="card-body">

                        <?php $form = ActiveForm::begin(['id' => 'form-to-dp']); ?>

                        <div class="dm-to-dp-form">

                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'maquan')->dropDownList(api('/dm/quan?role=true'), [
                                        'prompt' => 'Chọn quận...',
                                        'id' => 'drop-quan',
                                        'v-model' => 'form.maquan'
                                    ]) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'maphuong')->widget(DepDrop::className(), [
                                        'options' => ['prompt' => 'Chọn phường...', 'id' => 'drop-phuong', 'v-model' => 'form.maphuong'],
                                        'pluginOptions' => [
                                            'depends' => ['drop-quan'],
                                            'url' => url(['/api/dm/phuong?role=true']),
                                            'initialize' => $model->maquan == true,
                                            'placeholder' => 'Chọn phường...',
                                            'ajaxSettings' => ['data' => ['value' => $model->maphuong]],
                                        ],
                                    ]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'khupho')->widget(DepDrop::className(), [
                                        'options' => ['prompt' => 'Chọn phường...', 'v-model' => 'form.khupho'],
                                        'pluginOptions' => [
                                            'depends' => ['drop-phuong'],
                                            'url' => url(['/api/dm/khupho']),
                                            'initialize' => $model->maphuong == true,
                                            'placeholder' => 'Chọn khu phố...',
                                            'ajaxSettings' => ['data' => ['value' => $model->khupho]],
                                        ],
                                    ]) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'to_dp')->textInput(['maxlength' => true, 'v-model' => 'form.to_dp']) ?>

                                </div>
                            </div>

                            <div class="form-group text-right">
                                <?= Html::submitButton($model->isNewRecord ? lang('Create') : lang('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </template>
            </page-to-dp>
        </div>
    </div>


<?php $this->beginBlock('scripts'); ?>
<?php
$options = ['depends' => [\common\assets\AppPluginAsset::className()]];
$this->registerCssFile('https://cdn.jsdelivr.net/npm/leaflet@1.6.0/dist/leaflet.css', $options);
$this->registerJsFile('/pcd/pages/dist/dm-to-dp/main.js?v=' . params('version'), $options);
?>
<?php $this->endBlock(); ?>
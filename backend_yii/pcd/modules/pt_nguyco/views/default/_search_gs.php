<?php
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\depdrop\DepDrop;

$maquan = userInfo()->ma_quan;
$maphuong = userInfo()->ma_phuong;
$model->maquan = $model->maquan ? $model->maquan : $maquan;
$year = $model->year;
$dm_loaihinh = api('pt_nguyco/dm/loaihinh');
$dm_nhom = api('pt_nguyco/dm/nhom');

?>

<?php $form = ActiveForm::begin([
    'method' => 'GET',
    'options' => ['id' => 'giamsat-search', 'data-pjax' => true]
]) ?>
<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'maquan')->dropDownList(api('/dm/quan?role=true'), [
            'prompt'  => 'Chọn quận huyện...',
            'id'      => 'drop-quan1',
        ])->label(false); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'maphuong')->widget(DepDrop::className(), [
            'options'       => ['prompt' => 'Chọn phường...'],
            'pluginOptions' => [
                'depends'      => ['drop-quan1'],
                'url'          => url(['/api/dm/phuong?role=true']),
                'initialize'   => $model->maquan == true,
                'placeholder'  => 'Chọn phường...',
                'ajaxSettings' => ['data' => ['value' => $maphuong]],
            ],
        ])->label(false) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'nhom')->dropDownList($dm_nhom, ['prompt' => 'Chọn nhóm...', 'id' => 'drop-nhom'])->label(false) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'loaihinh_id')->widget(DepDrop::className(), [
            'options'       => ['prompt' => 'Chọn nhóm...'],
            'pluginOptions' => [
                'depends'      => ['drop-nhom'],
                'url'          => url(['/pt_nguyco/api/dm/loaihinh']),
                'placeholder'  => 'Chọn nhóm...',
            ],
        ])->label(false) ?>
    </div>
</div>
<div class="row">
    <?php if($year):?>
        <div class="col-md-3">
            <?= $form->field($model, 'year')
                ->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Năm'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy',
                        'minViewMode' => 2,
                    ]
                ])->label(false); ?>
        </div>
    <?php else:?>
        <div class="col-md-3">
            <?= $form->field($model, 'date_from')
                ->widget(DatePicker::classname(), ['options' => ['placeholder' => 'Từ ngày cập nhật']])->label(false); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'date_to')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Đến ngày'],
            ])->label(false) ?>
        </div>

    <?php endif?>
    <div class="col-md-3 offset-md-3 pull-right">
        <button type="submit" class="form-control btn btn-primary pull-right" style="width: 100px"><i class="icon-search4 text-size-base"></i></button>
    </div>
</div>
<?php ActiveForm::end() ?>

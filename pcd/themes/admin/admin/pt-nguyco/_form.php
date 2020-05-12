<?php


use pcd\models\KehoachGs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\widgets\DatePicker;
use ttungbmt\map\Map;

/* @var $this yii\web\View */
/* @var $model pcd\models\PtNguyco */
/* @var $form yii\widgets\ActiveForm */

$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' Điểm nguy cơ';
$k1 = collect($model->kehoachs);
$khs = collect(range(1,12))->map(function ($m) use ($k1){
    $d = $k1->firstWhere('month', $m);
    return $d ? $d : new KehoachGs(['month' => $m]);
});
$dm_loaihinh = api('dm/loaihinh');
$loaihinh = \pcd\models\DmLoaihinh::find()->asArray()->all();
$yesno = [1 => 'Có', 0 => 'Không'];
?>
    <div id="vueApp">
        <div class="pt-nguyco-form">
            <?php $form = ActiveForm::begin([
                'enableClientValidation' => false,
            ]); ?>

            <?=$form->errorSummary(array_merge([$model], $model->giamsats), [
                'header' => '<span class="font-weight-semibold">Vui lòng điền các thông tin sau:</span>',
                'class' => 'error-summary alert alert-danger border-0 alert-dismissible'
            ])?>

            <div class="card">
                <?= Map::widget([
                    'model' => $model,
                ]) ?>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'lng')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <h5 class="font-weight-semibold text-primary-600"><span
                                class="badge badge-flat badge-pill border-primary">1</span> Thông tin cơ bản</h5>

                    <div class="row">
                        <div class="col-md-3"><?= $form->field($model, 'sonha')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-3"><?= $form->field($model, 'tenduong')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-3"><?= $form->field($model, 'khupho')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-3"><?= $form->field($model, 'to_dp')->textInput(['maxlength' => true]) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'loaihinh_id')->dropDownList($dm_loaihinh, ['prompt' => 'Chọn loại hình...', 'v-model' => 'm.loaihinh_id']) ?>
                        </div>
                        <div class="col-md-6">
                            <div v-if="shownTenLH">
                                <?= $form->field($model, 'loaihinh')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div v-show="shownKyCamket">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'ky_ck')->radioList($yesno) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'ngayky_ck')->widget(DatePicker::className()) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-3"><?= $form->field($model, 'ngaycapnhat')->widget(\kartik\widgets\DatePicker::className()) ?></div>
                        <div class="col-md-3"><?= $form->field($model, 'ngayxoa')->widget(\kartik\widgets\DatePicker::className()) ?></div>
                    </div>
                    <?= $form->field($model, 'ghichu')->textarea() ?>

                    <h5 class="font-weight-semibold text-primary-600 mt-3"><span
                                class="badge badge-flat badge-pill border-primary">2</span> Kế hoạch kiểm soát ĐNC</h5>
                    <h6 class="font-weight-semibold text-primary-600 mt-3">Giám sát thực tế</h6>

                    <?php foreach ($giamsats as $i => $gs):?>
                        <?=$this->render('_sub_gs', ['form' => $form, 'model' => $gs, 'i' => $i])?>
                    <?php endforeach;?>

                    <div id="resp-gs"></div>
                    <div class="text-right">
                        <button type="button" @click="addItem" class="btn bg-success-400 btn-labeled btn-labeled-left legitRipple"><b><i class="icon-file-plus"></i></b> Thêm lần giám sát</button>
                    </div>

                    <?php if (!request()->isAjax): ?>
                        <div class="form-group mt-5">
                            <?= Html::submitButton($model->isNewRecord ? lang('Create') : lang('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>


<?php $this->beginBlock('scripts') ?>
    <script>
        let app = new Vue({
            el: '#vueApp',
            data: {
                incre: <?=count($giamsats)?>,
                items: [],
                m: {
                    loaihinh_id: <?=json_encode($model->toArray())?>
                },
                dm_loaihinh: <?=json_encode($loaihinh)?>
            },
            mounted(){
                this.setFnRemove()
            },
            computed: {
                shownTenLH(){
                    let khac = _.chain(this.dm_loaihinh).filter({ten_lh: 'Khác'}).map(v => _.toString(v.id)).value()
                    return _.includes(khac, this.m.loaihinh_id)
                },
                shownKyCamket(){
                    let id = _.toInteger(this.m.loaihinh_id),
                        ob = _.find(this.dm_loaihinh, {id})

                    return (ob && ob.nhom == '1') ? true : false
                }
            },
            methods: {
                addItem(){
                    $.get(`/admin/pt-nguyco/view-gs?i=`+this.incre++, res => {
                        $('#resp-gs').append(res)
                        setTimeout(() => this.setFnRemove())
                    })
                },

                setFnRemove(){
                    $('.btn-remove-item').click(function () {
                        $(this).closest('.gs-wrapper').remove();
                    })
                }
            }
        })
    </script>
<?php $this->endBlock() ?>
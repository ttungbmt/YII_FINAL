<?php

use pcd\modules\pt_nguyco\models\DmLoaihinh;
use pcd\modules\pt_nguyco\models\KehoachGs;
use kartik\widgets\DepDrop;
use ttungbmt\leaflet\widgets\MiniMap;
use ttungbmt\yii\alpine\Alpine;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model pcd\models\PtNguyco */
/* @var $form yii\widgets\ActiveForm */

$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' Điểm nguy cơ';
$k1 = collect($model->kehoachs);
$khs = collect(range(1, 12))->map(function ($m) use ($k1) {
    $d = $k1->firstWhere('month', $m);
    return $d ? $d : new KehoachGs(['month' => $m]);
});
$dm_loaihinh = api('pt_nguyco/dm/loaihinh');
$loaihinh = DmLoaihinh::find()->asArray()->all();
$yesno = [1 => 'Có', 0 => 'Không'];
$template = '{label}<span class="text-danger">*</span>{input}';
$dm_quan = api('/dm/quan?role=true');
$url_phuong = url(['/api/dm/phuong']);

ttungbmt\yii\alpine\AlpineAsset::register($this);
?>
<?= MiniMap::widget(['model' => $model]) ?>
    <div id="vueApp">
        <div class="pt-nguyco-form">
            <?php $form = ActiveForm::begin([
                'enableClientValidation' => false,
            ]); ?>

            <?= $form->errorSummary(array_merge([$model], $model->giamsats), [
                'header' => '<span class="font-weight-semibold">Vui lòng điền các thông tin sau:</span>',
                'class' => 'error-summary alert alert-danger border-0 alert-dismissible'
            ]) ?>

            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'lat', ['template' => $template])->textInput(['id' => 'inpLat', 'class' => 'form-control pt-lat', 'maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'lng', ['template' => $template])->textInput(['id' => 'inpLng', 'class' => 'form-control pt-lng', 'maxlength' => true]) ?>
                        </div>
                    </div>

                    <h5 class="font-weight-semibold text-primary-600"><span
                                class="badge badge-flat badge-pill border-primary">1</span> Thông tin cơ bản</h5>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'ten_cs', ['template' => $template])->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'dienthoai')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <h6 class="mb-0 font-weight-semibold mb-2">Địa chỉ: <?php if ($model->diachi): ?><span
                                class="text-muted" style="font-size: 12px">
                            (Địa chỉ cũ: <cite><?= $model->diachi ?></cite>)</span> <?php endif; ?> </h6>
                    <div class="row">
                        <div class="col-md-3"><?= $form->field($model, 'sonha')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-3"><?= $form->field($model, 'tenduong', ['template' => $template])->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-3"><?= $form->field($model, 'khupho')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-3"><?= $form->field($model, 'to_dp')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-6">
                            <?= $form->field($model, "maquan")->dropDownList($dm_quan, [
                                'prompt' => 'Chọn quận huyện...',
                                'id' => "drop-quan-khac",
                            ])->label("Quận huyện") ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, "maphuong")->widget(DepDrop::className(), [
                                'options' => ['prompt' => 'Chọn phường xã...'],
                                'pluginOptions' => [
                                    'depends' => ["drop-quan-khac"],
                                    'initialize' => $model->maquan ? true : false,
                                    'ajaxSettings' => ['data' => ['value' => $model->maphuong, 'role' => 'true']],
                                    'url' => $url_phuong,
                                ],
                            ])->label("Phường xã") ?>
                        </div>
                    </div>
                    <h6 class="mb-0 font-weight-semibold mb-2">Loại hình: <?php if ($model->loaihinh): ?><span
                                class="text-muted" style="font-size: 12px">(LH cũ: <cite><?= $model->loaihinh ?></cite>)
                            </span> <?php endif; ?> </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'loaihinh_id', ['template' => $template])->dropDownList($dm_loaihinh, ['prompt' => 'Chọn loại hình...', 'v-model' => 'm.loaihinh_id']) ?>
                        </div>
                        <div class="col-md-6">
                            <div v-if="shownTenLH">
                                <?= $form->field($model, 'loaihinh')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div v-if="shownKyCamket">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'ky_ck')->radioList($yesno, ['itemOptions' => ['v-model' => 'm.ky_ck']]) ?>
                                    </div>
                                    <div class="col-md-6" v-if="m.ky_ck=='1'">
                                        <?= $form->field($model, 'ngayky_ck')->widget(DatePicker::className()) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-3"><?= $form->field($model, 'ngaycapnhat', ['template' => $template])->widget(\kartik\widgets\DatePicker::className()) ?></div>
                        <div class="col-md-3"><?= $form->field($model, 'ngayxoa')->widget(\kartik\widgets\DatePicker::className()) ?></div>
                    </div>
                    <?= $form->field($model, 'ghichu')->textarea() ?>

                    <h5 class="font-weight-semibold text-primary-600 mt-3"><span
                                class="badge badge-flat badge-pill border-primary">2</span> Kế hoạch kiểm soát ĐNC</h5>
                    <h6 class="font-weight-semibold text-primary-600 mt-3">Giám sát thực tế</h6>

                    <?php foreach ($giamsats as $i => $gs): ?>
                        <?= $this->render('_sub_gs', ['form' => $form, 'model' => $gs, 'i' => $i]) ?>
                    <?php endforeach; ?>

                    <div id="resp-gs"></div>
                    <div class="text-right">
                        <button type="button" @click="addItem"
                                class="btn bg-success-400 btn-labeled btn-labeled-left legitRipple"><b><i
                                        class="icon-file-plus"></i></b> Thêm lần giám sát
                        </button>
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
                message: 'Hello',
                incre: <?=count($giamsats)?>,
                items: [],
                m: <?=json_encode($model->toArray())?>,
                dm_loaihinh: <?=json_encode($loaihinh)?>
            },
            mounted() {
                this.setFnRemove()
            },
            watch: {
                'm.ky_ck': function (value) {
                    if (value === '1') {
                        this.$nextTick(() => {
                            let id = $('input[name="PtNguyco[ngayky_ck]"]').data('krajeeKvdatepicker')
                            $('#ptnguyco-ngayky_ck-kvdate').kvDatepicker(window[id]);
                        });
                    }

                }
            },
            computed: {
                shownTenLH() {
                    let khac = _.chain(this.dm_loaihinh).filter({ten_lh: 'Khác'}).map(v => _.toString(v.id)).value()
                    return _.includes(khac, this.m.loaihinh_id + '')
                },
                shownKyCamket() {
                    let id = _.toInteger(this.m.loaihinh_id),
                        ob = _.find(this.dm_loaihinh, {id})

                    return (ob && ob.nhom == '1') ? true : false
                },
            },
            methods: {
                addItem() {
                    $.get(`/pt_nguyco/default/view-gs?i=` + this.incre++, res => {
                        $('#resp-gs').append(res)
                        setTimeout(() => {

                            this.setFnRemove()
                        })
                    })
                },
                setFnRemove() {
                    $('.btn-remove-item').click(function () {
                        $(this).closest('.gs-wrapper').remove();
                    })
                }
            }
        })
    </script>
<?php $this->endBlock() ?>
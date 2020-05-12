<?php
$this->title = 'Thống kê xử phạt ĐNC';

use kartik\form\ActiveForm;
use yii\helpers\Html;

$model->year = $model->year ? $model->year : date('Y');
$dm_loaitk = [
    'loaihinh' => 'Loại hình',
    'xuphat'   => 'Xử phạt',
];
?>
<style>
    tfoot td {font-weight: bold}
</style>

<div id="tkApp">
    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'id' => 'formTK',
            ]); ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'loai_tk')->dropDownList($dm_loaitk); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'year')->widget(\kartik\widgets\DatePicker::className(), [
                        'pluginOptions' => [
                            'autoclose'   => true,
                            'minViewMode' => 2,
                            'format'      => 'yyyy'
                        ],
                    ]); ?>
                </div>
            </div>

            <?= Html::submitButton('Thống kê', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div id="resp-html">
        <div class="text-right mb-2">
            <btn-export class="btn badge bg-blue-400" table-id="tb-export" v-if="shownResp">Xuất excel</btn-export>
        </div>

        <div class="card">
            <div class="progress m-2" v-if="isLoading">
                <div class="progress-bar progress-bar-info progress-bar-striped active" style="width: 100%"><span
                            class="sr-only">100% hoàn thành</span></div>
            </div>
            <div class="table-responsive" v-if="shownResp">

                <div v-if="loai_tk=='loaihinh'">
                    <?=$this->render('_loaihinh')?>
                </div>
                <div v-if="loai_tk=='xuphat'">
                    <?=$this->render('_xuphat')?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=asset('assets/vue/vue-component/dist/library.js')?>"></script>
<script>
    $(function () {
        let thongkeMixin = VueCore.mixins.thongke
        let tkApp = new Vue({
            el: '#tkApp',
            mixins: [thongkeMixin],
            data: {
                formId: 'formTK',
                loai_tk: '<?=$model->loai_tk?>',
                year: '',
                list_url: {
                    loaihinh: '/pt_nguyco/thongke/loaihinh',
                    xuphat: '/pt_nguyco/thongke/xuphat'
                }
            },
            computed: {
                postUrl(){
                    return this.list_url[this.loai_tk]
                }
            },
            methods: {
                beforePost({loai_tk}){
                    this.loai_tk = loai_tk
                },
                afterPost(resp){
                    this.resp = resp.data
                },
            }
        })
    })



</script>

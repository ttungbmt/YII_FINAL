<?php
$this->title = 'Thống kê ổ dịch';
?>
<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

?>


<div id="app">
    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'id' => 'formTK',
            ]); ?>

            <?= $form->field($model, 'year')->widget(\kartik\widgets\DatePicker::className(), [
                'pluginOptions' => [
                    'autoclose'   => true,
                    'minViewMode' => 2,
                    'format'      => 'yyyy'
                ],
            ]); ?>

            <div class="text-right">
                <?= Html::submitButton('Thống kê', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div id="resp-html">
        <div class="text-right mb-2">
            <btn-export class="btn badge bg-blue-400" table-id="tb-export" v-if="shownResp">Xuất excel</btn-export>
        </div>

        <div class="text-right mt-2 mb-2" v-if="!isLoading && !_.isEmpty(resp)">
            <!--                <btn-export class="btn badge bg-blue-400" table-id="tb-export">Xuất Excel</btn-export>-->
        </div>
        <div class="card">
            <div class="progress m-2" v-if="isLoading">
                <div class="progress-bar progress-bar-info progress-bar-striped active" style="width: 100%"><span
                            class="sr-only">100% hoàn thành</span></div>
            </div>

            <div v-if="!isLoading && !_.isEmpty(resp)" class="table-responsive">
                <table id="tb-export" class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <td rowspan="2">STT</td>
                        <td rowspan="2">Số ca</td>
                        <td rowspan="2">Số ngày ca bệnh trong</td>
                        <td rowspan="2">Số tổ</td>
                        <td rowspan="2">Số ĐNC</td>
                        <td colspan="5">Tỷ lệ theo loại hình ĐNC</td>
                    </tr>
                    <tr>
                        <td>……</td>
                        <td>……</td>
                        <td>……</td>
                        <td>……</td>
                        <td>……</td>
                        <td>……</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(i, k) in resp" :data-id="i.id">
                        <td>{{k+1}}</td>
                        <td>{{i.num_sxh | orZero}}</td>
                        <td></td>
                        <td></td>
                        <td>{{i.num_dnc | orZero}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>

            </div>
        </div>
    </div>

</div>

<?php $this->beginBlock('scripts'); ?>
<script src="<?= asset('assets/vue/vue-component/dist/library.js') ?>"></script>
<script>
    let thongkeMixin = VueCore.mixins.thongke
    let tkVue = new Vue({
        el: '#app',
        mixins: [thongkeMixin],
        data: {
            formId: 'formTK',
        },
        computed: {
            postUrl(){
                return '<?=$model->postUrl?>'
            }
        },
        methods: {
            afterPost(resp){
                this.resp = resp.data
            },
        }
    })
</script>
<?php $this->endBlock(); ?>





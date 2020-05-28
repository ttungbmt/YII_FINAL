<?php
$this->title = 'Thống kê xử phạt ĐNC';

use kartik\form\ActiveForm;
use yii\helpers\Html;
use kartik\depdrop\DepDrop;

$model->year = $model->year ? $model->year : date('Y');
$dm_loaitk = [
    'loaihinh' => 'Loại hình',
    'xuphat' => 'Xử phạt',
];
$maquan = userInfo()->ma_quan;
$maphuong = userInfo()->ma_phuong;
?>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<style>
    tfoot td {
        font-weight: bold
    }
</style>

<div id="tkApp">
    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'id' => 'formTK',
                'method' => 'POST'
            ]); ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'loai_tk')->dropDownList($dm_loaitk); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'month')->widget(\kartik\widgets\DatePicker::className(), [
                        'pluginOptions' => [
                            'autoclose' => true,
                            'minViewMode' => 1,
                            'format' => 'mm/yyyy'
                        ],
                    ]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'maquan')->dropDownList(api('/dm/quan?role=true'), [
                        'prompt' => 'Chọn quận huyện...',
                        'id' => 'drop-quan',
                        'options' => [
                            userInfo()->ma_quan => ['Selected' => true],
                        ]
                    ]); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'maphuong')->widget(DepDrop::className(), [
                        'options' => ['prompt' => 'Chọn phường...'],
                        'pluginOptions' => [
                            'depends' => ['drop-quan'],
                            'url' => url(['/api/dm/phuong?role=true']),
                            'initialize' => $maquan == true,
                            'placeholder' => 'Chọn phường...',
                            'ajaxSettings' => ['data' => ['value' => $maphuong]],
                        ],
                    ]) ?>
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
                    <?= $this->render('_loaihinh') ?>
                </div>
                <div v-if="loai_tk=='xuphat'">
                    <?= $this->render('_xuphat') ?>
                </div>
            </div>
        </div>

<!--        <div id="chartdiv" style="height: 1000px; width: 100%"></div>-->

    </div>

</div>
<script src="<?= asset('assets/vue/vue-component/dist/library.js') ?>"></script>
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
                },
                chartData: {
                    labels: ['January', 'February'],
                    datasets: [
                        {
                            label: 'Data One',
                            backgroundColor: '#f87979',
                            data: [40, 20]
                        }
                    ]
                },
            },
            components: {},
            filters: {
                number: function (value) {
                    if (_.isNull(value)) return 0
                    return value
                }
            },
            computed: {
                postUrl() {
                    return this.list_url[this.loai_tk]
                }
            },
            methods: {
                beforePost({loai_tk}) {
                    this.loai_tk = loai_tk
                },
                afterPost(resp) {
                    this.resp = resp.data
                },

                renderChart(){
                    am4core.useTheme(am4themes_animated);

                    let chart = am4core.create("chartdiv", am4charts.XYChart);

                    chart.data = this.resp;

                    let categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
                    categoryAxis.dataFields.category = "ten_lh";
                    categoryAxis.renderer.inversed = true;

                    let label = categoryAxis.renderer.labels.template;
                    label.wrap = true;
                    label.maxWidth = 400;
                    label.textAlign = 'end';

                    //create value axis for income and expenses
                    let valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
                    valueAxis.renderer.opposite = true;

                    let series = chart.series.push(new am4charts.ColumnSeries());
                    series.dataFields.categoryY = "ten_lh";
                    series.dataFields.valueX = "dauthang";
                    series.name = "DNC";
                    series.columns.template.fillOpacity = 0.5;
                    series.columns.template.strokeOpacity = 0;
                    series.columns.template.tooltipText = "{valueX.value}";
                    chart.legend = new am4charts.Legend();
                }
            }
        })
    })


</script>

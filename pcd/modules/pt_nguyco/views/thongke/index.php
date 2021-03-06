<?php
$this->title = 'Thống kê xử phạt ĐNC';

use kartik\form\ActiveForm;
use pcd\supports\Helper;use yii\helpers\Html;
use kartik\depdrop\DepDrop;

$model->year = $model->year ? $model->year : date('Y');
$model->maphuong = $model->maphuong ? $model->maphuong : '';
$dm_loaitk = [
    'loaihinh' => 'Loại hình',
    'hanhchinh' => 'Hành chính',
    'xuphat' => 'Xử phạt',
    'tinhhinh_gs' => 'Tình hình giám sát',
];
$maquan = (string)userInfo()->ma_quan;
$maphuong = userInfo()->ma_phuong;
?>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<style>
    tfoot td {
        font-weight: bold
    }

    [v-cloak] > * { display:none }
    [v-cloak]::before { content: "loading…" }
    thead {background: white}
</style>

<div id="tkApp" v-cloak>
    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'id' => 'formTK',
                'method' => 'POST'
            ]); ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'loai_tk')->dropDownList($dm_loaitk, ['v-model' => 'form.loai_tk']); ?>
                </div>
                <div class="col-md-6" v-show="form.loai_tk!=='xuphat'">
                    <?= $form->field($model, 'month')->widget(\kartik\widgets\DatePicker::className(), [
                        'options' => ['v-model' => 'form.month'],
                        'pluginEvents' => ['changeDate' => "function(){ vueApp.\$set(vueApp.form, 'month', $(this).val()) }"],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'minViewMode' => 1,
                            'format' => 'mm/yyyy'
                        ],
                    ]); ?>
                </div>
                <div class="col-md-6" v-show="form.loai_tk=='xuphat'">
                    <?= $form->field($model, 'year')->widget(\kartik\widgets\DatePicker::className(), [
                        'pluginEvents' => ['changeDate' => "function(){ vueApp.\$set(vueApp.form, 'year', $(this).val()) }"],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'minViewMode' => 2,
                            'format' => 'yyyy'
                        ],
                    ]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'maquan')->dropDownList(api('/dm/quan?role=true'), Helper::addPrompt(role('admin'), 'Chọn quận huyện...', [
                        'id' => 'drop-quan',
                        'options' => [$maquan => ['Selected' => true],],
                        'v-model' => 'form.maquan'
                    ])); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'maphuong')->widget(DepDrop::className(), [
                        'options' => [
                            'prompt' => 'Chọn phường...',
                            'v-model' => 'form.maphuong'
                        ],
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
        <div class="text-right mb-2" v-if="shownResp">
            <button @click="onExport" class="btn badge bg-blue-400">Xuất excel</button>
            <btn-export class="hidden" table-id="tb-export" id="btn-export">Xuất excel</btn-export>
        </div>

        <div class="card">
            <div class="progress m-2" v-if="isLoading">
                <div class="progress-bar progress-bar-info progress-bar-striped active" style="width: 100%"><span
                            class="sr-only">100% hoàn thành</span></div>
            </div>
            <div class="table-responsive" v-if="shownResp">
                <div v-if="form.loai_tk==='tinhhinh_gs'">
                    <?= $this->render('_tinhhinh_gs') ?>
                </div>
                <div v-else-if="form.loai_tk==='xuphat'">
                    <?= $this->render('_xuphat') ?>
                </div>
                <div v-else>
                    <?= $this->render('_loaihinh') ?>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="<?= asset('assets/vue/vue-component/dist/library.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/urijs@1.19.2/src/jquery.URI.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/floatthead@2.1.2/dist/jquery.floatThead.min.js"></script>
<script src="http://jpchip.github.io/stickytable/dist/jquery-stickytable.js"></script>
<?php
$this->registerJsVar('pageData', [
    'form' => array_merge($model->toArray(), [
        'maquan' => is_null($model->maquan) ? '' : $model->maquan
    ]),
])
?>

<script>
    $(function () {
        let thongkeMixin = VueCore.mixins.thongke

        window.vueApp = new Vue({
            el: '#tkApp',
            mixins: [thongkeMixin],
            data: {
                formId: 'formTK',
                list_url: {
                    loaihinh: '/pt_nguyco/thongke/loaihinh',
                    hanhchinh: '/pt_nguyco/thongke/loaihinh',
                    xuphat: '/pt_nguyco/thongke/xuphat',
                    tinhhinh_gs: '/pt_nguyco/thongke/tinhhinh-gs',
                },
                field: {},
                resp: [],
                nhoms: {},
                ...window.pageData
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
                    return this.list_url[this.form.loai_tk]
                }
            },
            watch: {
                ['form.loai_tk'](){
                    this.resp = []
                }
            },
            methods: {
                onExport(){
                    $('#tb-export').floatThead('destroy')
                    $('#btn-export')[0].click()
                    this.floatHead()
                },
                filterByNhom(resp, ids){
                    return resp.filter(v => _.includes(ids, v.code))
                },
                getLoaihinhUri(code, col, value){

                    if(value != 0){

                        let uri = URI("/pt_nguyco")

                        uri.setSearch(_.pick(this.form, ['loai_tk', 'maquan', 'maphuong']))
                        uri.setSearch({col_tk: col})

                        switch (this.form.loai_tk) {
                            case "loaihinh":
                                if(_.isPlainObject(code)) {
                                    uri.setSearch(_.merge({month: this.form.month}, code));
                                } else {
                                    uri.setSearch({loaihinh_id: code, month: this.form.month});
                                }
                                break;
                            case "hanhchinh":
                                if(this.form.maquan && this.form.maphuong){
                                    uri.setSearch({khupho: code, month: this.form.month});
                                } else {
                                    uri.setSearch({maphuong: code, month: this.form.month});
                                }
                                break;
                            case "xuphat": uri.setSearch({year: this.form.year, month: value ? `${value}/${this.form.year}` : null, maphuong: code}); break;
                        }

                        window.open(uri.toString())
                    } else {
                        alert('Chỉ hiển thị danh sách những ô có giá trị khác 0')
                    }
                },
                beforePost({loai_tk}) {
                    this.loai_tk = loai_tk
                },

                floatHead(){
                    $('#tb-export').floatThead({
                        responsiveContainer: function($table){
                            return $table.closest('.table-responsive');
                        },

                    })
                },
                afterPost(resp) {
                    this.nhoms = resp.nhoms
                    this.resp = resp.data
                    this.field = resp.field

                    setTimeout(() => {
                        this.floatHead()
                    }, 500)
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

<?php
\pcd\assets\MapAssets::register($this);
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\web\JsExpression;

$this->title = 'Thống kê bệnh truyền nhiễm';

$dm_benh = [
    'HO GA'      => 'Ho gà',
    'THUONG HAN' => 'Thương hàn',
    'ZIKA'       => 'Zika',
    'TIEU CHAY'  => 'Tiêu chảy',
];

$dulieu = [
    'cabenh' => 'Số ca bệnh',
    '1k_dan' => 'Số ca bệnh theo 100000 dân',
];

if (!$model->by_date) $model->by_date = 'nam';
if (!$model->dulieu) $model->dulieu = 'cabenh';
if (!$model->nam) $model->nam = date('Y');
//$model->loaibenh = 'TIEU CHAY';
//$model->thangs = '1,2,3,4';
//$model->nam = '2019';

$hc = \pcd\models\HcQuan::find()->select('maquan, tenquan, center, ST_AsGeoJSON(geom) geometry')->asArray()->all();
?>
<style>
    tfoot tr {font-weight: bold}
</style>

<div id="app">
    <v-app>
        <div class="card">
            <div class="card-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'formTK',
                ]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'loaibenh')->dropDownList($dm_benh, ['prompt' => 'Chọn loại bệnh', 'v-model' => 'loaibenh']); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'dulieu')->dropDownList($dulieu, ['v-model' => 'dulieu']); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'by_date')->radioList(['nam' => 'Năm', 'thang' => 'Tháng'], [
                            'item' => function ($index, $label, $name, $checked, $value) {
                                return Html::radio($name, $checked, ['v-model' => 'by_date', 'v-on:change' => 'onChangeByField', 'value' => $value, 'label' => Html::encode($label)]);
                            },
                        ]) ?>
                    </div>
                    <div class="col-md-3" v-show="by_date==='nam'">
                        <?= $form->field($model, 'nams')->widget(\kartik\widgets\DatePicker::className(), [
                            'pluginOptions' => [
                                'multidate'   => true,
                                'minViewMode' => 2,
                                'format'      => 'yyyy'
                            ],
                        ]); ?>
                    </div>
                    <div class="col-md-3" v-show="by_date==='thang'">
                        <?= $form->field($model, 'thangs')->widget(\kartik\widgets\DatePicker::className(), [
                            'pluginOptions' => [
                                'multidate'   => true,
                                'minViewMode' => 1,
                                'maxViewMode' => 1,
                                'format'      => 'm'
                            ],
                        ]); ?>
                    </div>
                    <div class="col-md-3" v-show="by_date==='thang'">
                        <?= $form->field($model, 'nam')->widget(\kartik\widgets\DatePicker::className(), [
                            'options'       => ['id' => 'nam1'],
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
            <div class="text-right mt-2 mb-2" v-if="!isLoading && !_.isEmpty(resp)">
                <btn-export class="btn badge bg-blue-400" table-id="tb-export">Xuất Excel</btn-export>
            </div>
            <div class="card">
                <div class="progress m-2" v-if="isLoading">
                    <div class="progress-bar progress-bar-info progress-bar-striped active" style="width: 100%"><span
                                class="sr-only">100% hoàn thành</span></div>
                </div>

                <div v-if="!isLoading && !_.isEmpty(resp)" class="table-responsive">
                    <div v-if="by_date==='nam'">
                        <?= $this->render('_by_year') ?>
                    </div>
                    <div v-else>
                        <?= $this->render('_by_month') ?>
                    </div>

                </div>
            </div>
        </div>


        <div class="card">
            <v-map :resp="resp"/>
        </div>

    </v-app>

</div>

<?php $this->beginBlock('scripts'); ?>
<!--<script src="https://cdn.jsdelivr.net/npm/excellentexport@3.4.0/dist/excellentexport.min.js"></script>-->
<link rel="stylesheet" href="/pcd/assets/vue/pcd/dist/css/dichbenh.css">
<script src="/pcd/assets/vue/pcd/dist/js/chunk-vendors.js"></script>
<script src="/pcd/assets/vue/pcd/dist/js/dichbenh.js"></script>
<!--<script src="--><?//=asset('assets/vue/vue-component/dist/library.js')?><!--"></script>-->

<script>
    $(function () {
        // let thongkeMixin = VueCore.mixins.thongke
        let hc = window.hc = <?=json_encode($hc)?>;
        window.ranh_hc = hc
        hc = hc.map(({geometry, ...v}) => ({type: 'Feature', properties: v, geometry: JSON.parse(geometry)}))

        let info = L.control();

        info.onAdd = function (map) {
            this._div = L.DomUtil.create('div', 'info');
            this.update();
            return this._div;
        };

        info.update = function (props) {
            if(props) {
                this._div.innerHTML = `<b>${props.tenquan}</b>: ${props.count}`;
            }

        };

        function highlightFeature(e) {
            let layer = e.target;

            layer.setStyle({
                weight: 3,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.7
            });
            info.update(layer.feature.properties);
        }

        let tkVue = new Vue({
            el: '#app',
            // mixins: [thongkeMixin],
            data: {
                labels: {
                    dt_noi: 'Điều trị nội trú',
                    dt_ngoai: 'Điều trị ngoại trú',
                    ravien: 'Ra viện',
                },
                isLoading: false,
                dulieu: '<?=$model->dulieu?>',
                by_date: '<?=$model->by_date?>',
                loaibenh: '<?=$model->loaibenh?>',
                nam: '',
                nams: [],
                thangs: [],
                resp: null,
                data: null
            },
            computed: {
                namArr() {
                    return _.flatten(this.nams.map(v => ([{nam: v, key: 'dt_noi'}, {nam: v, key: 'dt_ngoai'}, {nam: v, key: 'ravien'}])))
                }
            },
            mounted() {
                // this.initMap()
                $('#formTK').on('beforeSubmit', this.onSubmit);
            },
            methods: {
                sumFields(resp, fields){
                    let count = 0
                    fields.map(f => {
                        count += _.get(resp, f)
                    })
                    return count
                },
                sumByFields(resp, fields){
                    let count = 0
                    fields.map(f => {
                        count += _.sumBy(resp, f)
                    })
                    return count
                },
                drawMap() {
                    let data = _.mapKeys(this.resp.map(v => {
                        return {maquan: v.maquan, tenquan: v.tenquan, count: _.sumBy(v.thangs, 'count')}
                    }), v => v.maquan)

                    let features = {
                        "type": "FeatureCollection", "features": hc.map(v => {
                            let maquan = v.properties.maquan
                            v.properties.count = _.get(data, `${maquan}.count`)
                            return v
                        })
                    }

                    let geom = L.choropleth(features, {
                        valueProperty: 'count', // which property in the features to use
                        scale: ['white', 'red'], // chroma.js scale - include as many as you like
                        steps: 5, // number of breaks or steps in range
                        mode: 'q', // q for quantile, e for equidistant, k for k-means
                        style: {
                            weight: 2,
                            opacity: 1,
                            color: 'white',
                            dashArray: '3',
                            fillOpacity: 0.7,
                        },
                        onEachFeature: function ({properties: props}, layer) {
                            let label = `${props.tenquan}: ${props.count}`
                            // layer.bindPopup(label)
                            layer.on({
                                mouseover: highlightFeature,
                                mouseout: resetHighlight,
                            });
                        }
                    }).addTo(this.$map)

                    function resetHighlight(e) {
                        geom.resetStyle(e.target);
                        info.update();
                    }
                },
                initMap() {
                    this.$map = L.map('map').setView([10.801103, 106.649921], 10);

                    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    // }).addTo(this.$map);

                    // let myBarChart = L.minichart([10.801103, 106.649921], {type: 'pie', data: [1,1,1]});
                    // this.$map.addLayer(myBarChart);

                    info.addTo(this.$map);
                },
                sumBy({route, field, f1, f2, v1, v2}) {
                    let dat = _.chain(this.resp)
                    if (f1) {
                        dat = dat.filter({[f1]: v1})
                    }
                    if (route) {
                        dat = dat.map(route).flatten()

                        if (f2) dat = dat.filter({[f2]: v2})
                    }
                    return dat.sumBy(field).value()
                },
                sumByYear(field, year) {
                    let dat = _.chain(this.resp).map('nam').flatten()
                    if (year) dat = dat.filter({nam: year})
                    return dat.sumBy(field).value()
                },
                sumByMonth(month, field) {
                    let dat = _.chain(this.resp).map('thangs').flatten()
                    if (month) dat = dat.filter({thang: month})
                    return dat.sumBy(field).value()
                },
                sumALL() {
                    return _.chain(this.resp).map('thangs').flatten().sumBy('count').value()
                },
                parseField(p) {
                    return p.split(',').map(v => v.trim()).filter(v => v)
                },
                onSubmit(e) {
                    let url, data = $('#formTK').serializeObject();
                    this.nams = this.parseField(data.nams)
                    this.nam = data.nam.trim()
                    this.thangs = this.parseField(data.thangs)
                    if(_.isEmpty(this.thangs) && this.by_date === 'thang'){
                        this.thangs = _.range(1,12).map(v => v + '')
                    }

                    e.preventDefault();
                    this.isLoading = true

                    if (this.by_date === 'thang') {
                        url = '/thongke/dichbenh/by-month'
                        data.thangs = this.thangs
                    } else {
                        url = '/thongke/dichbenh/by-year'
                    }

                    this.$http.post(url, data).then(({body}) => {
                        this.resp = body.data;
                        this.isLoading = false

                        if(this.by_date === 'thang'){
                            // this.drawMap()
                        }
                    }, resp => {
                        this.resp = null
                        this.isLoading = false
                    })
                    return false;
                },
                onChangeByField(v) {
                    this.resp = []
                    if (v.target.value === 'thang') {
                        this.nams = []
                    } else {
                        this.thangs = []
                        this.nam = ''
                    }
                }
            }
        })
    })

</script>
<?php $this->endBlock(); ?>




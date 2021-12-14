<?php
$this->title = 'Xét nghiệm huyết thanh';
\common\assets\LeafletAsset::register($this);

use kartik\form\ActiveForm;
use yii\helpers\Html;

$loai_tk = [
    'benhvien'  => 'Bệnh viện',
    'ketqua_xn' => 'Kết quả xét nghiệm',
];

$dm_xn = [
    'PCR'        => 'PCR',
    'MAC-ELISA'  => 'MAC-ELISA',
    'TEST-NHANH' => 'TEST NHANH',
];
$dulieu = [
    'dinhky'   => 'Giám sát định kỳ',
    'chandoan' => 'Xét nghiệm chẩn đoán',
];
if (!$model->year) $model->year = '2019';
if (!$model->dulieu) $model->dulieu = 'chandoan';
if (!$model->loai_tk) $model->loai_tk = 'ketqua_xn';

$hc = \pcd\models\HcQuan::find()->select('maquan, tenquan, center, ST_AsGeoJSON(geom) geojson')->asArray()->all();
?>
<style>
    .info { padding: 6px 8px; font: 14px/16px Arial, Helvetica, sans-serif; background: white; background: rgba(255, 255, 255, 0.8); box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); border-radius: 5px; }

    .info h4 { margin: 0 0 5px; color: #777; }

    .legend { text-align: left; line-height: 18px; color: #555; }

    .legend i { width: 18px; height: 18px; float: left; margin-right: 8px; opacity: 0.7; }

    .label-poly {
        white-space: nowrap;
        text-shadow: 0 0 0.1em white, 0 0 0.1em white,
        0 0 0.1em white, 0 0 0.1em white, 0 0 0.1em;
        color: #e21d60;
        font-weight: bold;
    }
</style>

<div id="tkApp">
    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'id' => 'formTK',
            ]); ?>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'dulieu')->dropDownList($dulieu, ['prompt' => 'Chọn...'])->label('Dữ liệu'); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'loai_tk')->dropDownList($loai_tk)->label('Thống kê theo'); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'loai_xn')->dropDownList($dm_xn, ['prompt' => 'Chọn loại xét nghiệm']); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'months')->widget(\kartik\widgets\DatePicker::className(), [
                        'options'       => ['placeholder' => 'mm'],
                        'pluginOptions' => [
                            'multidate'   => true,
                            'minViewMode' => 1,
                            'maxViewMode' => 1,
                            'format'      => 'm'
                        ],
                    ]); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'year')->widget(\kartik\widgets\DatePicker::className(), [
                        'options'       => ['placeholder' => 'yyyy'],
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
            <div class="table-responsive" v-if="!isLoading && !_.isEmpty(resp)">
                <div v-if="loai_tk==='benhvien'">
                    <?= $this->render('_benhvien') ?>
                </div>
                <div v-else>
                    <?= $this->render('_loai_xn') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div id="map" style="height: 1000px;"></div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/leaflet.minichart@0.2.5/dist/leaflet.minichart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/turf@3.0.14/turf.min.js"></script>
<script src="<?= asset('assets/vue/vue-component/dist/library.js') ?>"></script>

<script>
    $(function () {
        let thongkeMixin = VueCore.mixins.thongke

        let hc = window.hc = <?=json_encode($hc)?>;
        hc = hc.map(({center, ...v}) => ({...v, center: JSON.parse(center)}))

        let tkApp = new Vue({
            el: '#tkApp',
            mixins: [thongkeMixin],
            data: {
                formId: 'formTK',
                loai_tk: '',
                loai_xn: false,
                months: [],
                list_url: {
                    benhvien: '/thongke/xn-huyetthanh/by-benhvien',
                    ketqua_xn: '/thongke/xn-huyetthanh/by-ketqua-xn',
                }
            },
            mounted() {
                this.initMap()
            },
            computed: {
                postUrl() {
                    return this.list_url[this.loai_tk]
                }
            },
            methods: {
                resetMap() {
                    this.$charts.eachLayer(layer => {
                        this.$charts.removeLayer(layer)
                    })
                },
                drawMap() {
                    this.resetMap()

                    if (_.includes(['PCR', 'MAC-ELISA'], this.loai_xn)) {
                        let data = _.chain(this.resp).map(v => ({
                            tenquan: v.tenquan,
                            maquan: v.maquan,
                            data: (this.loai_xn === 'PCR') ? [v.den1, v.den2, v.den3, v.den4] : [v.duongtinh, v.amtinh]
                        })).mapKeys(v => v.maquan).value()

                        hc.map(({maquan, center: c}, k) => {
                            let center = [c[0] + 0.00449660181862269, c[1]],
                                chartData = _.get(data, `${maquan}.data`)

                            if (chartData) {
                                let chart = L.minichart(center, {
                                    data: chartData,
                                    type: 'pie',
                                    width: 45,
                                    height: 45,
                                    labels: 'auto'
                                });
                                this.$charts.addLayer(chart)
                            }
                        })
                    }
                },
                initMap() {
                    this.$map = L.map('map').setView([10.801103, 106.649921], 12);
                    let printer = L.easyPrint({
                        sizeModes: ['Current', 'A4Landscape', 'A4Portrait'],
                        filename: 'Ban do huyet thanh',
                        exportOnly: true,
                        hideControlContainer: true
                    }).addTo(this.$map);
                    this.$charts = new L.layerGroup()
                    let group = new L.layerGroup()

                    hc.map(({tenquan, center}) => {
                        group.addLayer(L.marker(center, {
                            icon: L.divIcon({
                                className: "label-poly",
                                html: `<span style="margin-left: -${tenquan.length * 3.5}px">${tenquan}</span>`
                            }),
                            draggable: true
                        }))

                    })

                    let hc_features = hc.map(({geojson, ...v}) => ({
                        type: 'Feature',
                        properties: v,
                        geometry: JSON.parse(geojson)
                    }))
                    let ranhquan = L.geoJSON(hc_features, {
                        style: () => ({
                            weight: 1,
                            dashArray: '3',
                            color: '#03a4ec',
                            fillOpacity: 0.1
                        })
                    })

                    this.$layers_control = L.control.layers(null, {
                        'Ranh quận': ranhquan.addTo(this.$map),
                        'Label': group.addTo(this.$map),
                        'Biểu đồ': this.$charts.addTo(this.$map),
                    }).addTo(this.$map)

                    let legend = L.control({position: 'bottomright'});
                    legend.onAdd = function (map) {
                        let div = L.DomUtil.create('div', 'info legend'),
                            labels = [
                                '<i style="background:#1f77b4"></i> DEN-1',
                                '<i style="background:#ff7f0e"></i> DEN-2',
                                '<i style="background:#2ca02c"></i> DEN-3',
                                '<i style="background:#d62728"></i> DEN-4',
                                '<i style="background:#1f77b4"></i> Dương tính',
                                '<i style="background:#ff7f0e"></i> Âm tính',
                            ]


                        div.innerHTML = labels.join('<br>');
                        return div;
                    };

                    legend.addTo(this.$map);
                },
                showColMon(m) {
                    return _.includes(this.months, m + ``) || _.isEmpty(this.months)
                },
                beforePost() {
                    this.loai_tk = this.formData.loai_tk
                    this.loai_xn = this.formData.loai_xn
                    this.months = this.formData.months.split(',').filter(v => v)

                    this.formData.months = this.months.map(v => {
                        if (v < 10) return `0${v.trim()}`
                        return v.trim()
                    })
                },
                afterPost(resp) {
                    this.resp = resp.data;
                    this.drawMap()
                },
            }
        })
    })

</script>



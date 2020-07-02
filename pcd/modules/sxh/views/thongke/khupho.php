<?php

use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;

$this->title = 'Thống kê Khu phố/Tổ dân phố';
$maquan = $model->maquan = $model->maquan ? $model->maquan : userInfo()->maquan;
$maphuong = $model->maphuong = $model->maphuong ? $model->maphuong : userInfo()->maphuong;

$this->registerJsFile('https://cdn.jsdelivr.net/npm/excellentexport@3.4.3/dist/excellentexport.min.js');
$this->registerJsFile('https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js');
$this->registerJsVar('pageData', [
    'form' => $model->toArray()
]);
$extra = !$maquan || !$maphuong ? [ 'prompt' => 'Chọn quận huyện...'] : [];
?>

<div id="vue-app">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'tk-form', 'method' => 'GET']) ?>
                    <?= $form->field($model, 'maquan')->dropDownList(api('/dm/quan?role=true'), array_merge([
                        'id' => 'drop-quan',
                        'options' => [
                            $maquan => ['Selected' => true],
                        ],
                        'v-model' => 'form.maquan'
                    ], $extra)) ?>

                    <?= $form->field($model, 'maphuong')->widget(DepDrop::className(), [
                        'options' => ['v-model' => 'form.maphuong'],
                        'pluginOptions' => [
                            'depends' => ['drop-quan'],
                            'url' => url(['/api/dm/phuong?role=true']),
                            'initialize' => $maquan == true,
                            'placeholder' => 'Chọn phường...',
                            'ajaxSettings' => ['data' => ['value' => $maphuong]],
                        ],
                    ]) ?>

                    <div class="text-right">
                        <a v-if="!_.isEmpty(data)" download="thongke_kp.xls" href="#" onclick="return ExcellentExport.excel(this, 'tb-khupho');"
                           class="btn btn-sm btn-link">Xuất Excel</a>

                        <button type="submit" class="btn btn-primary">Thống kê</button>
                    </div>

                    <?php ActiveForm::end() ?>

                </div>
            </div>
        </div>

        <div class="col-md-9">
            <b-progress :value="100" variant="primary" striped :animated="true" v-if="loading"></b-progress>

            <div v-if="!_.isEmpty(data) && !loading">
                <div class="card">
                    <table class="table table-bordered" id="tb-khupho">
                        <thead>
                        <tr>
                            <th>TT</th>
                            <th v-if="showColHc">{{field.label}}</th>
                            <th>Khu phố</th>
                            <th>Tổ dân phố</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(i, k) in data">
                            <td>{{k+1}}</td>
                            <td v-if="showColHc">{{i.name}}</td>
                            <td>{{i.khupho}}</td>
                            <td>{{i.to_dp}}</td>
                        </tr>
                        <tr class="font-bold">
                            <td :colspan="2">Tổng cộng</td>
                            <td v-if="showColHc">{{_.sumBy(data, 'khupho')}}</td>
                            <td>{{_.sumBy(data, 'to_dp')}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->beginBlock('scripts'); ?>
<?php
$options = ['depends' => [\common\assets\AppPluginAsset::className()]];

?>
<script>
    Vue.use(BootstrapVue)
    Vue.prototype._ = _

    let vueApp = new Vue({
        el: '#vue-app',
        data: {
            ...window.pageData,
            loading: false,
            field: {},
            data: []
        },

        mounted() {
            $(`#tk-form`).submit(this.onSubmit)
        },
        computed: {
            showColHc(){
                return !_.isEmpty(this.field)
            }
        },
        watch: {
            'form.maquan': function (val) {
                if(!val) this.form.maphuong = ''
            }
        },
        methods: {
            onSubmit(e) {
                e.preventDefault()
                let data = this.form

                this.loading = true
                $.post('/sxh/thongke/khupho', data).then(data => {
                    this.field = data.field
                    this.data = data.data
                    this.loading = false
                })

            }
        }
    })

</script>
<?php $this->endBlock(); ?>

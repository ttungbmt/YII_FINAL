<?php
use kartik\form\ActiveForm;
//use pcd\assets\AltairAsset;
//use pcd\assets\AltairTopAsset;
//use pcd\models\Benhvien;
//use pcd\modules\role_phuongquan\services\PQService;
//use pcd\services\DichteApi;
//use yii\helpers\ArrayHelper;
//use yii\widgets\ActiveForm;
//
//$this->title = ($psxh->isNewRecord ? lang('Create') : lang('Update')) . ' Phiếu điều tra';
//
//$yesno = [1 => 'Có', 0 => 'Không'];
//$yesnonull = [1 => 'Có', 0 => 'Không', 9 => 'Không rõ'];
//$xuly = [1 => 'Chưa xử lý', 2 => 'trong thời gian xử lý', 3 => 'Sau thời gian xử lý'];
//$xacdinh = [1 => 'Bệnh SXH', 2 => 'Sốt/Nhiễm siêu vi/Nghi ngờ sốt xuất huyết', 3 => 'Bệnh khác'];
//$benhvien = ArrayHelper::map(Benhvien::find()->all(), 'tenvt', 'tenbenhvien');
//if($psxh->chuyenca1){
//    $chca_info = \pcd\models\VDmPhuong::find()->where(['ma_phuong' => $psxh->chuyenca1])->one();
//}
?>
<!--<script src="https://v1.vuejs.org/js/vue.js"></script>
<style>
    [v-cloak] {
        display: none;
    }
</style>
-->
<div id="cabenh-wrapper">
    <?php $form = ActiveForm::begin([
        'id' => 'phieudt',
        //    'enableAjaxValidation' => true,
//        'enableClientValidation' => false
    ]) ?>
    <?// echo $this->render('//messages/index', ['messages' => $psxh->getErrors()]); ?>
    <?// echo $this->render('//messages/errors', ['errors' => $psxh->getErrors()]); ?>
    <div class="card card-white">
        <div id="map-container" style="position: relative; height: 400px;">
            <leaflet
                    :zoom="10"
            ></leaflet>
        </div>


        <div class="card-header" v-cloak
             style="border-bottom: 1px solid #E8E4E4; background-color: rgba(255, 255, 255, 0.9); z-index: 10">
            <h6 class="card-title font-weight-semibold text-blue-600 float-left">
                <i class="icon-map5 position-left"></i> Sốt xuất huyết
                <span v-if="psxh.xmcabenh==null" class="badge badge-danger">
                    Chưa điều tra
                </span>
                <span v-if="psxh.xmcabenh==1" class="badge badge-success">
                    Đang điều tra
                 </span>
                <span v-if="psxh.xmcabenh==2" class="badge badge-success">
                    Chưa xuất viện
                 </span>
                <span v-if="psxh.xmcabenh==3" class="badge badge-primary">
                    Đã điều tra
                 </span>
            </h6>
            <div class="heading-elements float-right">
                <span class="heading-text">
                    <span v-if="psxh.kdc_pxk==1" class="badge badge-warning">
                        Không địa chỉ tại px, địa chỉ ở PX khác trong QH
                    </span>
                    <span v-if="psxh.kdc_qhk==1" class="badge badge-warning">
                        Không địa chỉ tại px, địa chỉ ở QH khác
                    </span>
                    <span v-if="psxh.kdc_tk==1" class="badge badge-warning">
                        Không tìm được địa chỉ
                    </span>
                    <span v-if="psxh.cdc_kbn_pxk==1" class="badge badge-warning">
                        Có địa chỉ, không BN, ca bệnh ở PX khác trong QH
                    </span>
                    <span v-if="psxh.cdc_kbn_qhk==1" class="badge badge-warning">
                        Ca bệnh ở QH khác
                    </span>
                    <span v-if="psxh.cdc_kbn_tk==1" class="badge badge-warning">
                        Ca bệnh ở tỉnh khác/ không biết
                    </span>
                    <span v-if="psxh.cdc_cbn_sxh==1" class="badge badge-warning">
                        Có địa chỉ, có bệnh nhân, SXH
                    </span>
                    <span v-if="psxh.cdc_cbn_sot==1 || psxh.cdc_cbn_benhkhac==1"
                          class="badge badge-warning">
                        Có địa chỉ, có bệnh nhân, không SXH
                    </span>
                </span>

                <div class="heading-btn">
                    <div v-show="chuyenca">
                        <button type="button" id="btnSubmitCC" class="btn bg-danger-400 btn-labeled btn-labeled-left btn-rounded"><b><i
                                        class="icon-file-check"></i></b> Chuyển ca
                        </button>
                    </div>
                    <div v-show="chapnhan">
                        <button type="button" id="btnSubmitForm" class="btn bg-primary-400 btn-labeled btn-labeled-left btn-rounded">
                            <b><i class="icon-file-check"></i></b> <?= isset($this->params['button']) ? $this->params['button'] : '' ?>
                        </button>
                    </div>
                    <div v-show="traca">
                        <button type="button" id="btnSubmitTC" class="btn bg-warning-400 btn-labeled btn-labeled-left btn-rounded"><b><i
                                        class="icon-file-check"></i></b> Trả ca
                        </button>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="card-body">
            <?php //include_once(__DIR__ . '/partials/_0_bando.php') ?>
            <fieldset>
                <legend class="font-weight-semibold">
                    <i class="icon-file-text2 position-left"></i>
                    Phiếu điều tra
                    <a class="control-arrow" data-toggle="collapse" data-target="#phieusxh" aria-expanded="true">
                        <i class="icon-circle-down2"></i>
                    </a>
                </legend>

                <div class="collapse in" id="phieusxh">

                    <header id="header">
                        <p class="text-primary-300">Phiếu điều tra</p>
                        <p class="text-primary">Ca bệnh sốt xuất huyết Dengue</p>
                    </header>
                    <div class="phieu-body">
                        <?php //include_once(__DIR__ . '/partials/_1_xacminh.php') ?>

                        <div v-if="xmcabenh" class="animated" transition="bounce">
                            <?php //include_once(__DIR__ . '/partials/_2_dieutra.php') ?>

                            <?php //include_once(__DIR__ . '/partials/_3_xuly.php') ?>

                        </div>

                        <div class="row">
                            <div class="col-md-6 pull-right">
                                <?php //echo $form->field($psxh, 'nguoidieutra') ?>
                            </div>

                        </div>
                        <?php// if($psxh->chuyenca1):?>

                       <!-- <div class="row">
                            <div class="col-md-6 pull-right">
                                <h6 class="text-info">Danh sách thông tin chuyển ca</h6>
                                <table class="table table-borderd">
                                    <thead>
                                    <tr>
                                        <th>Quận</th>
                                        <th>Phường</th>
                                        <th>Người điều tra</th>
                                        <th>Điện thoại</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?/*=$chca_info->ten_quan*/?></td>
                                        <td><?/*=$chca_info->ten_phuong*/?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>-->
                        <?php// endif;?>

                    </div>
                </div>
            </fieldset>

        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>
<?php $this->beginBlock('styles'); ?>
<?php
//AltairAsset::register($this);
//AltairTopAsset::register($this);
?>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('scripts'); ?>
<!--<link rel="stylesheet" href="<?/*= url('/libs/bower/leaflet/dist/leaflet.css') */?>">
<script src="<?/*= url('/libs/bower/leaflet/dist/leaflet.js') */?>"></script>
<script src="<?/*= url('/pcd/core/libs/map/core/Leaflet.extra-markers/dist/js/leaflet.extra-markers.min.js') */?>"></script>
<script src="<?/*= asset('app/assets/js/app_map.js') */?>"></script>
<?php /*$this->endBlock(); */?>

<script !src="">
    $(function () {

        $('#btnSubmitCC').click(function () {
            if (!confirm('Bạn có chắc chắn muốn chuyển ca này đi không?')) {
                return false;
            }
            $('#phieudt').submit();
        })

        $('#btnSubmitTC').click(function () {
            if (!confirm('Bạn có chắc chắn muốn trả ca này không?')) {
                return false;
            }
            $('#phieudt').submit();
        })

        $('#btnSubmitForm').click(function () {
            $('#phieudt').submit();
        })

    });


    var myMixin = {
        ready: function () {
            var self = this;
            // Xử lý lỗi không nhận px1 thêm mới ca
            $('#vphieusxh-px1').on('depdrop.afterChange', function (event) {
                self.psxh.px1 = $(this).val();
            });

            $('input[type="radio"]').parent().css('margin-right', '10px');
            App.init();

        },
        data: {
            psxh: <?/*= json_encode($psxh->attributes, JSON_NUMERIC_CHECK)*/?>,
            dsbv: <?/*= json_encode(DichteApi::getDsBV()) */?>,
            role: <?/*= json_encode(PQService::getRolePQOfCurrentUser()->attributes); */?>,
            bound: <?/*= json_encode(co_pqpx()->getBound()); */?>,
            chuyenca: null,
            traca: null,
            chapnhan: null,
        },
        computed: {
            xmcabenh: function () {
                var xmcabenh = 0;

                // Có địa chỉ, có bệnh nhân -> dc1:1 - bn1:1
                if (this.psxh.diachi1 == 1 && this.psxh.benhnhan1 == 1) {

                    // Bệnh nhân sông một nơi-> noikhac:0
                    if (this.psxh.benhnoikhac == 0) {
                        xmcabenh = 1;
                    }
                    // Bệnh nhân sống 2 nơi -> noikhac:1 (chuyển ca)
                    if (this.psxh.benhnoikhac == 1) {
                        xmcabenh = 1;
                    }
                    // Xét chuyển ca

                }

                // Có địa chỉ, không bệnh nhân -> dc1:1 - bn1:0
                if ((this.psxh.diachi1 == 1 || this.psxh.diachi1 == 0) && this.psxh.benhnhan1 == 0) {
                    // Xác minh địa chỉ khác BN -> dc2:1
                    if (this.psxh.diachi2 == 1) {
                        if (this.psxh.px1 == this.psxh.px2 && this.psxh.px2 != null) {
                            xmcabenh = 1;
                            if (this.psxh.chuyenca1 && this.psxh.benhnhan3 === 1) {
                                xmcabenh = 1;

                            } else if (this.psxh.chuyenca1 && (this.psxh.benhnhan3 == null || this.psxh.benhnhan3 == 0)) {
                                xmcabenh = 0;
                            }

                        } else if (this.psxh.tinh2 == 'TinhKhac') {
                            console.log(1);
                            xmcabenh = 0;
                        }
                    }

                    // K Xác minh địa chỉ khác BN -> dc2:0 => Khóa hết, kết thúc, ĐÃ ĐIỀU TRA
                    if (this.psxh.diachi2 == 0) {

                    }

                }

                if (this.psxh.chuyenca_filter != 2) {
                    if (this.psxh.px1 != this.psxh.px2 && this.psxh.px2 != null && this.psxh.px2 != '' && !this.psxh.chuyeca1) {
                        this.chuyenca = 1;
                    } else {
                        this.chuyenca = 0;
                    }

                    if (this.psxh.benhnhan3 == 0 && this.psxh.chuyenca1) {
                        this.traca = 1;
                    } else {
                        this.traca = 0;
                    }

                    if (!this.chuyenca && !this.traca) {
                        this.chapnhan = 1;
                    } else {
                        this.chapnhan = 0;
                    }
                }

                return xmcabenh;
            },
        },
        watch: {
            'psxh': {
                handler: function (val, oldVal) {

                    var self = this;
                    this.initAutoBV();
                    $('.i-datepicker').datepicker(defaultDatepicker);
                    $('input[type="radio"]').parent().css('margin-right', '10px');

                    var vphieusxh_px2 = $('#vphieusxh-px2').attr('data-krajee-depdrop');
                    $('#vphieusxh-px2').depdrop(eval(vphieusxh_px2)).on('depdrop.afterChange', function (event) {
                        self.psxh.px2 = $('#vphieusxh-px2').val();
                    });

                    var vphieusxh_px3 = $('#vphieusxh-px3').attr('data-krajee-depdrop');
                    if (typeof vphieusxh_px3 != 'undefined') {
                        $('#vphieusxh-px3').depdrop(eval(vphieusxh_px3)).on('depdrop.afterChange', function (event) {
                            self.psxh.px3 = $('#vphieusxh-px3').val();
                        });
                    }

                    var vphieusxh_pxkhac = $('#vphieusxh-pxkhac').attr('data-krajee-depdrop');
                    $('#vphieusxh-pxkhac').depdrop(eval(vphieusxh_pxkhac)).on('depdrop.afterChange', function (event) {
                        self.psxh.pxkhac = $('#vphieusxh-pxkhac').val();
                    });

                    var vphieusxh_dclamviecpx = $('#vphieusxh-dclamviecpx').attr('data-krajee-depdrop');
                    $('#vphieusxh-dclamviecpx').depdrop(eval(vphieusxh_dclamviecpx));

                    $('#vphieusxh-tpbv_bv').select2({
                        placeholder: 'Chọn bệnh viện',
                        allowClear: true
                    });

                },
                deep: true,
            }
        },
        methods: {
            initAutoBV: function () {

//                var benhvien = new Bloodhound({
//                    datumTokenizer: Bloodhound.tokenizers.whitespace,
//                    queryTokenizer: Bloodhound.tokenizers.whitespace,
//                    local: this.dsbv
//                });
//                console.log(this.dsbv);


                $('.autoBV').typeahead("destroy")
                $('.autoBV').typeahead(
                    {
                        hint: true,
                        highlight: true,
                        minLength: 1
                    },
                    {
                        name: 'dsbv',
                        displayKey: 'value',
                        source: this.substringMatcher(this.dsbv)
                    }
                );
            },
            substringMatcher: function (strs) {
                return function findMatches(q, cb) {
                    var matches, substringRegex;

                    // an array that will be populated with substring matches
                    matches = [];

                    // regex used to determine if a string contains the substring `q`
                    substrRegex = new RegExp(q, 'i');

                    // iterate through the pool of strings and for any string that
                    // contains the substring `q`, add it to the `matches` array
                    $.each(strs, function (i, str) {
                        if (substrRegex.test(str)) {

                            // the typeahead jQuery plugin expects suggestions to a
                            // JavaScript object, refer to typeahead docs for more info
                            matches.push({value: str});
                        }
                    });

                    cb(matches);
                };
            },
        }
    }

    $(function () {
        $(".panel-heading").sticky({topSpacing: 0, zIndex: 1000});
    });
</script>


<script src="/libs/bower/jquery-sticky/jquery.sticky.js"></script>-->
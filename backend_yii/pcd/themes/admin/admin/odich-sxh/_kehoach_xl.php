
<div id="kehoach-xl-odsxh">
    <h6 class="font-weight-semibold">1.	Phạm vi khoanh vùng xử lý (tự lấy)</h6>
    <?= $form->field($khXulyOdsxh, 'odich_id')->textInput(['type' => 'hidden', 'value' => $model->id])->label(false) ?>
    <?= $form->field($khXulyOdsxh, 'created_by')->textInput(['type' => 'hidden', 'value' => \Yii::$app->user->id])->label(false) ?>
    <div class="row mx-2">
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'kp_ap')->textInput()->label('Khu phố/ấp') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'to_dp')->textInput()->label('Tổ dân phố') ?>
        </div>
    </div>

    <h6 class="font-weight-semibold">2.	Diệt lăng quăng</h6>
    <div class="row mx-2">
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'dietlq_phamvi')->textInput()->label('Các tổ:') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'dietlq_nhansu')->textInput(['type' => 'number'])->label('Số lượng nhân sự:') ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($khXulyOdsxh, 'dietlq_dot1')->textInput(['type' => 'date'])->label('Đợt 1: Ngày') ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($khXulyOdsxh, 'dietlq_dot2')->textInput(['type' => 'date'])->label('Đợt 2: Ngày') ?>
        </div>
    </div>

    <h6 class="font-weight-semibold mx-2">Bảng phân công nhân sự tham gia diệt lăng quăng</h6>
    <table class="table table-bordered mx-2 mb-2">
        <tr>
            <th>Tổ dân phố</th>
            <th>Nhân sự tham gia</th>
            <th><span class="btn btn-sm btn-outline-primary btn-icon" @click="addNhansuDietlq"><i class="icon-plus2"></i></span></th>
        </tr>
        <tr v-for="(ns, lqidx) in dietlqPhuluc">
            <td><input type="text" class="form-control" v-model="ns.todp"></td>
            <td><input type="text" class="form-control" v-model="ns.nhansu"></td>
            <td><span class="btn btn-sm btn-outline-danger btn-icon" @click="removeNhansuDietlq(lqidx)"><i class="icon-minus2"></i></span></td>
        </tr>
    </table>
    <input type="hidden" name="KehoachXulyOdsxh[dietlq_phuluc]" v-model="dietlqPL">
    
    <h6 class="font-weight-semibold">
        <span>3. Kiểm soát điểm nguy cơ</span>
        <button id="updateDNC" type="button" class="ml-2 btn badge bg-warning-400"> Cập nhật danh sách ĐNC</button>
    </h6>
    <div id="htmlDNC" style="max-height: 350px; overflow: auto; margin: 10px 0 10px 0"></div>
    <div class="row mx-2">
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'dnc_ngaybatdau')->textInput(['type' => 'date'])->label('Thời gian bắt đầu giám sát:') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'dnc_dvxuphat')->textInput()->label('Đơn vị xử phạt (nếu có):') ?>
        </div>
    </div>

    <h6 class="font-weight-semibold">4.	Hoạt động truyền thông</h6>
    <div class="row mx-2">
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'tt_diadiem')->textInput()->label('Địa điểm truyền thông:') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'tt_hinhthuckhac')->textInput()->label('Hình thức khác (nếu có):') ?>
        </div>
    </div>

    <h6 class="font-weight-semibold">5.	Hoạt động phun hóa chất</h6>
    <div class="row mx-2">
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'phc_soto')->textInput(['type' => 'number'])->label('Số tổ:') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'phc_sonha')->textInput(['type' => 'number'])->label('Số nhà:') ?>
        </div>
        <div class="col-md-12">
             <?= $form->field($khXulyOdsxh, 'phc_smn')->textInput(['type' => 'number'])->label('Số máy nhỏ:') ?>
        </div>
        <div class="col-md-6">
             <?= $form->field($khXulyOdsxh, 'phc_sml')->textInput(['type' => 'number'])->label('Số máy lớn:') ?>
        </div>
        <div class="col-md-6">
             <?= $form->field($khXulyOdsxh, 'phc_sml_tuyenduong')->textInput()->label('Đi các tuyền đường:') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'phc_lit')->textInput(['type' => 'number'])->label('Số lít hóa chất dự trù (lít):') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'phc_loaihc')->textInput()->label('Loại hóa chất:') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($khXulyOdsxh, 'phc_nhansu')->textInput(['type' => 'number'])->label('Nhân sự gồm (người):') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($khXulyOdsxh, 'phc_nhansu_mangmay')->textInput(['type' => 'number'])->label('Nhân sự mang máy:') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($khXulyOdsxh, 'phc_nhansu_danduong')->textInput(['type' => 'number'])->label('Nhân sự dẫn đường:') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($khXulyOdsxh, 'phc_nhansu_giamsat')->textInput(['type' => 'number'])->label('Nhân sự giám sát:') ?>
        </div>
    </div>
    <h6 class="font-weight-semibold mx-2">Thời gian phun hóa chất</h6>
    <div class="row mx-2">
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'phc_lan1')->textInput(['type' => 'date'])->label('Lần 1: ngày') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'phc_lan1_ghichu')->textInput()->label('Lúc') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'phc_lan2')->textInput(['type' => 'date'])->label('Lần 2: ngày') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($khXulyOdsxh, 'phc_lan2_ghichu')->textInput()->label('Lúc') ?>
        </div>
    </div>

    <h6 class="font-weight-semibold mx-2">Bảng phân công nhân sự tham gia diệt lăng quăng</h6>
    <table class="table table-bordered mx-2 mb-2">
        <tr>
            <th>STT máy</th>
            <th>Địa điểm phun</th>
            <th>Nhân sự phun</th>
            <th>Nhân sự dẫn đường</th>
            <th>Nhân sự giám sát</th>
            <th><span class="btn btn-sm btn-outline-primary btn-icon" @click="addNhansuPhc"><i class="icon-plus2"></i></span></th>
        </tr>
        <tr v-for="(ns, phcidx) in phcPhuluc">
            <td><input type="text" class="form-control" v-model="ns.stt"></td>
            <td><input type="text" class="form-control" v-model="ns.diadiem"></td>
            <td><input type="text" class="form-control" v-model="ns.nhansu"></td>
            <td><input type="text" class="form-control" v-model="ns.danduong"></td>
            <td><input type="text" class="form-control" v-model="ns.giamsat"></td>
            <th><span class="btn btn-sm btn-outline-danger btn-icon" @click="removeNhansuPhc(phcidx)"><i class="icon-minus2"></i></span></th>
        </tr>
    </table>
    <input type="hidden" name="KehoachXulyOdsxh[phc_phuluc]" v-model="phcPL">

    <h6 class="font-weight-semibold">6.	Khảo sát côn trùng</h6>
    <div class="row mx-2">
        <div class="col-md-12">
            <?= $form->field($khXulyOdsxh, 'ct_lan1')->textInput(['type' => 'date'])->label('Lần 1 dự kiến vào ngày') ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($khXulyOdsxh, 'ct_lan2')->textInput(['type' => 'date'])->label('Lần 2 dự kiến vào ngày') ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($khXulyOdsxh, 'ct_lan3')->textInput(['type' => 'date'])->label('Lần 3 dự kiến vào ngày') ?>
        </div>
    </div>
    
    <h6 class="font-weight-semibold">7.	Kinh phí</h6>
    <div class="row mx-2">
        <div class="col-md-12">
            <?= $form->field($khXulyOdsxh, 'kinhphi')->textInput()->label('Kinh phí (VND):') ?>
        </div>
    </div>
</div>

<script>

    $(function() {



        var dietlq = JSON.parse(<?= json_encode($khXulyOdsxh->dietlq_phuluc, true) ?>);
        var phc = JSON.parse(<?= json_encode($khXulyOdsxh->phc_phuluc, true) ?>);
        var vm = new Vue({
            el: '#kehoach-xl-odsxh',
            data: {
                dietlqPhuluc: dietlq ? dietlq : [{todp: '', nhansu: ''}],
                phcPhuluc: phc ? phc : [{stt: '', diadiem: '', nhansu: '', giamsat: '', danduong: ''}]
            },
            computed: {
                dietlqPL: function() {
                    return JSON.stringify(this.dietlqPhuluc);
                },
                phcPL: function() {
                    return JSON.stringify(this.phcPhuluc)
                }
            },
            mounted(){
                $('#updateDNC').click(function () {
                    let progress = `<div class="progress"> <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%"> </div> </div>`
                    $('#htmlDNC').html(progress)
                    $.post('/api/odich/tim-dnc', {cabenhIds: <?=json_encode(collect($cabenhs)->pluck('gid'))?>}).done(function (resp) {
                        $('#htmlDNC')
                            .html(resp.html)
                            .find('table').floatThead();
                    })
                })
            },
            methods: {
                addNhansuDietlq: function() {
                    var length = this.dietlqPhuluc.length;

                    if(this.dietlqPhuluc[length - 1].todp != '' || this.dietlqPhuluc[length - 1].nhansu != '') {
                        this.dietlqPhuluc.push({todp: '', nhansu: ''});
                    }
                },

                removeNhansuDietlq: function(index) {
                    if(this.dietlqPhuluc.length > 1) {
                        this.dietlqPhuluc.splice(index, 1);
                    }
                },

                addNhansuPhc: function() {
                    var length = this.phcPhuluc.length;

                    if(this.phcPhuluc[length - 1].stt != '' || this.phcPhuluc[length - 1].diadiem != '' || 
                        this.phcPhuluc[length - 1].nhansu != '' || this.phcPhuluc[length - 1].danduong != '' || this.phcPhuluc[length - 1].giamsat != '') {
                        this.phcPhuluc.push({stt: '', diadiem: '', nhansu: '', giamsat: '', danduong: ''});
                    }
                },

                removeNhansuPhc: function(index) {
                    if(this.phcPhuluc.length > 1) {
                        this.phcPhuluc.splice(index, 1);
                    }
                }
            }
        })
    })
</script>
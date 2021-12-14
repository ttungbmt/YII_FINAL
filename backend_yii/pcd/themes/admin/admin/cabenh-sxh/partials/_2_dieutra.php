<?php
use kartik\widgets\DepDrop;
use kartik\widgets\DatePicker;
?>
<hr class="dashed">
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'songuoicutru')->textInput(['type' => 'number']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'cutruduoi15')->textInput(['type' => 'number'])->label('Trong đó số dưới 15 tuổi') ?>
    </div>
</div>

<!-- ĐIỀU TRA DỊCH TỂ ---------------------------------------------------->
<div class="phieu-title mb-1">
    <span class="badge badge-flat badge-pill border-primary text-primary">2</span> Điều tra dịch tễ
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'tpbv')->radioList($yesno, ['inline' => true, 'itemOptions' => ['v-model.number' => 'm.tpbv']]) ?>
        <div v-if="m.tpbv===1" class="animated">
            <div class="form-group">
                <?= $form->field($model, 'tpbv_bv')->dropDownList($benhvien, [
                    'prompt' => 'Chọn bệnh viện...',
                    'disabled' => array_key_exists($model->tpbv_bv, $benhvien) ? true : false,
//                    'options' => [$model->tpbv_bv => ['Selected' => true],]
                ])->label('Tên bệnh viện');?>
            </div>
        </div>
    </div>
    <div class="col-md-6" v-if="m.tpbv===0">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'phcd')->radioList($yesno, ['inline' => true, 'itemOptions' => ['v-model.number' => 'm.phcd']]) ?>
            </div>
            <div v-if="m.phcd===1" class="col-md-6">
                <?= $form->field($model, 'nhapvien')->radioList($yesno, ['inline' => true, 'itemOptions' => ['v-model.number' => 'm.nhapvien']]) ?>
            </div>

        </div>
        <div v-if="m.phcd===1 && m.nhapvien===1" class="form-group">
            <?= $form->field($model, 'nhapvien_bv')->textInput(['class' => 'form-control autoBV'])->label('Tên bệnh viện') ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'ngaymacbenh')->widget(DatePicker::class) ?>
    </div>
    <div class="col-md-3" v-if="m.nhapvien !== 0">
        <?= $form->field($model, 'ngaynhapvien')->widget(DatePicker::class) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'nghenghiep') ?>
    </div>
</div>

<div id="row-xn" class="row" style="background-color: white; border: 1px solid #e2dddd; border-radius: 4px; padding-top: 4px">
    <div class="col-md-3">
        <?= $form->field($model, 'xetnghiem')->radioList($yesno, ['inline' => true, 'itemOptions' => ['v-model.number' => 'm.xetnghiem']]) ?>
    </div>
    <div class="col-md-9" v-if="m.xetnghiem === 1">
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'ngaylaymau')->widget(DatePicker::class) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'loai_xn')->dropDownList($loai_xn, [
                    'prompt' => 'Chọn...',
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'ketqua_xn')->dropDownList($ketqua_xn, [
                    'id' => 'ketqua_xn',
                    'prompt' => 'Chọn...',
                ]) ?>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-3">
        <?= $form->field($model, 'dclamviec') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'dclamviec_tinh')->dropDownList($dmTinh, [
            'id' => 'dclamviec_tinh',
            'prompt' => 'Chọn tỉnh...',
            'v-model' => 'm.dclamviec_tinh'
        ])->label('Tỉnh') ?>
    </div>
    <div class="col-md-3" v-if="m.dclamviec_tinh == '79'">
        <?= $form->field($model, 'dclamviecqh')->dropDownList(api('/dm/quan'), [
            'prompt'  => 'Chọn quận huyện...',
            'id'      => 'drop-dclamviecqh',
            'disabled' => $disabled_dc3,
            'v-model' => 'm.dclamviecqh',
        ]) ?>
    </div>
    <div class="col-md-3" v-if="m.dclamviec_tinh == '79'">
        <?= $form->field($model, 'dclamviecpx')->widget(DepDrop::className(), [
            'options'       => ['prompt' => 'Chọn phường...', 'v-model' => 'm.dclamviecpx'],
            'pluginOptions' => [
                'depends'      => ['drop-dclamviecqh'],
                'url'          => url(['/api/dm/phuong']),
                'initialize' => true,
            ],
        ]) ?>
    </div>
</div>

<div class="form-group">
    <?= $form->field($model, 'noilamviec_sxh')->radioList([1 => 'Có', 0 => 'Không', 9 => 'Không rõ'], ['inline' => true])->label('Tại nơi làm việc, trong vòng 2 tuần qua có ai bị SXH / nghi ngờ SXH / sốt không?') ?>
</div>
<div class="form-group">
    Trong vòng 2 tuần trước khi bị bệnh, BN có đi đến hay thường đến những nơi nào sau đây (đánh dấu nhiều ô):
</div>

<div class="row">
    <div class="col-md-3"> Nhà có BN SXH</div>
    <div class="col-md-9"> <?= $form->field($model, 'nhacobnsxh')->radioList($yesno, ['inline' => true])->label(false) ?> </div>

    <div class="col-md-3"> Nhà có người bệnh</div>
    <div class="col-md-9"> <?= $form->field($model, 'nhaconguoibenh')->radioList($yesno, ['inline' => true])->label(false) ?> </div>

    <div class="col-md-3"> BV PK</div>
    <div class="col-md-9"> <?= $form->field($model, 'bvpk')->radioList($yesno, ['inline' => true])->label(false) ?> </div>

    <div class="col-md-3"> Nhà thờ</div>
    <div class="col-md-9"> <?= $form->field($model, 'nhatho')->radioList($yesno, ['inline' => true])->label(false) ?> </div>

    <div class="col-md-3"> Đình chùa</div>
    <div class="col-md-9"> <?= $form->field($model, 'dinh')->radioList($yesno, ['inline' => true])->label(false) ?> </div>

    <div class="col-md-3"> Công viên</div>
    <div class="col-md-9"> <?= $form->field($model, 'congvien')->radioList($yesno, ['inline' => true])->label(false) ?> </div>

    <div class="col-md-3"> Nơi hội họp</div>
    <div class="col-md-9"> <?= $form->field($model, 'noihoihop')->radioList($yesno, ['inline' => true])->label(false) ?> </div>

    <div class="col-md-3"> Nơi xây dựng</div>
    <div class="col-md-9"> <?= $form->field($model, 'noixd')->radioList($yesno, ['inline' => true])->label(false) ?> </div>

    <div class="col-md-3"> Quán cà phê/internet</div>
    <div class="col-md-9"> <?= $form->field($model, 'cafe')->radioList($yesno, ['inline' => true])->label(false) ?> </div>

    <div class="col-md-3"> Nơi chăn nuôi</div>
    <div class="col-md-9"> <?= $form->field($model, 'noichannuoi')->radioList($yesno, ['inline' => true])->label(false) ?> </div>

    <div class="col-md-3"> Nơi bán cây cảnh</div>
    <div class="col-md-9"> <?= $form->field($model, 'noibancay')->radioList($yesno, ['inline' => true])->label(false) ?> </div>

    <div class="col-md-3"> Vựa phế liệu</div>
    <div class="col-md-9"> <?= $form->field($model, 'vuaphelieu')->radioList($yesno, ['inline' => true])->label(false) ?> </div>

    <div class="col-md-3"> Khác</div>
    <div class="col-md-9"> <?= $form->field($model, 'noikhac')->radioList($yesno, ['inline' => true, 'itemOptions' => ['v-model.number' => 'm.noikhac']])->label(false) ?> </div>
</div>

<div class="row" v-if="m.noikhac===1">
    <div class="col-md-5"> <?= $form->field($model, 'noikhac_ghichu')->label(false) ?> </div>
</div>

<div class="form-group">
    Các điểm đã đến ghi ở trên thuộc địa bàn (đánh dấu nhiều ô):
</div>

<div class="row">
    <div class="col-md-3"> PX</div>
    <div class="col-md-4">
        <?= $form->field($model, 'diemden_px')->radioList($yesno, ['inline' => true])->label(false) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3"> PX khác</div>
    <div class="col-md-4">
        <?= $form->field($model, 'diemden_pxkhac')->radioList($yesno, ['inline' => true])->label(false) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3"> QH khác</div>
    <div class="col-md-4">
        <?= $form->field($model, 'diemden_qhkhac')->radioList($yesno, ['inline' => true])->label(false) ?>
    </div>
</div>


<div class="form-group">
    Trong vòng 1 tháng qua, tại gia đình
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'gdcosxh')->radioList($yesnonull, ['inline' => true, 'itemOptions' => ['v-model.number' => 'm.gdcosxh']])->label('Có người mắc bệnh SXH không?') ?>
    </div>
    <div class="col-md-6" v-if="m.gdcosxh===1">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'gdsonguoisxh')->textInput(['type' => 'number']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'gdso15t')->textInput(['type' => 'number']) ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'gdthuocsxh')->radioList($yesnonull, ['inline' => true, 'itemOptions' => ['v-model.number' => 'm.gdthuocsxh']])->label('Có người mắc bệnh sốt hoặc có uống thuốc hạ sốt?') ?>
    </div>
    <div class="col-md-6" v-if="m.gdthuocsxh===1">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'gdthuocsxhsonguoi')->textInput(['type' => 'number']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'gdthuocsxh15t')->textInput(['type' => 'number']) ?>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    (nếu có người mắc bệnh SXH, điều tra ca bệnh tiếp tục theo mẫu điều tra này)
</div>

<!-- KHẢO SÁT LĂNG QUĂNG ---------------------------------------------------->
<div class="phieu-title mb-1">
    <span class="badge badge-flat badge-pill border-primary text-primary">3</span> Khảo sát lăng quăng
</div>
<p>Khảo sát khi ca bệnh là ca chỉ điểm / ca đầu tiên.</p>
<ul>
    <li>Mục đích khảo sát là để có quyết định xử lý như ổ dịch nhỏ hay không.</li>
    <li>Nếu là các ca thứ phát chỉ khảo sát trong quá trình xử lý ổ dịch.</li>
</ul>
<p>Khảo sát nhà ca bệnh và 15 nhà chung quanh theo mẫu khảo sát lăng quăng.</p>
<div class="form-inline">
    <div class="form-group">
        <label class="control-label cursor-pointer" for="">Kết quả:</label>
    </div>
    <?= $form->field($model, 'bi')->textInput(['type' => 'number']) ?>
    <?= $form->field($model, 'ci')->textInput(['type' => 'number']) ?>
</div>

<!-- HƯỚNG XỬ LÝ ---------------------------------------------------->
<div class="phieu-title mb-1 mt-2">
    <span class="badge badge-flat badge-pill border-primary text-primary">4</span> Hướng xử lý
</div>
<p class="font-weight-semibold text-primary">Ca bệnh</p>
<div class="row">
    <div class="col-md-4 font-weight-semibold"> 1. Ca bệnh chỉ điểm/ca bệnh đầu tiên</div>
    <div class="col-md-4">
        <?= $form->field($model, 'cachidiem')->radioList($yesno, ['inline' => true, 'itemOptions' => ['v-model.number' => 'm.cachidiem']])->label(false) ?>
    </div>
</div>
<div v-if="m.cachidiem===1" class="animated">
    <div class="form-group font-weight-semibold"> Dự kiến xử lý</div>
    <div class="row">
        <div class="col-md-4"> Diệt lăng quăng diệt muỗi/gia đình</div>
        <div class="col-md-8"> <?= $form->field($model, 'dietlangquang')->radioList($yesno, ['inline' => true])->label(false) ?> </div>

        <div class="col-md-4"> Giám sát theo dõi</div>
        <div class="col-md-8"> <?= $form->field($model, 'giamsattheodoi')->radioList($yesno, ['inline' => true])->label(false) ?> </div>

        <div class="col-md-4"> Xử lý ổ dịch</div>
        <div class="col-md-8"> <?= $form->field($model, 'xulyonho')->radioList($yesno, ['inline' => true])->label(false) ?> </div>
        <div class="col-md-4"> Xử lý diện rộng</div>
        <div class="col-md-8"> <?= $form->field($model, 'xulyorong')->radioList($yesno, ['inline' => true])->label(false) ?> </div>
    </div>
</div>
<div class="row" v-if="m.cachidiem===0">
    <div class="col-md-4 font-weight-semibold"> 2. Ca bệnh thứ phát</div>
    <div class="col-md-4">
        <?= $form->field($model, 'cathuphat')->radioList($yesno, ['inline' => true, 'itemOptions' => ['v-model.number' => 'm.cathuphat']])->label(false) ?>
    </div>
</div>
<div v-if="m.cathuphat === 1&& m.cachidiem===0" class="animated">
    <div class="row">
        <div class="col-md-4">Ổ dịch mới</div>
        <div class="col-md-4"><?= $form->field($model, 'odichmoi')->radioList($yesno, ['inline' => true])->label(false) ?></div>
    </div>
    <div class="row">
        <div class="col-md-4">Ổ dịch cũ đã xác định</div>
        <div class="col-md-2">
            <?= $form->field($model, 'odichcu')->radioList($yesno, ['inline' => true, 'itemOptions' => ['v-model.number' => 'm.odichcu']])->label(false) ?>
        </div>
        <div class="col-md-2" v-if="m.odichcu===1"> Xử lý</div>
        <div class="col-md-2" v-if="m.odichcu===1">
            <?= $form->field($model, 'odichcu_xuly')->textInput(['type' => 'number'])->label(false) ?>
        </div>
        <div class="col-md-1" v-if="m.odichcu===1"> ngày</div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'xuly')->radioList($xuly, ['inline' => true, 'itemOptions' => ['v-model.number' => 'm.xuly']])->label(false) ?>
        </div>
        <div class="col-md-2" v-if="m.xuly===3"> Sau xử lý</div>
        <div class="col-md-2" v-if="m.xuly===3">
            <?= $form->field($model, 'xuly_ngay')->textInput(['type' => 'number'])->label(false) ?>
        </div>
        <div class="col-md-1" v-if="m.xuly===3"> ngày</div>
    </div>
</div>

<?php

use kartik\select2\Select2;
use kartik\typeahead\Typeahead;
use kartik\widgets\DepDrop;
use yii\helpers\Html;
$dmTinh = ['01' => 'Thành phố Hà Nội', '02' => 'Tỉnh Hà Giang', '04' => 'Tỉnh Cao Bằng', '06' => 'Tỉnh Bắc Kạn', '08' => 'Tỉnh Tuyên Quang', '10' => 'Tỉnh Lào Cai', '11' => 'Tỉnh Điện Biên', '12' => 'Tỉnh Lai Châu', '14' => 'Tỉnh Sơn La', '15' => 'Tỉnh Yên Bái', '17' => 'Tỉnh Hoà Bình', '19' => 'Tỉnh Thái Nguyên', '20' => 'Tỉnh Lạng Sơn', '22' => 'Tỉnh Quảng Ninh', '24' => 'Tỉnh Bắc Giang', '25' => 'Tỉnh Phú Thọ', '26' => 'Tỉnh Vĩnh Phúc', '27' => 'Tỉnh Bắc Ninh', '30' => 'Tỉnh Hải Dương', '31' => 'Thành phố Hải Phòng', '33' => 'Tỉnh Hưng Yên', '34' => 'Tỉnh Thái Bình', '35' => 'Tỉnh Hà Nam', '36' => 'Tỉnh Nam Định', '37' => 'Tỉnh Ninh Bình', '38' => 'Tỉnh Thanh Hoá', '40' => 'Tỉnh Nghệ An', '42' => 'Tỉnh Hà Tĩnh', '44' => 'Tỉnh Quảng Bình', '45' => 'Tỉnh Quảng Trị', '46' => 'Tỉnh Thừa Thiên Huế', '48' => 'Thành phố Đà Nẵng', '49' => 'Tỉnh Quảng Nam', '51' => 'Tỉnh Quảng Ngãi', '52' => 'Tỉnh Bình Định', '54' => 'Tỉnh Phú Yên', '56' => 'Tỉnh Khánh Hoà', '58' => 'Tỉnh Ninh Thuận', '60' => 'Tỉnh Bình Thuận', '62' => 'Tỉnh Kon Tum', '64' => 'Tỉnh Gia Lai', '66' => 'Tỉnh Đắk Lắk', '67' => 'Tỉnh Đắk Nông', '68' => 'Tỉnh Lâm Đồng', '70' => 'Tỉnh Bình Phước', '72' => 'Tỉnh Tây Ninh', '74' => 'Tỉnh Bình Dương', '75' => 'Tỉnh Đồng Nai', '77' => 'Tỉnh Bà Rịa - Vũng Tàu', '79' => 'Thành phố Hồ Chí Minh', '80' => 'Tỉnh Long An', '82' => 'Tỉnh Tiền Giang', '83' => 'Tỉnh Bến Tre', '84' => 'Tỉnh Trà Vinh', '86' => 'Tỉnh Vĩnh Long', '87' => 'Tỉnh Đồng Tháp', '89' => 'Tỉnh An Giang', '91' => 'Tỉnh Kiên Giang', '92' => 'Thành phố Cần Thơ', '93' => 'Tỉnh Hậu Giang', '94' => 'Tỉnh Sóc Trăng', '95' => 'Tỉnh Bạc Liêu', '96' => 'Tỉnh Cà Mau'];

?>
<style>
    .bold {
        font-weight: bold;
    }
</style>

<hr class="dashed">
<div class="row">
    <div class="col-md-6">
        <?= $form->field($psxh, 'songuoicutru')->textInput(['type' => 'number']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($psxh, 'cutruduoi15')->textInput(['type' => 'number'])->label('Trong đó số dưới 15 tuổi') ?>
    </div>
</div>

<!-- ĐIỀU TRA DỊCH TỂ ---------------------------------------------------->
<div class="phieu-title mb-10">
    <span class="badge badge-flat border-primary text-primary bold">2</span> Điều tra dịch tễ
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($psxh, 'tpbv')->radioList($yesno, ['itemOptions' => ['v-model' => 'psxh.tpbv']]) ?>
        <div v-if="psxh.tpbv=='1'" class="animated" transition="bounce">
            <div class="form-group">
                <?php
                echo $form->field($psxh, 'tpbv_bv')->dropDownList($benhvien, [
                    'prompt' => 'Chọn bệnh viện...',
                    'disabled' => array_key_exists($psxh->tpbv_bv, $benhvien) ? true : false,
                    'options' => [$psxh->tpbv_bv => ['Selected' => true],]
                ])->label('Tên bệnh viện');

                //                echo "<input type='text' class='form-control' value='{$psxh->tpbv_bv}' disabled>";
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-6" v-if="psxh.tpbv=='0'" class="animated" transition="bounce">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($psxh, 'phcd')->radioList($yesno, ['itemOptions' => ['v-model' => 'psxh.phcd']]) ?>
            </div>
            <div v-if="psxh.phcd=='1'" class="animated" transition="bounce">
                <div class="col-md-6">
                    <?= $form->field($psxh, 'nhapvien')->radioList($yesno, ['itemOptions' => ['v-model' => 'psxh.nhapvien', 'number']]) ?>
                </div>
            </div>

        </div>
        <div v-if="psxh.phcd=='1' && psxh.nhapvien=='1'" class="animated" transition="bounce">
            <div class="form-group">
                <?= $form->field($psxh, 'nhapvien_bv')->textInput(['class' => 'form-control autoBV'])->label('Tên bệnh viện') ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <?= $form->field($psxh, 'ngaymacbenh')->textInput(['placeholder' => 'DD/MM/YYY', 'class' => 'form-control i-datepicker']); ?>
    </div>
    <div class="col-md-3" v-if="psxh.nhapvien != 0">
        <?= $form->field($psxh, 'ngaynhapvien')->textInput(['class' => 'form-control i-datepicker', 'placeholder' => 'DD/MM/YYY']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($psxh, 'nghenghiep') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($psxh, 'dclamviec') ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($psxh, 'dclamviec_khac')->dropDownList($dmTinh, [
            'id' => 'dclamviec_khac',
            'prompt' => 'Chọn tình...',
            'options' => [
                '79' => ['Selected' => true],
            ],
            'v-model' => 'psxh.dclamviec_khac'
        ])->label('Tỉnh') ?>
    </div>
    <div class="col-md-3" v-if="psxh.dclamviec_khac == '79'">
        <?= $form->field($psxh, 'dclamviecqh')->dropDownList(co_pqpx()->listQH(), [
            'id' => 'dclamviecqh',
            'prompt' => 'Chọn...',
            'options' => [
                co_pqpx()->selectQH($psxh->dclamviecqh) => ['Selected' => true],
            ]
        ])->label('Quận huyện'); ?>
    </div>
    <div class="col-md-3" v-if="psxh.dclamviec_khac == '79'">
        <input type="hidden" id="dclamviecpx_param" value="<?= $psxh->dclamviecpx; ?>">
        <?= $form->field($psxh, 'dclamviecpx')->widget(DepDrop::classname(), [
            'pluginOptions' => [
                'depends' => [
                    'dclamviecqh'
                ],
                'placeholder' => 'Chọn...',
                'initialize' => true,
                'url' => url_home('apis/role-list-px?filter=0'),
                'params' => ['dclamviecpx_param']
            ]
        ])->label('Phường xã'); ?>
    </div>
</div>

<div class="form-group">
    <?= $form->field($psxh, 'noilamviec_sxh')->radioList([1 => 'Có', 0 => 'Không', 9 => 'Không rõ'])->label('Tại nơi làm việc, trong vòng 2 tuần qua có ai bị SXH / nghi ngờ SXH / sốt không?') ?>
</div>
<div class="form-group">
    Trong vòng 2 tuần trước khi bị bệnh, BN có đi đến hay thường đến những nơi nào sau đây (đánh dấu nhiều ô):
</div>

<div class="row">
    <div class="col-md-3"> Nhà có BN SXH</div>
    <div class="col-md-9"> <?= $form->field($psxh, 'nhacobnsxh')->radioList($yesno)->label(false) ?> </div>

    <div class="col-md-3"> Nhà có người bệnh</div>
    <div class="col-md-9"> <?= $form->field($psxh, 'nhaconguoibenh')->radioList($yesno)->label(false) ?> </div>

    <div class="col-md-3"> BV PK</div>
    <div class="col-md-9"> <?= $form->field($psxh, 'bvpk')->radioList($yesno)->label(false) ?> </div>

    <div class="col-md-3"> Nhà thờ</div>
    <div class="col-md-9"> <?= $form->field($psxh, 'nhatho')->radioList($yesno)->label(false) ?> </div>

    <div class="col-md-3"> Đình chùa</div>
    <div class="col-md-9"> <?= $form->field($psxh, 'dinh')->radioList($yesno)->label(false) ?> </div>

    <div class="col-md-3"> Công viên</div>
    <div class="col-md-9"> <?= $form->field($psxh, 'congvien')->radioList($yesno)->label(false) ?> </div>

    <div class="col-md-3"> Nơi hội họp</div>
    <div class="col-md-9"> <?= $form->field($psxh, 'noihoihop')->radioList($yesno)->label(false) ?> </div>

    <div class="col-md-3"> Nơi xây dựng</div>
    <div class="col-md-9"> <?= $form->field($psxh, 'noixd')->radioList($yesno)->label(false) ?> </div>

    <div class="col-md-3"> Quán cà phê/internet</div>
    <div class="col-md-9"> <?= $form->field($psxh, 'cafe')->radioList($yesno)->label(false) ?> </div>

    <div class="col-md-3"> Nơi chăn nuôi</div>
    <div class="col-md-9"> <?= $form->field($psxh, 'noichannuoi')->radioList($yesno)->label(false) ?> </div>

    <div class="col-md-3"> Nơi bán cây cảnh</div>
    <div class="col-md-9"> <?= $form->field($psxh, 'noibancay')->radioList($yesno)->label(false) ?> </div>

    <div class="col-md-3"> Vựa phế liệu</div>
    <div class="col-md-9"> <?= $form->field($psxh, 'vuaphelieu')->radioList($yesno)->label(false) ?> </div>

    <div class="col-md-3"> Khác</div>
    <div class="col-md-9"> <?= $form->field($psxh, 'noikhac')->radioList($yesno, ['itemOptions' => ['v-model' => 'psxh.noikhac']])->label(false) ?> </div>
</div>

<div class="row" v-if="psxh.noikhac=='1'" class="animated" transition="bounce">
    <div class="col-md-5"> <?= $form->field($psxh, 'noikhac_ghichu')->label(false) ?> </div>
</div>

<div class="form-group">
    Các điểm đã đến ghi ở trên thuộc địa bàn (đánh dấu nhiều ô):
</div>

<div class="row">
    <div class="col-md-3"> PX</div>
    <div class="col-md-4">
        <?= $form->field($psxh, 'diemden_px')->radioList($yesno)->label(false) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3"> PX khác</div>
    <div class="col-md-4">
        <?= $form->field($psxh, 'diemden_pxkhac')->radioList($yesno)->label(false) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3"> QH khác</div>
    <div class="col-md-4">
        <?= $form->field($psxh, 'diemden_qhkhac')->radioList($yesno)->label(false) ?>
    </div>
</div>


<div class="form-group">
    Trong vòng 1 tháng qua, tại gia đình
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($psxh, 'gdcosxh')->radioList($yesnonull, ['itemOptions' => ['v-model' => 'psxh.gdcosxh']])->label('Có người mắc bệnh SXH không?') ?>
    </div>
    <div v-if="psxh.gdcosxh=='1'" class="animated" transition="bounce">
        <div class="col-md-3">
            <?= $form->field($psxh, 'gdsonguoisxh')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($psxh, 'gdso15t')->textInput(['type' => 'number']) ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($psxh, 'gdthuocsxh')->radioList($yesnonull, ['itemOptions' => ['v-model' => 'psxh.gdthuocsxh']])->label('Có người mắc bệnh sốt hoặc có uống thuốc hạ sốt?') ?>
    </div>
    <div v-if="psxh.gdthuocsxh=='1'" class="animated" transition="bounce">
        <div class="col-md-3">
            <?= $form->field($psxh, 'gdthuocsxhsonguoi')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($psxh, 'gdthuocsxh15t')->textInput(['type' => 'number']) ?>
        </div>
    </div>
</div>
<div class="form-group">
    (nếu có người mắc bệnh SXH, điều tra ca bệnh tiếp tục theo mẫu điều tra này)
</div>

<!-- KHẢO SÁT LĂNG QUĂNG ---------------------------------------------------->
<div class="phieu-title mb-10">
    <span class="badge badge-flat border-primary text-primary bold">3</span> Khảo sát lăng quăng
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
    <?= $form->field($psxh, 'bi')->textInput(['type' => 'number', 'value' => $psxh->bi ?: 0]) ?>
    <?= $form->field($psxh, 'ci')->textInput(['type' => 'number', 'value' => $psxh->ci ?: 0]) ?>
</div>

<!-- HƯỚNG XỬ LÝ ---------------------------------------------------->
<div class="phieu-title mb-10 mt-20">
    <span class="badge badge-flat border-primary text-primary bold">4</span> Hướng xử lý
</div>
<p class="bold text-primary">Ca bệnh</p>
<div class="row">
    <div class="col-md-4 bold"> 1. Ca bệnh chỉ điểm/ca bệnh đầu tiên</div>
    <div class="col-md-4">
        <?= $form->field($psxh, 'cachidiem')->radioList($yesno, ['itemOptions' => ['v-model' => 'psxh.cachidiem']])->label(false) ?>
    </div>
</div>
<div v-if="psxh.cachidiem=='1'" class="animated" transition="bounce">
    <div class="form-group bold"> Dự kiến xử lý</div>
    <div class="row">
        <div class="col-md-4"> Diệt lăng quăng diệt muỗi/gia đình</div>
        <div class="col-md-8"> <?= $form->field($psxh, 'dietlangquang')->radioList($yesno)->label(false) ?> </div>

        <div class="col-md-4"> Giám sát theo dõi</div>
        <div class="col-md-8"> <?= $form->field($psxh, 'giamsattheodoi')->radioList($yesno)->label(false) ?> </div>

        <div class="col-md-4"> Xử lý ổ dịch nhỏ</div>
        <div class="col-md-8"> <?= $form->field($psxh, 'xulyonho')->radioList($yesno)->label(false) ?> </div>
    </div>
</div>
<div v-if="psxh.cachidiem=='0'">
    <div class="row">
        <div class="col-md-4 bold"> 2. Ca bệnh thứ phát</div>
        <div class="col-md-4">
            <?= $form->field($psxh, 'cathuphat')->radioList($yesno, ['itemOptions' => ['v-model' => 'psxh.cathuphat', '']])->label(false) ?>
        </div>
    </div>
</div>
<div v-if="psxh.cathuphat == '1' && psxh.cachidiem=='0'" class="animated" transition="bounce">
    <div class="row">
        <div class="col-md-4">Ổ dịch mới</div>
        <div class="col-md-4"><?= $form->field($psxh, 'odichmoi')->radioList($yesno)->label(false) ?></div>
    </div>
    <div class="row">
        <div class="col-md-4">Ổ dịch cũ đã xác định</div>
        <div class="col-md-2">
            <?= $form->field($psxh, 'odichcu')->radioList($yesno, ['itemOptions' => ['v-model' => 'psxh.odichcu']])->label(false) ?>
        </div>
        <div class="col-md-2" v-if="psxh.odichcu=='1'" class="animated" transition="bounce"> Xử lý</div>
        <div class="col-md-2" v-if="psxh.odichcu=='1'">
            <?= $form->field($psxh, 'odichcu_xuly')->textInput(['type' => 'number'])->label(false) ?>
        </div>
        <div class="col-md-1" v-if="psxh.odichcu=='1'" class="animated" transition="bounce"> ngày</div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($psxh, 'xuly')->radioList($xuly, ['itemOptions' => ['v-model' => 'psxh.xuly']])->label(false) ?>
        </div>
        <div class="col-md-2" v-if="psxh.xuly=='3'" class="animated" transition="bounce"> Sau xử lý</div>
        <div class="col-md-2" v-if="psxh.xuly=='3'" class="animated" transition="bounce">
            <?= $form->field($psxh, 'xuly_ngay')->textInput(['type' => 'number'])->label(false) ?>
        </div>
        <div class="col-md-1" v-if="psxh.xuly=='3'" class="animated" transition="bounce"> ngày</div>
    </div>
</div>


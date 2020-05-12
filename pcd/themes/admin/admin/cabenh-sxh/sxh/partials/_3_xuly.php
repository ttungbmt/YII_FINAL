<!-- HƯỚNG XỬ LÝ ---------------------------------------------------->
<div class="phieu-title mb-10">
    <span class="badge badge-flat border-primary text-primary bold">5</span> Kết luận
</div>
<div v-if="psxh.nhapvien != 0">
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($psxh, 'xuatvien')->radioList([
                1 => 'Đã xuất viện',
                0 => 'Chưa xuất viện',
                9 => 'Không rõ',
            ], ['itemOptions' => ['v-model' =>'psxh.xuatvien', 'number']]) ?>
        </div>
        <div v-if="psxh.xuatvien=='1'" class="animated" transition="bounce">
            <div class="col-md-4">
                <?= $form->field($psxh, 'ngayxuatvien')->textInput(['class' => 'form-control i-datepicker']) ?>
            </div>
        </div>
    </div>
</div>

<!--<div v-if="psxh.loaibc!==0" class="animated" transition="bounce">

</div>-->

<div class="row" v-if="psxh.xuatvien == 1">
    <div class="col-md-8">
        <?= $form->field($psxh, 'xacdinh')->radioList($xacdinh, ['itemOptions' => ['v-model' =>'psxh.xacdinh']]) ?>
    </div>
    <div v-if="psxh.xacdinh=='3'" class="animated" transition="bounce">
        <div class="col-md-4" >
            <?= $form->field($psxh, 'chuandoan_khac') ?>
        </div>
    </div>
</div>


<div class="form-group">
    <i>* Điều tra ghi phiếu đầy đủ và không bỏ sót bất kỳ nội dung nào. <br>
        * Mẫu phiếu được thực hiện:  ca bệnh thông báo khi bệnh nhân có ở tại nhà, cư trú có thể ở bất cứ nơi đâu, bệnh sốt xuất huyết hay là bệnh khác.
    </i>
</div>
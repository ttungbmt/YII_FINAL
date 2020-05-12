<!-- HƯỚNG XỬ LÝ ---------------------------------------------------->
<div v-if="m.ht_dieutri !== 0">
    <div class="phieu-title mb-10">
        <span class="badge badge-flat badge-pill border-primary text-primary">5</span> Kết luận
    </div>
    <div>
        <div class="row" v-if="m.nhapvien != 0">
            <div class="col-md-8">
                <?= $form->field($model, 'xuatvien')->radioList([
                    1 => 'Đã xuất viện',
                    0 => 'Chưa xuất viện',
                    9 => 'Không rõ',
                ], ['inline' => true, 'itemOptions' => ['v-model.number' =>'m.xuatvien']]) ?>
            </div>
            <div v-if="m.xuatvien===1" class="col-md-4">
                <?= $form->field($model, 'ngayxuatvien')->widget(\kartik\widgets\DatePicker::className()) ?>
            </div>
        </div>

        <div class="row" v-if="m.xuatvien === 1">
            <div class="col-md-8">
                <?= $form->field($model, 'chuandoan')->radioList($xacdinh, ['inline' => true, 'itemOptions' => ['v-model.number' =>'m.chuandoan']]) ?>
            </div>
            <div v-if="m.chuandoan===3" class="col-md-4">
                <?= $form->field($model, 'chuandoan_khac') ?>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <i>* Điều tra ghi phiếu đầy đủ và không bỏ sót bất kỳ nội dung nào. <br>
        * Mẫu phiếu được thực hiện:  ca bệnh thông báo khi bệnh nhân có ở tại nhà, cư trú có thể ở bất cứ nơi đâu, bệnh sốt xuất huyết hay là bệnh khác.
    </i>
</div>
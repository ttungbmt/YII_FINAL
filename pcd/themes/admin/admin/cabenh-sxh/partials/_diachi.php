<?php
use kartik\widgets\DepDrop;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;

$stt = $k+1;
$phuong = HcPhuong::findOne(['maphuong' => userInfo()->ma_phuong]);
$locked = $xm->is_locked == 1 ? true : false;
?>
<div v-if="shownXm[<?=$k?>]">
    <?= $form->field($xm, "[{$k}]type")->hiddenInput(['value' => $stt % 2 ? 1 : 0])->label(false)?>
    <?= $form->field($xm, "[{$k}]id")->hiddenInput()->label(false)?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($xm, "[{$k}]is_diachi")->radioList($yesno, ['inline' => true, 'itemOptions' => ['v-model.number' => "m.xacminhCbs[{$k}].is_diachi", 'disabled' => $locked]])->label("Địa chỉ ({$stt})")?>
        </div>
        <?php if($stt % 2 == 1):?>
            <div class="col-md-3">
                <?=$form->field($xm, "[{$k}]is_benhnhan")->radioList($yesno, ['inline' => true, 'itemOptions' => ['v-model.number' => "m.xacminhCbs[{$k}].is_benhnhan", 'disabled' => $locked]])->label("Bệnh nhân ({$stt})")?>
            </div>
        <?php endif?>
        <div class="col-md-3">
            <?=$form->field($xm, "[{$k}]dienthoai")->textInput(['disabled' => $locked])->label("Điện thoại ({$stt})")?>
        </div>
        <?php if($k == 0):?>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label cursor-pointer"><i>Vị trí (cũ)</i></label>
                    <div><?=$model->vitri?></div>
                </div>
            </div>
        <?php endif?>
    </div>
    <div v-if="shown_diachi(<?=$k?>)">
        <div class="row">
            <div class="col-md-3">
                <?=$form->field($xm, "[{$k}]sonha")->textInput(['disabled' => $locked])->label("Số nhà ({$stt})")?>
            </div>
            <div class="col-md-3">
                <?=$form->field($xm, "[{$k}]duong")->textInput(['disabled' => $locked])->label("Đường ({$stt})")?>
            </div>
            <div class="col-md-3">
                <?=$form->field($xm, "[{$k}]to_dp")->textInput(['disabled' => $locked])->label("Tổ ({$stt})")?>
            </div>
            <div class="col-md-3">
                <?=$form->field($xm, "[{$k}]khupho")->textInput(['disabled' => $locked])->label("Khu phố ({$stt})")?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=$form->field($xm, "[{$k}]tinh")->dropDownList($k == 0 ? ['HCM' => 'Hồ Chí Minh']: $dm_tinh, [
                    'v-model' => "m.xacminhCbs[{$k}].tinh",
                    'disabled' => $locked
                ])->label("Tỉnh ({$stt})")?>
            </div>
            <div class="col-md-6" v-if="m.xacminhCbs[<?=$k?>].tinh == 'HCM'">
                <div class="row">
                    <div class="col-md-6">
                        <?php if($stt % 2 == 0):?>
                            <?=$form->field($xm, "[{$k}]qh")->dropDownList($dm_quan, [
                                'prompt' => 'Chọn quận huyện...',
                                'id'      => "drop-quan-{$stt}",
                                'v-model' => "m.xacminhCbs[{$k}].qh",
                                'disabled' => $locked
                            ])->label("Quận huyện ({$stt})")?>
                        <?php else:?>
                            <?php
                            $qh = is_null($xm->qh) ? data_get($phuong, 'maquan') : $xm->qh;
                            $ten_qh = is_null($xm->qh) ? data_get($phuong, 'tenquan') : data_get($xm, 'phuong.tenquan');
                            $dm_q = role('phuong') ? [$qh => $ten_qh] : $dm_quan;
                            ?>
                            <?=$form->field($xm, "[{$k}]qh")->dropDownList($dm_q, [
                                'prompt' => 'Chọn quận huyện...',
                                'id'      => "drop-quan-{$stt}",
                                'v-model' => "m.xacminhCbs[{$k}].qh",
                                'disabled' => $locked
                            ])->label("Quận huyện ({$stt})")?>
                        <?php endif?>

                    </div>
                    <div class="col-md-6">
                        <?php if($stt % 2 == 0 || !role('phuong')):?>
                            <?=$form->field($xm, "[{$k}]px")->widget(DepDrop::className(), [
                                'options'       => ['prompt' => 'Chọn phường xã...', 'v-model' => "m.xacminhCbs[{$k}].px", 'disabled' => $locked],
                                'pluginOptions' => [
                                    'depends' => ["drop-quan-{$stt}"],
                                    'initialize' => true,
                                    'ajaxSettings' => ['data' => ['value' => $xm->px]],
                                    'url'     => $url_phuong,
                                ],
                            ])->label("Phường xã ({$stt})")?>
                        <?php else:?>
                            <?php
                            $px = is_null($xm->qh) ? data_get($phuong, 'maphuong') : $xm->px;
                            $ten_px = is_null($xm->qh) ? data_get($phuong, 'tenphuong') : data_get($xm, 'phuong.tenphuong');
                            ?>
                            <?=$form->field($xm, "[{$k}]px")->dropDownList([$px => $ten_px], [
                                'prompt' => 'Chọn phường xã...',
                                'id'      => "drop-phuong-{$stt}",
                                'v-model' => "m.xacminhCbs[{$k}].px",
                                'disabled' => $locked
                            ])->label("Phường xã ({$stt})")?>
                        <?php endif?>
                    </div>
                </div>
            </div>

            <div class="col-md-6" v-if="m.xacminhCbs[<?=$k?>].tinh == 'TinhKhac'">
                <?=$form->field($xm, "[{$k}]tinh_dc_khac")->textInput(['disabled' => $locked])->label("Địa chỉ tỉnh khác ({$stt})")?>
            </div>
        </div>
    </div>
</div>

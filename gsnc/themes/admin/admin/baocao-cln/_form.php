<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model gsnc\models\Dmloaibv */
/* @var $form yii\widgets\ActiveForm */
$this->title = ($model->isNewRecord ? 'Thêm mới' : 'Cập nhật') . ' Loại bệnh viện';

$dm_thoigian = [
    '6 THANG' => '6 tháng',
    '1 NAM' => '1 năm',
];
?>

<div class="dmloaibv-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-body">
            <div class="flex">
                <div class="flex flex-col flex-auto items-center text-base">
                    <div class="font-bold">SỞ Y TẾ TP. HỒ CHÍ MINH</div>
                    <div class="font-bold">TRUNG TÂM KIỂM SOÁT BỆNH TẬT</div>
                    <div>Số…………..</div>
                </div>
                <div class="flex flex-col flex-auto items-center text-base">
                    <div class="font-bold">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</div>
                    <div class="font-bold">Độc lập - Tự do - Hạnh phúc</div>
                </div>
            </div>
            <div class="text-right">
                TP. Hồ Chí Minh, ngày ….. tháng ….. năm 20……
            </div>

            <div class="text-center">
                <div class="text-xl  font-bold">
                    BÁO CÁO
                </div>
                <div class="text-base  font-bold">
                    Tổng hợp kết quả kiểm tra chất lượng nước sạch
                </div>
                <div>
                    <?=$form->field($model, 'thoigian')->radioList($dm_thoigian)->label('Báo cáo')?>
                </div>
            </div>

            <div>
                <div class="font-bold">A. TÌNH HÌNH CHUNG</div>

            </div>




            <?php if (!request()->isAjax): ?>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? lang('Create') : lang('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

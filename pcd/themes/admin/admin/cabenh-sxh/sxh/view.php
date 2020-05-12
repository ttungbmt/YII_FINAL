<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DieutraSxh */

$this->title = $model->ma_dt_sxh;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dieutra Sxhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dieutra-sxh-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ma_dt_sxh], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ma_dt_sxh], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ma_dt_sxh',
            'macabenh',
            'ngaydieutra',
            'conha:boolean',
            'cobenhnhan:boolean',
            'cutrutainha:boolean',
            'cutrutinhthanh:boolean',
            'phuongxa',
            'quanhuyen',
            'diachi:ntext',
            'songuoicutru',
            'soduoinamtuoi',
            'nghenghiep:ntext',
            'noilamviec_hoctap:ntext',
            'phuongxa_lamviechoctap',
            'quanhuyen_lamviechoctap',
            'noilamviecco_sxh',
            'dennhaco_bn_sxh:boolean',
            'dennhaco_nguoibenh:boolean',
            'bv_pk:boolean',
            'nhatho:boolean',
            'dinhchua:boolean',
            'congvien:boolean',
            'hoihop:boolean',
            'xaydung:boolean',
            'cafe_internet:boolean',
            'channuoi:boolean',
            'caycanh:boolean',
            'vuaphelieu:boolean',
            'noikhac:boolean',
            'ghichu:ntext',
            'diemden_px:boolean',
            'diemden_px_khac:boolean',
            'diemden_qh_khac:boolean',
            'giadinhco_sxh',
            'songuoi_sxh',
            'soduoi15_sxh',
            'giadinhco_sot',
            'soduoi15_sot',
            'xacdinh',
            'chuandoan_khac',
            'benhthuoc_px:boolean',
            'cadautien:boolean',
            'diet_lq_muoi:boolean',
            'giamsat:boolean',
            'xulyodichnho:boolean',
            'dich_moi_cu:boolean',
            'tenodich',
            'xuly:ntext',
            'songaysauxuly',
            'tennguoidieutra',
            'bi',
            'ci',
        ],
    ]) ?>

</div>

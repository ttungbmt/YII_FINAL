<?php

use johnitvn\ajaxcrud\CrudAsset;
use kartik\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = 'Danh sách Ổ dịch SXH';
$models = $dataProvider->getModels();
$pagination = $dataProvider->getPagination();
CrudAsset::register($this);
?>
<div id="odichFrm">
    <div class="btn-group mb-10">
        <?=Html::a('Mẫu 1', ['admin/odich-sxh', 'mau' => 1], ['class' => 'btn btn-primary'])?>
        <?=Html::a('Mẫu 2', ['admin/odich-sxh', 'mau' => 2], ['class' => 'btn btn-primary'])?>
    </div>

    <?=$this->render('_search', ['model' => $searchModel])?>
</div>

<?php Pjax::begin([
    'linkSelector' => '#odichFrm a'
])?>
<?=renderSummary($dataProvider, null, ['class' => 'summary mb-10 mt-10'])?>
<?php if(request('mau') == '2'):?>
    <div class="panel">
        <div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th rowspan="2">STT</th>
                        <th rowspan="2">Hành động</th>
                        <th colspan="7">Ổ dịch và xác định phạm vi ổ dịch</th>
                        <th colspan="7">Quản lý và xử lý ổ dịch</th>
                    </tr>
                    <tr>
                        <th>Tên ca bệnh đầu tiên</th>
                        <th>Tổ</th>
                        <th>KP/ẤP</th>
                        <th>Ngày xác định</th>
                        <th>Số ca bệnh</th>
                        <th>Số tổ</th>
                        <th>Số hộ</th>
                        <th>Ngày xử lý</th>
                        <th>Lần xử lý</th>
                        <th>Số hộ diệt LQ</th>
                        <th>BI trước</th>
                        <th>BI sau</th>
                        <th>Tên hóa chất</th>
                        <th>Lượng sử dụng</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($models as $k => $m):?>
                        <?php
                        $cb = collect(head($m->cabenhs));
                        $xl = collect($m->xulys);
                        $tr = function ($x, $pos){
                            return (
                                Html::tag('td', $x->tungaydlq).
                                Html::tag('td', $pos+1).
                                Html::tag('td', $x->sonhaduocdlq).
                                Html::tag('td', $x->truoc_bi).
                                Html::tag('td', $x->sau_bi).
                                Html::tag('td', $x->tenhc1).
                                Html::tag('td', $x->solithc1)
                            );
                        }
                        ?>
                        <tr>
                            <td rowspan="2"><?=$k+1?></td>
                            <td rowspan="2">
                                <?=\kartik\helpers\Html::a('<span class="icon-pencil7"></span>', ['/admin/odich-sxh/update', 'id' => $m->id], ['data-toggle' => 'tooltip', 'title' => lang('Update')])?>
                            </td>
                            <td rowspan="2"><?=$cb->get('hoten')?></td>
                            <td rowspan="2"><?=$cb->get('to1')?></td>
                            <td rowspan="2"><?=$cb->get('khupho1')?></td>
                            <td rowspan="2"><?=$m->ngayxacdinh?></td>
                            <td rowspan="2"><?=count($m->cabenhs)?></td>
                            <td rowspan="2"></td>
                            <td rowspan="2"></td>
                            <?=$tr($xl->slice(0, 1)->first(), 0)?>
                        </tr>
                        <?php foreach($xl->slice(1) as $i => $x):?>
                            <tr><?=$tr($x, $i)?></tr>
                        <?php endforeach;?>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else:?>
    <div class="panel">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Hành động</th>
                    <th>Họ tên</th>
                    <th>Tuổi</th>
                    <th>Tổ</th>
                    <th>KP</th>
                    <th>PX</th>
                    <th>QH</th>
                    <th>Ngày khởi bệnh</th>
                    <th>Ngày xác định ổ dịch</th>
                    <th>Số lần xử lý</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($models as $k => $m):?>
                    <?php $cb = $m->cabenhs; $c = count($cb); ?>
                    <?php foreach($cb as $i => $s):?>
                        <tr >
                            <?php if($i === 0):?>
                                <td rowspan="<?=$c?>"><?=$k+1?></td>
                                <td rowspan="<?=$c?>">
                                    <?=\kartik\helpers\Html::a('<span class="icon-pencil7"></span>', ['/admin/odich-sxh/update', 'id' => $m->id], ['data-toggle' => 'tooltip', 'title' => lang('Update')])?>
                                    <?=\kartik\helpers\Html::a('<span class="icon-list-ordered"></span>', ['/admin/odich-sxh/xuly', 'id' => $m->id], ['data-toggle' => 'tooltip', 'title' => 'Xử lý', 'role' => 'modal-remote'])?>
                                </td>
                            <?php endif;?>
                            <td><?=$s->hoten?></td>
                            <td><?=$s->tuoi?></td>
                            <td><?=$s->to1?></td>
                            <td><?=$s->khupho1?></td>
                            <td><?=data_get($s, 'dmPhuong.ten_phuong')?></td>
                            <td><?=data_get($s, 'dmPhuong.ten_quan')?></td>
                            <td><?=$s->ngaymacbenh ?? $s->ngaynhapvien?></td>
                            <?php if($i === 0):?>
                                <td rowspan="<?=$c?>"><?=$m->ngayxacdinh?></td>
                                <td rowspan="<?=$c?>"><?=$m->getXulys()->count()?></td>
                            <?php endif;?>
                        </tr>
                    <?php endforeach;?>
                <?php endforeach;?>

                </tbody>
            </table>
        </div>
    </div>
<?php endif;?>

<?=LinkPager::widget([
    'pagination' => $pagination,
])?>

<?php Pjax::end()?>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>


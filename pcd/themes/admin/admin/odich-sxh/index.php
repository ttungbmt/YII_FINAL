<?php

use johnitvn\ajaxcrud\CrudAsset;
use kartik\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = 'Danh sách Ổ dịch SXH';
if(request('chiendich')) {
    $this->title = "Chiến dịch phòng chống dịch";
}
$models = $dataProvider->getModels();
$pagination = $dataProvider->getPagination();
CrudAsset::register($this);
\yii\grid\GridViewAsset::register($this);
$id = 'pjax-container';
$is_partial = request('partial') == true || Yii::$app->request->isPjax;
if($is_partial){
    $updateOpts = ['target' => '_blank', 'data-pjax' => 0];
}
?>

<div id="searchContainer">
    <?= $this->render('_search', ['model' => $searchModel]) ?>

    <div class="btn-group mb-3">
        <?= Html::a('Mẫu 1', ['admin/odich-sxh', 'mau' => 1], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Mẫu 2', ['admin/odich-sxh', 'mau' => 2], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="icon-download4"></i> ', '#', ['class' => 'btn-download btn btn-warning', 'title' => 'Tải xuống', 'data' => [
            'action'   => 'download',
            'selector' => "#{$id} table",
        ]]) ?>
    </div>
</div>

<?php Pjax::begin([
    'id'           => $id,
    'scrollTo'     => true,
    'formSelector' => '#searchContainer form',
    'linkSelector' => "#searchContainer a, #{$id} a, #{$id} select",
    'enablePushState' => $is_partial ? false : true,
]) ?>

<?= renderSummary($dataProvider, null, ['class' => 'summary mb-2']) ?>
<div class="card">
    <div class="<?=$is_partial ? : 'table-responsive'?>">
        <?php if (request('mau') == '2'): ?>
            <table class="table table-bordered kv-grid-table">
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
                <?php foreach ($models as $k => $m): ?>
                    <?php
                    $data = $m->toArray();
                    $cb = collect(head($m->cabenhs));
                    $xl = collect($m->xulyOdsxhs);
                    $rowspan = $xl->count() ? "rowspan='{$xl->count()}'" : '';
                    $tr = function ($x, $pos) {
                        if (!$x) {
                            return Html::tag('td', '', ['colspan' => 7]);
                        };

                        return (
                            Html::tag('td', $x->tungaydlq) .
                            Html::tag('td', $pos + 1) .
                            Html::tag('td', $x->sonhaduocdlq) .
                            Html::tag('td', $x->truoc_bi) .
                            Html::tag('td', $x->sau_bi) .
                            Html::tag('td', $x->tenhc1) .
                            Html::tag('td', $x->solithc1)
                        );
                    };
                    ?>
                    <tr>
                        <td <?= $rowspan ?>"><?= $k + 1 ?></td>
                        <td <?= $rowspan ?>">
                        <div class="list-icons">
                            <?= Html::a('<span class="icon-location4"></span>', null, ['class' => 'list-icons-item text-primary', 'data-toggle' => 'tooltip', 'title' => 'Định vị', 'data' => [
                                'pjax' => 0,
                                'action' => 'locate',
                                'item' => $data
                            ]]) ?>
                            <?= Html::a('<span class="icon-pencil7"></span>', ['/admin/odich-sxh/update', 'id' => $m->id], ['class' => 'list-icons-item text-primary', 'data-toggle' => 'tooltip', 'title' => lang('Update'), 'data' => [
                                'pjax' => 0, 'target' => $is_partial ? '_blank' : '_self'
                            ]]) ?>
                            <?= Html::a('<span class="icon-list-ordered"></span>', ['/admin/odich-sxh/xuly', 'id' => $m->id, ''], ['class' => 'list-icons-item text-info', 'data-toggle' => 'tooltip', 'title' => 'Xử lý', 'role' => 'modal-remote']) ?>
                            <?php if (role('admin')): ?>
                                <?= Html::a('<span class="icon-trash"></span>', ['/admin/odich-sxh/delete', 'id' => $m->id, ''], ['class'                => 'list-icons-item text-danger', 'data-toggle' => 'tooltip', 'title' => lang('Delete'), 'role' => 'modal-remote', 'data-request-method' => 'post', 'data-confirm-ok' => 'Chấp nhận', 'data-confirm-cancel' => 'Đóng',
                                                                                                                                  'data-confirm-title'   => 'Bạn có chắc chắn?',
                                                                                                                                  'data-confirm-message' => 'Bạn có chắc chắn muốn xóa ổ dịch này không ?',]) ?>
                            <?php endif; ?>
                        </div>
                        </td>
                        <td <?= $rowspan ?>
                        <td><?= Html::a($cb->get('hoten'), ['/admin/cabenh-sxh/update', 'id' => $cb->get('gid')], ['data-pjax' => 0, 'target' => '_blank']) ?></td>
                        <td <?= $rowspan ?>"><?= $cb->get('to_dp') ?></td>
                        <td <?= $rowspan ?>"><?= $cb->get('khupho') ?></td>
                        <td <?= $rowspan ?>"><?= $m->ngayxacdinh ?></td>
                        <td <?= $rowspan ?>"><?= count($m->cabenhs) ?></td>
                        <td <?= $rowspan ?>"></td>
                        <td <?= $rowspan ?>"></td>
                        <?php if (!$xl->isEmpty()): ?>
                            <?= $tr($xl->slice(0, 1)->first(), 0) ?>
                        <?php else: ?>
                            <td colspan="7"></td>
                        <?php endif; ?>
                    </tr>
                    <?php if (!$xl->isEmpty()): ?>
                        <?php foreach ($xl->slice(1) as $i => $x): ?>
                            <tr><?= $tr($x, $i) ?></tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <table class="table table-bordered kv-grid-table">
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
                <?php foreach ($models as $k => $m): ?>
                    <?php
                    $data = $m->toArray();
                    $cb = $m->cabenhs;
                    $c = count($cb);
                    ?>
                    <?php foreach ($cb as $i => $s): ?>
                        <tr>
                            <?php if ($i === 0): ?>
                                <td rowspan="<?= $c ?>"><?= $k + 1 ?></td>
                                <td rowspan="<?= $c ?>">
                                    <div class="list-icons">
                                        <?= Html::a('<span class="icon-location4"></span>', null, ['class' => 'list-icons-item text-primary', 'data-toggle' => 'tooltip', 'title' => 'Định vị', 'data' => [
                                            'pjax' => 0,
                                            'action' => 'locate',
                                            'item' => $data
                                        ]]) ?>
                                        <?= Html::a('<span class="icon-pencil7"></span>', ['/admin/odich-sxh/update', 'id' => $m->id], ['class' => 'list-icons-item text-primary', 'data-toggle' => 'tooltip', 'title' => lang('Update'), 'data-pjax' => 0, 'target' => $is_partial ? '_blank' : '_self']) ?>
                                        <?= Html::a('<span class="icon-list-ordered"></span>', ['/admin/odich-sxh/xuly', 'id' => $m->id, ''], ['class' => 'list-icons-item text-info', 'data-toggle' => 'tooltip', 'title' => 'Xử lý', 'role' => 'modal-remote']) ?>
                                        <?php if (role('admin')): ?>
                                            <?= Html::a('<span class="icon-trash"></span>', ['/admin/odich-sxh/delete', 'id' => $m->id, ''], ['class'                => 'list-icons-item text-danger', 'data-toggle' => 'tooltip', 'title' => lang('Delete'), 'role' => 'modal-remote', 'data-request-method' => 'post', 'data-confirm-ok' => 'Chấp nhận', 'data-confirm-cancel' => 'Đóng',
                                                                                                                                              'data-confirm-title'   => 'Bạn có chắc chắn?',
                                                                                                                                              'data-confirm-message' => 'Bạn có chắc chắn muốn xóa ổ dịch này không ?',]) ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            <?php endif; ?>
                            <td>
                                <?=Html::a($s->hoten, ['/admin/cabenh-sxh/update', 'id' => data_get($s, 'gid')], ['data-pjax' => 0, 'target' => '_blank'])?>
                            </td>
                            <td><?= $s->tuoi ?></td>
                            <td><?= $s->to_dp ?></td>
                            <td><?= $s->khupho ?></td>
                            <td><?= data_get($s, 'hcPhuong.tenphuong') ?></td>
                            <td><?= data_get($s, 'hcPhuong.tenquan') ?></td>
                            <td><?= $s->ngaymacbenh ?? $s->ngaynhapvien ?></td>
                            <?php if ($i === 0): ?>
                                <td rowspan="<?= $c ?>"><?= $m->ngayxacdinh ?></td>
                                <td rowspan="<?= $c ?>"><?= $m->getXulyOdsxhs()->count() ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>

                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center">
        <div class="form-inline">
            <span class="mr-1">Hiển thị</span>
            <?= Html::dropDownList($pagination->pageSizeParam, request($pagination->pageSizeParam), [
                10  => '10 đối tượng',
                20  => '20 đối tượng',
                50  => '50 đối tượng',
                100 => '100 đối tượng',
                -1  => 'Tất cả',
            ], ['class' => 'form-control']) ?>
        </div>
        <?= LinkPager::widget([
            'pagination' => $pagination,
        ]) ?>
    </div>

</div>

<?php Pjax::end() ?>



<?php $this->beginBlock('scripts') ?>
<?php Modal::begin([
    "id"     => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>

<script>
    //$(function () {
    //    jQuery('#<?//=$id?>//>').yiiGridView({
    //        "filterUrl": "/admin/odich-sxh",
    //        "filterSelector": "#<?//=$id?>// input, #<?//=$id?>// select"
    //    });
    //})
</script>

<?php $this->endBlock() ?>


<?php

use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\widgets\Pjax;

$pts = $dataProvider->getModels();
$pagination = $dataProvider->getPagination();
$offset = $pagination->getOffset();
$id = 'ketqua-gs';
$this->title = "Kết quả giám sát điểm nguy cơ";
$year = $searchModel->year;
$checkFn = function ($v) {
    return Html::tag('span', '', ['class' => $v ? "icon-radio-unchecked" : "icon-cross2"]);
};
$dm_mucdich_gs = api('dm_mucdich_gs');
?>

    <div id="searchContainer">
        <?= $this->render('_search_gs', ['model' => $searchModel, 'dateType' => 'year']) ?>
    </div>

    <div class="btn-group mb-3">
        <?= Html::a('Mẫu tháng', ['admin/pt-nguyco/ketqua-gs'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Mẫu năm', ['admin/pt-nguyco/ketqua-gs', 'year' => date('Y')], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="icon-download4"></i> ', '#', ['class' => 'btn-download btn btn-warning', 'title' => 'Tải xuống', 'data' => [
            'action' => 'download',
            'selector' => "#{$id} table",
        ]]) ?>
    </div>

<?php Pjax::begin([
    'id' => $id,
    'scrollTo' => true,
    'formSelector' => '#searchContainer form',
    'linkSelector' => "#searchContainer a, #{$id} a, #{$id} select",
    'enablePushState' => true,
]) ?>
    <div class="card">
        <div class="table-responsive">
            <?php if ($year): ?>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th rowspan="2">STT</th>
                        <th rowspan="2" style="width: 100px;">Điểm nguy cơ</th>
                        <th rowspan="2">Địa chỉ</th>
                        <th rowspan="2">QH</th>
                        <th rowspan="2">PX</th>
                        <th rowspan="2">Khu phố/Ấp</th>
                        <th rowspan="2">Tổ</th>
                        <?php foreach (range(1, 12) as $m): ?>
                            <th colspan="2"><?= $m ?></th>
                        <?php endforeach; ?>
                        <th colspan="2">TC</th>
                    </tr>
                    <tr>
                        <?php foreach (range(1, 13) as $m): ?>
                            <th>Lần</th>
                            <th>LQ</th>
                        <?php endforeach; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pts as $k => $pt): ?>
                        <?php $gs = collect($pt->getGsYear($year)->all()); ?>
                        <tr>
                            <td><?= $offset + $k + 1 ?></td>
                            <td><?= $pt->dncText ?></td>
                            <td><?= $pt->diachiText ?></td>
                            <td><?= data_get($pt, 'quan.tenquan')?></td>
                            <td><?= data_get($pt, 'phuong.tenphuong')?></td>
                            <td><?= $pt->khupho ?></td>
                            <td><?= $pt->to_dp ?></td>
                            <?php foreach (range(1, 12) as $m): ?>
                                <?php $g = $gs->firstWhere('month', $m); ?>
                                <td><?= data_get($g, 'count_gs'), '' ?></td>
                                <td><?= data_get($g, 'count_lq'), '' ?></td>
                            <?php endforeach; ?>
                            <td><?= $gs->sum('count_gs') ?></td>
                            <td><?= $gs->sum('count_lq') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên điểm</th>
                        <th>Địa chỉ</th>
                        <th>QH</th>
                        <th>PX</th>
                        <th>Khu phố/Ấp</th>
                        <th>Tổ</th>
                        <th>Ngày giám sát</th>
                        <th>Vật chứa nước</th>
                        <th>Vật chứa lăng quăng</th>
                        <th>Mục đích giám sát</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pts as $k => $pt): ?>
                        <?php $gs = collect($pt->giamsats);
                        $g1 = $gs->first();
                        $c = $gs->count();
                        $c = $c == 0 ? 1 : $c;
                        $md_gs = data_get($g1, 'mucdich_gs'); ?>
                        <tr>
                            <td rowspan="<?= $c ?>"><?= $offset + $k + 1 ?></td>
                            <td rowspan="<?= $c ?>"><?= $pt->dncText ?></td>
                            <td rowspan="<?= $c ?>"><?= $pt->diachiText ?></td>
                            <td rowspan="<?= $c ?>"><?= data_get($pt, 'quan.tenquan')?></td>
                            <td rowspan="<?= $c ?>"><?= data_get($pt, 'phuong.tenphuong')?></td>
                            <td rowspan="<?= $c ?>"><?= $pt->khupho ?></td>
                            <td rowspan="<?= $c ?>"><?= $pt->to_dp ?></td>
                            <?php if ($g1): ?>
                                <td><?= data_get($g1, 'ngay_gs') ?></td>
                                <td class="text-center">
                                    <?= $checkFn(data_get($g1, 'vc_nc')) ?>
                                </td>
                                <td class="text-center"><?= $checkFn(data_get($g1, 'vc_lq')) ?></td>
                                <td><?= data_get($dm_mucdich_gs, is_null($md_gs) ? '' : $md_gs) ?></td>
                            <?php else: ?>
                                <td colspan="4"><?= '' ?></td>
                            <?php endif ?>
                            <td rowspan="<?=$gs->count() == 0 ? 1 : $gs->count()?>">
                                <a href="">Thêm lần giám sát</a>
                            </td>
                        </tr>
                        <?php foreach ($gs->slice(1) as $i => $g2): ?>
                            <tr>
                                <td><?= data_get($g2, 'ngay_gs') ?></td>
                                <td class="text-center"><?= $checkFn(data_get($g2, 'vc_nc')) ?></td>
                                <td class="text-center"><?= $checkFn(data_get($g2, 'vc_lq')) ?></td>
                                <td><?= data_get($dm_mucdich_gs, is_null($md_gs) ? '' : $md_gs) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <div class="card-footer bg-transparent d-flex justify-content-between">
            <?= LinkPager::widget([
                'pagination' => $pagination,
            ]) ?>
        </div>
    </div>
<?php Pjax::end() ?>
<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\widgets\Pjax;
$pts = $dataProvider->getModels();
$pagination = $dataProvider->getPagination();
$offset = $pagination->getOffset();
$id = 'kehoach-gs';
$this->title = 'Kế hoạch và theo dõi giám sát điểm nguy cơ';
$year = $searchModel->year;
?>
<div id="searchContainer">
    <?= $this->render('_search_gs', ['model' => $searchModel, 'dateType' => 'year']) ?>
</div>

<?php Pjax::begin([
    'id'           => $id,
    'scrollTo'     => true,
    'formSelector' => '#searchContainer form',
    'linkSelector' => "#searchContainer a, #{$id} a, #{$id} select",
    'enablePushState' => true,
]) ?>
<div class="card" id="<?=$id?>">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th rowspan="2">STT</th>
                <th rowspan="2">Điểm nguy cơ</th>
                <th rowspan="2">Địa chỉ</th>
                <th rowspan="2">QH</th>
                <th rowspan="2">PX</th>
                <th rowspan="2">KP/Ấp</th>
                <th rowspan="2">Tổ</th>
                <th colspan="12">Tháng</th>
                <th rowspan="2">TC</th>
            </tr>
            <tr>
                <?php foreach (range(1, 12) as $m): ?>
                    <th><?= $m ?></th>
                <?php endforeach; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($pts as $k => $pt): ?>
                <?php $gs = collect($pt->getKhYear($year)->all()); ?>
                <tr>
                    <td><?= $offset + $k + 1 ?></td>
                    <td><?= $pt->dncText ?></td>
                    <td><?= $pt->diachiText ?></td>
                    <td><?= data_get($pt, 'quan.tenquan') ?></td>
                    <td><?= data_get($pt, 'phuong.tenphuong') ?></td>
                    <td><?= $pt->khupho ?></td>
                    <td><?= $pt->to_dp ?></td>
                    <?php foreach (range(1, 12) as $m): ?>
                        <?php $g = $gs->firstWhere('month', $m);
                        $dk = data_get($g, 'dukien');
                        $tt = data_get($g, 'thucte') ?>
                        <td>
                            <?php if ($dk & $tt): ?>
                                <span class="icon-close2"></span>
                            <?php elseif (!$dk && $tt): ?>
                                <span class="icon-radio-unchecked"></span>
                            <?php elseif ($dk && !$tt): ?>
                                <span class="icon-cross3"></span>
                            <?php else: ?>

                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>
                    <td><?= $gs->sum('dukien') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card-footer bg-transparent d-flex justify-content-between">
        <?=LinkPager::widget([
            'pagination' => $pagination,
        ])?>
    </div>
</div>

<?php Pjax::end() ?>

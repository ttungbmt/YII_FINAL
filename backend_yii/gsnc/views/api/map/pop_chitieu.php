<?php
$format = function ($num){
    return $num ? number_format($num, 1) : '';
}
?>

<div class="table-responsive mt-6">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Đánh giá</th>
            <th>HL / VS => HL & VS</th>
            <th>K / Đ => K</th>
        </tr>
        <tr>
            <th>Chỉ tiêu</th>
            <th>Giới hạn</th>
            <th>Kết quả XN</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($chitieu as $item): ?>
            <tr>
                <td><?=$item['f2']?></td>
                <td><?=$format($item['f3'])?> / <?=$format($item['f4'])?></td>
                <td><?=$item['f5']?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

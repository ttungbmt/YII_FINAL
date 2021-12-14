<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/26/2018
 * Time: 10:19 AM
 */

use common\models\Query;
$this->title = 'Danh sách các ca bệnh sai thông tin';
?>

<!--Thống kê-->
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
            <li class="nav-item"><a href="#tab1" data-toggle="tab" class="nav-link active" aria-expanded="true">Lỗi thông tin điều tra</a></li>
            <li class="nav-item"><a href="#tab2" data-toggle="tab" class="nav-link" aria-expanded="false">Lỗi thông tin chuyển ca</a></li>
            <li class="nav-item"><a href="#tab3" data-toggle="tab" class="nav-link" aria-expanded="false">Lỗi thông tin xác minh địa chỉ, bệnh nhân</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab1">
                <?php if(!$errorDieutra): ?>
                    <h5>Chưa phát hiện ca bệnh nào bị lỗi thông tin điều tra!</h5>
                <?php else: ?>
                    <?php $tong_ED = 0;?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th><?=role('admin') ? 'Quận/huyện' : (role('quan') ? 'Phường/xã' : 'Khu phố')?></th>
                            <th>Họ tên</th>
                            <th>Tuổi</th>
                            <th>Ngày mắc bệnh</th>
                            <th>Địa chỉ</th>
                            <th>Điện thoại</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($errorDieutra as $k => $hc):?>
                            <?php
                                if(role('admin')){
                                    $name_hc = (new Query())->select('tenquan')->from('hc_phuong')->where(['maquan' => $k])->column();
                                } elseif (role('quan')) {
                                    $name_hc = (new Query())->select('tenphuong')->from('hc_phuong')->where(['maphuong' => $k])->column();
                                } else {
                                    $name_hc = [$k];
                                }

                                $tong_ED += count($hc);
                            ?>
                            <?php foreach ($hc as $cb):?>
                                <tr>
                                    <?php if($cb == reset($hc)) :?>
                                    <th rowspan="<?=count($hc)?>"><?=$name_hc[0]?></th>
                                    <?php endif; ?>
                                    <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh/update', 'id' => $cb['gid']])?>"><?=$cb['hoten']?></a></td>
                                    <td><?=$cb['tuoi']?></td>
                                    <td><?=$cb['ngaymacbenh']?></td>
                                    <td><?=$cb['vitri']?></td>
                                    <td><?=$cb['dienthoai']?></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endforeach;?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="5">Tổng cộng</th>
                            <th colspan="1"><?=$tong_ED . ' ca bệnh'?></th>
                        </tr>
                        </tfoot>
                    </table>
                <?php endif; ?>
            </div>

            <div class="tab-pane fade" id="tab2">
                <?php if(!$errorChuyenca): ?>
                    <h5>Chưa phát hiện ca bệnh nào bị lỗi thông tin chuyển ca!</h5>
                <?php else: ?>
                    <?php $tong_ED = 0;?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th><?=role('admin') ? 'Quận/huyện' : (role('quan') ? 'Phường/xã' : 'Khu phố')?></th>
                            <th>Họ tên</th>
                            <th>Tuổi</th>
                            <th>Ngày mắc bệnh</th>
                            <th>Địa chỉ</th>
                            <th>Điện thoại</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($errorChuyenca as $k => $hc):?>
                            <?php
                                if(role('admin')){
                                    $name_hc = (new Query())->select('tenquan')->from('hc_phuong')->where(['maquan' => $k])->column();
                                } elseif (role('quan')) {
                                    $name_hc = (new Query())->select('tenphuong')->from('hc_phuong')->where(['maphuong' => $k])->column();
                                } else {
                                    $name_hc = [$k];
                                }

                                $tong_ED += count($hc);
                            ?>
                            <?php foreach ($hc as $cb):?>
                                <tr>
                                    <?php if($cb == reset($hc)) :?>
                                        <th rowspan="<?=count($hc)?>"><?=$name_hc[0]?></th>
                                    <?php endif; ?>
                                    <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh/update', 'id' => $cb['gid']])?>"><?=$cb['hoten']?></a></td>
                                    <td><?=$cb['tuoi']?></td>
                                    <td><?=$cb['ngaymacbenh']?></td>
                                    <td><?=$cb['vitri']?></td>
                                    <td><?=$cb['dienthoai']?></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endforeach;?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="5">Tổng cộng</th>
                            <th colspan="1"><?=$tong_ED . ' ca bệnh'?></th>
                        </tr>
                        </tfoot>
                    </table>
                <?php endif; ?>
            </div>

            <div class="tab-pane fade" id="tab3">
                <?php if(!$errorDiachi): ?>
                    <h5>Chưa phát hiện ca bệnh nào bị lỗi thông tin xác minh địa chỉ, bệnh nhân!</h5>
                <?php else: ?>
                    <?php $tong_ED = 0;?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th><?=role('admin') ? 'Quận/huyện' : (role('quan') ? 'Phường/xã' : 'Khu phố')?></th>
                            <th>Họ tên</th>
                            <th>Tuổi</th>
                            <th>Ngày mắc bệnh</th>
                            <th>Địa chỉ</th>
                            <th>Điện thoại</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($errorDiachi as $k => $hc):?>
                            <?php
                                if(role('admin')){
                                    $name_hc = (new Query())->select('tenquan')->from('hc_phuong')->where(['maquan' => $k])->column();
                                } elseif (role('quan')) {
                                    $name_hc = (new Query())->select('tenphuong')->from('hc_phuong')->where(['maphuong' => $k])->column();
                                } else {
                                    $name_hc = [$k];
                                }

                                $tong_ED += count($hc);
                            ?>
                            <?php foreach ($hc as $cb):?>
                                <tr>
                                    <?php if($cb == reset($hc)) :?>
                                        <th rowspan="<?=count($hc)?>"><?=$name_hc[0]?></th>
                                    <?php endif; ?>
                                    <td><a target="_blank" href="<?=url(['/admin/cabenh-sxh/update', 'id' => $cb['gid']])?>"><?=$cb['hoten']?></a></td>
                                    <td><?=$cb['tuoi']?></td>
                                    <td><?=$cb['ngaymacbenh']?></td>
                                    <td><?=$cb['vitri']?></td>
                                    <td><?=$cb['dienthoai']?></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endforeach;?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="5">Tổng cộng</th>
                            <th colspan="1"><?=$tong_ED . ' ca bệnh'?></th>
                        </tr>
                        </tfoot>
                    </table>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

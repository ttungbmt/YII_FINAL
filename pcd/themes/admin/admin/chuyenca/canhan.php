<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/8/2018
 * Time: 10:31 AM
 */
$this->title = "Thông báo ca nhận"
?>

<style>
    .noti-item:hover{
        background: #eee;
    }
    .noti-item:first-child{
        border-top: 1px solid #ccc
    }
    .noti-item{
        margin: 0 !important;
        border-bottom: 1px solid #ccc;
        padding: 5px 10px;
    }
</style>

<div class="card">
    <div class="card-header" style="border-bottom: 1px solid #aaa; padding: 10px;">
        <span class="font-weight-bold">Thông báo</span>
    </div>
    <div class="card-body" style="padding: 10px 0px;">
        <ul class="media-list">
            <?php foreach($canhans as $cb) :?>
                <li class="media noti-item" style="">
                    <div class="mr-3 position-relative">
                        <i class="icon-aid-kit"></i>
                    </div>
                    <a href="" class="noti-item-read" id="<?=$cb['id']?>">
                        <div class="media-body">
                            <div class="media-title">
                                <span class="font-weight-semibold" style="color: #000"><?= $cb['tenphuong'] . " " . $cb['tenquan'] ?> <span style="font-weight: 400;"><?= "chuyển ca bệnh " . $cb['hoten']?></span></span>
                            </div>
                            <span class="text-muted"><?= $cb['created_at'] ?></span>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<script>
    $(function () {
        $(".noti-item-read").on('click', function () {
            $.ajax({
                type: "POST",
                url: "/admin/chuyenca/read-canhan",
                data: {
                    id: this.id
                }
            })
        })
    })
</script>

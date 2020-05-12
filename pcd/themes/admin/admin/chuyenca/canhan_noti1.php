<style>
    .noti-item:hover {
        background: #eee;
    }

    .noti-item:first-child {
        border-top: 1px solid #ccc
    }

    .noti-item {
        margin: 0 !important;
        border-bottom: 1px solid #ccc;
        padding: 5px 10px;
    }
</style>

<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
    <i class="icon-bell2"></i>
    <span class="d-md-none ml-2">Thông báo</span>
    <?php if (count($canhans) > 0) : ?>
        <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0"><?= count($canhans) ?></span>
    <?php endif; ?>
</a>

<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
    <div class="dropdown-content-header" style="border-bottom: 1px solid #ccc">
        <span class="font-weight-bold">Thông báo</span>
    </div>

    <div class="dropdown-content-body dropdown-scrollable">
        <ul class="media-list">
            <?php if(empty($canhans)):?>
                <li class="media">
                    <div class="mr-3">
                        <a href="#" class="btn bg-success-400 rounded-round btn-icon"><i class="icon-mention"></i></a>
                    </div>

                    <div class="media-body">
                        <a href="#">Taylor Swift</a> mentioned you in a post "Angular JS. Tips and tricks"
                        <div class="font-size-sm text-muted mt-1">4 minutes ago</div>
                    </div>
                </li>
            <?php else:?>
                <li class="media">
                    <div class="mr-3">
                        <a href="#" class="btn bg-success-400 rounded-round btn-icon"><i class="icon-mention"></i></a>
                    </div>

                    <div class="media-body">
                        <a href="#">Taylor Swift</a> mentioned you in a post "Angular JS. Tips and tricks"
                        <div class="font-size-sm text-muted mt-1">4 minutes ago</div>
                    </div>
                </li>
            <?php endif;?>

        </ul>
    </div>

    <!-- <div class="dropdown-content-body dropdown-scrollable" style="padding: 10px 0px;">
        <ul class="media-list">
            <?php /*foreach($canhans as $cb) :*/ ?>
            <li class="media noti-item" style="">
                <div class="mr-3 position-relative">
                    <i class="icon-aid-kit"></i>
                </div>

                <a href="" class="noti-item-read1" id="<? /*=$cb['id']*/ ?>">
                    <div class="media-body">
                        <div class="media-title">
                            <span class="font-weight-semibold" style="color: #000"><? /*= $cb['tenphuong'] . " " . $cb['tenquan'] */ ?> <span style="font-weight: 400;"><? /*= "chuyển ca bệnh " . $cb['hoten']*/ ?></span></span>
                        </div>
                        <span class="text-muted"><? /*= $cb['created_at'] */ ?></span>
                    </div>
                </a>
            </li>
            <?php /*endforeach; */ ?>
        </ul>
    </div>
-->
    <div class="dropdown-content-footer bg-light">
        <a href="#" class="font-weight-semibold text-grey mr-auto">Xem tất cả</a>
        <div>
            <a href="<?= url(['/notifications/markReadAll']) ?>" class="text-grey" data-popup="tooltip"
               title="Đánh dấu tất cả đã đọc"><i class="icon-checkmark3"></i></a>
            <a href="<?= url(['/notifications/settings']) ?>" class="text-grey ml-2" data-popup="tooltip"
               title="Cài đặt"><i class="icon-gear"></i></a>
        </div>
    </div>

</div>
<script>
    $(function () {
        $(".noti-item-read1").on('click', function () {
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


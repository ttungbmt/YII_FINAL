<?php
use yii\bootstrap\Html;

$li = function ($name, $url, $icon = '', $access = null){
    $active = (app('request')->url == $url) ? 'active' : '';
    if($access && !can($access)){
        return null;
    }

    return (
        Html::tag('li', (
        Html::a((
            (empty($icon) ? '':  Html::tag('i', null, ['class' => $icon])).
            Html::tag('span', $name)
        ), $url, ['class' => 'nav-link'])
        ), ['class' => 'nav-item '.$active])
    );
};
$header = function ($title){
    return "<li class='nav-item-header'><div class='text-uppercase font-size-xs line-height-xs'>{$title}</div> <i class='icon-menu' title='{$title}'></i></li>";
};
?>

<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>

    <div class="sidebar-content">

        <?=$this->render('@app/views/partials/_sb_user')?>

        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Bảng tin</div> <i class="icon-menu" title="Bảng tin"></i></li>
                <?=$li(lang('Dashboard'), '/admin', 'icon-home4')?>
                <li class="nav-item"><a href="<?='/admin/site/changelog'?>" class="nav-link"><i class="icon-list-unordered"></i><span><?=lang('Changelog')?></span><span class="badge bg-blue-400 align-self-center ml-auto">2.0</span></a></li>
                <?=$li(lang('Contact'), '/admin/site/contact', 'icon-phone')?>

                <?=$header('Quản lý SXH')?>

                <li class="nav-item nav-item-submenu nav-item-open">
                    <a href="#" class="nav-link"><i class="icon-history"></i> <span>Bệnh SXH</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Bệnh truyền nhiễm" style="display: block">
                        <?=$li('Danh sách', '/admin/cabenh-sxh')?>
                        <?=$li('Ca chuyển', '/admin/chuyenca')?>
                        <?=$li('Thống kê', '/admin/thongke')?>
                        <?=$li('Nhập excel', '/import/sxh', null, 'sxh.import')?>

                        <?php if(role('admin')):?>
                            <?=$li('Ca bệnh nghi ngờ', '/admin/cabenh-sxh-nn')?>

                        <?php endif; ?>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-cart4"></i> <span>Ổ dịch</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Ổ dịch">
                        <?=$li('Danh sách', '/sxh/odich', null, 'odich.index.view')?>
                        <?=$li('Thống kê', '/sxh/thongke/odich', null, 'odich.thongke')?>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-history"></i> <span>Điểm nguy cơ</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Lược sử">
                        <?=$li('Danh sách ĐNC', '/pt_nguyco', null, 'dnc')?>
                        <?=$li('Danh sách giám sát', ['/pt_nguyco/phieu-gs'], null, 'dnc')?>
                        <?=$li('Thống kê', ['/pt_nguyco/thongke'], null, 'dnc.thongke')?>
                        <?php if(role('admin')):?>
                            <?=$li('Nhập Excel', ['/import/dnc'], null, 'dnc.import')?>
                        <?php endif; ?>
                    </ul>
                </li>

                <?php if(can('xn-huyetthanh.index.view')):?>
                    <li class="nav-item nav-item-submenu">
                        <a href="#" class="nav-link"><i class="icon-history"></i> <span>Xét nghiệm huyết thanh</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Xét nghiệm huyết thanh">
                            <?=$li('Danh sách', '/admin/xn-huyetthanh', null, 'xn-huyetthanh.index.view')?>
                            <?=$li('Nhập excel', '/import/xn-huyetthanh', null, 'xn-huyetthanh.import')?>
                            <?=$li('Thống kê', '/thongke/xn-huyetthanh', null, 'xn-huyetthanh.thongke')?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(can('benh_tn.index.view')):?>
                    <?=$header('Quản lý bệnh khác')?>
                    <li class="nav-item nav-item-submenu">
                        <a href="#" class="nav-link"><i class="icon-history"></i> <span>Bệnh truyền nhiễm</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Bệnh truyền nhiễm">
                            <?=$li('Danh sách', '/benh_tn', null, 'benh_tn.index.view')?>
                            <?=$li('Nhập excel', '/import/dichbenh', null, 'benh_tn.import')?>
                            <?=$li('Thống kê', '/thongke/benh-tn', null, 'benh_tn.thongke')?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(role('admin')):?>
                    <?=$header('Kiểm tra')?>
                    <?=$li('Thông tin ca bệnh', '/admin/kiemtra-cabenh', 'icon-stack')?>
                <?php endif; ?>

                <?php if(role('admin')):?>
                    <?=$header('Nhập excel')?>
                    <?=$li('Excel Thông tin xét nghiệm', '/admin/xetnghiem-update', 'icon-database-insert')?>
                    <?=$li('Excel Ca bệnh nghi ngờ', '/admin/cabenh-sxh-nn-import', 'icon-database-insert')?>
                <?php endif; ?>

                <?=$header('QL danh mục')?>
                <?=$li('Dân số', '/admin/danso', 'icon-file-text')?>

                <?php if(role('admin')):?>
                    <?=$li('Chỉ tiêu GS huyết thanh', '/admin/chitieu-ht', 'icon-file-text')?>
                    <?=$li('Loại bệnh', '/admin/loaibenh', 'icon-file-text')?>
                    <?=$li('Bệnh viện', '/admin/benhvien', 'icon-office')?>
                    <?=$li('Loại hình ĐNC', '/pt_nguyco/dm-loaihinh', 'icon-file-text')?>

                    <?=$li('Ranh tổ', '/dm/ranhto', 'icon-file-text')?>
                <?php endif; ?>
                <?=$li('Khu phố', '/dm/khupho', 'icon-file-text')?>
                <?=$li('Tổ dân phố', '/dm/to-dp', 'icon-file-text')?>

                <?php if(role('admin')):?>
                    <?=$header('Quản trị hệ thống')?>
                    <?=$li('Người dùng', '/auth/user', 'icon-user-tie')?>
                    <?=$li('Phân quyền người dùng', '/auth/role', 'icon-people')?>
                    <?=$li('Phân quyền truy cập', '/auth/permission', 'icon-lock')?>

                    <li class="nav-item nav-item-submenu">
                        <a href="#" class="nav-link"><i class="icon-history"></i> <span>Lược sử </span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Lược sử">
                            <?=$li('Truy cập', '/auth/log-auth')?>
                            <?=$li('Thao tác', '/auth/log-user')?>
                        </ul>
                    </li>
                <?php endif;?>

                <?=$header('Khác')?>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-book"></i> <span>Hướng dẫn sử dụng</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Hướng dẫn sử dụng">
                        <?=$li('Tài liệu', '/admin/site/doc-guide')?>
                        <?=$li('Video', '/admin/site/video-guide')?>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</div>
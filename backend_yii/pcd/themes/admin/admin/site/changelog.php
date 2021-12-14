<?php
$this->title = 'ChangeLog';
use yii\helpers\Html;
?>
<div class="d-flex align-items-start flex-column flex-md-row">

    <!-- Left content -->
    <div class="w-100 order-2 order-md-1">

        <!-- Initial release -->
        <div class="card" id="v_1_0">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Phát hành</h5>
                <div class="header-elements">
                    <span class="text-muted">1 Tháng 1, 2018</span>

                    <!--                    <div class="list-icons ml-3">-->
                    <!--                        <a class="list-icons-item" data-action="collapse"></a>-->
                    <!--                        <a class="list-icons-item" data-action="reload"></a>-->
                    <!--                        <a class="list-icons-item" data-action="remove"></a>-->
                    <!--                    </div>-->
                </div>
            </div>

            <div class="card-body">
                <p class="content-group">Giai đoạn I - năm 2017: Hệ dựng hệ thống quản lý bệnh truyền nhiễm.</p>
                <pre class=" language-javascript">
                    <code class=" language-javascript" data-language="javascript">
<span class="token comment" spellcheck="true">// Chức năng hệ thống -------------</span>
<span class="token punctuation">[</span><span class="token keyword">new</span><span class="token punctuation">]</span>  Quản lý ca bệnh sốt xuất huyết
<span class="token punctuation">[</span><span class="token keyword">new</span><span class="token punctuation">]</span>  Quản lý ổ dịch
<span class="token punctuation">[</span><span class="token keyword">new</span><span class="token punctuation">]</span>  Quản lý ca bệnh
<span class="token punctuation">[</span><span class="token keyword">new</span><span class="token punctuation">]</span>  Nhập dữ liệu ca bệnh bằng file excel
<span class="token punctuation">[</span><span class="token keyword">new</span><span class="token punctuation">]</span>  Phân quyền truy cập
<span class="token punctuation">[</span><span class="token keyword">new</span><span class="token punctuation">]</span>  Lược sử
                    </code>
                </pre>
            </div>
        </div>
        <!-- /initial release -->

    </div>
    <!-- /left content -->

    <!-- Right sidebar component -->
    <div class="sidebar-sticky w-100 w-md-auto order-1 order-md-2">
        <div class="sidebar sidebar-light sidebar-component sidebar-component-right sidebar-expand-md" style="">
            <div class="sidebar-content">

                <!-- Navigation -->
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Phiên bản</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <a href="/admin/site/contact" class="btn bg-danger-400 btn-block" target="_blank"><i
                                    class="icon-lifebuoy mr-2"></i>Hỗ trợ</a>
                    </div>

                    <ul class="nav nav-sidebar nav-scrollspy">
                        <li class="nav-item-header font-size-xs line-height-xs text-uppercase pt-0">Lịch sử phiên bản
                        </li>
                        <li class="nav-item"><a href="#v_1_0" class="nav-link">Phát hành<span
                                        class="text-muted font-weight-normal ml-auto">1 Tháng 1, 2018</span></a></li>
                        <li class="nav-item-header font-size-xs line-height-xs text-uppercase pt-0">Mở rộng</li>
                        <li class="nav-item"><a href="/admin/site/contact" class="nav-link"><i
                                        class="icon-bubbles4 text-slate-400"></i> Liên hệ &amp; Hỗ trợ</a></li>
                        <li class="nav-item"><a href="/admin/site/doc-guide" class="nav-link"><i
                                        class="icon-graduation text-slate-400"></i>Tài liệu sử dụng</a></li>
                    </ul>
                </div>
                <!-- /navigation -->

            </div>
        </div>
    </div>
    <!-- /right sidebar component -->
</div>
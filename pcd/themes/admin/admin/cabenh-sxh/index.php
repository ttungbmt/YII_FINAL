<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel pcd\search\CanghingoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
CrudAsset::register($this);


$this->title = "Quản lý ca bệnh SXH";
$is_partial = request('partial') == true;
$role = \pcd\supports\RoleHc::init();
$gridColumns = require(__DIR__ . '/_columns.php');
$exportMenu =  ExportMenu::widget(['dataProvider' => $dataProvider, 'columns' => $gridColumns]);
?>
<style>
    .grid-view td {
        white-space: nowrap;
    }
</style>

<?php if(role('quan|phuong')):?>
    <div class="alert alert-primary border-0 alert-dismissible" style="margin-bottom: 30px">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <span class="font-weight-semibold text-uppercase">Thông báo!</span>
        <br> - Hiện tại hệ thống vừa được cập nhật nên không thể tránh khỏi những lỗi kỹ thuật về tài khoản và chức năng. Mong quý anh/chị thông cảm cho sự bất tiện này ảnh hưởng tiến độ công việc, hiện chúng tôi đang hoàn tất chỉnh sửa để hệ thống được tốt hơn. Chân thành cám ơn.
        <br> - Trường hợp không nhập được phiếu điều tra. Quý anh/ chị gửi mail thông tin liên hệ và hình ảnh chụp lỗi cho TÙNG (ttungbmt@gmail.com - 0796628733) để được xử lỷ ngay, kịp tiến độ công việc
    </div>
<?php endif;?>


<div class="dm-dichte-index">
    <div id="ajaxCrudDatatable">
        <?= $this->render('_search', ['model' => $searchModel]) ?>

        <?= GridView::widget([
            'id'               => 'crud-datatable',
            'dataProvider'     => $dataProvider,
            'filterModel'      => $searchModel,
            'responsiveWrap'      => false,
            'pjax'             => true,
            'pjaxSettings'     => [
                'options' => [
                    'enablePushState' => $is_partial ? false : true,
                    'formSelector'    => '#ajaxCrudDatatable form[data-pjax]',
                    'scrollTo'        => true,
                ],
            ],
            'columns'          => $gridColumns,
            'toolbar'          => [
                ['content' =>
                     $is_partial ? '' : (
                         (!role('guest') ? Html::a('Thêm mới', ['/sxh/default/update'],
                             ['title' => 'Thêm mới', 'class' => 'btn btn-primary', 'data-pjax' => 0]): '').
                         Html::a('<i class="icon-reload-alt"></i>', [''],
                             ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => lang('Reset Grid')]) .
                         '{toggleData}'
                     )
                ],
                $exportMenu,
            ],
            'striped'          => true,
            'condensed'        => true,
            'responsive'       => $is_partial ? false : true,
            'resizableColumns' => false,
            'panel'            => [
                'type'    => 'primary',
                'heading' => 'Danh sách ca bệnh',
                'before'  => Html::tag('div', $role->btnChuyenca(), ['class' => 'btn-group'])
            ],
            'tableOptions'     => ['id' => 'tbl-cabenh'],
        ]) ?>
    </div>

</div>
<?php Modal::begin([
    "id"     => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>
<script>

    function toAddress(sonha, tenduong, to_dp, khupho, tenphuong, tenquan, ten_tp = "HCM") {
        sonha = ucfirst(sonha.trim());
        tenduong = ucfirst(tenduong.trim());
        to_dp = ucfirst(to_dp.trim());
        khupho = ucfirst(khupho.trim());
        tenphuong = ucfirst(tenphuong.trim());
        tenquan = ucfirst(tenquan.trim());
        ten_tp = ucfirst(ten_tp.trim());

        if (ten_tp === "") {
            ten_tp = "HCM";
        }

        if ((sonha == null || sonha === "") && (tenduong == null || tenduong === "") && (to_dp == null || to_dp === "") &&
            (khupho == null || khupho === "") && (tenphuong == null || tenphuong === "") && (tenquan == null || tenquan === "")) {
            return "Không rõ địa chỉ";
        }

        let diachi = "";

        if (sonha != null && sonha !== "") {
            if (tenduong != null && tenduong !== "") {
                diachi += sonha + " ";
            } else {
                diachi += sonha + ", ";
            }
        }

        if (tenduong != null && tenduong !== "") {
            diachi += tenduong + ", ";
        }

        if (to_dp != null && to_dp !== "") {
            diachi += to_dp + ", ";
        }

        if (khupho != null && khupho !== "") {
            diachi += khupho + ", ";
        }

        if (tenphuong != null && tenphuong !== "") {
            diachi += tenphuong + ", ";
        }

        if (tenquan != null && tenquan !== "") {
            diachi += tenquan + ", ";
        }

        diachi += ten_tp;

        return diachi;
    }

    function ucfirst(str) {
        let strUcFirst = "";
        if (str.length === 0) {
            return str;
        } else {
            let list = str.split(" ");
            list.forEach(function (item) {
                strUcFirst += item[0].toUpperCase() + item.substring(1) + " "
            })
        }

        return strUcFirst;
    }
</script>






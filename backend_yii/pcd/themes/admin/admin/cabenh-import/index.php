<?php
use kartik\helpers\Html;
use kartik\widgets\ActiveForm;

$this->title = 'Nhập Excel Ca bệnh nghi ngờ';
?>
<div class="card card-white">
    <?php $form = ActiveForm::begin([
        'options' => ['id' => 'uploadForm', 'enctype' => 'multipart/form-data'],
//        'type' => ActiveForm::TYPE_INLINE,
    ]);?>
    <div class="card-header header-elements-inline">
        <div class="card-title text-semibold text-uppercase">
            <i class="icon-database-add text-size-base position-left"></i>
            Nhập dữ liệu
        </div>
        <div class="heading-elements">
            <?= Html::a('<i class="icon-file-download"></i> Tải file mẫu', $sampleFile,['class' => 'btn btn-link']) ?>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'file')->fileInput()->label(false) ?>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="btn-group pull-right">
                    <?= Html::submitButton('<span class="ladda-label"> <i class="icon-cloud-upload"></i> Xem trước</span>', ['id' => 'btnPreview', 'name' => 'btnPreview', 'class' => 'btn btn-success btn-ladda btn-ladda-spinner', 'data-style' => 'zoom-in']) ?>
                    <?= Html::button('<span class="ladda-label"><i class="icon-database-insert"></i> Nhập tất cả</span>', ['id' => 'btnSaveAll', 'class' => 'btn btn-primary btn-ladda btn-ladda-spinner', 'data-style' => 'zoom-in']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end() ?>
    <div id="importResp" style="overflow: hidden">
    </div>
</div>

<div class="alert" style="border: 1px solid rgba(0, 188, 212, 0.52); background-color: white;">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <h6 class="alert-heading font-weight-semibold"><span class="badge bg-blue-400">1 </span>  Hướng dẫn</h6>
    <p> - Nhấn nút "TẢI FILE MẪU" để tải file excel mẫu về máy</p>
    <p> - Nhấn nút "CHOOSE FILE" để chọn file excel nhập dữ liệu</p>
    <p> - Nhấn nút "XEM TRƯỚC" để hiển thị giao diện xem và chỉnh sửa dữ liệu file excel</p>
    <p> - Nhấn nút "NHẬP DỮ LIỆU" để nhập dữ liệu trên trang hiện tại vào cơ sở dữ liệu</p>
    <p> - Nhấn nút "NHẬP TẤT CẢ" để nhập toàn bộ dữ liệu từ file excel vào cơ sở dữ liệu</p>
    <br>

    <h6 class="alert-heading font-weight-semibold"><span class="badge bg-blue-400">2 </span>  Format file excel mẫu</h6>
    <p> - Không thay đổi tên của các ô tại dòng thứ 2 của file mẫu </p>
    <p> - Không thay đổi format kiểu dữ liệu của file mẫu </p>
    <p> - Tên bệnh nằm trong <a href="/admin/loaibenh" target="_blank">danh sách</a> loại bệnh (cột "Mã bệnh")</p>
    <p> - Nếu tên bệnh không nằm trong danh sách loại bệnh ở trên, ghi rõ tên bệnh vào cột "Tên bệnh"</p>
</div>

<?php $this->beginBlock('scripts') ?>
    <script src="<?=url('/libs/bower/jquery.floatThead/dist/jquery.floatThead.min.js')?>"></script>
    <script>
        $(function () {
            const postApi = (url, data) => {
                return $.ajax({
                    url,
                    type: 'POST',
                    data,
                    processData: false,
                    contentType: false,
                })
            }

            $('#uploadForm').submit(function (e) {

                document.cookie = "refesh=true";
                e.preventDefault()
                window.pages = []

                let data = new FormData(this)
                let l = Ladda.create($('#btnPreview')[0])
                l.start()
                const api = postApi(`/admin/cabenh-sxh-nn-import?type=preview`, data)
                api.done(res => {
                    l.stop()
                    $('#importResp').html(res.html)
                }).fail(() => l.stop())
            })

            $('#btnSaveAll').click(function (e) {
                window.pages = []

                e.preventDefault()
                let l = Ladda.create($(this)[0])
                let data = new FormData($('#uploadForm')[0])
                const api = postApi(`/admin/cabenh-sxh-nn-import?type=save-all`, data)
                l.start()
                api.done(res => {
                    l.stop()
                    $('#importResp').html(res.html)
                }).fail(() => l.stop())
            })

        })
    </script>
<?php $this->endBlock() ?>
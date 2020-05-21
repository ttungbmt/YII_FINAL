<?php
use kartik\helpers\Html;
use kartik\widgets\ActiveForm;

$this->title = 'Nhập Excel Điểm nguy cơ';
$postUrl = '/import/dnc';
?>

<div class="card card-white">
    <?php $form = ActiveForm::begin([
        'options' => ['id' => 'uploadForm', 'enctype' => 'multipart/form-data'],
    ]);?>
    <div class="card-header header-elements-inline">
        <div class="card-title font-weight-semibold text-uppercase">
            <i class="icon-database-add text-size-base position-left"></i>
            Nhập dữ liệu
        </div>
        <div class="heading-elements">
            <?= Html::a('<i class="icon-file-download"></i> Tải file mẫu', $sample,['id' => 'btn-download', 'class' => 'btn btn-link']) ?>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'file')->fileInput()->label(false) ?>
            </div>
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
                const api = postApi(`<?=$postUrl?>?type=preview`, data)
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
                const api = postApi(`<?=$postUrl?>?type=save-all`, data)
                l.start()
                api.done(res => {
                    l.stop()
                    $('#importResp').html(res.html)
                }).fail(() => l.stop())
            })

        })
    </script>
<?php $this->endBlock() ?>
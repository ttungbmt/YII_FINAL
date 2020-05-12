
<div>
    <h6 class="font-weight-semibold">1.	Phạm vi khoanh vùng xử lý (tự lấy)</h6>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'phamvi_khupho')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phamvi_to')->textInput() ?>
        </div>
    </div>

    <h6 class="font-weight-semibold">2.	Diệt lăng quăng</h6>
    <?= $form->field($model, 'tmp[]')->textInput()->label('Tổ') ?>
    <?= $form->field($model, 'tmp[]')->textInput()->label('Đợt 1: Ngày') ?>
    <?= $form->field($model, 'tmp[]')->textInput()->label('Đợi 2: Ngày') ?>
    <h6 class="font-weight-semibold">3.	Hoạt động phun hóa chất</h6>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tmp[]')->textInput()->label('Số tổ phun hóa chất') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tmp[]')->textInput()->label('Số nhà') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
             <?= $form->field($model, 'tmp[]')->textInput()->label('Số máy nhỏ sử dụng') ?>
        </div>
        <div class="col-md-3">
             <?= $form->field($model, 'tmp[]')->textInput()->label('Số máy lớn sử dụng') ?>
        </div>
        <div class="col-md-3">
             <?= $form->field($model, 'tmp[]')->textInput()->label('Đi các tuyền đường') ?>
        </div>
        <div class="col-md-3">
             <?= $form->field($model, 'tmp[]')->textInput()->label('Số máy') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tmp[]')->textInput()->label('Số lít hóa chất dự trù') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tmp[]')->textInput()->label('Loại hóa chất') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'tmp[]')->textInput()->label('Nhân sự gồm (người)') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tmp[]')->textInput()->label('Nhân sự mang máy nhỏ') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tmp[]')->textInput()->label('Nhân sự dẫn đường') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tmp[]')->textInput()->label('Nhân sự giám sát') ?>
        </div>
    </div>

    <h6>Thời gian phun hóa chất</h6>
    <?= $form->field($model, 'tmp[]')->textInput()->label('Nhân sự giám sát') ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tmp[]')->textInput()->label('Lần 1: ngày') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tmp[]')->textInput()->label('Lúc') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tmp[]')->textInput()->label('Lần 2: ngày') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tmp[]')->textInput()->label('Lúc') ?>
        </div>
    </div>

    <h6 class="font-weight-semibold">4.	Khảo sát côn trùng</h6>
    <?= $form->field($model, 'tmp[]')->textInput()->label('Lần 1 dự kiến vào ngày') ?>
    <?= $form->field($model, 'tmp[]')->textInput()->label('Lần 2 dự kiến vào ngày') ?>
    <?= $form->field($model, 'tmp[]')->textInput()->label('Lần 3 dự kiến vào ngày') ?>
</div>
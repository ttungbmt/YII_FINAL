<?php
use kartik\alert\Alert;
 //$this->render('//messages/errors', ['errors' => $model->getErrors()]);

if($model->hasErrors()) {
    echo Alert::widget([
        'type' => Alert::TYPE_WARNING,
        'title' => 'Lỗi!',
        'icon' => 'icon-warning',
        'showSeparator' => true,
        'body' => 'Vui lòng chọn quận/huyện để thực hiện thống kê',
    ]);
}
?>
<style>
    .fade:not(.show){
        opacity: 1;
    }
</style>

<?php
namespace pcd\modules\import\controllers;

use common\controllers\BackendController;
use common\controllers\ImportTrait;
use common\forms\UploadForm;
use common\libs\excel\Excel;
use pcd\models\Danso;
use pcd\models\DmQuan;
use pcd\models\HcQuan;
use pcd\supports\RoleHc;

class DansoController extends BackendController {
    use ImportTrait;

    public $enableCsrfValidation = false;
    protected $modelImportClass = 'pcd\modules\import\forms\DansoImportForm';
    protected $modelClass = 'pcd\models\Danso';

    public function actionQuan(){
        $role = RoleHc::init();
        $qh = HcQuan::find()->orderBy('order');
        if(request('role')){
            $role->filterHc($qh);
        }
        $qh = $qh->pluck('tenquan', 'maquan');
        return $this->asJson($qh);
    }

    protected function options()
    {
        return [
            'header' => ['tt', 'ten_qh'],
            'sample' => '/pcd/storage/samples/DAN SO UOC.xlsx',
            'startDataRow' => 1
        ];
    }

    protected function extraHeader() {
        $add_prefix = function ($i, $range){ return array_map(function ($v) use($i, $range){ return $i.$v; }, $range);};
        $col = array_merge($add_prefix('',range('1995', '2025')), $add_prefix('ds_uoc_',range('2017', '2025')));
        return $col;
    }


    public function actionIndex()
    {
        $model = new UploadForm();
        $excel = new Excel();
        if ($model->load(request()->post())) {
            if ($model->validateForm()) {
                $fileName = $model->file->tempName;
                $type = request('type');
                $this->prepareData();

                $startDataRow = $this->opt('startDataRow', 4);
                $exHeader = collect($excel->readSheetHeader($fileName, $startDataRow))->filter()->values();
                $header = collect($this->opt('header'))->merge($this->extraHeader());
                $exData = collect($excel->import($fileName, $startDataRow));


                # Validate header
                $diff = $exHeader->diff($header);
                if ($diff->isNotEmpty()) {
                    $this->data['messages'] = "Excel k đúng định dạng. Không tồn tại các cột: <b>" . $diff->implode(',') . "</b>. Vui lòng kiểm tra mã các cột";
                    return $this->renderJson(['html' => $this->renderAjax('@common/themes/admin/admin/import/_errors', $this->data)]);
                }
                $hc = DmQuan::pluck('ma_quan', 'ten_qh');
//                $data = collect($exData)->map(function ($v, $k) use($hc){
//                    $v['maquan'] = data_get($hc, $v['ten_qh']);
//                    unset($v['tt']);
//                    unset($v['ten_qh']);
//                    return $v;
//                })->groupBy($groupBy);
                foreach ($exData->all() as $row){
                    $m = new Danso();
                    $maquan = (string)data_get($hc, $row['ten_qh']);
                    $uoctinh = collect($row)->filter(function ($v, $k){return starts_with($k, 'ds_uoc_');})
                        ->mapWithKeys(function ($v, $k) use($maquan){
                            $year = str_replace('ds_uoc_', '', $k);
                            $m = new Danso();
                            $m->setAttributes(['ma_hc' => $maquan, 'nam' => $year, 'uoctinh' => 1, 'danso' => round($v)]);
                            return [$year => $m];
                        });
                    $dat = collect($row)->filter(function ($v, $k){return in_array($k, range(1995, 2025));})->map(function ($v, $year)  use($maquan){
                        $m = new Danso();
                        $m->setAttributes(['ma_hc' => $maquan, 'nam' => $year, 'uoctinh' => 0, 'danso' => round($v)]);
                        return $m;
                    })->merge($uoctinh);

                    foreach ($dat as $m){
                        $m->save();
                    }
                }



                dd('Finish');
                return $this->renderJson([
                    'html' => $this->renderAjax('_preview', $this->data)
                ]);
            }

        }

        $this->data_set('sample', $this->opt('sample'));
        return $this->render('index', array_merge(['model' => $model, 'errors' => $this->errors], $this->data));
    }

}
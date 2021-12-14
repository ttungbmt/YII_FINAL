<?php
namespace pcd\controllers\admin;

use common\controllers\ImportTrait;
use pcd\controllers\AppController;
use pcd\models\CabenhSxh;
use pcd\models\XacminhCb;
use pcd\models\HcPhuong;
use yii\base\Model;
use pcd\models\Loaibenh;

class CabenhImportController extends AppController
{
    use ImportTrait;
    public $enableCsrfValidation = false;
    protected $formClass = 'pcd\forms\CabenhImportForm';
    protected $modelClass = 'pcd\models\CabenhSxh';
    protected $sampleFile = 'storage/samples/ca-benh.xlsx';
    protected $instructionView = '@pcd_theme/admin/admin/cabenh-import/_instruction';
    protected $startDataRow = 2;

    public function options(){
        return [];
    }

    /**
     * @param $data
     * @param $name
     *
     * @return bool
     */
    protected function validateModels(&$data, $name)
    {
        $data = collect($data)->map(function ($item) {
            $item = $item->toArray();
            /**
             * Chuyển từ tên quận huyện sang mã quận huyện
             */
            $phuong = HcPhuong::find()->where(['tenphuong_en' => $item['phuongxa']])->andWhere(['tenquan_en' => $item['quanhuyen']])->one();
            if($phuong) {
                $item['maphuong'] = $phuong->maphuong;
                $item['maquan'] = $phuong->maquan;
                $item['px'] = $phuong->maphuong;
                $item['qh'] = $phuong->maquan;
            }
            return $item;
        })->values()->all();

        $existCabenh = [];

        foreach($data as $d){
            $q = CabenhSxh::find()
                ->where(['hoten' => $d['hoten']])
                ->andWhere(['tuoi' => $d['tuoi']])
                ->andWhere(['maquan' => $d['maquan']])
                ->andWhere(['maphuong' => $d['maphuong']])
                ->andWhere(['ngaybaocao' => $d['ngaybaocao']])
                ->one();
            if($q) {
                array_push($existCabenh, $d['stt'] . '-' . $d['hoten']);
            }
        }

        if($existCabenh) {
            $this->data['errors'] = "Dữ liệu đã tồn tại trong cơ sở dữ liệu, vui lòng kiểm tra lại thông tin các ca bệnh sau: " . implode(", ", $existCabenh);
            return false;
        }

        $models = array_fill(0, count($data), $name);

        if (Model::loadMultiple($models, $data, '') && Model::validateMultiple($models)) {
            $dm_benh = Loaibenh::pluck('tenbenh', 'mabenh')->keys();

            foreach ($data as $d) {
                $m = new $this->modelClass;
                $m->setAttributes($d);

                /**
                 * Kiểm tra tên bệnh
                 * Nếu không nằm trong danh sách loại bệnh, lưu thành bênh khác
                 */
                if($dm_benh->contains($d['tenbenh'])){
                    $m->chuandoan_bd = $d['tenbenh'];
                } else {
                    $m->chuandoan_bd = 'KHAC';
                    $m->chuandoan_bd_khac = $d['tenbenh'];
                }

                /**
                 * Kiểm tra lat lng
                 */
                if ($d['lat'] && $d['lng']) {
                    $m->geom = [$d['lng'], $d['lat']];
                }

                $m->save();

                /**
                 * Lưu thông tin địa chỉ vào table địa chỉ
                 */

                $dc = new XacminhCb();
                $dc->setAttributes([
                    'cabenh_id' => $m->gid,
                    'px' => $m->maphuong,
                    'qh' => $m->maquan,
                    'dienthoai' => $m->dienthoai,
                ]);

                $dc->save();
            }
            return true;
        }

        $this->data['errors'] = $models;

        return false;
    }

}
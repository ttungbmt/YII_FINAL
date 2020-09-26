<?php

namespace pcd\modules\sxh\forms;

use Carbon\Carbon;
use codeonyii\yii2validators\AtLeastValidator;
use common\forms\MyForm;
use common\models\User;
use common\modules\auth\models\UserInfo;
use common\modules\notifications\models\Notification;
use Illuminate\Support\Arr;
use nepstor\validators\DateTimeCompareValidator;
use pcd\models\CabenhSxh;
use pcd\models\Chuyenca;
use pcd\models\DieutraSxh;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use pcd\models\XacminhCb;
use pcd\notifications\ChuyencaNoty;
use ttungbmt\db\Query;
use yii\base\Arrayable;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class SxhForm extends MyForm
{
    use SxhTrait, SxhMapTrait, SxhAttrTrait;

    const SCENARIO_XACMINH = 'xacminh';
    const SCENARIO_DIEUTRA = 'dieutra';

    protected function checkRequiredDate(){
        return Carbon::createFromFormat('d/m/Y', $this->ngaydieutra) >= Carbon::parse('2020-07-20');
    }

    public function xacminhValidator($attribute, $params, $validator)
    {
        $xacminh = $this->{$attribute};

        if (is_array($xacminh)) {
            foreach ($xacminh as $k => $v) {
                $index = $k + 1;
                $i = optional((object)$v);

                if($i->tinh == 'HCM' && $i->duong == '' && $this->checkRequiredDate()){
                    $this->addError("xacminh.{$k}.duong", "Đường ($index) buộc nhập");
                }

                if (!$i->tinh && !($index % 2 == 0 && $i->is_diachi == 0 || is_null($i->is_diachi))) {
                    $this->addError("xacminh.{$k}.tinh", "Tỉnh ($index) buộc nhập");
                }

                // TH: 2 4 6
                if ($i->tinh === 'HCM' && (($i->is_diachi == 1 && $index % 2 == 0) || $index % 2 != 0)) {
                    // TH: 1 3 5
                    if ($index % 2 != 0) {
                        if ($i->is_diachi == 1 && $this->checkRequiredDate()) {
                            if ($i->khupho == '') $this->addError("xacminh.{$k}.khupho", "Khu phố ($index) bắt buộc nhập");
                            if ($i->to_dp == '') $this->addError("xacminh.{$k}.to_dp", "Tổ dân phố ({$index}) bắt buộc nhập");
                        }

                        if((count($xacminh)-1) == $index){
                            if (role('phuong') && $i->px != userInfo()->maphuong) $this->addError("xacminh.{$k}.px", "Phường xã ($index) này không được chọn");
                            if (role('quan') && $i->qh != userInfo()->maquan) $this->addError("xacminh.{$k}.quan", "Quận huyện ($index) này không được chọn");
                        }

                    }


                    if (!$i->qh) $this->addError("xacminh.{$k}.qh", "Quận huyện ($index) buộc nhập");
                    if (!$i->px) $this->addError("xacminh.{$k}.px", "Phường xã ($index) buộc nhập");

                } elseif ($i->tinh === 'TinhKhac') {
                    if (!$i->tinh_dc_khac) $this->addError("xacminh.{$k}.tinh_dc_khac", "Địa chỉ tỉnh khác ({$index}) bắt buộc nhập");
                }

                if ($i->is_diachi === null) $this->addError("xacminh.{$k}.is_diachi", "Địa chỉ ({$index}) bắt buộc nhập");
                if ($i->is_benhnhan === null && ($index) % 2 !== 0) $this->addError("xacminh.{$k}.is_benhnhan", "Bệnh nhân ({$index}) bắt buộc nhập");
            }
        } else {
            $this->addError('xacminh.0.is_benhnhan', 'Bệnh nhân (1) không được bỏ trống');
            $this->addError('xacminh.0.is_diachi', 'Địa chỉ (1) không được bỏ trống');
        }

        if($this->id){
            $chca = Chuyenca::find()->andWhere(['cabenh_id' => $this->id])->orderBy(['id' => SORT_DESC])->one();
            $is_chuyentiep = data_get($chca, 'is_chuyentiep');
            if( request('status.is_chuyenca') && $is_chuyentiep === 0){
                $lastIndex = count($xacminh)-1;
                $this->addError("xacminh.{$lastIndex}.px", "Ca bệnh trả về không được phép tiếp tục chuyển ca");
            }
        }
    }

    public function rules()
    {
        return [
            [['loaidieutra', 'xacminh', 'loai_xm_cb', 'ngaymacbenh_nv', 'loaicabenh', 'list_chuyenca', 'is_chuyenca'], 'safe'],
            [['chuandoan_bd', 'chuandoan_bd_khac', 'me', 'ngaybaocao', 'ma_icd', 'shs', 'ht_dieutri', 'ngaynhanthongbao', 'ngaydieutra', 'maso', 'hoten', 'phai', 'ngaysinh', 'tuoi', 'vitri', 'to_dp', 'khupho', 'px', 'qh', 'tinh', 'tinh_dc_khac', 'benhnoikhac', 'sonhakhac', 'duongkhac', 'tokhac', 'khuphokhac', 'tinhkhac', 'qhkhac', 'pxkhac', 'tinhnoikhac', 'songuoicutru', 'cutruduoi15', 'tpbv', 'tpbv_bv', 'phcd', 'nhapvien', 'nhapvien_bv', 'ngaymacbenh', 'ngaynhapvien', 'nghenghiep', 'xetnghiem', 'ngaylaymau', 'loai_xn', 'ketqua_xn', 'dclamviec', 'dclamviec_tinh', 'dclamviecqh', 'dclamviecpx', 'noilamviec_sxh', 'nhacobnsxh', 'nhaconguoibenh', 'bvpk', 'nhatho', 'dinh', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu', 'noikhac', 'noikhac_ghichu', 'diemden_px', 'diemden_pxkhac', 'diemden_qhkhac', 'gdcosxh', 'gdsonguoisxh', 'gdso15t', 'gdthuocsxh', 'gdthuocsxhsonguoi', 'gdthuocsxh15t', 'bi', 'ci', 'cachidiem', 'dietlangquang', 'giamsattheodoi', 'xulyonho', 'xulyorong', 'cathuphat', 'odichmoi', 'odichcu', 'odichcu_xuly', 'xuly', 'xuly_ngay', 'xuatvien', 'ngayxuatvien', 'chuandoan', 'chuandoan_khac', 'nguoidieutra', 'nguoidieutra_sdt'], 'safe'],
            [['dienthoai', 'vitri', 'chuandoan', 'dclamviec_tinh', 'dclamviecqh', 'dclamviecpx'], 'safe'],
            [['chuandoan_bd'], 'required', 'on' => ['xacminh']],
            [['ht_dieutri'], 'required', 'on' => ['xacminh']],
            [['nguoidieutra_sdt', 'me'], 'string'],
            [['tuoi', 'ngaysinh'], AtLeastValidator::className(), 'in' => ['tuoi', 'ngaysinh'], 'message' => 'Điền ít nhất 1 trường: tuổi hoặc ngày sinh', 'on' => ['xacminh']],
            [['px', 'qh'], 'required', 'when' => function($model){
                return $model->tinh == 'HCM';
            }],
            [['ngaybaocao', 'hoten', 'ngaynhanthongbao', 'ngaydieutra', 'ngaybaocao', 'phai', 'ngaydieutra', 'nguoidieutra'], 'required', 'on' => ['xacminh']],
            ['xacminh', 'xacminhValidator', 'skipOnEmpty' => false, 'on' => ['xacminh']],
            [['sonha', 'duong', 'to_dp', 'khupho', 'px', 'qh', 'tinh', 'tinh_dc_khac'], 'safe'],
            [['lat', 'lng'], 'number'],
            [['geom'], 'geom', 'geoprocessing' => [$this, 'validateGeom']],
            [['songuoicutru', 'cutruduoi15', 'tuoi', 'bi', 'ci', 'gdsonguoisxh', 'gdso15t', 'gdthuocsxhsonguoi', 'gdthuocsxh15t', 'odichcu_xuly'], 'integer', 'min' => 0, 'max' => 5000, 'on' => ['dieutra']],
            // Ngày
            [['ngaybaocao', 'ngaysinh', 'ngaynhanthongbao', 'ngaydieutra', 'ngaymacbenh', 'ngaynhapvien', 'ngayxuatvien'], DateTimeCompareValidator::className(), 'compareValue' => date('d/m/Y'), 'operator' => '<=', 'format' => 'd/m/Y', 'jsFormat' => 'DD/MM/YYYY', 'skipOnEmpty' => true],
            [['ngaybaocao', 'ngaysinh', 'ngaynhanthongbao', 'ngaydieutra', 'ngaymacbenh', 'ngaynhapvien', 'ngayxuatvien'], 'date', 'format' => 'php:d/m/Y'],

            // BENH NOI KHAC
            [['benhnoikhac'], 'required', 'on' => ['dieutra']],
            [['tinhkhac'], 'required', 'when' => function () {
                return $this->benhnoikhac == 1;
            }],
            [['qhkhac', 'pxkhac'], 'required', 'when' => function () {
                return $this->tinhkhac == 'HCM' && $this->benhnoikhac == 1;
            }],
            [['tinhnoikhac'], 'required', 'when' => function () {
                return $this->tinhkhac == 'TinhKhac' && $this->benhnoikhac == 1;
            }],
            // --
            [['songuoicutru', 'cutruduoi15'], 'required', 'on' => ['dieutra']],
            [['xetnghiem'], 'required', 'on' => ['dieutra']],
            [['ngaylaymau', 'loai_xn', 'ketqua_xn'], 'required', 'on' => ['dieutra'], 'when' => function () {
                return $this->xetnghiem == 1;
            }],

            // TPBV
            [['tpbv'], 'required', 'on' => ['dieutra']],
            [['tpbv_bv'], 'required', 'when' => function () {
                return $this->tpbv == 1;
            }, 'on' => ['dieutra']],
            [['phcd'], 'required', 'when' => function () {
                return $this->tpbv == 0;
            }, 'on' => ['dieutra']],
            [['nhapvien'], 'required', 'when' => function () {
                return $this->phcd == 1;
            }, 'on' => ['dieutra']],
            [['nhapvien_bv'], 'required', 'when' => function () {
                return $this->nhapvien == 1;
            }, 'on' => ['dieutra']],

            [['ngaynhapvien'], 'required', 'when' => function () {
                return $this->tpbv == 1 || $this->nhapvien == 1;
            }, 'on' => ['dieutra']],
            [['ngaymacbenh'], 'required', 'on' => ['dieutra']],
            [['nghenghiep', 'dclamviec', 'noilamviec_sxh'], 'required', 'on' => ['dieutra']],

            [['nhacobnsxh', 'nhaconguoibenh', 'bvpk', 'nhatho', 'dinh', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu', 'noikhac'], 'required', 'on' => ['dieutra']],
            [['nhacobnsxh', 'nhaconguoibenh', 'bvpk', 'nhatho', 'dinh', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu', 'noikhac'], 'integer', 'on' => ['dieutra']],
            [['noikhac'], 'required', 'when' => function () {
                return $this->noikhac == 1;
            }, 'on' => ['dieutra']],
            [['noikhac_ghichu'], 'required', 'when' => function () {
                return $this->noikhac == 1;
            }, 'on' => ['dieutra']],

            [['diemden_px', 'diemden_pxkhac', 'diemden_qhkhac'], 'required', 'on' => ['dieutra']],

            [['gdcosxh'], 'required', 'on' => ['dieutra']],
            [['gdsonguoisxh', 'gdso15t'], 'required', 'when' => function () {
                return $this->gdcosxh == 1;
            }, 'on' => ['dieutra']],
            [['gdthuocsxh'], 'required', 'on' => ['dieutra']],
            [['gdthuocsxhsonguoi', 'gdthuocsxh15t'], 'required', 'when' => function () {
                return $this->gdthuocsxh == 1;
            }, 'on' => ['dieutra']],

            // 4. HƯỚNG XỬ LÝ
            [['bi', 'ci'], 'required', 'when' => function () {
                return $this->chuandoan == 1;
            }, 'on' => ['dieutra']],
            [['cachidiem'], 'required', 'on' => ['dieutra']],
            [['dietlangquang', 'giamsattheodoi', 'xulyonho'], 'required', 'when' => function () {
                return $this->cachidiem == 1;
            }, 'on' => ['dieutra']],
            [['xulyorong'], 'required', 'when' => function () {
                return $this->xulyonho === '0';
            }, 'on' => ['dieutra']],
            [['cathuphat'], 'required', 'when' => function () {
                return $this->cachidiem === '0';
            }, 'on' => ['dieutra']],
            [['odichmoi'], 'required', 'when' => function () {
                return $this->cathuphat == 1;
            }, 'on' => ['dieutra']],
            [['odichcu'], 'required', 'when' => function () {
                return $this->odichmoi === '0';
            }, 'on' => ['dieutra']],
            [['odichcu_xuly'], 'required', 'when' => function () {
                return $this->odichcu == 1;
            }, 'on' => ['dieutra']],
            [['xuly'], 'required', 'when' => function () {
                return $this->cathuphat == 1;
            }, 'on' => ['dieutra']],
            [['xuly_ngay'], 'required', 'when' => function () {
                return $this->xuly == 3;
            }, 'on' => ['dieutra']],

            // 5. KẾT LUẬN
            [['xuatvien'], 'required', 'on' => ['dieutra'], 'when' => function () {
                return $this->ht_dieutri == 1;
            }], // => Chú ý
            [['chuandoan'], 'required', 'on' => ['dieutra'], 'when' => function () {
                return $this->ht_dieutri == 0;
            }], // => Chú ý
            [['ngayxuatvien'], 'required', 'when' => function () {
                return $this->xuatvien == 1;
            }, 'on' => ['dieutra'], 'whenClient' => "function (attribute, value) { return false; }"],
            [['chuandoan'], 'required', 'when' => function () {
                return $this->xuatvien == 1;
            }, 'on' => ['dieutra']],
            [['chuandoan_khac'], 'required', 'when' => function () {
                return $this->chuandoan == 3;
            }, 'on' => ['dieutra']],
        ];
    }

    public function validateGeom()
    {
        $geojson = ['type' => 'Point', 'coordinates' => $this->geom];
        $e1 = "ST_SetSRID(ST_GeomFromGeoJSON('" . Json::encode($geojson) . "'), 4326)";
        $bool = true;
        $message = 'Tọa độ không hợp lệ';

        $e2 = function ($field) {
            return "SELECT ST_Union(geom) FROM {$field['table']} WHERE ST_Intersects(geom, (SELECT geom FROM {$field['table']} WHERE {$field['key']} = '{$field['value']}'))";
        };

        if (role('phuong')) {
            $maphuong = userInfo()->maphuong;
            $field = ['table' => HcPhuong::tableName(), 'key' => 'maphuong', 'value' => $maphuong];
            $bool = Arr::first((new Query())->select(new Expression("ST_Intersects( $e1, (" . $e2($field) . ")) bool"))->one());
            $message = 'Tọa độ không nằm trong phạm vi cập nhật phường xã của bạn';
        }

        if (role('quan')) {
            $field = ['table' => HcQuan::tableName(), 'key' => 'maquan', 'value' => userInfo()->maquan];
            $bool = Arr::first((new Query())->select(new Expression("ST_Intersects( $e1, (" . $e2($field) . ")) bool"))->one());
            $message = 'Tọa độ không nằm trong phạm vi cập nhật quận huyện của bạn';
        }

        if (!$bool) {
            $this->addError('geom', $message);
            return false;
        }

    }

    protected function loadDcCuoi($formData)
    {
        $lastXm = optional((object)(last($this->xacminh)));
        $count = count($this->xacminh);

        if($count > 1 && $count%2 == 0) {
            if($lastXm->is_diachi == 0){
                $lastXm = optional((object)($this->xacminh[$count-2]));
            } elseif ($lastXm->is_diachi == 1 && $lastXm->tinh != 'HCM'){
                $lastXm = optional((object)($this->xacminh[$count-1]));
            }
        }

        $this->to_dp = $lastXm->to_dp;
        $this->khupho = $lastXm->khupho;
        $this->sonha = $lastXm->sonha;
        $this->duong = $lastXm->duong;
        $this->px = $lastXm->px;
        $this->qh = $lastXm->qh;
        $this->tinh = $lastXm->tinh;
        $this->tinh_dc_khac = $lastXm->tinh_dc_khac;
        $this->diachi_cc_id = $lastXm->id;
        $this->dienthoai = $lastXm->dienthoai;
    }

    public function loadForm($id)
    {
        $this->scenario = SxhForm::SCENARIO_XACMINH;

        $this->id = $id;
        $cb = CabenhSxh::findOne($id);
        $cb = $cb ? $cb : new CabenhSxh();
        $xacminh = $cb->xacminhCbs;
        $this->setAttributes($cb->toArray());

        if ($cb) {
            if ($cb->geom) {
                $this->lat = $cb->geom[1];
                $this->lng = $cb->geom[0];
            }

            if ($cb->dieutraSxh) {
                $this->scenario = SxhForm::SCENARIO_DIEUTRA;
                $this->setAttributes($cb->dieutraSxh->toArray());
            }

            $chCas = $cb->getChuyenCas()->with(['nhan', 'chuyen'])->all();
            $this->list_chuyenca = $this->getListChuyenca($chCas);
        }

        $this->xacminh = $this->getListXacminh($xacminh);
    }

    protected function updateXacminh($cb, &$formData)
    {
        if ($cb->isNewRecord) return null;

        $listDbXacminh = $this->getListXacminh($cb->xacminhCbs);
        $this->xacminh = $this->xacminh ? $this->xacminh : $listDbXacminh;

        foreach ($this->xacminh as $k => $v) {
            if (data_get($listDbXacminh, $k)) {
                $index = $k+1;
                $dbXm = data_get($listDbXacminh, $k);
                $this->xacminh[$k] = array_merge($dbXm, $v ? $v : []);

                $xm = $this->xacminh[$k];
                if($index%2!=1 && $xm['is_diachi'] == 0 && is_null($xm['is_benhnhan'])){
                    $this->setNullAttrs($this->xacminh[$k], ['is_benhnhan', 'dienthoai', 'sonha', 'duong', 'to_dp', 'khupho', 'tinh', 'tinh_dc_khac', 'px', 'qh']);
                }
            }
        }
        if (opt($formData)->xacminh) unset($formData['xacminh']);
    }

    protected function setNullAttrs(&$obj, $attrs){
        foreach ($attrs as $attr){
            $obj[$attr] = null;
        }
    }

    public function validateForm($id, &$data)
    {
        $formData = request('SxhForm');
        $is_dieutra = request('status.is_dieutra');
        $is_chuyenca = request('status.is_chuyenca');
        $cb = new CabenhSxh();
        $this->id = $id;

        $this->scenario = self::SCENARIO_XACMINH;
        if ($id) {
            $cb = CabenhSxh::findOne($id);
            $this->load($cb->toArray(), '');
            if ($dt = $cb->dieutraSxh) {
                $this->load($dt->toArray(), '');
            }
        }

        $this->load($formData, '');
        $this->updateXacminh($cb, $formData);
        $this->loadDcCuoi($formData);
        $this->geom = $this->lat && $this->lng ? [$this->lng, $this->lat] : null;

        $this->validate();

        $errors = $this->getErrors();
        $data->put('errors', $errors);

        if ($is_dieutra) {
            $this->scenario = self::SCENARIO_DIEUTRA;

            $emptyData = array_fill_keys([
                'dietlangquang', 'giamsattheodoi', 'xulyonho', 'xulyorong',
                'cathuphat', 'odichmoi', 'odichcu', 'xuly', 'xuly_ngay',
                'xuatvien', 'ngayxuatvien'
            ], null); // ------------ fix load dữ liệu cũ
            $this->load($emptyData, '');

            $this->load($formData, '') && $this->validate();
            $warnings = $this->getErrors();

            $data->put('warnings', $warnings);

            if (empty($warnings)) {
                $this->loaidieutra = ($this->ht_dieutri == 1 && !is_null($this->xuatvien) && $this->xuatvien == 0) ? 2 : 3;
            } else {
                $this->loaidieutra = 0;
            }

            return true;
        }

        if (empty($errors)) {
            $this->loaidieutra = $is_chuyenca ? 1 : 3;
            return true;
        }
    }

    public function saveForm($id, $data)
    {
        if ($data->get('errors')) return false;
        $is_chuyenca = request('status.is_chuyenca');

        $this->ngaymacbenh_nv = $this->ngaymacbenh ? $this->ngaymacbenh : $this->ngaynhapvien;
        !$this->phcd || $this->loaicabenh = 3;
        $lastXm = last($this->xacminh);

        // Lock phân quyền
        $cb = $id ? (CabenhSxh::findOne($id) ? CabenhSxh::findOne($id) : new CabenhSxh()) : new CabenhSxh();
        $dt = $cb->dieutraSxh ? $cb->dieutraSxh : new DieutraSxh();
        $cb->attributes = $this->toArray();
        $cb->maquan = $this->qh;
        $cb->maphuong = $this->px;
        $cb->tenquan = data_get(HcQuan::findOne(['maquan' => $this->qh]), 'tenquan');
        $cb->tenphuong = data_get(HcPhuong::findOne(['maphuong' => $this->px]), 'tenphuong');
        $cb->deadline_at = null;
        $cb->geom = $this->lat && $this->lng ? [$this->lng, $this->lat] : null;
        $dt->attributes = $this->toArray();


        // Cập nhật thông tin người nhận
        if (count($this->xacminh) > 2) {
            $lastCh = last($cb->chuyenCas);
            if ($lastCh && (optional($lastCh)->hoten_nhan != $this->nguoidieutra) || optional($lastCh)->sdt_nhan != $this->nguoidieutra_sdt) {
                $lastCh->hoten_nhan = $this->nguoidieutra;
                $lastCh->sdt_nhan = $this->nguoidieutra_sdt;
                $lastCh->save();
            }
        }

        $cb->save();
        if ($is_chuyenca) $this->doChuyenca($cb, $dt, $data);
        $cb->link('dieutraSxh', $dt);
        $cb->syncOne('xacminhCbs', $this->xacminh);

        $this->id = $cb->id;

        return true;
    }

    protected function doChuyenca($cb, $dt, $data)
    {
        $ch = new Chuyenca();
        $lastXm = opt(last($this->xacminh));
        $preLastXm = opt(head(array_slice($this->xacminh, -2)));
        $px_nhan = $lastXm->px;

        $ch->setAttributes([
            'qh_chuyen' => $preLastXm->qh,
            'px_chuyen' => $preLastXm->px,
            'hoten_chuyen' => $this->nguoidieutra,
            'sdt_chuyen' => $this->nguoidieutra_sdt,
            'qh_nhan' => $lastXm->qh,
            'px_nhan' => $lastXm->px,
            'nguoinhan' => null,
            'sdt_nhan' => null,
            'is_chuyentiep' => $this->checkIsChuyenTiep($cb),
        ]);

        $cb->link('chuyenCas', $ch);
        $cb->deadline_at = Carbon::now()->addHours(24);
        $cb->save();
        // Xóa thông tin người gửi trên form
        $dt->nguoidieutra = null;
        $dt->nguoidieutra_sdt = null;
        $this->list_chuyenca = self::getListChuyenca($cb->getChuyenCas()->with(['nhan', 'chuyen'])->all());

        $users = User::find()->select('u.*')->alias('u')->leftJoin(['i' => UserInfo::tableName()], 'i.user_id = u.id')->andWhere(['i.maphuong' => $px_nhan])->all();
        $noty = new ChuyencaNoty($ch, $cb);
        Notification::send($users, $noty);
    }


    protected function checkIsChuyenTiep($cb)
    {
        if (!$cb->chuyenCas) return 1;

        $existCh = collect($cb->chuyenCas)->pluck('px_chuyen')->contains($this->px);
        return $existCh ? 0 : 1;
    }

    public function getListChuyenca($chCas)
    {
        return $chCas ? ArrayHelper::toArray($chCas, [
            Chuyenca::className() => [
                'chuyen' => function ($model) {
                    $chuyen = opt($model->chuyen);
                    return [
                        'hoten' => $model->hoten_chuyen,
                        'sdt' => $model->sdt_chuyen,
                        'maquan' => $model->qh_chuyen,
                        'maphuong' => $model->px_chuyen,
                        'tenquan' => $chuyen->tenquan,
                        'tenphuong' => $chuyen->tenphuong,
                    ];
                },
                'nhan' => function ($model) {
                    $nhan = opt($model->nhan);
                    return [
                        'hoten' => $model->hoten_nhan,
                        'sdt' => $model->sdt_nhan,
                        'maquan' => $model->qh_nhan,
                        'maphuong' => $model->px_nhan,
                        'tenquan' => $nhan->tenquan,
                        'tenphuong' => $nhan->tenphuong,
                    ];
                },
                'datetime' => function ($model) {
                    return $model->datetime;
                }
            ],
        ]) : [];
    }

    public function getListXacminh($xacminh)
    {
        $is_phuong = role('phuong');
        $maphuong = userInfo()->maphuong;
        $unlockedIndex = 100;

        $fields = [
            'id', 'is_diachi', 'is_benhnhan', 'dienthoai', 'sonha', 'duong', 'to_dp', 'khupho', 'tinh', 'tinh_dc_khac', 'px', 'qh',
            'disabled' => function ($model, $key, $index) use ($xacminh, $is_phuong, $maphuong, &$unlockedIndex) {
                if(count($xacminh) == 0) return false;
                if(count($xacminh) == 1 && $xacminh[0]['px'] == $maphuong) return false;

                $stt = $index+1;
                $total = count($xacminh);

                if(count($xacminh) >= 2){
                    // 1 3 5
                    if($total%2==1 && $stt == $total && $xacminh[$index]['tinh'] == 'HCM' && $xacminh[$index]['px'] == $maphuong){
                        $unlockedIndex = $index;
                    }

                    // 2 4 6
                    if($total%2!=1 && $stt == $total-1 && (($xacminh[$index+1]['is_diachi'] == 1 && $xacminh[$index+1]['tinh'] != 'HCM') || $xacminh[$index+1]['is_diachi'] == 0) && $xacminh[$index]['px'] == $maphuong){
                        $unlockedIndex = $index;
                    }

                    if($index >= $unlockedIndex) return false;
                }

                return true;
            }];

        return $xacminh ? $this->toTransform($xacminh, [
            XacminhCb::className() => $fields
        ]) : [
            $this->toTransform(new XacminhCb, [
                XacminhCb::className() => array_merge($fields, [
                    'dienthoai' => function () {
                        return $this->dienthoai;
                    },
                    'px' => function () {
                        return $this->px;
                    },
                    'qh' => function () {
                        return $this->qh;
                    },
                ])
            ])
        ];
    }

    public function toTransform($object, $properties = [], $recursive = true, $index = null)
    {
        if (is_array($object)) {
            if ($recursive) {
                foreach ($object as $key => $value) {
                    if (is_array($value) || is_object($value)) {
                        $object[$key] = $this->toTransform($value, $properties, true, $key, $object);
                    }
                }
            }

            return $object;
        } elseif (is_object($object)) {
            if (!empty($properties)) {
                $className = get_class($object);
                if (!empty($properties[$className])) {

                    $result = [];
                    foreach ($properties[$className] as $key => $name) {
                        if (is_int($key)) {
                            $result[$name] = $object->$name;
                        } else {
                            $result[$key] = ArrayHelper::getValue($object, function ($value, $defaultValue) use ($name, $key, $index) {
                                return $name($value, $key, $index);
                            });
                        }
                    }

                    return $recursive ? $this->toTransform($result, $properties) : $result;
                }
            }

            if ($object instanceof Arrayable) {
                $result = $object->toArray([], [], $recursive);
            } else {
                $result = [];
                foreach ($object as $key => $value) {
                    $result[$key] = $value;
                }
            }

            return $recursive ? $this->toTransform($result, $properties) : $result;
        }
        return [$object];
    }


}
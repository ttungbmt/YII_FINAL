<?php

namespace pcd\forms;

use Carbon\Carbon;
use codeonyii\yii2validators\AtLeastValidator;
use common\models\User;
use common\modules\auth\models\UserInfo;
use common\modules\notifications\models\Notification;
use nepstor\validators\DateTimeCompareValidator;
use pcd\models\CabenhSxh;
use pcd\models\Chuyenca;
use pcd\models\DieutraSxh;
use pcd\models\HcPhuong;
use pcd\models\VPhieuDt;
use pcd\models\XacminhCb;
use pcd\notifications\ChuyencaNoty;
use Yii;
use yii\base\DynamicModel;
use yii\base\Model;

class CabenhSxhForm extends VPhieuDt
{
    public $dates = [
        'ngaysinh',
        'ngaybaocao',
        'ngaynhanthongbao',
        'ngaymacbenh',
        'ngaynhapvien',
        'ngayxuatvien',
        'ngaydieutra',
        'ngaylaymau',
    ];

    protected $xm;

    public $validateOnSubmit = true;
    public $lat;
    public $lng;

    public function rules()
    {
        $rules = array_merge(parent::rules(), [
            [['is_trave', 'chuandoan'], 'safe'],
            [['tinh', 'tinh_dc_khac', 'nguoidieutra_sdt'], 'string'],
            [['tuoi', 'ngaysinh'], AtLeastValidator::className(), 'in' => ['tuoi', 'ngaysinh'], 'message' => 'Điền ít nhất 1 trường: tuổi hoặc ngày sinh'],
            [['chuyenca', 'loaidieutra', 'maquan', 'maphuong', 'chuandoan_bd', 'ht_dieutri', 'ngaybaocao', 'ngaymacbenh_nv'], 'default', 'value' => function ($model, $attribute) {
                return $this->setDefault($model, $attribute);
            }],
            [['ngaybaocao', 'hoten', 'ngaynhanthongbao', 'ngaydieutra', 'ngaybaocao', 'phai', 'ngaydieutra', 'nguoidieutra'], 'required'],
            [['lat', 'lng'], 'inBound', 'on' => ['geom']],
            [['lat', 'lng'], 'number'],
            [['songuoicutru', 'cutruduoi15', 'tuoi', 'bi', 'ci', 'gdsonguoisxh', 'gdso15t', 'gdthuocsxhsonguoi', 'gdthuocsxh15t', 'odichcu_xuly'], 'integer', 'min' => 0],
            // Ngày
            [['ngaybaocao', 'ngaysinh', 'ngaynhanthongbao', 'ngaydieutra', 'ngaymacbenh', 'ngaynhapvien', 'ngayxuatvien'], DateTimeCompareValidator::className(), 'compareValue' => date('d/m/Y'), 'operator' => '<=', 'format' => 'd/m/Y', 'jsFormat' => 'DD/MM/YYYY', 'skipOnEmpty' => true],
            [['ngaybaocao', 'ngaysinh', 'ngaynhanthongbao', 'ngaydieutra', 'ngaymacbenh', 'ngaynhapvien', 'ngayxuatvien'], 'date', 'format' => 'php:d/m/Y'],
            // Bắt buộc nhập ngày sinh hoặc tuổi
//            [['benhnoikhac'], 'required', 'when' => function ($model) {
//                return $model->diachi1 == 1 && $model->benhnhan1 == 1;
//            }, 'on'                              => ['cdc_cbn'], 'enableClientValidation' => false
//            ],
//            [['qhkhac', 'pxkhac'], 'required', 'when' => function ($model) {
//                return $model->tinhkhac == 'HCM' && $model->benhnoikhac == 1;
//            }, 'on'                                   => ['cdc_cbn_nk']],

//            // ----------------------------------------------------------------
            [['songuoicutru', 'cutruduoi15'], 'required', 'on' => ['dieutra']],

            // TPBV
            [['tpbv'], 'required', 'on' => ['dieutra']],
            [['tpbv_bv'], 'required', 'when' => function () {
                return $this->tpbv == 1;
            }, 'on'                          => ['dieutra']],
            [['phcd'], 'required', 'when' => function () {
                return $this->tpbv == 0;
            }, 'on'                       => ['dieutra']],
            [['nhapvien'], 'required', 'when' => function () {
                return $this->phcd == 1;
            }, 'on'                           => ['dieutra']],
            [['nhapvien_bv'], 'required', 'when' => function () {
                return $this->nhapvien == 1;
            }, 'on'                              => ['dieutra']],

            [['ngaynhapvien'], 'required', 'when' => function () {
                return $this->tpbv == 1 || $this->nhapvien == 1;
            }, 'on'                               => ['dieutra']],
            [['ngaymacbenh'], 'required', 'on' => ['dieutra']],
            [['nghenghiep', 'dclamviec', 'noilamviec_sxh'], 'required', 'on' => ['dieutra']],

            [['nhacobnsxh', 'nhaconguoibenh', 'bvpk', 'nhatho', 'dinh', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu', 'noikhac'], 'required', 'on' => ['dieutra']],
            [['nhacobnsxh', 'nhaconguoibenh', 'bvpk', 'nhatho', 'dinh', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu', 'noikhac'], 'integer', 'on' => ['dieutra']],
            [['noikhac'], 'required', 'when' => function () {
                return $this->noikhac == 1;
            }, 'on'                          => ['dieutra']],
            [['noikhac_ghichu'], 'required', 'when' => function () {
                return $this->noikhac == 1;
            }, 'on'                                 => ['dieutra']],

            [['diemden_px', 'diemden_pxkhac', 'diemden_qhkhac'], 'required', 'on' => ['dieutra']],

            [['gdcosxh'], 'required', 'on' => ['dieutra']],
            [['gdsonguoisxh', 'gdso15t'], 'required', 'when' => function () {
                return $this->gdcosxh == 1;
            }, 'on'                                          => ['dieutra']],
            [['gdthuocsxh'], 'required', 'on' => ['dieutra']],
            [['gdthuocsxhsonguoi', 'gdthuocsxh15t'], 'required', 'when' => function () {
                return $this->gdthuocsxh == 1;
            }, 'on'                                                     => ['dieutra']],

//            [['bi', 'ci'], 'required', 'on' => ['dieutra']],

            // 4. HƯỚNG XỬ LÝ
            [['cachidiem'], 'required', 'on' => ['dieutra']],
            [['dietlangquang', 'giamsattheodoi', 'xulyonho', 'xulyorong'], 'required', 'when' => function () {
                return $this->cachidiem == 1;
            }, 'on'                                                              => ['dieutra']],
            [['cathuphat'], 'required', 'when' => function () {
                return $this->cachidiem === '0';
            }, 'on'                            => ['dieutra']],
            [['odichmoi', 'odichcu'], 'required', 'when' => function () {
                return $this->cathuphat == 1;
            }, 'on'                                      => ['dieutra']],
            [['odichcu_xuly'], 'required', 'when' => function () {
                return $this->odichcu == 1;
            }, 'on'                               => ['dieutra']],
            [['xuly'], 'required', 'when' => function () {
                return $this->cathuphat == 1;
            }, 'on'                       => ['dieutra']],
            [['xuly_ngay'], 'required', 'when' => function () {
                return $this->xuly == 3;
            }, 'on'                            => ['dieutra']],
            [['benhnoikhac'], 'required', 'when' => function () {
                $xm = array_last($this->xm);
                return data_get($xm, 'is_diachi') == 1 && data_get($xm, 'is_benhnhan') == 1;
            }],
            [['tinhkhac'], 'required', 'when' => function () {
                return $this->benhnoikhac == 1;
            }],

            // 5. KẾT LUẬN
            [['xuatvien'], 'required', 'on' => ['dieutra'],  'when' => function () {
                return $this->ht_dieutri == 1;
            }], // => Chú ý
            [['ngayxuatvien'], 'required', 'when' => function () {
                return $this->xuatvien == 1;
            }, 'on'                               => ['dieutra'], 'whenClient' => "function (attribute, value) { return false; }"],
            [['chuandoan'], 'required', 'when' => function () {
                return $this->xuatvien == 1;
            }, 'on'                            => ['dieutra']],
            [['chuandoan_khac'], 'required', 'when' => function () {
                return $this->chuandoan == 3;
            }, 'on'                                 => ['dieutra']],
        ]);

        return $rules;
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'gid'               => 'Gid',
            'loaidieutra'       => 'Điều tra',
            'loaicabenh'        => 'Ca bệnh',
            'ma_icd'            => 'Mã ICD',
            'maphuong'          => 'Phường',
            'maquan'            => 'Quận',
            'hoten'             => 'Họ tên',
            'tuoi'              => 'Tuổi',
            'ngaysinh'          => 'Ngày sinh',
            'phai'              => 'Giới tính',
            'benhvien'          => 'Bệnh viện',
            'ngaybaocao'        => 'Ngày báo cáo',
            'ngaynhanthongbao'  => 'Ngày nhận thông báo',
            'ngaymacbenh'       => 'Ngày mắc bệnh',
            'ngaynhapvien'      => 'Ngày nhập viện',
            'ngayxuatvien'      => 'Ngày xuất viện',
            'nghenghiep'        => 'Nghề nghiệp',
            'shs'               => 'Số hồ sơ (SHS)',
            'vitri'             => 'Vị trí',
            'me'                => 'Mẹ',
            'dienthoai'         => 'Điện thoại',
            'sonha'             => 'Số nhà',
            'duong'             => 'Đường',
            'to_dp'             => 'Tổ',
            'khupho'            => 'Khu phố',
            'px'                => 'Phường',
            'qh'                => 'Quận',
            'ht_dieutri'        => 'Hình thức điều trị',
            'loaixacminh_cb'    => 'Xác minh địa chỉ',
            'loaibaocao'        => 'Loại báo cáo',
            'chuandoan_bd'      => 'Bệnh ',
            'chuandoan_bd_khac' => 'Chuẩn đoán khác',

            'tenbenhkhac' => 'Tên bệnh khác',
            'cabenh_id'   => 'Cabenh ID',
            'maso'        => 'Mã số',
            'ngaydieutra' => 'Ngày điều tra',

            'benhnoikhac' => 'Bệnh nhân ở nơi khác',
            'tinhkhac'    => 'Tỉnh (khác)',
            'tinhnoikhac' => 'Địa chỉ tỉnh khác (khác)',
            'qhkhac'      => 'Quận huyện (khác)',
            'pxkhac'      => 'Phường xã (khác)',
            'sonhakhac'   => 'Số nhà (khác)',
            'duongkhac'   => 'Đường (khác)',
            'tokhac'      => 'Tổ (khác)',
            'khuphokhac'  => 'Khu phố/ấp (khác)',

            'songuoicutru'      => 'Số người cư trú trong gia đình',
            'cutruduoi15'       => 'Trong đó số dưới 15 tuổi',
            'tpbv'              => 'TP báo về (TPBV)',
            'tpbv_bv'           => 'Tên bệnh viện',
            'phcd'              => 'Phát hiện cộng đồng (PHCD)',
            'nhapvien'          => 'Nhập viện',
            'nhapvien_bv'       => 'Tên bệnh viện',
            'xetnghiem'         => 'Có xét nghiệm hay không? ',
            'ngaylaymau'        => 'Ngày lấy mẫu',
            'loai_xn'           => 'Loại xét nghiệm',
            'ketqua_xn'         => 'Kết quả',
            'dclamviec'         => 'Địa chỉ nơi làm việc',
            'dclamviecqh'       => 'Quận huyện',
            'dclamviecpx'       => 'Phường xã',
            'noilamviec_sxh'    => 'Tại nơi làm việc, trong vòng 2 tuần qua có ai bị SXH / nghi ngờ SXH / sốt không? Sxh',
            'nhacobnsxh'        => 'Nhà có BN SXH',
            'nhaconguoibenh'    => 'Nhà có người bệnh',
            'bvpk'              => 'BV PK',
            'nhatho'            => 'Nhà thờ',
            'dinh'              => 'Đình chùa',
            'congvien'          => 'Công viên',
            'noihoihop'         => 'Nơi hội họp',
            'noixd'             => 'Nơi xây dựng',
            'cafe'              => 'Quán cà phê/internet',
            'noichannuoi'       => 'Nơi chăn nuôi',
            'noibancay'         => 'Nơi bán cây cảnh',
            'vuaphelieu'        => 'Vựa phế liệu',
            'noikhac'           => 'Khác',
            'noikhac_ghichu'    => 'Ghi chú',
            'diemden_px'        => 'PX',
            'diemden_pxkhac'    => 'PX khác',
            'diemden_qhkhac'    => 'QH khác',
            'gdcosxh'           => 'Có người mắc bệnh SXH không?',
            'gdsonguoisxh'      => 'Tại gia đình, số người bị SXH',
            'gdso15t'           => 'Tại gia đình, số người < 15 tuổi',
            'gdthuocsxh'        => 'Có người mắc bệnh sốt hoặc có uống thuốc hạ sốt?',
            'gdthuocsxhsonguoi' => 'Tại gia đình, số người mắc bệnh',
            'gdthuocsxh15t'     => 'Tại gia đình, số người mắc bệnh < 15 tuổi',
            'bi'                => 'BI',
            'ci'                => 'CI',
            'cachidiem'         => 'Ca bệnh chỉ điểm/ca bệnh đầu tiên',
            'dietlangquang'     => 'Diệt lăng quăng diệt muỗi/gia đình',
            'giamsattheodoi'    => 'Giám sát theo dõi',
            'xulyonho'          => 'Xử lý ổ dịch',
            'xulyorong'          => 'Xử lý diện rộng',
            'cathuphat'         => 'Ca bệnh thứ phát',
            'odichmoi'          => 'Ổ dịch mới',
            'odichcu'           => 'Ổ dịch cũ đã xác định',
            'odichcu_xuly'      => 'Odichcu Xuly',
            'xuly'              => 'Xử lý',
            'xuly_ngay'         => 'Sau xử lý',
            'xuatvien'          => 'Xuất viện',
            'chuandoan'         => 'Chuẩn đoán',
            'chuandoan_khac'    => 'Tên bệnh',
            'nguoidieutra'      => 'Người điều tra',
            'nguoidieutra_sdt'  => 'Số điện thoại',
            'geom'              => 'Geom',
        ]);
    }

    public function setAttrs($attrs)
    {
        foreach ($attrs as $k => $a) {
            $this->{$k} = $this->{$a};
        }
    }

    public function lockCb(&$xm)
    {
        foreach ($xm as $k => $i) {
            $xm[$k]->is_locked = 1;
        }
    }

    public function saveModel(&$xacminhCbs)
    {
        $data = collect(request()->all())->filterBlank([$this->formName()])->all();
        $this->xm = collect(request('XacminhCb'))->map(function ($item, $k) use ($xacminhCbs) {
            $item = array_filter_blank($item);
            $model = data_get($xacminhCbs, data_get($item, 'id', ''));
            $model = $model ? $model : new XacminhCb();
            $model->load($item, '');
            return $model;
        })->all();

        $xmValid = Model::validateMultiple($this->xm);
        $this->load($data);

        if (!$this->validate() || !$xmValid) {
            // Hiển thị lỗi cho Xm ca bệnh
            foreach ($this->xm as $k => $v){
                $xacminhCbs[$k] = $v;
            }
            return false;
        }

        $this->scenario = 'geom';
        if (!$this->validate()) {
            $this->lat = null;
            $this->lng = null;
            return false;
        }

        $cb = CabenhSxh::findOne($this->gid);
        $cb = $cb ? $cb : new CabenhSxh();
        $dt = DieutraSxh::findOne(['cabenh_id' => $this->gid]);
        $dt = $dt ? $dt : new DieutraSxh();

        $xacminhCbs = $this->xm;
        $this->setDiachiCuoi($xacminhCbs);

        if($this->xuatvien != 1){$this->chuandoan = null;}
        $this->chuandoan = $this->ht_dieutri === '0' ? 1 : $this->chuandoan;
        $this->ngaymacbenh_nv = $this->ngaymacbenh ? $this->ngaymacbenh : $this->ngaynhapvien;
        $this->loaidieutra = 1;
        if($this->lat & $this->lng){
            $this->geom = [$this->lng, $this->lat];
        }

        # Save tb: chuyenca
        $xm = collect($this->xm);
        $p_xm = $xm->slice(-2, 1)->first();
        $px_n_xm = data_get($p_xm, 'px');
        $l_xm = $xm->last();
        $px_l_xm = data_get($l_xm, 'px');

        $isChuyenca = !empty($px_n_xm) && !empty($px_l_xm) && $px_l_xm != $px_n_xm;
        $chCas = collect($cb->chuyenCas)->last();
        $isTrave = $chCas ? in_array($l_xm->px, $chCas->pluck('px_chuyen')->all()) : 0;

        $cungnha = collect(request('CabenhSxh'))->filter(function ($item) {
            return $item['is_cungnha'] == '1';
        })->keys();
        if ($cungnha->isNotEmpty()) {
            $cb->sync('cungnhas', $cungnha->all());
        }

        if ($isChuyenca) {
            $isChuyentiep = $chCas ? $chCas->is_chuyentiep : 0;
//            dd($chCas);

            if (!$chCas || $isChuyentiep) {
                $this->lockCb($xm);
                $this->saveCabenhWithRelation($cb, $dt, $xm);
                $this->doChuyenca($l_xm, $p_xm, $cb, $dt, $chCas, $isTrave);
                return true;
            }

            $this->addError('is_chuyentiep', 'Vui lòng yêu cầu cấp quản lý cao hơn cấp quyền chuyển');
            return false;
        }

        if ($p_xm->is_benhnhan == 0 && $l_xm->is_benhnhan == 0) {
            $this->loaidieutra = 3;
            $this->setLoaiXmCb($xm);
            $this->saveCabenhWithRelation($cb, $dt, $xm);
            return true;
        }

        // Kiểm tra điều tra
        $this->scenario = 'dieutra';
        $this->validateOnSubmit = false;
        $this->validate();
        $message = $this->getFirstErrors();

        if ($chCas) {
            $chCas->nguoinhan = $this->nguoidieutra;
            $chCas->save();
        }
//        $this->clearErrors();
//        $this->addErrors($message);

        if (empty($message)) {
            if($this->xuatvien != 1){
                $this->loaidieutra = (!$this->ht_dieutri) ? 3 : 2;
            } else {
                $this->loaidieutra = 3;
            }
        }

        $this->setLoaiXmCb($xm);
        $this->is_trave = 0;
        $this->saveCabenhWithRelation($cb, $dt, $xm);

        Yii::$app->session->setFlash('warnings', $this->getErrors());

        return true;
    }

    public function saveCabenhWithRelation($cb, $dt, $xm)
    {
        $cb->load($this->attributes, '');
        $dt->load($this->attributes, '');
        # Save tb: cabenh_sxh
        $last_dc = $xm->last();
        $cb->maquan = $last_dc->qh;
        $cb->maphuong = $last_dc->px;

        $cb->save();
        # Save tb: dieutra_sxh
        $cb->link('dieutraSxh', $dt);
        # Save tb: xacminh_cb
        $cb->syncOne('xacminhCbs', $xm);
    }

    public function setLoaiXmCb($xm)
    {
        if($xm->count()%2){
            $p_xm = $xm->last();
            $l_xm = [];
        } else {
            $p_xm = $xm->slice(-2, 1)->first();
            $l_xm = $xm->last();
        }

        $is_bn = data_get($p_xm, 'is_benhnhan');
        $is_dc = data_get($p_xm, 'is_diachi');
        $px1 = data_get($p_xm, 'px');
        $qh1 = data_get($p_xm, 'qh');

        $is_dc2 = data_get($l_xm, 'is_diachi');
        $px2 = data_get($l_xm, 'px');
        $qh2 = data_get($l_xm, 'qh');
        $tinh2 = data_get($l_xm, 'tinh');

        $setCbn = function ($cond = null){
            if($cond){return $cond;}

            if ($this->chuandoan == 1 || $this->ht_dieutri == 0) {
                $this->loai_xm_cb = 8;
            } else {
                $this->loai_xm_cb = 7;
            }
        };

        $setKbn = function ($px1, $qh1, $px2, $qh2, $tinh2, $cond1, $cond2, $cond3) use($setCbn){
            if($tinh2 == 'HCM'){
                if($qh1 == $qh2){
                    if($px1 == $px2){
                        $setCbn($cond3);
                    } else {
                        $this->loai_xm_cb = $cond1;
                    }
                } else {
                    $this->loai_xm_cb = $cond2;
                }
            } else {
                $this->loai_xm_cb = $cond3;
            }
        };

        if ($is_bn == 1) {
            $setCbn();
        } else {
            if ($is_dc == 1) {
                if ($is_dc2 == 1) {
                    $setKbn($px1, $qh1, $px2, $qh2, $tinh2, 4, 5, 6);
                } else {
                    $this->loai_xm_cb = is_null($is_dc2) ? null : 6;
                }
            } else {
                if ($is_dc2 == 1) {
                    $setKbn($px1, $qh1, $px2, $qh2, $tinh2, 1, 2, 3);
                } else {
                    $this->loai_xm_cb = is_null($is_dc2) ? null : 3;
                }
            }
        }
    }

//    public function setLoaiXmCbOld()
//    {
//       if(!is_null($dc3)){
//           if($dc3 == 1){
//               if($bn3 == 1){
//                   if($chuandoan == 1 || $loaibc == 1){
//                       $xm = 8;
//                   } else {
//                       $xm = 7;
//                   }
//               } else {
//                    if($qh3 != $qh2){
//                        $xm = 5;
//                    } else {
//                        if($px3 != $px2){
//                            $xm = 4;
//                        }
//                    }
//
//                   $xm = 6;
//               }
//           } else {
//               // Trả về
//               $xm = 3;
//           }
//       } else {
//           if(!is_null($dc2)){
//                if($dc2 == 1){
//                    if($tinh2 != 'HCM'){
//                        $xm = 6;
//                    }
//                } else {
//                    $xm = 3;
//                }
//           } else {
//               if($dc1 == 1 && $bn1 == 1){
//                   if($chuandoan == 1 || $loaibc == 1){
//                       $xm = 8;
//                   } else {
//                       $xm = 7;
//                   }
//               }
//           }
//       }
//    }


    public function doChuyenca($l_xm, $p_xm, $cb, $dt, $chCas, $isTrave)
    {
        $chCa = new Chuyenca();
        $px_nhan = data_get($l_xm, 'px');
        $cType = collect($cb->chuyenCas)->pluck('px_chuyen')->contains($px_nhan);
        $ng_dt = $this->nguoidieutra;
        $ng_dt_sdt = $this->nguoidieutra_sdt;
        $chCa->setAttributes([
            'type'          => $cType ? 2 : 1,
            'nguoichuyen'   => $ng_dt,
            'qh_chuyen'     => data_get($p_xm, 'qh'),
            'px_chuyen'     => data_get($p_xm, 'px'),
            'nguoinhan'     => null,
            'qh_nhan'       => $qh_nhan = data_get($l_xm, 'qh'),
            'px_nhan'       => $px_nhan,
            'is_chuyentiep' => $isTrave ? 0 : 1,
            'sdt_chuyen'    => $ng_dt_sdt,
            'sdt_nhan'      => null,
        ]);

        $cb->maquan = $qh_nhan;
        $cb->maphuong = $px_nhan;
        $cb->is_trave = $isTrave;
        $cb->save();

        if ($chCas) {
            $chCas->nguoinhan = $ng_dt;
            $chCas->sdt_nhan = $ng_dt_sdt;
            $chCas->save();
        }
        $cb->link('chuyenCas', $chCa);

        if(role('quan') || role('phuong')){
            $ids = [];
            if($qh_nhan){
                $qs = UserInfo::find()->where("maquan = '{$qh_nhan}' AND maphuong IS NULL")->pluck('user_id')->all();
                $ids = array_merge($ids, $qs ? $qs : []);
            }

            if($px_nhan) {
                $ids = array_merge($ids, UserInfo::find()->where(['maphuong' => $px_nhan])->pluck('user_id')->all());
            }
            $users = User::findAll($ids);
            $noty = new ChuyencaNoty(
                $cb->gid,
                $chCa->id,
                $isTrave
            );
            Notification::send($users, $noty);
        }
    }


    public function fields()
    {
        return [
            'xacminhCbs',
            'chuyenCas',
            'loai_xm_cb',
            'benhnoikhac',
            'tinhkhac',

            'lat',
            'lng',
            'loaidieutra',
            'chuandoan_bd',
            'ht_dieutri',
            'maquan',
            'maphuong',
            'ht_dieutri',

            'hoten',

            'tpbv',
            'phcd',
            'nhapvien',
            'dclamviec_tinh',
            'dclamviecqh',
            'dclamviecpx',
            'noikhac',
            'xetnghiem',
            'gdcosxh',
            'gdthuocsxh',
            'cachidiem',
            'cathuphat',
            'odichcu',
            'xuly',
            'xuatvien',
            'chuandoan',
            'chuyenca',
        ];
    }

    public function setDiachiCuoi($xacminhCbs)
    {
        $last = array_last($xacminhCbs);
        $keys = ['sonha', 'duong', 'to_dp', 'khupho', 'px', 'qh', 'tinh', 'tinh_dc_khac'];
        foreach ($keys as $k => $name) {
            $this->{$name} = data_get($last, $name);
        }
    }

    public function setLoaiCa()
    {
        $this->loaicabenh = 1;

        if ($this->phcd) {
            $this->loaicabenh = 4;
        }
    }

    protected function setDefault($model, $attribute)
    {
        switch ($attribute) {
            case 'chuyenca':
                return 0;
            case 'loaidieutra':
                return 0;
            case 'chuandoan_bd':
                return 'SXH';
            case 'ht_dieutri':
                return 1;
            case 'ngaybaocao':
                return date('d/m/Y');
            case 'dclamviecqh':
                return '';
            case 'ngaymacbenh_nv':
                return $this->ngaymacbenh ? $this->ngaymacbenh : $this->ngaynhapvien;
            default:
                return null;
        }
    }


}
<?php
namespace pcd\entities;

use common\modules\auth\supports\UserService;
use nepstor\validators\DateTimeCompareValidator;
use pcd\models\Cabenh;
use pcd\models\VDmPhuong;
use pcd\models\VDmPhuong1;
use pcd\models\VDmQuan1;
use pcd\modules\role_phuongquan\models\DmPhuong;
use Yii;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class vPhieuSxh extends \pcd\models\VPhieusxh
{
    use ModelTrait;
    public $geom_x;
    public $geom_y;

    protected $cdn_cbn;
    protected $cdn_kbn;
    protected $kdn_kbn;


//    public $baby;

    public $typeExport = 'excel';

    public function getDieutraSxh()
    {
        return $this->hasOne(mDieutraSxh::className(), ['ma_dt_sxh' => 'ma_dt_sxh']);
    }

    public function getCabenh()
    {
        return $this->hasOne(mCabenh::className(), ['macabenh' => 'macabenh']);
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['dclamviec_khac'], 'safe'],
            [['chuandoanbd'], 'required'],
            [['ngaybaocao', 'ngaydieutra', 'ngaymacbenh', 'ngaynhapvien', 'ngayxuatvien'], DateTimeCompareValidator::className(), 'compareValue' => date('d/m/Y'), 'operator' => '<=', 'format' => 'd/m/Y', 'jsFormat' => 'DD/MM/YYYY', 'skipOnEmpty' => true],
            # -- KIỂM TRA 1 ----------------------------------------------------------------------
            [['px1', 'qh1', 'hoten', 'phai', 'ngaybaocao', 'ngaynhanthongbao', 'ngaydieutra', 'nguoidieutra'], 'required'],
            [['ngaybaocao', 'ngaysinh', 'ngaynhanthongbao', 'ngaydieutra', 'ngaymacbenh', 'ngaynhapvien', 'ngayxuatvien'], 'date'],
            [['songuoicutru', 'cutruduoi15', 'tuoi', 'bi', 'ci', 'gdsonguoisxh', 'gdso15t', 'gdthuocsxhsonguoi', 'gdthuocsxh15t', 'odichcu_xuly',], 'integer', 'min' => 0],

            // Bắt buộc nhập ngày sinh hoặc tuổi
            [['ngaysinh'], 'required', 'when' => function ($model) {
                return empty($model->tuoi);
            }, 'message' => 'Bắt buộc nhập ngày sinh hoặc tuổi.',
                'whenClient' => "function (attribute, value) {
                        return $('#vphieusxh-tuoi').val().length == 0;
                 }"
            ],
            [['tuoi'], 'required', 'when' => function ($model) {
                return empty($model->ngaysinh);
            }, 'message' => 'Bắt buộc nhập ngày sinh hoặc tuổi.',
                'whenClient' => "function (attribute, value) {
                       return $('#vphieusxh-ngaysinh').val().length == 0;
                }"
            ],
            [['diachi1', 'benhnhan1'], 'required'],
            [['to1', 'khupho1'], 'required', 'when' => function ($model) {
                return
                    $model->diachi1 == 1;
            },
                'whenClient' => "function (attribute, value) {
                    return $('#vphieusxh-diachi1 input[type=\"radio\"]:checked').val() == 1;
                 }"
            ],

            # -- KIỂM TRA 2 ----------------------------------------------------------------------
            [['diachi1', 'benhnhan1', 'benhnoikhac', 'diachi2', 'diachi3', 'benhnhan3'], 'default', 'value' => null],

            [['benhnoikhac'], 'required', 'when' => function ($model) {
                return $model->diachi1 == 1 && $model->benhnhan1 == 1;
            },
                'on' => ['cdc_cbn'], 'enableClientValidation' => false
            ],
            [['qhkhac', 'pxkhac'], 'required', 'when' => function ($model) {
                return $model->tinhkhac == 'HCM' && $model->benhnoikhac == 1;
            },
                'on' => ['cdc_cbn_nk']
            ],

            [['diachi2'], 'required', 'when' => function ($model) {
                return
                    ($model->diachi1 == 1 && $model->benhnhan1 === '0') ||
                    ($model->diachi1 == 0 && $model->benhnhan1 === '0');
            },
                'on' => ['cdc_kbn', 'kdc_kbn']],
            [['tinh2'], 'required', 'when' => function ($model) {
                return $model->diachi2 == 1;
            },
                'on' => ['cdc_kbn_xm', 'kdc_kbn_xm']],
            [['qh2', 'px2'], 'required', 'when' => function ($model) {
                return $model->tinh2 == 'HCM';
            },
                'on' => ['cdc_kbn_xm', 'kdc_kbn_xm']],

            [['diachi3', 'benhnhan3'], 'required',
                'on' => ['xm_dc3']
            ],
            // ----------------------------------------------------------------
            [['songuoicutru', 'cutruduoi15'], 'required', 'on' => ['dieutra']],

            // TPBV
            [['tpbv'], 'required', 'on' => ['dieutra']],
            [['tpbv_bv'], 'required', 'when' => function () {
                return $this->tpbv == 1;
            }, 'on' => ['dieutra']],
            [['phcd'], 'required', 'when' => function () {
                return $this->tpbv === '0';
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
            [['nghenghiep',
                'dclamviec', 'dclamviecqh', 'dclamviecpx',
                'noilamviec_sxh'], 'required', 'on' => ['dieutra']],
            [['nhacobnsxh', 'nhaconguoibenh', 'bvpk', 'nhatho', 'dinh', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu', 'noikhac'], 'required', 'on' => ['dieutra']],
            [['nhacobnsxh', 'nhaconguoibenh', 'bvpk', 'nhatho', 'dinh', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu', 'noikhac'], 'integer', 'on' => ['dieutra']],
            [['noikhac'], 'required', 'when' => function () {
                return $this->noikhac == 1;
            }, 'on' => ['dieutra']],
            [['noikhac_ghichu'], 'required', 'when' => function () {
                return $this->noikhac == 1;
            }, 'on' => ['dieutra'],
                'on' => ['dieutra']],
            [['diemden_px', 'diemden_pxkhac', 'diemden_qhkhac'], 'required', 'on' => ['dieutra']],


            [['gdcosxh'], 'required', 'on' => ['dieutra']],
            [['gdsonguoisxh', 'gdso15t'], 'required', 'when' => function () {
                return $this->gdcosxh == 1;
            }, 'on' => ['dieutra']],
            [['gdthuocsxh'], 'required', 'on' => ['dieutra']],
            [['gdthuocsxhsonguoi', 'gdthuocsxh15t'], 'required', 'when' => function () {
                return $this->gdthuocsxh == 1;
            }, 'on' => ['dieutra']],

            [['bi', 'ci'], 'required', 'on' => ['dieutra']],

            // 4. HƯỚNG XỬ LÝ
            [['cachidiem'], 'required', 'on' => ['dieutra']],
            [['dietlangquang', 'giamsattheodoi', 'xulyonho'], 'required', 'when' => function () {
                return $this->cachidiem == 1;
            }, 'on' => ['dieutra']],
            [['cathuphat'], 'required', 'when' => function () {
                return $this->cachidiem === '0';
            }, 'on' => ['dieutra']],
            [['odichmoi', 'odichcu'], 'required', 'when' => function () {
                return $this->cathuphat == 1;
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
            [['xuatvien'], 'required', 'on' => ['xuatvien']], // => Chú ý
            [['ngayxuatvien'], 'required', 'when' => function () {
                return $this->xuatvien == 1;
            }, 'on' => ['xuatvien'],
                'whenClient' => "function (attribute, value) {
                    return false;
                }"
            ],
            [['xacdinh'], 'required', 'when' => function () {
                return $this->xuatvien == 1;
            },
                'on' => ['xacdinh']],
            [['tenbenhkhac'], 'required', 'when' => function () {
                return $this->xacdinh == 3;
            }, 'on' => ['xacdinh']],
        ]);
    }

    public function beforeValidate()
    {
        return parent::beforeValidate();
    }

    public function validatePhieu($data, $method = 'update')
    {
        // Tạo mảng lọc các giá trị của các trường k POST;
        $arr = ['diachi2', 'dienthoai2', 'sonha2', 'duong2', 'to2', 'khupho2', 'tinh2', 'tinhkhac2', 'qh2', 'px2', 'diachi3', 'benhnhan3', 'sonha3', 'duong3', 'to3', 'khupho3', 'tinh3', 'tinhkhac3', 'qh3', 'px3', 'benhnoikhac', 'sonhakhac', 'duongkhac', 'tokhac', 'khuphokhac', 'tinhkhac', 'tinhnoikhac', 'qhkhac', 'pxkhac', 'songuoicutru', 'cutruduoi15', 'tpbv', 'tpbv_bv', 'phcd', 'nhapvien', 'nhapvien_bv', 'nghenghiep', 'ngaymacbenh', 'ngaynhapvien', 'dclamviec', 'dclamviecqh', 'dclamviecpx', 'noilamviec_sxh', 'nhacobnsxh', 'nhaconguoibenh', 'bvpk', 'nhatho', 'dinh', 'chua', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu', 'noikhac', 'noikhac_ghichu', 'diemden_px', 'diemden_pxkhac', 'diemden_qhkhac', 'gdcosxh', 'gdsonguoisxh', 'gdso15t', 'gdthuocsxh', 'gdthuocsxhsonguoi', 'gdthuocsxh15t', 'bi', 'ci', 'cachidiem', 'dietlangquang', 'giamsattheodoi', 'xulyonho', 'cathuphat', 'odichmoi', 'odichcu', 'odichcu_xuly', 'xuly', 'xuly_ngay', 'xuatvien', 'ngayxuatvien', 'xacdinh', 'tenbenhkhac',];
        $data = array_merge(array_fill_keys($arr, null), $data);
        $tmp =
            ['qh1', 'px1', 'ngaynhanthongbao', 'ngaydieutra', 'hoten', 'phai', 'ngaysinh', 'diachi1', 'benhnhan1', 'sonha1', 'to1', 'khupho1', 'diachi2', 'dienthoai2', 'sonha2', 'duong2', 'to2', 'khupho2', 'tinh2', 'tinhkhac2', 'qh2', 'px2',];
        $tmp1 = [];
        foreach ($tmp as $val) {
            $tmp1[$val] = $this->{$val};
        }

        if($data['geo_x'] && $data['geo_y']){
            $userSrv = new UserService();
            $user = $userSrv->current();
            if(user()->is('phuong')){
                $resp = (new Query())->select(new Expression("ST_Intersects(ST_GeomFromText('POINT({$data['geo_x']} {$data['geo_y']})', 4326), geom) in_bound"))->from('dm_phuong_new')->andFilterWhere(['ma_phuong' => $user->ma_phuong])->one();

                if($resp['in_bound'] == false){
                    $this->addError('geo_x', "Tọa độ không nằm trong khu vực {$user->username}");
                    $this->addError('geo_y', "Tọa độ không nằm trong khu vực {$user->username}");
                    return false;
                }
            }
        }



        $code_benhvien = $this->tpbv_bv;

        $this->attributes = $data;
        $this->ma_phuong = $this->px1;
        $this->ma_quan = $this->qh1;
        $this->tpbv_bv = $this->tpbv_bv ?: $code_benhvien;

        if ($this->chuyenca1) {
            $this->attributes = $tmp1;
        }

        $this->check_trungcabenh($method);

        # -- KIỂM TRA ---------------------------------------------------
        if (!$this->validate()) {
            return $this->validate();
        }

        # -- XÁC MINH ĐỊA CHỈ ----------------------------------------------
        # Có địa chỉ, có bệnh nhân -> dc1:1 - bn1:1
        if ($this->diachi1 == 1 && $this->benhnhan1 == 1) {
            $this->scenario = 'cdc_cbn';
            if (!$this->validate()) return $this->validate();

            // Bệnh nhân sông một nơi-> noikhac:0
            if ($this->benhnoikhac == 0) {

            }
            // Bệnh nhân sống 2 nơi -> noikhac:1 (chuyển ca)------------------------
            if ($this->benhnoikhac == 1) {
                $this->scenario = 'cdc_cbn_nk';
                if (!$this->validate()) return $this->validate();
            }

        }

        # Có địa chỉ, không bệnh nhân -> dc1:1 - bn1:0,  # Không địa chỉ, không bệnh nhân -> dc1:0 - bn1:0
        if (($this->diachi1 == 1 || $this->diachi1 == 0) && $this->benhnhan1 == 0) {
            $this->scenario = 'cdc_kbn';
            if (!$this->validate()) return $this->validate();

            // Xác minh địa chỉ khác BN -> dc2:1
            if ($this->diachi2 == 1) {
                $this->scenario = 'cdc_kbn_xm';
                if (!$this->validate()) return $this->validate();

                if ($this->tinh2 == 'HCM' && ($this->px1 != $this->px2 || $this->qh1 != $this->qh2)) {
                    if (!$this->chuyenca1 && !$this->chuyenca2) {
                        $this->xmcabenh = 1;
                        $this->chuyenCaDi();
                        return true;
                    }
                } elseif ($this->tinh2 !== 'HCM') {
                    $this->xmcabenh = 3;
                    return true;
                }

                if ($this->chuyenca1 && !$this->chuyenca2) {
                    // Ca nhận
                    $this->scenario = 'xm_dc3';
                    if (!$this->validate()) return $this->validate();

                    if ($this->benhnhan3 == 0) {
                        $this->chuyenCaVe();
                        $this->xmcabenh = 3;
                        return true;
                    }
                } elseif ($this->chuyenca1 && $this->chuyenca2) {
                    // Ca trả về, chặn chuyển di
                    $this->xmcabenh = 3;
                    $this->addError('chan_cc', 'Ca bệnh trả về, không được phép chuyển ca tiếp');
                    return false;
                };


            } elseif ($this->diachi2 == 0) { // K Xác minh địa chỉ khác BN -> dc2:0 => Khóa hết, kết thúc, ĐÃ ĐIỀU TRA
                $this->xmcabenh = 3;
                return true;
            }

        }
        # Không địa chỉ, có bệnh nhân -> dc1:0 - bn1:1
        if ($this->diachi1 == 0 && $this->benhnhan1 == 1) {
            # Không có trường hợp này
            $this->addError('kdc_cbn', '<b>Không có trường hợp này</b>');
            return false;
        }

        $this->checkTHForm();


        return true;
    }

    public function checkTHForm()
    {
        $this->xmcabenh = 1; // SET: ĐANG ĐIỀU TRA

        $this->scenario = 'dieutra';
        $dt = $this->validate();
        $message = $this->getFirstErrors();

        if ($dt) {
            $this->xmcabenh = 3;
        }

        if ($this->tpbv == 1 || $this->nhapvien == 1) {
            $this->scenario = 'xuatvien';
            $xvien = $this->validate();
            $message = array_merge($message, $this->getFirstErrors());
            if (!$xvien) {
                $this->xmcabenh = 1;
            }
        } elseif ($this->tpbv === '0' || $this->nhapvien === '0') {
            $this->xmcabenh = 2;
        }

        if ($this->xuatvien == 1) {
            $this->scenario = 'xacdinh';
            $xdinh = $this->validate();
            $message = array_merge($message, $this->getFirstErrors());
            if (!$xdinh) {
                $this->xmcabenh = 1;
            }
        } elseif ($this->xuatvien === '0') {
            $this->xmcabenh = 2;
        }

        if ($this->nhapvien == 1) {
            $this->scenario = 'xacdinh';
            $xdinh = $this->validate();
            $message = array_merge($message, $this->getFirstErrors());
            if (!$xdinh) {
                $this->xmcabenh = 1;
            }
        } elseif ($this->nhapvien === '0') {
            $this->xmcabenh = 2;
        }

        if (!$dt) {
            $this->xmcabenh = 1;
        }

        // Fix
        if ($dt && $this->tpbv === '0' && $this->nhapvien === '0') {
            $this->xmcabenh = 3;
        }

        $this->clearErrors();
        $this->addErrors($message);

        Yii::$app->session->addFlash('messages', ['errors' => $message]);

        # Xử lý
        if ($this->phcd) {
            $this->chuyenca_filter = 3;
        } else {
            $this->chuyenca_filter = 0;
        }

        # Phát sinh mã số
        $this->maso = $this->generateMaso();
    }

    public function check_trungcabenh($method)
    {
        if ($method == 'create') {
            $cb = (new self())->find()->where(Arrays::clean([
                'hoten' => $this->hoten,
                'to1' => $this->to1,
                'khupho1' => $this->khupho1,
                'px1' => $this->px1,
                'qh1' => $this->qh1,
                'ngaynhapvien' => $this->ngaynhapvien,
                'ngaynhapvien' => $this->ngaynhapvien,
                'chuandoanbd' => $this->chuandoanbd,
                'tpbv_bv' => $this->tpbv,
            ]))->one();

            if ($cb) {
                foreach (['hoten', 'to1', 'khupho1', 'px1', 'qh1', 'ngaynhapvien', 'chuandoanbd', 'tpbv_bv'] as $item) {
                    $this->addError($item, "Ca bệnh bị trùng lặp {$item}: {$this->$item}");
                }
                return false;
            }
        }
    }

    public function generateMaso()
    {
        // Xác minh ca bệnh đã điều tra mới sinh mã số
        if ($this->xmcabenh !== 3) return;

        // Phát hiện cộng đồng
        if ($this->chuyenca_filter == 3) {
            return;
        }


        if ($this->tpbv_bv && $this->ngaynhapvien && $this->maso_bv) {
            $ngaydt = explode('/', $this->ngaynhapvien);
            $yy = substr($ngaydt[2], 2, 2);
            $mm = $ngaydt[1];
            $mahs = $this->ma_dt_sxh;

            if ($this->maso_bv == '01' || $this->maso_bv == '02' || $this->maso_bv == '07') {
                // 3 bệnh viện lớn (NHI ĐÔNG 1, NHI ĐỒNG 2, NHIỆT ĐỚI) -> XXXXX: shs
                return $this->shs ? implode('-', [$this->maso_bv, $yy, $mm, $this->shs]) : null;
            } else {
                return implode('-', [$this->maso_bv, $yy, $mm, $mahs]);
            }
        }

    }

//    cdc_cbn_ksxh


    public function validateForm($data)
    {
        // Tạo mảng lọc các giá trị của các trường k POST;
        $arr = ['diachi2', 'dienthoai2', 'sonha2', 'duong2', 'to2', 'khupho2', 'tinh2', 'qh2', 'px2', 'diachi3', 'benhnhan3', 'sonha3', 'duong3', 'to3', 'khupho3', 'tinh3', 'qh3', 'px3', 'benhnoikhac', 'sonhakhac', 'duongkhac', 'tokhac', 'khuphokhac', 'tinhkhac', 'qhkhac', 'pxkhac', 'songuoicutru', 'cutruduoi15', 'tpbv', 'tpbv_bv', 'phcd', 'nhapvien', 'nhapvien_bv', 'ngaynhapvien', 'ngaymacbenh', 'nghenghiep', 'dclamviec', 'dclamviecqh', 'dclamviecpx', 'noilamviec_sxh', 'nhacobnsxh', 'nhaconguoibenh', 'bvpk', 'nhatho', 'dinh', 'chua', 'congvien', 'noihoihop', 'noixd', 'cafe', 'noichannuoi', 'noibancay', 'vuaphelieu', 'noikhac', 'noikhac_ghichu', 'diemden_px', 'diemden_pxkhac', 'diemden_qhkhac', 'gdcosxh', 'gdsonguoisxh', 'gdso15t', 'gdthuocsxh', 'gdthuocsxhsonguoi', 'gdthuocsxh15t', 'bi', 'ci', 'cachidiem', 'dietlangquang', 'giamsattheodoi', 'xulyonho', 'cathuphat', 'odichmoi', 'odichcu', 'odichcu_xuly', 'xuly', 'xuly_ngay', 'xuatvien', 'ngayxuatvien', 'xacdinh', 'tenbenhkhac'];
        $data = array_merge(array_fill_keys($arr, null), $data);
        $this->attributes = $data;
        $this->ma_phuong = $this->px1;
        $this->ma_quan = $this->qh1;

        //-------------------------------
//        if($this->chuyenca1){
//            d($this->attributes);
//        };
        //--------------------------------

        # -- KIỂM TRA 1 ---------------------------------------------------
        if (!$this->validate()) return $this->validate();

        # -- XÁC MINH ĐỊA CHỈ ----------------------------------------------
        # Có địa chỉ, có bệnh nhân -> dc1:1 - bn1:1
        if ($this->diachi1 == 1 && $this->benhnhan1 == 1) {
            $this->scenario = 'cdc_cbn';
            if (!$this->validate()) return $this->validate();

            // Bệnh nhân sông một nơi-> noikhac:0
            if ($this->benhnoikhac == 0) {

            }
            // Bệnh nhân sống 2 nơi -> noikhac:1 (chuyển ca)------------------------
            if ($this->benhnoikhac == 1) {
                $this->addError('benhnoikhac', 'Hệ thống đang bảo trì -  trường hợp bệnh nơi khác có');
                return false;
            }

        }

        # Có địa chỉ, không bệnh nhân -> dc1:1 - bn1:0,  # Không địa chỉ, không bệnh nhân -> dc1:0 - bn1:0
        if (($this->diachi1 == 1 || $this->diachi1 == 0) && $this->benhnhan1 == 0) {
            $this->scenario = 'cdc_kbn';
            if (!$this->validate()) return $this->validate();

            // Xác minh địa chỉ khác BN -> dc2:1
            if ($this->diachi2 == 1) {
                $this->scenario = 'cdc_kbn_xm';
                if (!$this->validate()) return $this->validate();

                // Xét PX, nếu trùng PX gốc (ca bệnh)-> (chuyển ca)-------------------
                if ($this->px1 != $this->px2 || $this->qh1 != $this->qh2 || $this->tinh2 != 'HCM') {
                    $this->xmcabenh = 1;
                    // Chặn chuyển ca lần 2
                    if ($this->chuyenca1) {
                        $this->xmcabenh = 3;
                        $this->addError('chan_cc', 'Ca bệnh trả về, không được phép chuyển ca tiếp');
                    } else {
                        $this->chuyenCaDi();
                    }

                    return true;// k Thong bao loi -> chuyen ca
                }
                // Xét trả ca về hay điều tra tiếp
                if ($this->chuyenca1 && !$this->chuyenca2) {
                    $this->scenario = 'xm_dc3';
                    if (!$this->validate()) return $this->validate();

                    if ($this->benhnhan3 == 0) {
                        $this->chuyenCaVe();
                        $this->xmcabenh = 3;
                        return true;
                    };
                }

            } elseif ($this->diachi2 == 0) { // K Xác minh địa chỉ khác BN -> dc2:0 => Khóa hết, kết thúc, ĐÃ ĐIỀU TRA
//                $this->updateThongke(['cdc_kbn', 2]); //Không biết - Tỉnh khác
                $this->xmcabenh = 3;
                return true;
            }

        }

        if ($this->diachi1 == 0 && $this->benhnhan1 == 1) {
            # Không có trường hợp này
            $this->addError('kdc_cbn', '<b>Không có trường hợp này</b>');
            return false;
        }

        $this->xmcabenh = 1; // SET: ĐANG ĐIỀU TRA

        $this->scenario = 'dieutra';
        $dt = $this->validate();
        $message = $this->getFirstErrors();

        $this->scenario = 'xuatvien';
        $xvien = $this->validate();

        $message = array_merge($message, $this->getFirstErrors());

        if ($dt && $xvien) {
            $this->xmcabenh = 3;
        } elseif ($dt && !$xvien) {
            $this->xmcabenh = 2;
        }


        $this->clearErrors();
        $this->addErrors($message);

        Yii::$app->session->addFlash('messages', ['errors' => $message]);

        # Xử lý
        $this->chuyenca_filter = $this->chuyenca_filter === null ? 3 : $this->chuyenca_filter;

        return true;
    }

    protected function chuyenCaDi()
    {


        # Kiểm tra ca bệnh này đã có bên PX2 chưa?
        $mq = DmPhuong::find()->where(['ma_quan' => $this->qh2, 'ma_phuong' => $this->px2])->one();
        $kt = Cabenh::find()->where(['macabenh' => $this->macabenh, 'ma_quan' => $this->qh2, 'ma_phuong' => $this->px2])->one();
        if ($kt) {
            $this->addError('kt_chuyenca', 'Ca bệnh này đã có ở phường xã khác. Bạn không được phép chuyển ca');
            return;
        }
        // Chuyên ca đi
        $this->chuyenca1 = $this->px1;
        $this->chuyenca2 = null;
        $this->chuyenca_filter = 1;

        $this->ma_phuong = $this->px2;
        $this->px1 = $this->px2;
        $this->ma_quan = $this->qh2;
        $this->qh1 = $this->qh2;

        Yii::$app->session->addFlash('messages', ['success' => "Ca bệnh đã được chuyển cho PX: $mq->ten_phuong - QH: $mq->ten_quan"]);
    }

    protected function chuyenCaVe()
    {
        $mq = DmPhuong::find()->where(['ma_phuong' => $this->chuyenca1])->one();
        // Trả ca về
        $this->chuyenca2 = $this->px2;
        $this->chuyenca_filter = 2;

        $this->ma_phuong = $this->chuyenca1;
        $this->px1 = $this->chuyenca1;
        $this->ma_quan = $mq->ma_quan;
        $this->qh1 = $mq->ma_quan;


        Yii::$app->session->addFlash('messages', ['success' => "Ca bệnh đã được chuyển cho PX cũ"]);
    }


    public function fields()
    {
        $px = ArrayHelper::map(VDmPhuong1::find()->asArray()->all(), 'ma_phuong', 'ten_phuong');
        $qh = ArrayHelper::map(VDmQuan1::find()->asArray()->all(), 'ma_quan', 'ten_quan');


        $action = [
            'tenpx1' => function () use ($qh, $px) {
                return isset($px[$this->px1]) ? $px[$this->px1] : '';
            },
            'tenqh1' => function () use ($qh, $px) {
                return isset($qh[$this->qh1]) ? $qh[$this->qh1] : '';
            },
            'tenpx2' => function () use ($qh, $px) {
                return isset($px[$this->px2]) ? $px[$this->px2] : '';
            },
            'tenqh2' => function () use ($qh, $px) {
                return isset($qh[$this->qh2]) ? $qh[$this->qh2] : '';
            },
            'tenpx3' => function () use ($qh, $px) {
                return isset($px[$this->px3]) ? $px[$this->px3] : '';
            },
            'tenqh3' => function () use ($qh, $px) {
                return isset($qh[$this->qh3]) ? $qh[$this->qh3] : '';
            },
            'tenpxkhac' => function () use ($qh, $px) {
                return isset($px[$this->pxkhac]) ? $px[$this->pxkhac] : '';
            },
            'tenqhkhac' => function () use ($qh, $px) {
                return isset($qh[$this->qhkhac]) ? $qh[$this->qhkhac] : '';
            },
            'tendclamviecqh' => function () use ($qh, $px) {
                return isset($qh[$this->dclamviecqh]) ? $qh[$this->dclamviecqh] : '';
            },
            'tendclamviecpx' => function () use ($qh, $px) {
                return isset($px[$this->dclamviecpx]) ? $px[$this->dclamviecpx] : '';
            },
        ];

        if ($this->typeExport == 'excel') {
            $keys = array_keys($this->labelExcel());
            return array_merge(array_combine($keys, $keys), $action);
        }

        return array_merge($this->labelExcel(), $action);

        return array_merge(parent::fields(), $action);
    }

    public function attributeLabels()
    {

        return array_merge(parent::attributeLabels(), [
            'me' => 'Mẹ',
            'ma_icd' => 'Mã ICD',
            'shs' => 'Số hồ sơ (SHS)',

            'qh1' => 'Quận huyện (1)',
            'px1' => 'Phường xã (1)',
            'maso' => 'Mã số',
            'phai' => 'Giới tính',

            'ngaysinh' => 'Ngày sinh',

            'diachi1' => 'Địa chỉ (1)',
            'dienthoai1' => 'Điện thoại (1)',
            'sonha1' => 'Số nhà (1)',
            'duong1' => 'Đường (1)',
            'benhnhan1' => 'Bệnh nhân (1)',
            'to1' => 'Tổ (1)',
            'khupho1' => 'Khu phố/ấp (1)',

            'diachi2' => 'Địa chỉ (2)',
            'dienthoai2' => 'Điện thoại (2)',
            'sonha2' => 'Số nhà (2)',
            'duong2' => 'Đường (2)',
            'to2' => 'Tổ (2)',
            'khupho2' => 'Khu phố/ấp (2)',
            'tinh2' => 'Tỉnh (2)',
            'qh2' => 'Quận huyện (2)',
            'px2' => 'Phường xã (2)',

            'diachi3' => 'Địa chỉ (3)',
            'benhnhan3' => 'Bệnh nhân (3)',
            'sonha3' => 'Số nhà (3)',
            'duong3' => 'Đường (3)',
            'to3' => 'Tổ (3)',
            'khupho3' => 'Khu phố/ấp (3)',
            'tinh3' => 'Tỉnh (3)',
            'qh3' => 'Quận huyện (3)',
            'px3' => 'Phường xã (3)',

            'benhnoikhac' => 'Bệnh nhân ở nơi khác',
            'sonhakhac' => 'Số nhà (khác)',
            'duongkhac' => 'Đường (khác)',
            'tokhac' => 'Tổ (khác)',
            'khuphokhac' => 'Khu phố/ấp (khác)',
            'tinhkhac' => 'Tỉnh (khác)',
            'qhkhac' => 'Quận huyện (khác)',
            'pxkhac' => 'Phường xã (khác)',

            'songuoicutru' => Yii::t('app', 'Số người cư trú trong gia đình'),
            'cutruduoi15' => Yii::t('app', 'Số người cư trú trong gia đình - Trong đó số dưới 15 tuổi'),

            'tpbv' => Yii::t('app', 'TP báo về (TPBV)'),
            'tpbv_bv' => Yii::t('app', 'TPBV - Bệnh viện'),
            'phcd' => Yii::t('app', 'Phát hiện cộng đồng (PHCD)'),
            'nhapvien' => Yii::t('app', 'Nhập viện'),
            'nhapvien_bv' => Yii::t('app', 'Nhập viện - Tên bệnh viện'),
            'nghenghiep' => Yii::t('app', 'Nghề nghiệp'),
            'ngaymacbenh' => Yii::t('app', 'Ngày mắc bệnh'),
            'ngaynhapvien' => Yii::t('app', 'Ngày nhập viện'),
            'dclamviec' => Yii::t('app', 'Địa chỉ nơi làm việc'),
            'dclamviecqh' => Yii::t('app', 'Địa chỉ nơi làm việc - Quận huyện'),
            'dclamviecpx' => Yii::t('app', 'Địa chỉ nơi làm việc - Phường xã'),
            'noilamviec_sxh' => Yii::t('app', 'Tại nơi làm việc, trong vòng 2 tuần qua có ai bị SXH / nghi ngờ SXH / sốt không?'),
            'nhacobnsxh' => Yii::t('app', 'Nhà có BN SXH'),
            'nhaconguoibenh' => Yii::t('app', 'Nhà có người bệnh'),
            'bvpk' => Yii::t('app', 'BVPK'),
            'nhatho' => Yii::t('app', 'Nhà Thờ'),
            'dinh' => Yii::t('app', 'Đình'),
            'chua' => Yii::t('app', 'Chùa'),
            'congvien' => Yii::t('app', 'Công viên'),
            'noihoihop' => Yii::t('app', 'Nơi hội họp'),
            'noixd' => Yii::t('app', 'Nơi xây dựng'),
            'cafe' => Yii::t('app', 'Cafe'),
            'noichannuoi' => Yii::t('app', 'Nơi chăn nuôi'),
            'noibancay' => Yii::t('app', 'Nơi bán cây'),
            'vuaphelieu' => Yii::t('app', 'Vựa phế liệu'),
            'noikhac' => Yii::t('app', 'Nơi khác'),
            'noikhac_ghichu' => Yii::t('app', 'Nơi khác - Ghi chú'),
            'diemden_px' => Yii::t('app', 'Điểm đã đến - Phường xã'),
            'diemden_pxkhac' => Yii::t('app', 'Điểm đã đến - Phường xã khác'),
            'diemden_qhkhac' => Yii::t('app', 'Điểm đã đến - Quận huyện khác'),
            'gdcosxh' => Yii::t('app', 'Tại gia đình, Có người mắc bệnh SXH không?'),
            'gdsonguoisxh' => Yii::t('app', 'Tại gia đình, số người bị SXH'),
            'gdso15t' => Yii::t('app', 'Tại gia đình, số người < 15 tuổi'),
            'gdthuocsxh' => Yii::t('app', 'Tại gia đình, Có người mắc bệnh sốt hoặc có uống thuốc hạ sốt?'),
            'gdthuocsxhsonguoi' => Yii::t('app', 'Tại gia đình, số người mắc bệnh'),
            'gdthuocsxh15t' => Yii::t('app', 'Tại gia đình, số người mắc bệnh < 15 tuổi'),
            'bi' => Yii::t('app', 'BI'),
            'ci' => Yii::t('app', 'CI'),
            'cachidiem' => Yii::t('app', 'Ca chỉ điểm'),
            'dietlangquang' => Yii::t('app', 'Diệt lăng quăng'),
            'giamsattheodoi' => Yii::t('app', 'Giám sát theo dõi'),
            'xulyonho' => Yii::t('app', 'Xử lý ổ dịch nhỏ'),
            'cathuphat' => Yii::t('app', 'Ca thứ phát'),
            'odichmoi' => Yii::t('app', 'Ổ dịch mới'),
            'odichcu' => Yii::t('app', 'Ổ dịch cũ'),
            'odichcu_xuly' => Yii::t('app', 'Ổ dịch cũ đã xác định, Xử lý ? ngày'),
            'xuly' => Yii::t('app', 'Xử lý'),
            'xuly_ngay' => Yii::t('app', 'Sau xử lý ? ngày'),
            'xuatvien' => Yii::t('app', 'Xuất viện'),
            'ngayxuatvien' => Yii::t('app', 'Ngày xuất viện'),
            'xacdinh' => Yii::t('app', 'Xác định'),
            'tenbenhkhac' => Yii::t('app', 'Tên bệnh khác'),
            'nguoidieutra' => 'Người điều tra',
            'chuandoanbd' => 'Chẩn đoán ban đầu',
        ]);
    }

    public function buildExcel(array $condition = [])
    {
        if (empty($condition)) {
            $data = $this->find()->all();
        } else {
            $data = $this->find()->where($condition)->all();
        }

        return array_merge([
            array_values($this->labelExcel())], // Cột
            ArrayHelper::toArray( // Dữ liệu
                $data,
                [
                    VDieutraSxh1::class => [$this->fields()]
                ])
        );
    }

    public function labelExcel()
    {
        return [
            'maso' => 'MASO',
            'tenqh1' => 'QH', // Check
            'tenpx1' => 'PX', // Check
            'ngaynhanthongbao' => 'NG_NHAN',
            'ngaydieutra' => 'NG_DT',
            'hoten' => 'H_TEN',
            'phai' => 'GIOI',
            'tuoi' => 'TUOI',
            'ngaysinh' => 'NG_SINH',
            'diachi1' => 'DC1',
            'benhnhan1' => 'BN1',
            'dienthoai1' => 'DT_1',
            'sonha1' => 'SONHA_1',
            'duong1' => 'DUONG_1',
            'to1' => 'TO_1',
            'khupho1' => 'KPAP_1',
            'diachi2' => 'DC2',
            'dienthoai2' => 'DT_2',
            'sonha2' => 'SONHA_2',
            'duong2' => 'DUONG_2',
            'to2' => 'TO_2',
            'khupho2' => 'KPAP_2',
            'tinh2' => 'TINH_2',
            'tenqh2' => 'QH_2', // Check
            'tenpx2' => 'PX_2', // Check
            'diachi3' => 'DC_3',
            'benhnhan3' => 'BN_3',
            'sonha3' => 'SONHA_3',
            'duong3' => 'DUONG_3',
            'to3' => 'TO_3',
            'khupho3' => 'KPAP_3',
            'tinh3' => 'TINH_3',
            'tenqh3' => 'QH_3', // Check
            'tenpx3' => 'PX_3', // Check
            'benhnoikhac' => 'DC_KHAC',
            'sonhakhac' => 'SONHA_K',
            'duongkhac' => 'DUONG_K',
            'tokhac' => 'TO_K',
            'khuphokhac' => 'KPAP_K',
            'tinhkhac' => 'TINH_K',
            'tenqhkhac' => 'QH_K', // Check
            'tenpxkhac' => 'PX_K', // Check
            'songuoicutru' => 'TVGD',
            'cutruduoi15' => 'TVGD_<15T',
            'tpbv' => 'CA_TP',
            'tpbv_bv' => 'BV',
            'phcd' => 'PHCD',
            'nhapvien' => 'NV',
            'nhapvien_bv' => 'BV_1',
            'ngaymacbenh' => 'NG_MAC',
            'ngaynhapvien' => 'NG_NV',
            'nghenghiep' => 'NN',
            'dclamviec' => 'DC_CT',
            'tendclamviecqh' => 'QH_CT', // Check
            'tendclamviecpx' => 'PX_CT', // Check
            'noilamviec_sxh' => 'NGUOI_LQ',
            'nhacobnsxh' => 'BN_SXH',
            'nhaconguoibenh' => 'CA_BENH',
            'bvpk' => 'BVPK',
            'nhatho' => 'NHATHO',
            'dinh' => 'DINH',
            'chua' => 'CHUA',
            'congvien' => 'C_VIEN',
            'noihoihop' => 'N_HOIHOP',
            'noixd' => 'N_XD',
            'cafe' => 'CF',
            'noichannuoi' => 'N_CHAN NUOI',
            'noibancay' => 'CAYCANH',
            'vuaphelieu' => 'PHELIEU',
            'noikhac' => 'KHAC',
            'noikhac_ghichu' => 'GHIRO',
            'diemden_px' => 'DB_PX',
            'diemden_pxkhac' => 'DB_PXK',
            'diemden_qhkhac' => 'DB_QHK',
            'gdcosxh' => 'GD_BENH',
            'gdsonguoisxh' => 'SONGUOI_1',
            'gdso15t' => '<=15T_1',
            'gdthuocsxh' => 'SOT_UT',
            'gdthuocsxhsonguoi' => 'SONGUOI_2',
            'gdthuocsxh15t' => '<=15T_2',
            'bi' => 'BI',
            'ci' => 'CI',
            'cachidiem' => 'CACHIDIEM',
            'dietlangquang' => 'DLQ',
            'giamsattheodoi' => 'GS_TD',
            'xulyonho' => 'XLOD',
            'cathuphat' => 'CA_TP',
            'odichmoi' => 'OD_MOI',
            'odichcu' => 'OD_CU',
            'odichcu_xuly' => 'SO_NG_XL',
            'xuly' => 'TT_XL',
            'xuly_ngay' => 'SO_NG_SXL',
            'xuatvien' => 'XV (92)',
            'ngayxuatvien' => 'NG_XV',
            'xacdinh' => 'CD_RV',
            'tenbenhkhac' => 'TEN_BK',
            'nguoidieutra' => 'NGUOI_DT',
        ];
    }

}
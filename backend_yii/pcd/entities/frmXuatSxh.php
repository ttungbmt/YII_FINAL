<?php
/**
 * Created by PhpStorm.
 * User: THANHTUNG
 * Date: 04/11/16
 * Time: 10:20 AM
 */

namespace pcd\entities;


use pcd\models\VDmPhuong1;
use pcd\models\VDmQuan1;
use pcd\modules\role_phuongquan\services\PQService;
use pcd\modules\role_phuongquan\services\RolePQConst;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class frmXuatSxh extends Model
{
    public $tinh;
    public $ma_quan;
    public $ma_phuong;
    public $chuandoan;
    public $datebc_from;
    public $datebc_to;

    public $dataTK;
    protected $role;

    public function init()
    {
        parent::init();
        $this->role = PQService::getRolePQOfCurrentUser();
    }

    public function rules(){
        $role = PQService::getRolePQOfCurrentUser();
        return [
            [['ma_quan', 'ma_phuong'], 'safe'],
            [['datebc_from', 'datebc_to'], 'date'],
            [['tinh', 'chuandoan', 'datebc_from','datebc_to'], 'required'],
//            [['datebc_to'], 'compare', 'compareAttribute' => 'datebc_from', 'operator' => '>='],
//            [['datebc_from'], 'compare', 'compareAttribute' => 'datebc_to', 'operator' => '<='],
            [['ma_quan'], 'required', 'when' => function() use($role){
                return $role->cap_hanhchinh == RolePQConst::$CAP_QUAN;
            }, 'on' => 'onRoleQuan'],
            [['ma_phuong'], 'required', 'when' => function() use($role){
                return $role->cap_hanhchinh == RolePQConst::$CAP_PHUONG;
            }, 'on' => 'onRolePhuong'
            ]
        ];
    }

    public function attributeLabels(){
        return [
            'tinh' => 'Tỉnh',
            'ma_quan' => 'Quận huyện',
            'ma_phuong' => 'Phường xã',
            'chuandoan' => 'Chẩn đoán',
            'datebc_from' => 'Từ ngày',
            'datebc_to' => 'Đến ngày',
        ];
    }

    public function checkRole(){
        if(!$this->validate()) return false;
        $this->scenario = 'onRoleQuan';
        if(!$this->validate()) return false;

        $this->scenario = 'onRolePhuong';
        if(!$this->validate()) return false;

        return true;
    }

    public function dataExcel(){
        $phieusxh = vPhieuSxh::find()
            ->where(['between', 'ngaybaocao', $this->datebc_from, $this->datebc_to]);

        $phieusxh = $this->ma_quan ? $phieusxh->andWhere(['ma_quan' => $this->ma_quan]) : $phieusxh;
        $phieusxh = $this->ma_phuong ? $phieusxh->andWhere(['ma_phuong' => $this->ma_phuong]) : $phieusxh;
        $phieusxh = $phieusxh->all();

        if($this->role->cap_hanhchinh == RolePQConst::$CAP_PHUONG){
            return $this->buildExcelPx($phieusxh);
        }

        return $this->buildExcelQh($phieusxh);
    }

    public function buildExcelQh($phieusxh){
        $px = ArrayHelper::map(VDmPhuong1::find()->asArray()->all(), 'ma_phuong', 'ten_phuong');
        $qh = ArrayHelper::map(VDmQuan1::find()->asArray()->all(), 'ma_quan', 'ten_quan');

        $arr = array_combine(array_keys($this->labelExcelQh()), array_keys($this->labelExcelQh()));

        return array_merge([$this->labelExcelQh()],
            ArrayHelper::toArray($phieusxh, [
            vPhieuSxh::class => array_merge($arr, [
                'tenpx1' => function($phieusxh) use ($qh, $px){            return isset($px[$phieusxh->px1]) ? $px[$phieusxh->px1] : '';},
                'tenqh1' => function($phieusxh) use ($qh, $px){            return isset($qh[$phieusxh->qh1]) ? $qh[$phieusxh->qh1] : '';},
                'tenpx2' => function($phieusxh) use ($qh, $px){            return isset($px[$phieusxh->px2]) ? $px[$phieusxh->px2] : '';},
                'tenqh2' => function($phieusxh) use ($qh, $px){            return isset($qh[$phieusxh->qh2]) ? $qh[$phieusxh->qh2] : '';},
                'tenpx3' => function($phieusxh) use ($qh, $px){            return isset($px[$phieusxh->px3]) ? $px[$phieusxh->px3] : '';},
                'tenqh3' => function($phieusxh) use ($qh, $px){            return isset($qh[$phieusxh->qh3]) ? $qh[$phieusxh->qh3] : '';},
                'tenpxkhac' => function($phieusxh) use ($qh, $px){         return isset($px[$phieusxh->pxkhac]) ? $px[$phieusxh->pxkhac]: '';},
                'tenqhkhac' => function($phieusxh) use ($qh, $px){         return isset($qh[$phieusxh->qhkhac]) ? $qh[$phieusxh->qhkhac]: '';},
                'tendclamviecqh' => function($phieusxh) use ($qh, $px){    return isset($qh[$phieusxh->dclamviecqh]) ? $qh[$phieusxh->dclamviecqh]: '';},
                'tendclamviecpx' => function($phieusxh) use ($qh, $px){    return isset($px[$phieusxh->dclamviecpx]) ? $px[$phieusxh->dclamviecpx]: '';},
            ])
        ]));
    }

    public function buildExcelPx($phieusxh){
        $px = ArrayHelper::map(VDmPhuong1::find()->asArray()->all(), 'ma_phuong', 'ten_phuong');
        $qh = ArrayHelper::map(VDmQuan1::find()->asArray()->all(), 'ma_quan', 'ten_quan');

        $arr = array_combine(array_keys($this->labelExcelPx()), array_keys($this->labelExcelPx()));

        return array_merge([$this->labelExcelPx()],
            ArrayHelper::toArray($phieusxh, [
                vPhieuSxh::class => array_merge($arr, [
                    'tenpx1' => function($phieusxh) use ($qh, $px){            return isset($px[$phieusxh->px1]) ? $px[$phieusxh->px1] : '';},
                    'tenqh1' => function($phieusxh) use ($qh, $px){            return isset($qh[$phieusxh->qh1]) ? $qh[$phieusxh->qh1] : '';},
                    'tenpx2' => function($phieusxh) use ($qh, $px){            return isset($px[$phieusxh->px2]) ? $px[$phieusxh->px2] : '';},
                    'tenqh2' => function($phieusxh) use ($qh, $px){            return isset($qh[$phieusxh->qh2]) ? $qh[$phieusxh->qh2] : '';},
                    'tenpx3' => function($phieusxh) use ($qh, $px){            return isset($px[$phieusxh->px3]) ? $px[$phieusxh->px3] : '';},
                    'tenqh3' => function($phieusxh) use ($qh, $px){            return isset($qh[$phieusxh->qh3]) ? $qh[$phieusxh->qh3] : '';},
                    'tenpxkhac' => function($phieusxh) use ($qh, $px){         return isset($px[$phieusxh->pxkhac]) ? $px[$phieusxh->pxkhac]: '';},
                    'tenqhkhac' => function($phieusxh) use ($qh, $px){         return isset($qh[$phieusxh->qhkhac]) ? $qh[$phieusxh->qhkhac]: '';},
                ])
            ]));
    }

    public function labelExcelPx(){
        return [
            'maso' => 'MASO',
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
            'tenqh1' => 'QH', // Check
            'tenpx1' => 'PX', // Check
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
            'tpbv' => 'CA_TP',
            'tpbv_bv' => 'BV',
            'phcd' => 'PHCD',
            'ngaymacbenh' => 'NG_MAC',
            'ngaynhapvien' => 'NG_NV',
            'ngayxuatvien' => 'NG_XV',
            'xacdinh' => 'CD_RV',
            'tenbenhkhac' => 'TEN_BK',
        ];
    }

    public function labelExcelQh(){
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
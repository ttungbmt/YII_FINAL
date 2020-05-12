<?php
/**
 * Created by PhpStorm.
 * User: ttungbmt
 * Date: 07/03/2016
 * Time: 08:19
 */

namespace pcd\entities;


use common\models\MyModel;
use pcd\models\Benhvien;
use pcd\models\Cabenh;
use pcd\models\VDmPhuong1;
use pcd\models\VDmQuan1;
use yii\helpers\ArrayHelper;

class excelCabenh extends MyModel
{
    use ModelTrait;

    public $bv;
    public $icd;
    public $tbenh;
    public $shs;
    public $ho_ten;
    public $phai;
    public $tuoi;
    public $dia_chi;
    public $nghe_nghiep;
    public $me;
    public $dt;
    public $qh;
    public $px;
    public $ngnv;
    public $ngbc;
    public $nam_nv;
    public $thang_nv;
    public $tuan_nv;
    public $nam_bc;
    public $thang_bc;
    public $tuan_bc;
    public $hinh_thuc_dieu_tri;


    protected $dates = ['ngnv', 'ngbc'];

    public function fields()
    {
        $px = ArrayHelper::map(VDmPhuong1::find()->asArray()->all(), 'ma_px', 'ten_px');
        $qh = ArrayHelper::map(VDmQuan1::find()->asArray()->all(), 'ma_qh', 'ten_qh');

        return [
            'benhvien' => 'bv',
            'ma_icd' => 'icd',
            'tbenh' => 'tbenh',
            'shs' => 'shs',
            'hoten' => 'ho_ten',
            'phai' => 'phai',
            'tuoi' => 'tuoi',
            'vitri1' => 'dia_chi',
            'nghenghiep' => 'nghe_nghiep',
            'me' => 'me',
            'dt' => 'dt',
            'qh1' => function() use ($qh){
                return array_search($this->qh, $qh);
            },
            'px1' => function() use ($px){
                return array_search($this->px, $px);
            },
            'ngaynhapvien' => 'ngnv',
            'ngaybaocao' => 'ngbc',
            'nam_nv' => 'nam_nv',
            'thang_nv' => 'thang_nv',
            'tuan_nv' => 'tuan_nv',
            'nam_bc' => 'nam_bc',
            'thang_bc' => 'thang_bc',
            'tuan_bc' => 'tuan_bc',
            'loaibc' => function(){
                if($this->hinh_thuc_dieu_tri == 'Điều trị ngoại trú'){
                    return 0;
                }

                if($this->hinh_thuc_dieu_tri == 'Điều trị nội trú'){
                    return 1;
                }

            },
        ];

    }

    public function rules()
    {
        return [
            [['bv', 'tbenh', 'ho_ten', 'qh', 'px'], 'required'],
            [['icd', 'shs', 'phai', 'tuoi', 'dia_chi', 'me', 'dt', 'ngnv', 'ngbc', 'nam_nv'], 'safe'],
            [['tuoi', 'thang_nv', 'nam_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc'], 'integer'],
            [['ngnv', 'ngbc'], 'checkDate'],
            ['phai','in','range'=>['T','G'], 'strict'=>true],
            ['tbenh','in','range'=>['SOT XUAT HUYET', 'SXH', 'TAY CHAN MIENG', 'TCM', 'SOT SIEU VI', 'SXV'], 'strict'=>true],
            ['qh', 'in', 'range'=> ArrayHelper::map(VDmQuan1::find()->asArray()->all(), 'ma_qh', 'ten_qh'), 'strict'=>true],
            ['px', 'in', 'range'=> ArrayHelper::map(VDmPhuong1::find()->asArray()->all(), 'ma_px', 'ten_px'), 'strict'=>true],
            [['bv'], 'in', 'range'=> ArrayHelper::map(Benhvien::find()->asArray()->all(), 'mabenhvien', 'tenvt'), 'strict'=>true],
            ['hinh_thuc_dieu_tri', 'in', 'range'=> ['Điều trị ngoại trú', 'Điều trị nội trú'], 'strict'=>true],
        ];
    }

    public function beforeValidate()
    {
        $px = ArrayHelper::map(VDmPhuong1::find()->asArray()->all(), 'ma_px', 'ten_px');
        $qh = ArrayHelper::map(VDmQuan1::find()->asArray()->all(), 'ma_qh', 'ten_qh');
        $bv = ArrayHelper::map(Benhvien::find()->asArray()->all(), 'tenvt', 'tenbenhvien');

        // Lưu ý: Không rõ
        $cabenh = Cabenh::find()->where([
            'hoten' => $this->ho_ten,
            'benhvien' => $this->bv,
            'ngaynhapvien' => $this->ngnv,
        ]);

        $cabenh = isset($px[$this->px]) && $px[$this->px] ? $cabenh->andWhere(['px1' => array_search($this->px, $px)]) : $cabenh;
        $cabenh = isset($qh[$this->qh]) && $qh[$this->qh] ? $cabenh->andWhere(['qh1' => array_search($this->qh, $qh)]) : $cabenh;

        $cabenh = ($this->tbenh == 'SOT XUAT HUYET' || $this->tbenh == 'SXH') ? $cabenh->andWhere(['tbenh' => 'SXH']) : $cabenh;
        $cabenh = $this->tbenh == 'SOT SIEU VI' || $this->tbenh == 'SXV' ? $cabenh->andWhere(['tbenh' => 'SXV']) : $cabenh;
        $cabenh = $this->tbenh == 'TAY CHAN MIENG' || $this->tbenh == 'TCM' ? $cabenh->andWhere(['tbenh' => 'TCM']) : $cabenh;

        if($cabenh->one()){
            $this->addError('ho_ten', "Ca bệnh {$this->ho_ten} - {$this->px} - {$this->qh} ($this->ngnv) đã nhập rồi");
            return false;
        }

        return parent::beforeValidate();
    }

//    public function check_benhvien($attribute, $params){
//        $bv = Benhvien::find()->where(['tenvt' => $this->$attribute])->one() ?: $this->addError($attribute, 'Mã bệnh viện không đúng');
//    }

    public function checkDate($attribute, $params){
        if(!validateDate($this->$attribute, 'd/m/Y')){
            $this->addError($attribute, 'Ngày nhập không đúng định dạng DD/MM/YYY.');
        }
    }

    public function attributeLabels()
    {
        return [
            'bv' => 'Bệnh viện',
            'icd' => 'ICD',
            'tbenh' => 'Tình trạng bệnh',
            'shs' => 'Số hồ sơ',
            'ho_ten' => 'Họ tên ca bệnh',
            'phai' => 'Phái',
            'tuoi' => 'Tuổi',
            'dia_chi' => 'Địa chỉ',
            'nghe_nghiep' => 'Nghề nghiệp',
            'me' => 'Mẹ',
            'dt' => 'Điện thoại',
            'qh' => 'Quận huyện',
            'px' => 'Phường xã',
            'ngnv' => 'Ngày nhập viện',
            'ngbc' => 'Ngày báo cáo',
            'nam_nv' => 'Năm nhập viện',
            'thang_nv' => 'Tháng nhập viện',
            'tuan_nv' => 'Tuần nhập viện',
            'nam_bc' => 'Năm báo cáo',
            'thang_bc' => 'Tháng báo cáo',
            'tuan_bc' => 'Tuần báo cáo',
            'hinh_thuc_dieu_tri' => 'Hình thức điều trị',
        ];
    }
}
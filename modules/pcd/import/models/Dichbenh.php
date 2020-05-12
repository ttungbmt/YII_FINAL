<?php
namespace modules\pcd\import\models;
use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "dichbenh".
 *
 * @property int $gid
 * @property string $benhvien
 * @property string $chuandoan_bd
 * @property string $shs
 * @property string $hoten
 * @property string $phai
 * @property int $tuoi
 * @property string $diachi
 * @property string $nghenghiep
 * @property string $me
 * @property string $dienthoai
 * @property string $maquan
 * @property string $maphuong
 * @property string $ngaynhapvien
 * @property string $ngaybaocao
 * @property string $nam_nv
 * @property string $thang_nv
 * @property string $tuan_nv
 * @property string $nam_bc
 * @property string $thang_bc
 * @property string $tuan_bc
 * @property string $hinhthuc_dt
 */
class Dichbenh extends MyModel
{
    protected $dates = ['ngaynhapvien', 'ngaybaocao'];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dichbenh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tuoi'], 'default', 'value' => null],
            [['tuoi'], 'integer'],
            [['ngaynhapvien', 'ngaybaocao'], 'date', 'format' => 'DD/MM/YYYY'],
            [['nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc', ], 'safe'],
            [['benhvien', 'chuandoan_bd', 'shs', 'hoten', 'phai', 'diachi', 'nghenghiep', 'me', 'dienthoai', 'maquan', 'maphuong', 'hinhthuc_dt'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gid' => 'Gid',
            'benhvien' => 'Bệnh viện',
            'chuandoan_bd' => 'Chuẩn đoán ban đầu',
            'shs' => 'Shs',
            'hoten' => 'Họ tên',
            'phai' => 'Phái',
            'tuoi' => 'Tuổi',
            'diachi' => 'Địa chỉ',
            'nghenghiep' => 'Nghề nghiệp',
            'me' => 'Mẹ',
            'dienthoai' => 'Điện thoại',
            'maquan' => 'Quận huyện',
            'maphuong' => 'Phường xã',
            'ngaynhapvien' => 'Ngày nhập viện',
            'ngaybaocao' => 'Ngày báo cáo',
            'nam_nv' => 'Nam Nv',
            'thang_nv' => 'Thang Nv',
            'tuan_nv' => 'Tuan Nv',
            'nam_bc' => 'Nam Bc',
            'thang_bc' => 'Thang Bc',
            'tuan_bc' => 'Tuan Bc',
            'hinhthuc_dt' => 'Hình thức điều trị',
        ];
    }
}

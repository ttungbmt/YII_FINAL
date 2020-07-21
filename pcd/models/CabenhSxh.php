<?php

namespace pcd\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "m_cabenh_sxh".
 *
 * @property int $gid
 * @property int $loaidieutra
 * @property int $loaicabenh
 * @property string $chuandoan;
 * @property string $chuandoan_bd
 * @property string $ma_icd
 * @property int $maphuong
 * @property int $maquan
 * @property string $hoten
 * @property int $tuoi
 * @property string $phai
 * @property string $benhvien
 * @property string $ngaybaocao
 * @property string $ngaynhanthongbao
 * @property string $ngaymacbenh
 * @property string $ngaynhapvien
 * @property string $ngayxuatvien
 * @property string $nghenghiep
 * @property string $shs
 * @property string $vitri
 * @property string $me
 * @property string $dienthoai
 * @property string $geom
 * @property int $nam_nv
 * @property int $thang_nv
 * @property int $tuan_nv
 * @property int $nam_bc
 * @property int $thang_bc
 * @property int $tuan_bc
 * @property string $sonha
 * @property string $duong
 * @property string $to_dp
 * @property string $khupho
 * @property int $px
 * @property int $qh
 * @property int $ht_dieutri
 * @property int $loai_xm_cb
 */
class CabenhSxh extends App
{
    protected $timestamps = true;
    protected $blameables = true;

    public $distance;
    public $is_cungnha;
    public $cungnha_id;

    public $lat;
    public $lng;

    public $dates = [
        'ngaybaocao',
        'ngaynhanthongbao',
        'ngaymacbenh',
        'ngaynhapvien',
        'ngayxuatvien',
        'ngaysinh',
        'ngaymacbenh_nv',
        'ngaylaymau',
//        'ngaydieutra',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cabenh_sxh';
    }

    public static function primaryKey()
    {
        return ['gid'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loaidieutra', 'loaicabenh', 'maphuong', 'maquan', 'tuoi', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc', 'px', 'qh', 'ht_dieutri'], 'default', 'value' => null],
            [['loai_xm_cb', 'chuandoan', 'loaidieutra', 'loaicabenh', 'maphuong', 'maquan', 'tuoi', 'nam_nv', 'thang_nv', 'tuan_nv', 'nam_bc', 'thang_bc', 'tuan_bc', 'px', 'qh', 'ht_dieutri', 'is_nghingo', 'xetnghiem', 'loai_xn', 'ketqua_xn'], 'integer'],
            [['is_trave', 'diachi_cc_id'], 'integer'],
            [['benhvien', 'dienthoai', 'chuandoan_khac'], 'string'],
            [['ngaybaocao', 'ngaynhanthongbao', 'ngaymacbenh', 'ngaynhapvien', 'ngayxuatvien', 'ngaysinh', 'ngaymacbenh_nv', 'ngaylaymau', 'geom'], 'safe'],
            [['chuandoan_bd', 'phai', 'nghenghiep', 'vitri', 'me', 'sonha', 'duong', 'to_dp', 'khupho'], 'string', 'max' => 255],
            [['shs', 'tp_guive'], 'safe'],
            [['ma_icd'], 'string', 'max' => 15],
            [['hoten'], 'string', 'max' => 150],
            [['lat', 'lng'], 'number'],
            [['px', 'qh'], 'required', 'when' => function($model){
                return $model->tinh == 'HCM';
            }],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gid' => 'Gid',
            'loaidieutra' => 'Điều tra',
            'loaicabenh' => 'Ca bệnh',
            'ma_icd' => 'Mã ICD',
            'maphuong' => 'Phường',
            'maquan' => 'Quận',
            'hoten' => 'Họ tên',
            'tuoi' => 'Tuổi',
            'phai' => 'Phái',
            'benhvien' => 'Bệnh viện',
            'ngaybaocao' => 'Ngày báo cáo',
            'ngaynhanthongbao' => 'Ngày nhận thông báo',
            'ngaymacbenh' => 'Ngày mắc bệnh',
            'ngaynhapvien' => 'Ngày nhập viện',
            'ngayxuatvien' => 'Ngày xuất viện',
            'nghenghiep' => 'Nghề nghiệp',
            'shs' => 'Số hồ sơ (SHS)',
            'vitri' => 'Vị trí',
            'me' => 'Mẹ',
            'dienthoai' => 'Điện thoại',
            'geom' => 'Geom',
            'nam_nv' => 'Năm nhập viện',
            'thang_nv' => 'Tháng nhập viện',
            'tuan_nv' => 'Tuần nhập viện',
            'nam_bc' => 'Năm báo cáo',
            'thang_bc' => 'Tháng báo cáo',
            'tuan_bc' => 'Tuần báo cáo',
            'sonha' => 'Số nhà',
            'duong' => 'Đường',
            'to_dp' => 'Tổ',
            'khupho' => 'Khu phố',
            'px' => 'Phường',
            'qh' => 'Quận',
            'ht_dieutri' => 'Hình thức điều trị',
            'loaixacminh_cb' => 'Xác minh địa chỉ',
            'chuandoan' => 'Chuẩn đoán',
            'loaibaocao' => 'Loại báo cáo',
            'chuandoan_bd' => 'Bệnh ',
            'ngaysinh' => 'Ngày sinh ',
            'ngaymacbenh_nv' => 'Ngày mắc bệnh',
            'lat' => 'Lat',
            'lng' => 'Long'
        ];
    }

    public function getHcPhuong()
    {
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'maphuong']);
    }

    public function getHcQuan()
    {
        return $this->hasOne(HcQuan::className(), ['maquan' => 'maquan']);
    }

    public function getDieutraSxh()
    {
        return $this->hasOne(DieutraSxh::className(), ['cabenh_id' => 'gid']);
    }

    public function getChuyenCas()
    {
        return $this->hasMany(Chuyenca::className(), ['cabenh_id' => 'gid'])->orderBy('id');
    }

    public function getXacminhCbs(){
        return $this->hasMany(XacminhCb::className(), ['cabenh_id' => 'gid'])->orderBy('id');
    }

    public function getCungnhas(){
        return $this->hasMany(CabenhSxh::className(), ['gid' => 'n_cabenh_id'])->viaTable('cungnha', ['cabenh_id' => 'gid']);
    }

    public static function getPopupInfo($id){
        $model = self::find()->andWhere(['gid' => $id])->one();
        $dm_chuandoan = api('dm_chuandoan');

        return ArrayHelper::toArray($model, [
            self::className() => [
                'gid',
                'hoten',
                'diachi' => function ($model) {
                    $lastXm = array_last($model->xacminhCbs);
                    if(!$lastXm) return '';
                    $diachi = collect([$lastXm->sonha, $lastXm->duong])->filter()->implode(' ');
                    $qh_px = collect([data_get($model, 'hcPhuong.tenphuong'), data_get($model, 'hcQuan.tenquan')])->filter()->implode(' - ');
                    return collect([$diachi, $qh_px])->filter()->implode(' - ');
                },
                'khupho_to'     => function ($model) {
                    return collect([$model->khupho, $model->to_dp])->filter()->implode(' - ');
                },
                'chuandoan' => function ($model) use ($dm_chuandoan) {
                    if ($model->chuandoan == 3) return $model->chuandoan_khac;
                    return opt($dm_chuandoan)->{$model->chuandoan};
                },
                'ngaymacbenh_nv' => function($m){
                    return $m->ngaymacbenh ? $m->ngaymacbenh : $m->ngaynhapvien;
                },
                'ngaymacbenh',
                'ngayxuatvien',
                'ngaynhapvien',
                'ngaybaocao',
                'geometry' => function($model){
                    return $model->toGeometry();
                },
            ]
        ]);
    }
}

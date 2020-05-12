<?php

namespace pcd\models;

use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "xn_huyetthanh".
 *
 * @property int $id
 * @property string $maso
 * @property string $hoten
 * @property string $ngaynhanmau
 * @property string $phai
 * @property string $namsinh
 * @property string $diachi
 * @property string $donvi_gui
 * @property string $duan
 * @property string $yeucau_xn
 * @property string $ketqua
 * @property string $ketluan
 */
class XnHuyetthanh extends MyModel
{
    protected $dates = ['ngaynhanmau', 'ngaykhoibenh', 'ngaylay_bp', 'ngaynhan_bp'];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xn_huyetthanh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['ngaynhanmau'], 'date', 'format' => 'DD/MM/YYYY'],
            [['ngaynhanmau', 'ngaykhoibenh', 'ngaylay_bp', 'ngaynhan_bp'], 'safe'],
            [['maso', 'namsinh', 'maquan', 'maphuong', ], 'safe'],
            [['hoten', 'phai',  'diachi', 'donvi_gui', 'duan', 'yeucau_xn', 'ketqua', 'ketluan', 'phantip_virut'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'maquan' => 'Quận',
            'maso' => 'Mã số',
            'hoten' => 'Họ tên',
            'ngaynhanmau' => 'Ngày nhận mẫu',
            'phai' => 'Phái',
            'namsinh' => 'Năm sinh',
            'diachi' => 'Địa chỉ',
            'donvi_gui' => 'Đơn vị gửi',
            'duan' => 'Dự án',
            'yeucau_xn' => 'Yêu cầu XN',
            'ketqua' => 'Kết quả',
            'ketluan' => 'Kết luận',
        ];
    }

    public function getQuan(){
        return $this->hasOne(HcQuan::className(), ['maquan' => 'maquan']);
    }
}

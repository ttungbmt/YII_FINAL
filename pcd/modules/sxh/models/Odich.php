<?php
namespace pcd\modules\sxh\models;

use Illuminate\Support\Arr;
use maybeworks\minify\MinifyHelper;
use pcd\models\App;
use pcd\models\CabenhSxh;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use pcd\models\OdichSxhPoly;

/**
 * This is the model class for table "odich_sxh".
 *
 * @property int $id #
 * @property int|null $loai_od
 * @property string|null $ngayxacdinh
 * @property string|null $ngayphathien
 * @property string|null $ngaydukien_kt
 * @property string|null $ngayketthuc
 * @property string|null $ngaybatdau_gs
 * @property string|null $hdtt_hinhthuc
 * @property string|null $hdtt_thoigian
 * @property string|null $hdtt_diadiem

 * @property string|null $ngaydukienkt
 * @property string|null $ngaykt
 * @property bool|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property float|null $dientichdk
 * @property string|null $maphuong
 * @property string|null $maquan
 * @property int|null $loaiodich
 * @property int|null $BI_bandau
 * @property int|null $CI_bandau
 * @property int|null $HI_bandau
 * @property int|null $is_nghingo
 * @property string|null $c_geom
 * @property string|null $donvi_xp
 * @property string|null $hinhthuc_tt
 * @property string|null $diadiem
 * @property string|null $thoigian
 * @property string|null $odich_kt
 * @property string|null $ngayketthuc_td
 * @property int|null $sonocgia
 * @property int|null $dncs_count
 */

class Odich extends App
{
    public $diet_lqs;
    public $khaosat_cts;
    public $phun_hcs;

    protected $timestamps = true;

    protected $dates = ['ngayxacdinh', 'ngayphathien', 'ngaydukien_kt', 'ngayketthuc', 'ngaybatdau_gs', 'ngayketthuc_td'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'odich_sxh';
    }

    public static function primaryKey()
    {
        return ['id'];
    }


    public function rules()
    {
        return [
            [['ngayxacdinh', 'ngayphathien', 'ngaydukien_kt', 'ngayketthuc', 'ngaybatdau_gs', 'ngayketthuc_td'], 'date', 'format' => 'php:d/m/Y'],
            [['donvi_xp', 'hdtt_hinhthuc', 'hdtt_thoigian', 'hdtt_diadiem', 'danhgia', 'nguoithuchien', 'dienthoai', 'dncs_count', 'nhandinh_gs'], 'safe'],
            [['loai_od', 'sonocgia'], 'integer'],
            [['khaosat_cts', 'diet_lqs', 'phun_hcs'], 'required'],
            [['maquan', 'maphuong', 'loai_od', 'ngayxacdinh', 'ngayphathien', 'ngaydukien_kt', 'sonocgia', 'ngaybatdau_gs', 'nguoithuchien'], 'required'],
            [['ngayxacdinh', 'ngayphathien', 'ngaybatdau_gs'], 'dateCompare', 'compareValue' => date('d/m/Y'), 'format' => 'd/m/Y', 'operator' => '<='],
        ];
    }

    public function formName()
    {
        return '';
    }

    public function attributeLabels()
    {
        return [
            'ngayxacdinh' => 'Ngày xác định',
            'ngayphathien' => 'Ngày phát hiện',
            'ngaydukien_kt' => 'Ngày dự kiến kết thúc',
            'ngaybatdau_gs' => 'Ngày bắt đầu giám sát',
            'nguoithuchien' => 'Người thực hiện',
            'diet_lqs' => 'Diệt lăng quăng',
            'khaosat_cts' => 'Khảo sát côn trùng',
            'phun_hcs' => 'Phun hóa chất',
        ];
    }

    public function getCabenhs()
    {
        return $this->hasMany(CabenhSxh::className(), ['gid' => 'resource_id'])
            ->viaTable('odich_sxh_poly', ['odich_id' => 'id'])
            ->andWhere(['resource_type' => 'sxh'])
            ->innerJoin(['pl' => 'odich_sxh_poly'], 'gid = resource_id')
            ->orderBy(['order' => SORT_ASC]);
    }

    public function saveModel(){
        $data = collect(request()->all());
        $this->load($data->only(['diet_lqs', 'khaosat_cts', 'phun_hcs'])->all(), '');
        if(!$this->validate()) return false;

        $this->save();

        $toPoly = function ($data, $type, $key){
            return collect($data)->map(function ($i, $k) use($type, $key){
                return [
                    'id' =>  $i['poly_id'],
                    'order' => $k+1,
                    'resource_type' => $type,
                    'resource_id' => $i[$key]
                ];
            })->all();
        };

        $cabenhs = $toPoly($data->get('cabenhs'), 'sxh', 'gid');
        $phunHcs = collect($data->get('phun_hcs'))->map(function ($i){
            if(is_array($i['loai_hc'])) $i['loai_hc'] = collect($i['loai_hc'])->filter()->implode(', ');
            return $i;
        });

        $this->linkMany('sxhPolys', $cabenhs);
        $this->linkMany('dietLqs', $data->get('diet_lqs'));
        $this->linkMany('phunHcs', $phunHcs);

        $xuly = $data->only(['xuly_id', 'phamvi_gis', 'phamvi_px', 'phamvi_px_html', 'khaosat_cts', 'dncs']);

        if(isset($xuly['phamvi_gis'])) $xuly['phamvi_gis'] = MinifyHelper::html($xuly['phamvi_gis']);
        if(isset($xuly['dncs'])) $xuly['dncs'] = Arr::pluck($xuly['dncs'], 'id');

        $this->linkOne('xuly', $xuly, ['xuly_id' => 'id']);

        return true;
    }

    public function getXuly(){
        return $this->hasOne(OdichSxhXuly::class, ['odich_id' => 'id']);
    }

    public function getQuan(){
        return $this->hasOne(HcQuan::className(), ['maquan' => 'maquan']);
    }

    public function getPhuong(){
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'maphuong']);
    }

    public function getDietLqs(){
        return $this->hasMany(DietLq::className(), ['odich_id' => 'id']);
    }

    public function getPhunHcs(){
        return $this->hasMany(PhunHc::className(), ['odich_id' => 'id']);
    }

    public function getSxhPolys(){
        return $this->hasMany(OdichSxhPoly::className(), ['odich_id' => 'id'])->andWhere(['resource_type' => 'sxh']);
    }

//    public function getDncPolys(){
//        return $this->hasMany(OdichSxhPoly::className(), ['odich_id' => 'id'])->andWhere(['resource_type' => 'dnc']);
//    }


}
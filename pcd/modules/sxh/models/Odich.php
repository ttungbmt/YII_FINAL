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
            [['donvi_xp', 'hdtt_hinhthuc', 'hdtt_thoigian', 'hdtt_diadiem', 'danhgia', 'nguoithuchien', 'dienthoai',], 'safe'],
            [['loai_od', 'sonocgia', 'dncs_count'], 'integer'],
        ];
    }

    public function formName()
    {
        return '';
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

        if(role('phuong')){
            $this->maphuong = $this->maphuong ? $this->maphuong : userInfo()->maphuong;
            $this->maquan = $this->maquan ? $this->maquan : userInfo()->maquan;
        }

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
//        $dncs = $toPoly($data->get('dncs'), 'dnc', 'id');

        $this->linkMany('sxhPolys', $cabenhs);
//        $this->linkMany('dncPolys', $dncs);

        $this->linkMany('dietLqs', $data->get('diet_lqs'));
        $this->linkMany('phunHcs', $data->get('phun_hcs'));

        $xuly = $data->only(['xuly_id', 'phamvi_gis', 'phamvi_px', 'phamvi_px_html', 'khaosat_cts', 'dncs']);

        if(isset($xuly['phamvi_gis'])) $xuly['phamvi_gis'] = MinifyHelper::html($xuly['phamvi_gis']);
        if(isset($xuly['dncs'])) $xuly['dncs'] = Arr::pluck($xuly['dncs'], 'id');

        $this->linkOne('xuly', $xuly, ['xuly_id' => 'id']);
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
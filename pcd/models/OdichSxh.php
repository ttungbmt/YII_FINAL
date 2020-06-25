<?php
namespace pcd\models;

use nanson\postgis\behaviors\GeometryBehavior;
use pcd\modules\sxh\models\PhunHc;
use Yii;

/**
 * This is the model class for table "odichsxh".
 *
 * @property integer $id
 * @property string  $ngayphathien
 * @property string  $ngaydukienkt
 * @property string  $ngaykt
 */
class OdichSxh extends App
{
    public $tmp;
    public $phamvi_to;
    public $phamvi_khupho;

    protected $dates = ['ngayphathien', 'ngaydukien_kt', 'ngaykt', 'ngayxacdinh'];

    public $geometryType = GeometryBehavior::GEOMETRY_MULTIPOLYGON;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'odich_sxh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngayphathien', 'ngaydukienkt', 'ngaykt', 'ngayxacdinh'], 'date', 'format' => 'php:d/m/Y'],
            [['dientichdk', 'status', 'c_geom'], 'safe'],
            [['loaiodich', 'HI_bandau', 'CI_bandau', 'BI_bandau', 'is_nghingo'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('app', '#'),
            'ngayphathien' => Yii::t('app', 'Ngày phát hiện ổ dịch'),
            'ngaydukienkt' => Yii::t('app', 'Ngày dự kiến kết thúc'),
            'ngaykt'       => Yii::t('app', 'Ngày kết thúc'),
            'loaiodich'    => Yii::t('app', 'Loại ổ dịch'),
            'ngayxacdinh'  => Yii::t('app', 'Ngày xác định'),
            'BI_bandau'    => Yii::t('app', 'BI_Ban đầu'),
            'CI_bandau'    => Yii::t('app', 'CI_Ban đầu'),
            'HI_bandau'    => Yii::t('app', 'HI_Ban đầu'),

            'phamvi_to' => 'Khu phố, ấp',
            'phamvi_khupho' => 'Tổ dân phố',
        ];
    }

    public function getXulyOdsxhs()
    {
        return $this->hasMany(XulyOdsxh::className(), ['odichsxh_id' => 'id']);
    }

    public function getKehoachXulyOdsxh()
    {
        return $this->hasOne(KehoachXulyOdsxh::className(), ['odich_id' => 'id']);
    }

    public function getPhunHcs(){
        return $this->hasMany(PhunHc::className(), ['odich_id' => 'id']);
    }

    public function saveGeometry($odich_id){

    }

//    public function getV_cabenhs()
//    {
//        return $this->hasMany(VCabenh1::className(), ['odichsxh_id' => 'id']);
//    }
//
    public function saveOdich($request)
    {
        $cabenh = $request->post('cabenhSxh');
        $xuly_odsxh = $request->post('XulyOdsxh');
        $arrRemove = $request->post('arrRemove') ? $request->post('arrRemove') : [];

        /**
         * Get geom of odich
         */
        $geomArr = array_diff(array_keys($cabenh), $arrRemove);

        $geom = Yii::$app->db->CreateCommand("
                SELECT st_asgeojson(st_union(st_buffer(cb.geom::geography , 200)::geometry)) as geom
                FROM cabenh_sxh cb
                WHERE gid IN (" . implode(', ', $geomArr) . ")")->queryColumn();

        if(count($cabenh) - count($arrRemove) < 2) {
            return false;
        }

        if($this->isNewRecord) {
            if($this->is_nghingo == 0){
                $this->maphuong = userInfo()->ma_phuong;
                $this->maquan = userInfo()->ma_quan;
            }
            $this->status = 1;
        }

        $this->c_geom = json_decode($geom[0], true);

        $this->save();

        OdichSxhPoly::deleteAll(['odich_id' => $this->id]);
        $stt = 1;
        foreach ($cabenh as $k => $val) {
            if (!in_array($val['gid'], array_keys($arrRemove))) {
                $cb = CabenhSxh::findOne($val['gid']);
                $pl = new OdichSxhPoly([
                    'odich_id' => $this->id,
                    'cabenh_id' => $cb->gid,
                    'order' => $stt++,
                    'resource_type' => 'sxh',
                    'resource_id' => $cb->gid
                ]);
                $pl->save();
            }
        }

        if (count($xuly_odsxh) > 0) {
            foreach ($xuly_odsxh as $k => $val) {
                if(!$this->isEmptyXulyOdich($val)) {
                    $xuly = XulyOdsxh::findOne($k) ?: new XulyOdsxh();
                    $xuly->attributes = $val;
                    $xuly->link('odichSxh', $this);
                }
            }
        }

        // Lưu kehoachxuly
        $khXulyOdsxh = KehoachXulyOdsxh::findOne(['odich_id' => $this->id]);
        $khXulyOdsxh = $khXulyOdsxh ? $khXulyOdsxh : new KehoachXulyOdsxh();
        $khXulyOdsxh->load($request->post());
        $khXulyOdsxh->save();

        return true;
    }

    public function getCabenhs()
    {
        return $this->hasMany(CabenhSxh::className(), ['gid' => 'resource_id'])
            ->viaTable('odich_sxh_poly', ['odich_id' => 'id'])
            ->andWhere(['resource_type' => 'sxh'])
            ->innerJoin(['pl' => 'odich_sxh_poly'], 'gid = resource_id')
            ->orderBy(['order' => SORT_ASC])
            ;

    }

    public function getOdichSxhPoly(){
        return $this->hasMany(OdichSxhPoly::className(), ['odich_id' => 'id']);
    }

    public function isEmptyXulyOdich($xuLyODich) {
        $temp = $xuLyODich;
        unset($temp['lanxl']);
        return array_filter($temp) ? false : true;
    }

    public function getQuan(){
        return $this->hasOne(HcQuan::className(), ['maquan' => 'maquan']);
    }

    public function getPhuong(){
        return $this->hasOne(HcPhuong::className(), ['maphuong' => 'maphuong']);
    }

    public function getQuanTxt(){
        return $this->quan->tenquan;
    }

    public function getPhuongTxt(){
        return $this->phuong->tenphuong;
    }

    public function getDiachiTxt(){
        $items = collect([
            $this->phuongTxt,
            $this->quanTxt,
        ]);
        return $items->implode(' - ');
    }
}

<?php
namespace pcd\modules\sxh\models;

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
            [['loai_od'], 'integer'],
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
            ->orderBy(['order' => SORT_ASC])
            ;
    }

    public function saveModel(){
        $data = request()->all();

        if(role('phuong')){
            $this->maphuong = $this->maphuong ? $this->maphuong : userInfo()->maphuong;
            $this->maquan = $this->maquan ? $this->maquan : userInfo()->maquan;
        }

        $this->save();

        $this->linkCabenhs(request()->post('cabenhs'));

        $xuly = $this->xuly ? $this->xuly : new OdichSxhXuly();
        if(isset($data['phamvi'])){
            $data['phamvi'] = MinifyHelper::html($data['phamvi']);
        }
        $xuly->setAttributes($data);
        $this->link('xuly', $xuly);

    }

    protected function linkCabenhs($cabenhs){
        OdichSxhPoly::deleteAll(['odich_id' => $this->id]);
        $stt = 1;
        foreach ($cabenhs as $k => $val) {
            $cb = CabenhSxh::findOne($val['gid']);
            $pl = new OdichSxhPoly([
                'odich_id' => $this->id,
                'order' => $stt++,
                'resource_type' => 'sxh',
                'resource_id' => $cb->gid
            ]);
            $pl->save();
        }
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

}
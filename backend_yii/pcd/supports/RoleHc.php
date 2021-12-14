<?php
namespace pcd\supports;

use kartik\helpers\Html;
use pcd\models\Chuyenca;
use pcd\models\HcPhuong;
use pcd\models\HcQuan;
use Yii;
use yii\base\BaseObject;
use yii\db\Expression;

class RoleHc
{
    public static function init()
    {
        $userId = user()->id;
        $info = userInfo();
        $roles = collect(getRoles());
        $data = [];

        if ($roles->contains('phuong')) {
            return Yii::createObject(['class' => PhuongAction::className(), 'maquan' => $info->ma_quan, 'maphuong' => $info->ma_phuong, 'qh' => (string)$info->ma_quan, 'px' => (string)$info->ma_phuong]);
        } elseif ($roles->contains('quan')) {
            return Yii::createObject(['class' => QuanAction::className(), 'maquan' => $info->ma_quan, 'qh' => (string)$info->ma_quan]);
        } else {
            return Yii::createObject(['class' => TpAction::className(), 'data' => $data]);
        }
    }
}
class TpAction extends BaseObject{
    public $data;
    public $maquan;
    public $maphuong;
    public $qh;
    public $px;

    public function initFormHc(&$obj, $keys = []){
        return $obj;
    }

    public function filterMahc(&$query, $field = ''){
        return $query;
    }

    public function filterCabenh(&$query){
        return $query;
    }

    public function filterCabenhSxh(&$query){
        $maquans = data_get($this->data, 'maquans');
        if($maquans){
            return $query->andFilterWhere(['maquan' => (string)$maquans]);
        }
        return $query;
    }

    public function filterHc(&$query){
        return $query;
    }

    public function getHc(){
        return [];
    }

    public function getGapranhCQL($cql = '', $hc = ''){
        return $cql ? "({$cql})" : '1=1';
    }

    public function showBtnSave($xm){
        return true;
    }

    public function btnChuyenCa(){
        return (
            Html::a('Tất cả', ['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 0]], ['class' => 'btn btn-'.Helper::statusClassCc(0).' btn-raised']) .
            Html::a('Ca TP', ['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 1]], ['class' => 'btn btn-'.Helper::statusClassCc(1).' btn-raised']) .
            Html::a('Ca chuyển', ['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 2]], ['class' => 'btn btn-'.Helper::statusClassCc(2).' btn-raised'])
        );
    }

    public function filterChuyenca($loaica, &$query, $key = 'gid'){
        $ca = Chuyenca::find()
            ->select(new Expression('DISTINCT cabenh_id'));

        if ($loaica == 2) {
            $query->andFilterWhere(['<>', 'tinh', 'HCM']);
        } elseif ($loaica == 1) {
            $query->andFilterWhere(['=', 'tinh', 'HCM']);
        } else {
            $this->filterCabenhSxh($query);
        }
    }

    public function getDmQp(){
        $dsQuan = HcPhuong::find()->select('DISTINCT(tenquan_en)')->asArray()->column();
        $dsPhuong = HcPhuong::find()->select('DISTINCT(tenphuong_en)')->asArray()->column();

        return [
            'quan' => $dsQuan,
            'phuong' =>$dsPhuong
        ];
    }
}

class QuanAction extends TpAction
{
    public function initFormHc(&$obj, $keys = ['maquan']){
        if(!$obj->{$keys[0]}) $obj->{$keys[0]} = (string)$this->maquan;

        return $obj;
    }

    public function filterMahc(&$query, $field = 'maquan'){
        return $query->andFilterWhere([$field => (string)$this->{$field}]);
    }

    public function filterCabenh(&$query, $type = null){
        return $query->andFilterWhere([($type ? 'ma_quan' : 'maquan') => (string)$this->maquan]);
    }

    public function filterCabenhSxh(&$query){
        return $query->andFilterWhere(['maquan' => (string)$this->maquan]);
    }

    public function filterHc(&$query){
        return $query->andFilterWhere(['maquan' => (string)$this->maquan]);
    }

    public function getHc(){
        return HcQuan::findOne(['maquan' => $this->maquan])->toArray([], ['geometry']);
    }

    public function getGapranhCQL($cql = '', $hc = ''){
        $q = collect(HcQuan::findOne(['maquan' => $this->maquan])->giapranh->toArray()['items'])
            ->push((string)$this->maquan)
            ->map(function ($v) {return "'{$v}'";})
            ->implode(',');
        $str = "(maquan IN ({$q}))";
        if($cql) {$str .= " AND ({$cql})";}
        return $str;
    }

    public function showBtnSave($model){
        return data_get($model, 'qh') == $this->maquan;
    }

    public function btnChuyenCa(){
        return (
            Html::a('Tất cả', ['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 0]], ['class' => 'btn btn-'.Helper::statusClassCc(0).' btn-raised']) .
            Html::a('Ca QH', ['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 1]], ['class' => 'btn btn-'.Helper::statusClassCc(1).' btn-raised']) .
            Html::a('Ca chuyển', ['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 2]], ['class' => 'btn btn-'.Helper::statusClassCc(2).' btn-raised']) .
            Html::a('Ca nhận', ['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 3]], ['class' => 'btn btn-'.Helper::statusClassCc(3).' btn-raised']).
            Html::a('Ca trả về', ['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 4]], ['class' => 'btn btn-'.Helper::statusClassCc(4).' btn-raised'])
        );
    }

    public function filterChuyenca($loaica, &$query, $key = 'gid'){
        $ca = Chuyenca::find()
            ->select(new Expression('DISTINCT cabenh_id'));


        if ($loaica == 2) {
            // Ca chuyển
            $ca = $ca->where(['is_chuyentiep' => 1, 'qh_chuyen' => (string)$this->maphuong]);
            $query->andFilterWhere(['gid' => $ca]);
        } elseif ($loaica == 3) {
            // Ca nhận
            $ca = $ca->where(['is_chuyentiep' => 1, 'qh_nhan' => (string)$this->maphuong]);
            $query->andFilterWhere(['gid' => $ca]);
        } elseif ($loaica == 4) {
            // Ca trả về
            $ca = $ca->where(['is_chuyentiep' => 0, 'qh_nhan' => $this->maphuong]);
            $query->andFilterWhere(['gid' => $ca]);
        } elseif ($loaica == 1) {
            // Ca TP
            $ca = $ca->where(['qh_nhan' => $this->maphuong]);
            $this->filterCabenhSxh($query);
            $query->andFilterWhere(['NOT IN', 'gid', $ca]);
        } else {
            $this->filterCabenhSxh($query);
        }
    }

    public function getDmQp(){
        $dsQuan = HcPhuong::find()->select('DISTINCT(tenquan_en)')->where(['maquan' => $this->maquan])->asArray()->column();
        $dsPhuong = HcPhuong::find()->select('DISTINCT(tenphuong_en)')->where(['maquan' => $this->maquan])->asArray()->column();

        return [
            'quan' => $dsQuan,
            'phuong' =>$dsPhuong
        ];
    }
}

class PhuongAction extends QuanAction
{
    public function initFormHc(&$obj, $keys = ['maquan', 'maphuong']){
        if(!$obj->{$keys[1]}) {
            $obj->{$keys[0]} = (string)$this->maquan;
            $obj->{$keys[1]} = (string)$this->maphuong;
        }

        return $obj;
    }

    public function filterMahc(&$query, $field = 'maphuong'){
        return $query->andFilterWhere([$field => (string)$this->{$field}]);
    }

    public function filterCabenh(&$query, $type = null){
        return $query->andFilterWhere([($type ? 'ma_phuong' : 'maphuong') => (string)$this->maphuong]);
    }

    public function filterCabenhSxh(&$query){
        return $query->andFilterWhere(['maphuong' => (string)$this->maphuong]);
    }

    public function filterHc(&$query){
        return $query->andFilterWhere(['maphuong' => (string)$this->maphuong]);
    }

    public function getHc(){
        return HcPhuong::findOne(['maphuong' => $this->maphuong])->toArray([], ['geometry']);
    }

    public function getGapranhCQL($cql = '', $hc = ''){
        if($hc == 'quan'){
            $str = parent::getGapranhCQL();
        } else {
            $q = collect(HcPhuong::findOne(['maphuong' => $this->maphuong])->giapranh->toArray()['items'])->push((string)$this->maphuong)
                ->map(function ($v) {return "'{$v}'";})
                ->implode(',');
            $str = "(maphuong IN ({$q}))";
        }

        if($cql) {$str .= " AND ({$cql})";}
        return $str;
    }

    public function showBtnSave($model){
        return data_get($model, 'px') == $this->maphuong;
    }

    public function btnChuyenCa(){
        return (
            Html::a('Tất cả', ['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 0]], ['class' => 'btn btn-'.Helper::statusClassCc(0).' btn-raised']) .
            Html::a('Ca PX', ['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 1]], ['class' => 'btn btn-'.Helper::statusClassCc(1).' btn-raised']) .
            Html::a('Ca chuyển', ['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 2]], ['class' => 'btn btn-'.Helper::statusClassCc(2).' btn-raised']) .
            Html::a('Ca nhận', ['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 3]], ['class' => 'btn btn-'.Helper::statusClassCc(3).' btn-raised']).
            Html::a('Ca trả về', ['/admin/cabenh-sxh', 'CabenhSxhSearch' => ['loaica' => 4]], ['class' => 'btn btn-'.Helper::statusClassCc(4).' btn-raised'])
        );
    }

    public function filterChuyenca($loaica, &$query, $key = 'gid'){
        $ca = Chuyenca::find()
            ->select(new Expression('DISTINCT cabenh_id'))
        ;

        if ($loaica == 2) {
            // Ca chuyển
            $ca = $ca->where(['is_chuyentiep' => 1, 'px_chuyen' => (string)$this->maphuong]);
            $query->andFilterWhere(['gid' => $ca]);
        } elseif ($loaica == 3) {
            // Ca nhận
            $ca = $ca->where(['is_chuyentiep' => 1, 'px_nhan' => (string)$this->maphuong]);
            $query->andFilterWhere(['gid' => $ca]);
        } elseif ($loaica == 4) {
            // Ca trả về
            $ca = $ca->where(['is_chuyentiep' => 0, 'px_nhan' => $this->maphuong]);
            $query->andFilterWhere(['gid' => $ca]);
        } elseif ($loaica == 1) {
            // Ca TP
            $ca = $ca->where(['px_nhan' => $this->maphuong]);
            $this->filterCabenhSxh($query);
            $query->andFilterWhere(['NOT IN', 'gid', $ca]);
        } else {
            $this->filterCabenhSxh($query);
        }
    }

    public function getDmQp(){
        $dsQuan = HcPhuong::find()->select('DISTINCT(tenquan_en)')->where(['maphuong' => $this->maphuong])->asArray()->column();
        $dsPhuong = HcPhuong::find()->select('DISTINCT(tenphuong_en)')->where(['maphuong' => $this->maphuong])->asArray()->column();

        return [
            'quan' => $dsQuan,
            'phuong' =>$dsPhuong
        ];
    }
}


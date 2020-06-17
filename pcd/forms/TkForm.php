<?php
/**
 * Created by PhpStorm.
 * User: THANHTUNG
 * Date: 3/28/2016
 * Time: 1:37 PM
 */

namespace pcd\forms;

use common\models\MyModel;
use pcd\models\CabenhSxh;
use pcd\models\HcPhuong;
use Yii;
use yii\db\Expression;
use yii\db\Query;


class TkForm extends MyModel
{
    public $tinh;
    public $ma_quan;
    public $ma_phuong;
    public $loaitk;
    public $chuandoan;
    public $date_cat;
    public $date_from;
    public $date_to;

    public $captk;

    public $dataTK;
    protected $role;

    public function init()
    {
        parent::init();
    }

    public function rules(){
        $roles = array_keys(auth()->getRolesByUser(null));
        return [
            [['captk', 'date_cat'], 'safe'],
            [['date_from', 'date_to'], 'date'],
            [['tinh', 'ma_quan', 'loaitk', 'chuandoan', 'date_to'], 'required'],
//            [['date_to'], 'compare', 'compareAttribute' => 'date_from', 'operator' => '>='],
//            [['date_from'], 'compare', 'compareAttribute' => 'date_to', 'operator' => '<='],
             [['ma_phuong'], 'required', 'when' => function() use($roles){
                return in_array('phuong', $roles);
             }
            ]
        ];
    }

    public function attributeLabels(){
        return [
            'tinh' => 'Tỉnh',
            'ma_quan' => 'Quận huyện',
            'ma_phuong' => 'Phường xã',
            'loaitk' => 'Loại thống kê',
            'chuandoan' => 'Chẩn đoán',
            'date_from' => 'Từ ngày',
            'date_to' => 'Đến ngày',
            'date_cat' => 'Thời gian',
        ];
    }

    public function xulyTK(){
        $query = new Query();
        // 2. Ngày nhập viện -> ngày mắc bệnh
        $where[] = $this->date_from ? "public.v_phieusxh.ngbaocao >= '".$this->date_from."'" : "";
        $where[]= $this->date_to ? "public.v_phieusxh.ngbaocao <= '".$this->date_to."'" : $where;
        $where = count(array_filter($where)) == 2 ? implode(" AND ", $where): implode("", $where);
        $where = "AND ".$where;

        $query = (new Query())->select([
            'qh1' => 'cb.qh',
            'px1' => 'cb.px',
            'ten_qh' => 'px.tenquan',
            'ten_px' => 'px.tenphuong',
            'kdc_qhk' => new Expression("SUM(CASE WHEN cb.loai_xm_cb = 1 THEN 1 ELSE 0 END)"),
            'kdc_pxk' => new Expression("SUM(CASE WHEN cb.loai_xm_cb = 2 THEN 1 ELSE 0 END)"),
            'kdc_tk' => new Expression("SUM(CASE WHEN cb.loai_xm_cb = 3 THEN 1 ELSE 0 END)"),
            'cdc_kbn_qhk' => new Expression("SUM(CASE WHEN cb.loai_xm_cb = 4 THEN 1 ELSE 0 END)"),
            'cdc_kbn_pxk' => new Expression("SUM(CASE WHEN cb.loai_xm_cb = 5 THEN 1 ELSE 0 END)"),
            'cdc_kbn_tk' => new Expression("SUM(CASE WHEN cb.loai_xm_cb = 6 THEN 1 ELSE 0 END)"),
            'cdc_cbn_khac' => new Expression("SUM(CASE WHEN cb.chuandoan = '3' THEN 1 ELSE 0 END)"),
            'cdc_cbn_ssv' => new Expression("SUM(CASE WHEN cb.chuandoan = '2' THEN 1 ELSE 0 END)"),
            'cdc_cbn_sxh' => new Expression("SUM(CASE WHEN cb.chuandoan = '1' THEN 1 ELSE 0 END)"),
        ])
            ->from(['cb' => CabenhSxh::tableName()])
            ->leftJoin(['px' => HcPhuong::tableName()], 'px.maphuong = cb.px')
            ->groupBy(new Expression('cb.qh, cb.px, px.tenquan, px.tenphuong'))
        ;

        $sortKey = 'ten_qh';

        if($this->ma_quan){
            $sortKey = 'ten_px';
            $this->dataTK['cap'] = 'quan';
            $query->andFilterWhere(['cb.qh' => $this->ma_quan]);
        }

        if($this->ma_phuong){
            $sortKey = 'khupho1';
            $this->dataTK['cap'] = 'phuong';
            $query->andFilterWhere(['cb.px' => $this->ma_phuong]);
            $query->addSelect(['khupho1' => 'cb.khupho'])->addGroupBy(new Expression('cb.khupho'));
        }

        $date_field = $this->date_cat ? $this->date_cat : new Expression("COALESCE(cb.ngaymacbenh, cb.ngaynhapvien)");

        if($this->date_to){
            $query->andFilterWhere(['<=', $date_field , $this->date_to]);
        }

        if($this->date_from){
            $query->andFilterWhere(['>=', $date_field, $this->date_from]);
        }


        $this->dataTK['tk_kpa'] = $query->all();
        $this->dataTK['tk_kpa'] = collect($this->dataTK['tk_kpa'])->sortBy($sortKey, SORT_NATURAL)->values()->all();
    }
}
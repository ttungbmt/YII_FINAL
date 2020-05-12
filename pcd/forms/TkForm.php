<?php
/**
 * Created by PhpStorm.
 * User: THANHTUNG
 * Date: 3/28/2016
 * Time: 1:37 PM
 */

namespace pcd\forms;

use common\models\MyModel;
use Yii;


class TkForm extends MyModel
{
    public $tinh;
    public $ma_quan;
    public $ma_phuong;
    public $loaitk;
    public $chuandoan;
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
            [['captk'], 'safe'],
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
        ];
    }

    public function xulyTK(){
        // 2. Ngày nhập viện -> ngày mắc bệnh
        $where[] = $this->date_from ? "public.v_phieusxh.ngbaocao >= '".$this->date_from."'" : "";
        $where[]= $this->date_to ? "public.v_phieusxh.ngbaocao <= '".$this->date_to."'" : $where;
        $where = count(array_filter($where)) == 2 ? implode(" AND ", $where): implode("", $where);
        $where = "AND ".$where;

        if(!$this->ma_phuong){
            $this->dataTK['cap'] = 'quan';
            $this->dataTK['tk_kpa'] = Yii::$app->db->createCommand(
                'SELECT v_dm_quan1.ten_qh, v_dm_phuong1.ten_px, v_tk.* FROM (SELECT MIN (sxh.ngaythongke) AS date_from, MAX (sxh.ngaythongke) AS date_to, sxh.qh1, sxh.px1, SUM (sxh . kdc_pxk):: INTEGER AS kdc_pxk, SUM (sxh . kdc_qhk):: INTEGER AS kdc_qhk, SUM (sxh.kdc_tk) :: INTEGER AS kdc_tk, SUM (sxh . cdc_kbn_pxk):: INTEGER AS cdc_kbn_pxk, SUM (sxh . cdc_kbn_qhk):: INTEGER AS cdc_kbn_qhk, SUM (sxh . cdc_kbn_tk):: INTEGER AS cdc_kbn_tk, SUM (sxh . cdc_cbn_sxh):: INTEGER AS cdc_cbn_sxh, SUM (sxh.cdc_cbn_sot) :: INTEGER AS cdc_cbn_sot, SUM (sxh.cdc_cbn_benhkhac) :: INTEGER AS cdc_cbn_benhkhac FROM(SELECT * FROM public.v_phieusxh WHERE (public.v_phieusxh.xmcabenh = 3 OR public.v_phieusxh.xmcabenh = 2) '.$where.') as sxh GROUP BY sxh.qh1, sxh.px1 ) v_tk LEFT JOIN v_dm_quan1 ON v_tk.qh1 = v_dm_quan1.ma_quan LEFT JOIN v_dm_phuong1 ON v_tk.px1 = v_dm_phuong1.ma_phuong WHERE qh1 = :qh1 ;',
                ['qh1' => $this->ma_quan]
            )->queryAll();

        } elseif ($this->ma_phuong) {
            $this->dataTK['cap'] = 'phuong';
            $this->dataTK['tk_kpa'] = Yii::$app->db->createCommand(
                'SELECT v_dm_quan1.ten_qh, v_dm_phuong1.ten_px, v_tk.* FROM (SELECT MIN (sxh.ngaythongke) AS date_from, MAX (sxh.ngaythongke) AS date_to, sxh.qh1, sxh.px1, sxh.khupho1, SUM (sxh . kdc_pxk):: INTEGER AS kdc_pxk, SUM (sxh . kdc_qhk):: INTEGER AS kdc_qhk, SUM (sxh.kdc_tk) :: INTEGER AS kdc_tk, SUM (sxh . cdc_kbn_pxk):: INTEGER AS cdc_kbn_pxk, SUM (sxh . cdc_kbn_qhk):: INTEGER AS cdc_kbn_qhk, SUM (sxh . cdc_kbn_tk):: INTEGER AS cdc_kbn_tk, SUM (sxh . cdc_cbn_sxh):: INTEGER AS cdc_cbn_sxh, SUM (sxh.cdc_cbn_sot) :: INTEGER AS cdc_cbn_sot, SUM (sxh.cdc_cbn_benhkhac) :: INTEGER AS cdc_cbn_benhkhac FROM(SELECT * FROM "public".v_phieusxh WHERE (public.v_phieusxh.xmcabenh = 3 OR public.v_phieusxh.xmcabenh = 2) '.$where.') as sxh GROUP BY sxh.qh1, sxh.px1, sxh.khupho1 ) v_tk LEFT JOIN v_dm_quan1 ON v_tk.qh1 = v_dm_quan1.ma_quan LEFT JOIN v_dm_phuong1 ON v_tk.px1 = v_dm_phuong1.ma_phuong WHERE qh1 = :qh1 AND px1 = :px1 ORDER BY khupho1',
                ['qh1' => $this->ma_quan, 'px1' => $this->ma_phuong]
            )->queryAll();
        }

    }
}
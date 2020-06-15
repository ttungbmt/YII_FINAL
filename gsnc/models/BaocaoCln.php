<?php
namespace app\models;

use gsnc\models\App;
use gsnc\models\DmQuan;
use Illuminate\Support\Arr;

/**
 * This is the model class for table "baocao_cln".
 *
 * @property int $id
 * @property string $thoigian
 */
class BaocaoCln extends App
{
    public $donvi_cns;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'baocao_cln';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['thoigian', 'donvi_bc', 'data'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'thoigian' => 'Thời gian',
        ];
    }

    public function formName()
    {
        return '';
    }

    public function toSchema(){
        return [
            'fields' => [
                'name' => 'thoigian',
                'label' => 'Báo cáo'
            ]

        ];
    }

    public function getDonviBc(){
        return $this->hasOne(DmQuan::className(), ['maquan' => 'donvi_bc']);
    }

    public function saveModel(){
        $this->data = request()->only([
            'donvi_cns',
            'donvi_thnks',
            'tk_hc_baocao',
            'ho_gd',
            'sokinhphi',
            'kinhphi_nk',
            'thuchien_bc',
            'maunuoc_tn',
            'maunuoc_dqc',
            'kiennghi',
            'chitieu_kd',

            'tk_ho_gd_ccn',
            'ho_gd',
            'kinhphi_nk',
            'thuchien_bc',
            'tk_cs_nk',
            'tk_tong_cs',
            'tk_capnc_nk',
            'tk_tyle_capnc_nk',
            'tk_solan_nk',
            'tk_tyle_ho_gd', 'tk_ho_gd_ccn', 'tk_cs1', 'tk_cs2', 'tk_nhamay', 'tk_tong_dvbc',
            'maunuoc_tn',
            'maunuoc_dqc',
            'tk_tyle_dqc', 'tk_mau_kdqd', 'tk_tylemau_kdqd',
            'kiennghi'
        ]);

        $this->data = array_merge($this->data, [
            'coso_cns' =>        collect(request()->post('coso_cns'))->map(function ($i) {
                return Arr::only($i, array_merge(['ten_cs'], request()->post('chitieu_kd', [])));
            })->all()
        ]);


        return $this->save();
    }
}

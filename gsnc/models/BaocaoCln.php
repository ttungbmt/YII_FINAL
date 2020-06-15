<?php
namespace app\models;

use gsnc\models\App;
use gsnc\models\DmQuan;

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
            'coso_cns',
            'donvi_thnks',
            'ho_gd',
            'sokinhphi',
            'kinhphi_nk',
            'thuchien_bc',
            'maunuoc_tn',
            'maunuoc_dqc',
            'kiennghi',

            'tk_ho_gd_ccn',
            'ho_gd',
            'kinhphi_nk',
            'thuchien_bc',
            'tk_tyle_ho_gd', 'tk_ho_gd_ccn', 'tk_cs1', 'tk_cs2', 'tk_nhamay', 'tk_tong_dvbc',
            'maunuoc_tn',
            'maunuoc_dqc',
            'tk_tyle_dqc', 'tk_mau_kdqd', 'tk_tylemau_kdqd',
            'kiennghi'
        ]);

        return $this->save();
    }
}

<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "kehoach_xuly_odsxh".
 *
 * @property int $id
 * @property int $odich_id
 * @property string $to_dp
 * @property string $kp_ap
 * @property string $dietlq_phamvi
 * @property int $dietlq_nhansu
 * @property string $dnc_ngaybatdau
 * @property string $dnc_dvxuphat
 * @property string $tt_diadiem
 * @property string $tt_hinhthuckhac
 * @property int $phc_soto
 * @property int $phc_sonha
 * @property int $phc_smn
 * @property int $phc_sml
 * @property string $phc_sml_tuyenduong
 * @property int $phc_lit
 * @property string $phc_loaihc
 * @property int $phc_nhansu
 * @property int $phc_nhansu_mangmay
 * @property int $phc_nhansu_danduong
 * @property int $phc_nhansu_giamsat
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $kinhphi
 * @property string $dietlq_dot1
 * @property string $dietlq_dot2
 * @property string $phc_lan1
 * @property string $phc_lan1_ghichu
 * @property string $phc_lan2
 * @property string $phc_lan2_ghichu
 * @property string $ct_lan1
 * @property string $ct_lan2
 * @property string $ct_lan3
 * @property string $dietlq_phuluc
 * @property string $phc_phuluc
 */
class KehoachXulyOdsxh extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kehoach_xuly_odsxh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['odich_id', 'dietlq_nhansu', 'phc_soto', 'phc_sonha', 'phc_smn', 'phc_sml', 'phc_lit', 'phc_nhansu', 'phc_nhansu_mangmay', 'phc_nhansu_danduong', 'phc_nhansu_giamsat', 'created_by', 'kinhphi'], 'default', 'value' => null],
            [['odich_id', 'dietlq_nhansu', 'phc_soto', 'phc_sonha', 'phc_smn', 'phc_sml', 'phc_lit', 'phc_nhansu', 'phc_nhansu_mangmay', 'phc_nhansu_danduong', 'phc_nhansu_giamsat', 'created_by', 'kinhphi'], 'integer'],
            [['dnc_ngaybatdau', 'created_at', 'updated_at', 'dietlq_dot1', 'dietlq_dot2', 'phc_lan1', 'phc_lan2', 'ct_lan1', 'ct_lan2', 'ct_lan3'], 'safe'],
            [['dietlq_phuluc', 'phc_phuluc'], 'string'],
            [['to_dp', 'kp_ap', 'dietlq_phamvi', 'dnc_dvxuphat', 'tt_diadiem', 'tt_hinhthuckhac', 'phc_sml_tuyenduong', 'phc_loaihc', 'phc_lan1_ghichu', 'phc_lan2_ghichu'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'odich_id' => Yii::t('app', 'Odich ID'),
            'to_dp' => Yii::t('app', 'To Dp'),
            'kp_ap' => Yii::t('app', 'Kp Ap'),
            'dietlq_phamvi' => Yii::t('app', 'Dietlq Phamvi'),
            'dietlq_nhansu' => Yii::t('app', 'Dietlq Nhansu'),
            'dnc_ngaybatdau' => Yii::t('app', 'Dnc Ngaybatdau'),
            'dnc_dvxuphat' => Yii::t('app', 'Dnc Dvxuphat'),
            'tt_diadiem' => Yii::t('app', 'Tt Diadiem'),
            'tt_hinhthuckhac' => Yii::t('app', 'Tt Hinhthuckhac'),
            'phc_soto' => Yii::t('app', 'Phc Soto'),
            'phc_sonha' => Yii::t('app', 'Phc Sonha'),
            'phc_smn' => Yii::t('app', 'Phc Smn'),
            'phc_sml' => Yii::t('app', 'Phc Sml'),
            'phc_sml_tuyenduong' => Yii::t('app', 'Phc Sml Tuyenduong'),
            'phc_lit' => Yii::t('app', 'Phc Lit'),
            'phc_loaihc' => Yii::t('app', 'Phc Loaihc'),
            'phc_nhansu' => Yii::t('app', 'Phc Nhansu'),
            'phc_nhansu_mangmay' => Yii::t('app', 'Phc Nhansu Mangmay'),
            'phc_nhansu_danduong' => Yii::t('app', 'Phc Nhansu Danduong'),
            'phc_nhansu_giamsat' => Yii::t('app', 'Phc Nhansu Giamsat'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'kinhphi' => Yii::t('app', 'Kinhphi'),
            'dietlq_dot1' => Yii::t('app', 'Dietlq Dot1'),
            'dietlq_dot2' => Yii::t('app', 'Dietlq Dot2'),
            'phc_lan1' => Yii::t('app', 'Phc Lan1'),
            'phc_lan1_ghichu' => Yii::t('app', 'Phc Lan1 Ghichu'),
            'phc_lan2' => Yii::t('app', 'Phc Lan2'),
            'phc_lan2_ghichu' => Yii::t('app', 'Phc Lan2 Ghichu'),
            'ct_lan1' => Yii::t('app', 'Ct Lan1'),
            'ct_lan2' => Yii::t('app', 'Ct Lan2'),
            'ct_lan3' => Yii::t('app', 'Ct Lan3'),
            'dietlq_phuluc' => Yii::t('app', 'Dietlq Phuluc'),
            'phc_phuluc' => Yii::t('app', 'Phc Phuluc'),
        ];
    }
}

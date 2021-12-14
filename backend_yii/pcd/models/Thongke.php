<?php

namespace pcd\models;

use Yii;

/**
 * This is the model class for table "thongke".
 *
 * @property int $id
 * @property int $cabenh_id
 * @property int $chua_dt
 * @property int $dang_dt
 * @property int $chua_xv
 * @property int $da_dt
 * @property int $ca_tp
 * @property int $canhan
 * @property int $cachuyen
 * @property int $ca_phcd
 * @property int $kdc_pxk
 * @property int $kdc_qhk
 * @property int $kdc_tk
 * @property int $cdc_kbn_pxk
 * @property int $cdc_kbn_qhk
 * @property int $cdc_kbn_tk
 * @property int $cdc_cbn_sxh
 * @property int $cdc_cbn_ksxh
 * @property int $noitru
 * @property int $ngoaitru
 */
class Thongke extends App
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_thongke';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cabenh_id', 'chua_dt', 'dang_dt', 'chua_xv', 'da_dt', 'ca_tp', 'canhan', 'cachuyen', 'ca_phcd', 'kdc_pxk', 'kdc_qhk', 'kdc_tk', 'cdc_kbn_pxk', 'cdc_kbn_qhk', 'cdc_kbn_tk', 'cdc_cbn_sxh', 'cdc_cbn_ksxh', 'noitru', 'ngoaitru'], 'default', 'value' => null],
            [['cabenh_id', 'chua_dt', 'dang_dt', 'chua_xv', 'da_dt', 'ca_tp', 'canhan', 'cachuyen', 'ca_phcd', 'kdc_pxk', 'kdc_qhk', 'kdc_tk', 'cdc_kbn_pxk', 'cdc_kbn_qhk', 'cdc_kbn_tk', 'cdc_cbn_sxh', 'cdc_cbn_ksxh', 'noitru', 'ngoaitru'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cabenh_id' => 'Cabenh ID',
            'chua_dt' => 'Chua Dt',
            'dang_dt' => 'Dang Dt',
            'chua_xv' => 'Chua Xv',
            'da_dt' => 'Da Dt',
            'ca_tp' => 'Ca Tp',
            'canhan' => 'Canhan',
            'cachuyen' => 'Cachuyen',
            'ca_phcd' => 'Ca Phcd',
            'kdc_pxk' => 'Kdc Pxk',
            'kdc_qhk' => 'Kdc Qhk',
            'kdc_tk' => 'Kdc Tk',
            'cdc_kbn_pxk' => 'Cdc Kbn Pxk',
            'cdc_kbn_qhk' => 'Cdc Kbn Qhk',
            'cdc_kbn_tk' => 'Cdc Kbn Tk',
            'cdc_cbn_sxh' => 'Cdc Cbn Sxh',
            'cdc_cbn_ksxh' => 'Cdc Cbn Ksxh',
            'noitru' => 'Noitru',
            'ngoaitru' => 'Ngoaitru',
        ];
    }
}

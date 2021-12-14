<?php

namespace pcd\models;

use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "pg_ranhphuong".
 *
 * @property integer $gid
 * @property string $caphc
 * @property string $maphuong
 * @property string $maquan
 * @property string $tenphuong
 * @property string $tenquan
 * @property string $soho
 * @property string $tenphuong_
 * @property string $tenquan_en
 * @property string $geom
 */
class PgRanhphuong extends MyModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pg_ranhphuong';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['soho'], 'number'],
            [['geom'], 'string'],
            [['caphc', 'tenquan'], 'string', 'max' => 20],
            [['maphuong', 'maquan', 'tenphuong'], 'string', 'max' => 50],
            [['tenphuong_', 'tenquan_en'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gid' => Yii::t('app', 'Gid'),
            'caphc' => Yii::t('app', 'Caphc'),
            'maphuong' => Yii::t('app', 'Maphuong'),
            'maquan' => Yii::t('app', 'Maquan'),
            'tenphuong' => Yii::t('app', 'Tenphuong'),
            'tenquan' => Yii::t('app', 'Tenquan'),
            'soho' => Yii::t('app', 'Soho'),
            'tenphuong_' => Yii::t('app', 'Tenphuong'),
            'tenquan_en' => Yii::t('app', 'Tenquan En'),
            'geom' => Yii::t('app', 'Geom'),
        ];
    }
}

<?php
namespace pcd\models;
use common\models\MyModel;
use Yii;

/**
 * This is the model class for table "xuly_odsxh".
 *
 * @property integer $id
 * @property integer $odichsxh_id
 * @property integer $lanxl
 * @property string $tungaydlq
 * @property string $denngaydlq
 * @property integer $sotodlq
 * @property string $tentodlq
 * @property integer $sokhuphodlq
 * @property string $tenkhuphodlq
 * @property integer $sonhadukiendlq
 * @property integer $sonhaduocdlq
 * @property integer $truoc_bi
 * @property integer $truoc_ci
 * @property integer $truoc_hi
 * @property integer $sau_bi
 * @property integer $sau_ci
 * @property integer $sau_hi
 * @property string $tungayphc
 * @property string $denngayphc
 * @property integer $sotophc
 * @property string $tentophc
 * @property integer $sokhuphophc
 * @property string $tenkhuphophc
 * @property integer $sohodukienphc
 * @property integer $sohoduocphc
 * @property string $tenhc1
 * @property double $solithc1
 * @property string $tenhc2
 * @property double $solithc2
 * @property double $tyle
 */
class XulyOdsxh extends App
{
    protected $dates = ['ngayxuly', 'tungaydlq', 'denngaydlq', 'tungayphc', 'denngayphc'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'xuly_odsxh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['odichsxh_id', 'lanxl', 'sotodlq', 'sokhuphodlq', 'sonhadukiendlq', 'sonhaduocdlq', 'truoc_bi', 'truoc_ci', 'truoc_hi', 'sau_bi', 'sau_ci', 'sau_hi', 'sotophc', 'sokhuphophc', 'sohodukienphc', 'sohoduocphc'], 'integer'],
            [['tungaydlq', 'denngaydlq', 'tungayphc', 'denngayphc'], 'safe'],
            [['tentodlq', 'tenkhuphodlq', 'tentophc', 'tenkhuphophc', 'tenhc1', 'tenhc2'], 'string'],
            [['solithc1', 'solithc2', 'tyle'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Mã xử lý'),
            'odichsxh_id' => Yii::t('app', 'Mã ổ dịch'),
            'lanxl' => Yii::t('app', 'Lần xử lý'),
            'tungaydlq' => Yii::t('app', 'Từ ngày DLQ'),
            'denngaydlq' => Yii::t('app', 'Đến ngày DQL'),
            'sotodlq' => Yii::t('app', 'Số tổ DLQ'),
            'tentodlq' => Yii::t('app', 'Tên tổ DLQ'),
            'sokhuphodlq' => Yii::t('app', 'Số khu phố DLQ'),
            'tenkhuphodlq' => Yii::t('app', 'Tên khu phố DLQ'),
            'sonhadukiendlq' => Yii::t('app', 'Số nhà dự kiến DLQ'),
            'sonhaduocdlq' => Yii::t('app', 'Số nhà được DLQ'),
            'truoc_bi' => Yii::t('app', 'Chỉ số trước phun BI'),
            'truoc_ci' => Yii::t('app', 'Chỉ số trước phun CI'),
            'truoc_hi' => Yii::t('app', 'Chỉ số trước phun HI'),
            'sau_bi' => Yii::t('app', 'Chỉ số sau phun BI'),
            'sau_ci' => Yii::t('app', 'Chỉ số sau phun CI'),
            'sau_hi' => Yii::t('app', 'Chỉ số sau phun HI'),
            'tungayphc' => Yii::t('app', 'Từ ngày PHC'),
            'denngayphc' => Yii::t('app', 'Đến ngày PHC'),
            'sotophc' => Yii::t('app', 'Số tổ PHC'),
            'tentophc' => Yii::t('app', 'Tên tổ PHC'),
            'sokhuphophc' => Yii::t('app', 'Số khu phố PHC'),
            'tenkhuphophc' => Yii::t('app', 'Tên khu phố PHC'),
            'sohodukienphc' => Yii::t('app', 'Số hộ dự kiến PHC'),
            'sohoduocphc' => Yii::t('app', 'Số hộ được PHC'),
            'tenhc1' => Yii::t('app', 'Tên HC 1'),
            'solithc1' => Yii::t('app', 'Số lít HC 1'),
            'tenhc2' => Yii::t('app', 'Tên HC 2'),
            'solithc2' => Yii::t('app', 'Số lít HC 2'),
            'tyle' => Yii::t('app', 'Tỷ lệ hộ dân mở cửa'),
        ];
    }

    public function getOdichSxh()
    {
        return $this->hasOne(OdichSxh::className(), ['id' => 'odichsxh_id']);
    }

}

<?php
namespace app\models;

use gsnc\models\App;

/**
 * This is the model class for table "baocao_cln".
 *
 * @property int $id
 */
class BaocaoCln extends App
{
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

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }
}

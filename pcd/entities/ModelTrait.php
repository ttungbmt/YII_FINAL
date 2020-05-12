<?php
/**
 * Created by PhpStorm.
 * User: ttungbmt
 * Date: 06/03/2016
 * Time: 11:27
 */

namespace pcd\entities;


Trait ModelTrait
{
    public static function firstOrFail($id){
        $tableName = parent::tableName();

        if(is_numeric($id) && ($model = parent::findOne($id)) !== null)
        {
            return $model;
        }
        else if(is_array($id) && ($model = parent::find()->where($id)->one()) !== null){
            return $model;
        }
        else {
            throw new \Exception('Không tìm thấy dữ liệu: ('.json_encode($id).') trong bảng "'.$tableName.'"');
        }
    }

    public function formatDate($toDate = 'd/m/Y', $fromDate = 'Y-m-d'){

        foreach($this->dates as $date){


            if(isset($this->$date) && $this->$date && validateDate($this->$date, $fromDate)){
                $this->$date = convertDate($this->$date, $toDate, $fromDate);
            }
        }
        return $this;

    }

}
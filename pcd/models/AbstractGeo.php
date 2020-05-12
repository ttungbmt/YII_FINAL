<?php

namespace pcd\models;

use common\models\MyModel;
use yii\helpers\StringHelper;

class AbstractGeo extends MyModel
{
    public $geo_x;
    public $geo_y;
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        $id = $this->primaryKey()[0];
        $tablename = $this->tableSchema->name;

        if (!$this->_initGeo()) {
            if($tablename == 'cabenh'){
                $sql = "update $tablename set geom = null where $id = {$this->$id}";
                \Yii::$app->db->createCommand($sql)->execute();
                return;
            }
            return;
        }
        // Add function to save geo props
//        $this->geom = new Expression("st_geomfromtext('POINT({$this->geo_y} {$this->geo_x})', 4326)");
//        dd($this->save());

        $sql = "update $tablename set geom = st_geomfromtext('POINT({$this->geo_y} {$this->geo_x})', 4326) where $id = {$this->$id}";
        $command = \Yii::$app->db->createCommand($sql);
        $command->execute();
    }

    protected function _initGeo() {
        $classname = 'V'.StringHelper::basename(self::className()) . '1';
        $data = \Yii::$app->request->post();


        if (!isset($data['vPhieuSxh'])) {
            return false;
        } else {
            $this->geo_y = $data['vPhieuSxh']['geo_x'];
            $this->geo_x = $data['vPhieuSxh']['geo_y'];

            return $this->geo_x && $this->geo_x ?: false;
        }


        if (!isset($data[$classname])) {
            return false;
        } else {
            $this->geo_x = $data[$classname]['geo_x'];
            $this->geo_y = $data[$classname]['geo_y'];

            return true;
        }

    }
}

<?php

namespace pcd\services;

use Yii;
use yii\data\SqlDataProvider;

/**
 * Contains function for database excution
 *
 * @author TriLVH
 */
class DbService {

    public static $_DEPENDEDS = [
        'don' => ['id' => 'id_don', 'child' => ['bao_cao_danh_gia', 'tb_don', 'dm_tai_lieu', 'nv_don', 'gia_han', 'cap_moi', 'bo_sung', 'cap_lai', 'giay_phep']],
        'bao_cao_danh_gia' => ['id' => 'id_bcdg', 'child' => ['dm_tai_lieu']],
        'dm_tai_lieu' => ['id' => 'id_tl', 'child' => []],
        'tb_don' => ['id' => 'id_tb', 'id2' => 'id_don', 'child' => []],
        'nv_don' => ['id' => 'id_nv', 'id2' => 'id_don', 'child' => []],
        'gia_han' => ['id' => 'id_don', 'child' => []],
        'cap_lai' => ['id' => 'id_don', 'child' => []],
        'cap_moi' => ['id' => 'id_don', 'child' => []],
        'bo_sung' => ['id' => 'id_don', 'child' => []],
        'giay_phep' => ['id' => 'id_gp', 'child' => ['tb_gp', 'nv_gp']],
        'tb_gp' => ['id' => 'id_tb', 'id2' => 'id_gp', 'child' => []],
        'nv_gp' => ['id' => 'id_nv', 'id2' => 'id_gp', 'child' => []],
    ];
    public static $modelpath = '\\pcd\\models\\';

    public static function deleteDeep($tablename, $ids) {
        $idname = self::$_DEPENDEDS[$tablename]['id'];
        self::_deleteDeep($tablename, $ids);
        DbService::execute("delete from $tablename where $idname in  $ids");
    }

    protected static function _deleteDeep($tablename, $ids) {
        // Get table depend model
        $depend = self::$_DEPENDEDS[$tablename];
        $parentid = $depend['id'];
        $childs = $depend['child'];
        // Check valid childs
        if (UtilsService::checkValidArray($childs)) {
            // Loop in child to delete with parent id
            foreach ($childs as $index => $child) {
                // Find all model of child which match parent id
                $models = DbService::getModelsByProp($child, "$parentid in $ids");
                $childidname = self::$_DEPENDEDS[$child]['id'];
                // Check if list models exist
                if (UtilsService::checkValidArray($models)) {
                    // Get list ids of child
                    $idsofchild = self::getSQLArrayFromModels($models, $childidname);
                    // Recursive in child of child
                    self::deleteDeep($child, $idsofchild);
                    // Delete all record of child match parent id
                    DbService::execute("delete from $child where $childidname in $idsofchild");
                }
            }
        }
    }

    public static function getSQLArrayFromModels($models, $idname) {
        $ids = UtilsService::getSubArrayFromHash($models, $idname);
        $strids = implode("','", $ids);
        return "('$strids')";
    }

    /**
     * Convert array as $key=>$value to ActiveRecord object
     * @param type $modelClass class of ActiveRecord in \pcd\models
     * @param type $array array contain $key=>$value
     * @param type $model init model: allow null
     * @param type $contains if key name contains
     * @return type ActiveRecord with model from array
     */
    public static function convertArrayToModel($modelClass, $array, $model, $contains = null) {
        $mdClass = self::$modelpath . $modelClass;
        // Check if model is new or need to updated
        $model = isset($model) ? $model : new $mdClass;
        // Loop in array and check $key exist in model's properties.
        foreach ($array as $key => $value) {
            $tmpkey = $key;
            if ($contains !== null) {
                $pos = strrpos($tmpkey, $contains);
                if ($pos !== false) {
                    $tmpkey = substr($tmpkey, 0, $pos);
                }
            }
            if (gettype($value) == 'string' && UtilsService::validateDate($value)) {
                $value = UtilsService::convertDate($value);
            }
            if ($model->hasAttribute($tmpkey)) {
              isset($model->{$tmpkey}) && in_array($tmpkey, $mdClass::primaryKey()) ? true : $model->{$tmpkey} = $value;
            } else if ($model->hasAttribute($key)) {
              isset($model->{$tmpkey}) && in_array($key, $mdClass::primaryKey()) ? true : $model->{$key} = $value;
            }
        }
        return $model;
    }

    /**
     * Excute SQL Statement to return list of models
     * @param type $sql
     * @return type
     */
    public static function getModels($sql, $params = []) {
        $provider = new SqlDataProvider([
            'sql' => $sql,
            'params' => self::convertToParamsString($params),
            'pagination' => false
        ]);
        return $provider->getModels();
    }

    /**
     * Convert param hash map to param hash map with ':' on first
     * @param string $params
     * @return string
     */
    private static function convertToParamsString($params) {
        $result = '';
        foreach ($params as $index => $param) {
            if ($index[0] != ':') {
                $result[':' . $index] = $param;
            } else {
                $result[$index] = $param;
            }
        }
        return $result;
    }

    /**
     * Excute SQL statement to return model
     * @param type $sql 
     * @return type return null if model not exist
     */
    public static function getModel($sql) {
        $models = self::getModels($sql);
        return UtilsService::getFirst($models);
    }

    /**
     * Get models by modelclass and hash of prop=>value
     * @param type $modelclass
     * @param type $hash
     */
    public static function getModelsByHash($modelclass, $hash, $more = '', $params = []) {
        $mdClass = self::$modelpath . $modelclass;
        $tablename = $mdClass::tableName();

        $compare = self::getCompareStringByHash($mdClass, $hash);

        $start = UtilsService::getArrayValue($hash, 'start', 0);
        $length = UtilsService::getArrayValue($hash, 'length', 10);
        $order = UtilsService::getVar('order by ', UtilsService::getArrayValue($hash, 'orderby'), '');

        $result = [];
        $compare = "$compare $more $order";
        $result['data'] = DbService::getModelsByProp($tablename, "$compare limit $length offset $start", $params);
        $query = "select count(*) from $tablename where $compare";
        $result['total'] = DbService::getValue($query);

        //return $compare;
        return $result;
    }

    /**
     * 
     * @param type $mdClass
     * @param type $hash
     * @return type
     */
    public static function getCompareStringByHash($mdClass, $hash) {
        $compare = '1 = 1';
        $model = new $mdClass;
        foreach ($hash as $key => $value) {
            if ($model->hasAttribute($key)) {
                if ($value !== '') {
                    //$value = UtilsService::convertViToEn($value, true);
                    $compare .= " and $key like '%$value%'";
                }
            }
        }
        return $compare;
    }

    /**
     * Get models by tablename and where statement
     * @param type $tablename name of table in database
     * @param type $compare where statement
     * @return type
     */
    // DbService::getModelsByProp('don_vi', 'id_don > 5');
    public static function getModelsByProp($tablename, $compare, $params = []) {
        $sql = "select * from $tablename where $compare";
        return self::getModels($sql, $params);
    }

    /**
     * Get model by tablename and where statement
     * @param type $tablename name of table in database
     * @param type $compare where statement
     * @return type
     */
    public static function getModelByProp($tablename, $compare, $params = []) {
        $models = self::getModelsByProp($tablename, $compare, $params);
        return UtilsService::getFirst($models);
    }

    /**
     * Save hashmap of model to database
     * @param type $modelClass
     * @param type $array
     * @return type
     */
    public static function saveModel($modelClass, &$array, $modelold = null) {
        $model = self::convertArrayToModel($modelClass, $array, $modelold);

        $pk = $model->getPrimaryKey();
        $fullpath = self::$modelpath . $modelClass;

        // Check if object have 1 pk
        if (!is_array($pk)) {
            if (UtilsService::checkValidData($pk)) {
                $model = $fullpath::findOne($model->getPrimaryKey());
                $model = self::convertArrayToModel($modelClass, $array, $model);
            } else {
                $model->setIsNewRecord(true);
            }
        } else { // Check if obj have 2 pks
            $tmp = $fullpath::findOne($model->attributes);
            if (isset($tmp)) {
                $tmp->delete();
            }
        }

        $model->save();
        
        return $model;
    }

    /**
     * insert array of model
     * @param type $modelClass
     * @param type $array
     * @param type $idname
     * @param type $idvalue
     * @return type
     */
    public static function saveModels($modelClass, &$array, $idname, $idvalue) {
        $fullpath = self::$modelpath . $modelClass;
        $tablename = $fullpath::tableName();

        if (isset($idvalue)) {
            self::execute("delete from $tablename where $idname = :value", [':value' => $idvalue]);
        }

        if (UtilsService::checkvalidArray($array)) {
            $sql = 'insert into ' . $tablename . ' ' . self::convertArrayToInsertSQL($array);
            DbService::execute($sql);
        }
    }

    /**
     * 
     * @param type $array
     * @return string
     */
    public static function convertArrayToInsertSQL($array) {
        $values = '';
        $counter = 0;
        $lastobj = null;

        foreach ($array as $id => $obj) {
            $objsql = implode("','", $obj);
            $values .= $counter > 0 ? ',' : '';
            $values .= "('$objsql')";
            $counter++;
            $lastobj = $obj;
        }

        $result = "";
        if ($lastobj !== null) {
            $keys = implode(",", array_keys($lastobj));
            $result = "($keys) values " . $values;
        }

        return $result;
    }

    /**
     * 
     * @param type $modelClass
     * @param type $id
     * @return type
     */
    public static function deleteModel($modelClass, $id) {
        $fullmodel = self::$modelpath . $modelClass;
        $model = $fullmodel::findOne($id);
        return $model->delete();
    }

    /**
     * Get value of query which return 
     * @param type $sql
     * @return type
     */
    public static function getValue($sql) {
        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

    /**
     * 
     * @param string $pcclass
     * @param type $parentclass
     * @param type $childclass
     * @param type $compare
     * @param type $parentaddon
     * @param type $childaddon
     * @return type
     */
    public static function getModelsWithChilds($pcclass, $parentclass, $parentkey, $childclass, $compare, $parentaddon = [], $childaddon = [], $childname = '', $contains = null, $childkey = null) {
        $cclass = self::$modelpath . $childclass;
        $pcclass = self::$modelpath . $pcclass;
        $prclass = self::$modelpath . $parentclass;

        $childtable = $cclass::tableName();
        $childname = empty($childname) ? $childtable . 's' : $childname;
        $pctable = $pcclass::tableName();

        $parents = DbService::getModelsByProp($pctable, $compare);

        $mdparent = new $prclass;
        $mdchild = new $cclass;

        $result = [];
        $prekey = '';
        $counter = -1;
        $childcounter = 0;
        foreach ($parents as $index => $parent) {
            $mdparent = DbService::convertArrayToModel($parentclass, $parent, null);
            if ($prekey != $parent[$parentkey]) {
                $counter++;
                $result[$counter] = $mdparent->attributes;
                $result[$counter] = UtilsService::cloneItems($result[$counter], $parent, $parentaddon);
                $result[$counter][$childname] = [];
                $prekey = $parent[$parentkey];
                $childcounter = 0;
            }
            $mdchild = DbService::convertArrayToModel($childclass, $parent, null, $contains);
            if (isset($childkey) && isset($mdchild->attributes[$childkey]) || !isset($childkey)) {
                $result[$counter][$childname][$childcounter] = $mdchild->attributes;
                $result[$counter][$childname][$childcounter] = UtilsService::cloneItems($result[$counter][$childname][$childcounter], $parent, $childaddon);
                $childcounter++;
            }
        }

        return $result;
    }

    /**
     * Convert 
     * @param type $sql
     * @param type $params
     */
    public static function execute($sql, $params = []) {
        Yii::$app->db->createCommand($sql, self::convertToParamsString($params))->execute();
    }

}

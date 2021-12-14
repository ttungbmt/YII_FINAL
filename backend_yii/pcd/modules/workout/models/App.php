<?php
namespace pcd\modules\workout\models;

use common\models\MyModel;

class App extends MyModel {
    public function fields()
    {
        $fields = parent::fields();
        unset($fields['geometry']);
        return $fields;
    }
}
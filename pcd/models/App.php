<?php
namespace pcd\models;

use common\models\MyModel;
use yii2tech\spreadsheet\Spreadsheet;

class App extends MyModel
{
    public static function find()
    {
        return new AppQuery(get_called_class());
    }

    public function exportData($dataProvider) {
        $exporter = new Spreadsheet([
            'dataProvider' => $dataProvider,
            'columns'      => $this->getColumns(),
        ]);

        return $exporter->send('danhsach.xls');
    }
}
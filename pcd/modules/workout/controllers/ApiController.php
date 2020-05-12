<?php
namespace pcd\modules\workout\controllers;

use pcd\modules\workout\models\BodyPart;
use pcd\modules\workout\models\Equip;
use pcd\modules\workout\models\Exercise;
use pcd\modules\workout\models\Mode;

class ApiController extends \common\controllers\ApiController {


    public function actionExercise($id = null){
        $model = Exercise::find()->with(['bodyPart', 'mode'])->asArray()->all();
        if($id) return Exercise::find()->with(['equip', 'bodyPart', 'mode'])->andWhere(['id' => $id])->asArray()->one();
        $equip = Equip::find()->all();
        $mode = Mode::find()->all();
        $bodyPart = BodyPart::find()->select(['id', 'title'])->asArray()->all();


        return [
            'data' => [
                'exercise' => $model,
                'equip' => $equip,
                'bodyPart' => $bodyPart,
            ]
        ];
    }

    public function actionBodyPart($id = null){
        $model = BodyPart::find()->all();
        if($id) return BodyPart::find()->with(['equip', 'bodyPart'])->andWhere(['id' => $id])->asArray()->one();

        return [
            'data' => $model
        ];
    }

    public function actionAddFavorite(){
        $id = request('id');
        $bool = request('bool');

        $model = Mode::find()->andWhere(['mode' => 'Favorites', 'exercise_id' => $id])->one();
        if(!$model) {
            $model = new Mode(['mode' => 'Favorites', 'exercise_id' => $id]);
        }

        $status = $bool ? $model->save() : $model->delete();

        return [
            'status' => $status ? 'OK' : 'FAIL',
            'model' => Exercise::find()->andWhere(['id' => $id])->with('mode')->asArray()->one()
        ];
    }

    public function actionSave($id = null){
        $data = request()->all();
        dd($data);
    }
}
<?php
namespace pcd\modules\workout\controllers\api;
use common\controllers\ApiController;
use Illuminate\Support\Arr;
use pcd\modules\workout\models\BodyPart;
use pcd\modules\workout\models\Equip;
use pcd\modules\workout\models\Exercise;
use pcd\modules\workout\models\Muscle;
use pcd\modules\workout\models\Workout;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class WorkoutController extends ApiController {
    public function actionView($id = null){
        $model = Workout::find()->with(['exercises'])->asArray()->all();
//        if($id) return [
//            'data' => Workout::find()->with(['exercises.equip', 'exercises.bodyPart'])->andWhere(['id' => $id])->orderBy('id')->asArray()->one()
//        ];

        return [
            'data' => $model
        ];
    }

    public function actionIndex(){
        $wo = Workout::find()->with(['exIds'])->orderBy('id')->asArray()->all();
        $ex = Exercise::find()->with(['mode', 'primaryMusl', 'secondaryMusl'])->orderBy(['id' => SORT_ASC])->all();
        $bodyPart = BodyPart::find()->alias('bd')->select('bd.id, bd.title, bd.img, count(*) as exCount')->leftJoin(['pl' => 'wk_body_part_poly'], 'bd.id=pl.body_part_id')->groupBy(new Expression('1'))->asArray()->all();
        $equip = Equip::find()->asArray()->all();
        $musle = Muscle::find()->asArray()->all();

        return [
            'data' => [
                'exercise' => ArrayHelper::toArray($ex, [Exercise::className() => [
                    'id', 'title', 'link', 'equip_id', 'musl_img', 'mode', 'thumbnail', 'bodyPart',
                    'primaryMusl' => function($model){
                        return data_get($model->primaryMusl, '0.id');
                    },
                    'secondaryMusl' => function($model){
                        return Arr::pluck($model->secondaryMusl, 'id');
                    },
                ]]),
                'bodyPart' => $bodyPart,
                'equip' => $equip,
                'workout' => $wo,
                'muscle' => $musle
            ]
        ];
    }

    public function actionDeleteExByWo(){
        $ex_id = request('ex_id');
        $wo_id = request('wo_id');
        $command = Yii::$app->db->createCommand();

        $command->delete('wk_workout_poly', ['workout_id' => $wo_id, 'exercise_id' => $ex_id])->execute();

        return [
            'status' => 'OK'
        ];
    }

    public function actionAddTo(){
        $workout_ids = request('workout_ids', []);
        $exercise_id = request('exercise_id');
        $command = Yii::$app->db->createCommand();

        $data = [];
        foreach ($workout_ids as $id){
            $data[] = [$id, $exercise_id];
        }

        $command->batchInsert('wk_workout_poly', ['workout_id', 'exercise_id'], $data)->execute();

        return [
            'status' => 'OK'
        ];
    }

    public function actionSave($id = null){
        $data = request()->all();
        $model = $id ? Workout::findOne($id) : new Workout();
        $model->fillable($data);

        return [
            'status' => $model->save() ? 'OK' : 'FAIL',
            'data' => $model
        ];
    }
}
<?php

namespace app\controllers;

use app\controllers\ApiController;
use app\models\Task;
use Yii;

class TaskController extends ApiController
{
    public $modelClass = Task::class;

    protected function prepareDataProvider()
    {
        $currentUserId = Yii::$app->user->id;

        $query = \app\models\Task::find();

        $query->where([
            'OR',
            ['user_id' => $currentUserId],
            ['assigned_to_id' => $currentUserId],
            ['validated_by_id' => $currentUserId]
        ]);

        return new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
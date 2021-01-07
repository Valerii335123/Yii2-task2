<?php

namespace app\modules\admin;

use app\models\User;
use Yii;

class Module extends \yii\base\Module
{

    public $controllerNamespace = 'app\modules\admin\controllers';

    public function init()
    {
        parent::init();

        if (!Yii::$app->user->isGuest) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            if ($user->role == 0)
                return Yii::$app->response->redirect(['site/']);
        } else
            return Yii::$app->response->redirect(['site/']);


    }
}

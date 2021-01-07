<?php

namespace app\modules\admin\controllers;

use app\models\searchModel\UserSearch;
use app\models\User;
use yii\web\Controller;
use Yii;

class DefaultController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionChange_role($id)
    {
        $user = User::findOne(['id' => $id]);
        $user->role = $user->role ? 0 : 1;
        $user->save();
        return $this->redirect('index');
    }

    public function actionChange_active($id)
    {
        $user = User::findOne(['id' => $id]);
        $user->active = $user->active ? 0 : 1;
        $user->save();
        return $this->redirect('index');
    }
}

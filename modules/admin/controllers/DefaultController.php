<?php

namespace app\modules\admin\controllers;

use app\models\searchModel\UserSearch;
use app\models\service\UserService;
use yii\web\Controller;
use Yii;

class DefaultController extends Controller
{
    private $userService;

    public function __construct($id, $module, UserService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userService = $service;
    }

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
        $this->userService->changeRole($id);

        return $this->redirect('index');
    }

    public function actionChange_active($id)
    {
        $this->userService->changeActive($id);

        return $this->redirect('index');
    }
}

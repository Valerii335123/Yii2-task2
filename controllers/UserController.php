<?php

namespace app\controllers;

use app\models\forms\LoginForm;
use app\models\forms\Registration;
use yii\filters\AccessControl;
use yii\web\Controller;
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'create','signup','login','logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [ 'create','logout'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login','signup','index'],
                        'roles' => ['?'],
                    ],
                ],
            ],

        ];
    }
    public function actionIndex()
    {
        $this->redirect('login');
    }

    public function actionLogin()
    {
        $login=new LoginForm();
        return $this->render('index',[
            'model'=>$login
        ]);
    }

    public function actionRegistration()
    {
        $registration=new Registration();
        return $this->render('index',[
            'model'=>$registration
        ]);
    }

}

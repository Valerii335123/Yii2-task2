<?php

namespace app\controllers;

use app\models\service\UserService;
use app\models\User;
use Yii;
use app\models\forms\LoginForm;
use app\models\forms\Registration;
use yii\filters\AccessControl;
use yii\web\Controller;

class UserController extends Controller
{
    private $userService;

    public function __construct($id, $module, UserService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userService = $service;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'registration', 'login', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                        'denyCallback' => function () {

                            return $this->redirect('site/index');
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login', 'index', 'registration'],
                        'roles' => ['?'],

                    ],
                ],
            ],

        ];
    }

    public function actionIndex()
    {
        $this->redirect('user/login');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $login = new LoginForm();

        if ($login->load(Yii::$app->request->post()) && $login->validate()) {
            if ($this->userService->login($login)) {

                return $this->goHome();
            }
        }

        $login->login = '';
        $login->pass = '';

        return $this->render('login', [
            'model' => $login,
        ]);
    }

    public function actionRegistration()
    {
        $registration = new Registration();

        if ($registration->load(Yii::$app->request->post()) && $registration->validate()) {
            $this->userService->registration($registration);

            return $this->goHome();
        }

        return $this->render('registration', [
            'model' => $registration
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

<?php

namespace app\controllers;

use app\models\User;
use Yii;
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
                'only' => ['index', 'registration', 'login', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
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
        $message = '';

        if ($login->load(Yii::$app->request->post()) && $login->validate()) {
            $user = User::findByLogin($login->login);

            if (!$user || !$user->validatePassword($login->pass)) {
                $message = 'Undefined user or pass';

            } elseif (!$user->active) {
                $message = 'User is banned';
            } else {
                Yii::$app->user->login($user, 3600 * 24);
                return $this->goHome();
            }

        }

        $login->login = '';
        $login->pass = '';

        return $this->render('login', [
            'model' => $login,
            'message' => $message
        ]);
    }

    public function actionRegistration()
    {
        $registration = new Registration();

        if ($registration->load(Yii::$app->request->post()) && $registration->validate()) {
            $user = new User();
            $user->registration($registration);
            $user->save();
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

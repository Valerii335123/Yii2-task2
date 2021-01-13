<?php

namespace app\models\service;

use Yii;
use app\models\forms\LoginForm;
use app\models\repository\UserRepository;
use app\models\forms\Registration;
use app\models\User;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registration(Registration $registration)
    {
        $user = new User();
        $user->registration($registration);

        $this->userRepository->save($user);
    }

    public function login(LoginForm $loginForm)
    {
        $user = $this->userRepository->findByLogin($loginForm->login);

        if (!$user || !$user->validatePassword($loginForm->pass)) {
            throw new \Exception('Undefined login or pass');

        } elseif (!$user->active) {
            throw new \Exception('User is banned');

        } else {
            return Yii::$app->user->login($user, 3600 * 24);
        }
    }

    public function changeRole($id)
    {
        $user = $this->userRepository->getById($id);
        $user->role = $user->role ? User::ROLE_USER : User::ROLE_ADMIN;
        $this->userRepository->save($user);
    }

    public function changeActive($id)
    {
        $user = $this->userRepository->getById($id);
        $user->active = $user->active ? User::USER_INACTIVE : User::USER_ACTIVE;
        $this->userRepository->save($user);
    }
}


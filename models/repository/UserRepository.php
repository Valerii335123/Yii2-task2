<?php

namespace app\models\repository;

use app\models\User;

class UserRepository
{
    public function save(User $user)
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function findByLogin($login)
    {
        return User::findOne(['login' => $login]);
    }

    public function getById($id)
    {
        $user = User::findOne($id);
        if ($user == null) {
            throw new \DomainException('User is not found');
        }
        return $user;
    }
}


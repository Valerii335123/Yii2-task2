<?php

namespace app\models\forms;

use yii\base\Model;

class LoginForm extends Model
{
    public $login;
    public $pass;

    public function rules()
    {
        return [
            [['login','pass'],'required'],
            [['login'], 'string', 'min'=>3,'max' => 255],
            [['pass'], 'match', 'pattern' => '/(?=.*[0-9])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/', 'skipOnError' => true],
            ['confirm_pass', 'compare', 'compareAttribute' => 'pass'],
        ];
    }
}
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


        ];
    }
}
<?php

namespace app\models\forms;

use yii\base\Model;

class Registration extends Model
{
    public $login;
    public $pass;
    public $confirm_pass;

    public function rules()
    {
        return [

            [['login'], 'string', 'max' => 255],
            [['pass'], 'match', 'pattern' => '/(?=.*[0-9])(?=.*[A-Z])[  0-9a-zA-Z!@#$%^&*]{6,}/', 'skipOnError' => true],
            ['confirm_pass', 'compare', 'compareAttribute' => 'pass'],
        ];
    }

}

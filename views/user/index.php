<?php
/* @var $this yii\web\View */

use app\models\forms\LoginForm;
use app\models\forms\Registration;
use yii\helpers\Html;

?>
<h1>user/index</h1>


<? if (isset($model)) {

    if ($model instanceof Registration) {
        echo html::a('Login', 'index', ['class' => 'h1']);

        echo $this->render('_registration', [
            'model' => $model
        ]);
    }

    elseif ($model instanceof LoginForm) {
        echo html::a('Registration', 'registration', ['class' => 'h1']);

        echo $this->render('_login', [
            'model' => $model
        ]);
    }
}

?>




<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="row">
    <?= html::label($message, ['class' => 'h2']) ?>
</div>

<div class="user-login">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'login') ?>
    <?= $form->field($model, 'pass') ?>

    <div class="form-group">
        <div class="row">
            <div class="col col-lg-1">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
            </div>

            <div class="col col-lg-2">
                <?= html::a('Registration', ['user/registration'], ['class' => ' btn btn-link ']); ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

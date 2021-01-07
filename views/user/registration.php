<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="user-login">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'login') ?>
    <?= $form->field($model, 'pass') ?>
    <?= $form->field($model, 'confirm_pass') ?>

    <div class="form-group">
        <div class="row">
            <div class="col col-lg-1">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>

            <div class="col col-lg-2">
                <?= html::a('Login', ['user/login'], ['class' => 'btn btn-link']); ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
